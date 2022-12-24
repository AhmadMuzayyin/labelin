<?php

namespace App\Http\Controllers\Api;

use App\Models\QrCode;
use App\Models\Report;
use App\Models\Sosmed;
use App\Models\RequestQr;
use App\Models\SettingWeb;
use App\Models\ProdukRating;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ScanProdukController extends Controller
{
    private $settings;

    public function __construct()
    {
        $settings = SettingWeb::first();
        $this->settings = $settings;
    }
    public function scan($id)
    {
        if ($this->settings->is_aktif_website === 'T') {
            return response()->json([
                'message' => 'website is under maintenance',
                'status' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'get serial number successfully',
            'status' => 200,
            'content' => $id
        ], 200);
    }
    public function verify(Request $request)
    {
        // if ($request->isMethod('PUT') || $request->isMethod('GET') || $request->isMethod('PATCH') || $request->isMethod('DELETE') || $request->isMethod('OPTION')) {
        //     return response()->json([
        //         'message' => 'method not allowed',
        //         'status' => 405,
        //         'content' => ''
        //     ], 405);
        // }
        $validator = Validator::make($request->all(), [
            'latitude' => ['required'],
            'longitude' => ['required'],
            'serial_number' => 'required|string',
            'pin' => 'required|min:6|numeric',
            'ipAddress' => 'required|ipv4'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'errors input',
                'status' => 200,
                'content' => $validator->errors()
            ], 200);
        }
        $pin = $request->pin;
        $cek = DB::table('qr_codes')
            ->where('pin', '=', $pin)
            ->where('serial_number', '=', $request->serial_number)
            ->first();
        // get ipv4 address client
        $ipClient = $request->ipAddress;
        // ambil data produk
        if ($cek) {
            $produk = DB::table('qr_codes')
                ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                ->join('products', 'request_qrs.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('businesses', 'products.business_id', '=', 'businesses.id')
                ->where('qr_codes.serial_number', $request->serial_number)
                ->where('qr_codes.pin', $pin)
                ->select('products.name as nama_produk', 'categories.name as nama_kategori', 'businesses.logo as logo_brand', 'businesses.brand as nama_brand', 'products.bpom', 'products.photo', 'products.id', 'products.netto', 'products.expired_date', 'products.production_code')
                ->first();

            // cek duplicate data
            $duplicate = ProductScanned::where('qr_code_id', $cek->id)->first();
            if ($duplicate) {
                $get_QR = $duplicate->load('qr_code');
                if ($get_QR) {
                    if ($get_QR->qr_code->status == true) {
                        //inser ke table scan
                        $getVisitor = ProductScanned::where('qr_code_id', $cek->id)->where('visitor', $ipClient)->first();
                        if (isset($getVisitor)) {
                            if ($getVisitor->visitor != $ipClient) {
                                DB::table('product_scanneds')->insert([
                                    'qr_code_id' => $cek->id,
                                    'lat' => $request->latitude,
                                    'long' => $request->longitude,
                                    'visitor' => $ipClient,
                                    'created_at' => date('Y-m-d H:i:s'),
                                ]);
                            }
                        } else {
                            DB::table('product_scanneds')->insert([
                                'qr_code_id' => $cek->id,
                                'lat' => $request->latitude,
                                'long' => $request->longitude,
                                'visitor' => $ipClient,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
                        return response()->json([
                            'message' => 'Serial number terdaftar',
                            'status' => 200,
                            'content' => [
                                'serial_number' => $request->serial_number,
                                'pin' => $pin,
                                'product' => $produk,
                                'duplicate' => $duplicate
                            ]
                        ], 200);
                    }
                }
            }

            //inser ke table scan
            $getVisitor = ProductScanned::where('qr_code_id', $cek->id)->where('visitor', $ipClient)->first();
            if (isset($getVisitor)) {
                if ($getVisitor->visitor != $ipClient) {
                    DB::table('product_scanneds')->insert([
                        'qr_code_id' => $cek->id,
                        'lat' => $request->latitude,
                        'long' => $request->longitude,
                        'visitor' => $ipClient,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } else {
                DB::table('product_scanneds')->insert([
                    'qr_code_id' => $cek->id,
                    'lat' => $request->latitude,
                    'long' => $request->longitude,
                    'visitor' => $ipClient,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            // get sosmed link
            $getPartnerId = RequestQr::firstWhere('id', $cek->request_qr_id);
            $sosmed = Sosmed::where('partner_id', $getPartnerId->partner_id)->get();
            $rating = DB::table('produk_ratings')->where('product_id', $produk->id)->where('visitor', $ipClient)->first();
            $getProdukRating = ProdukRating::where('product_id', $produk->id)->get('produk_rated');
            $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
            return response()->json([
                'message' => 'Serial Number Terdaftar',
                'status' => 200,
                'content' => [
                    'serial_number' => $request->serial_number,
                    'pin' => $pin,
                    'product' => $produk,
                    'link_official' => $sosmed,
                    'rating_status' => $rating != null ? true : false,
                    'product_rating' => isset($getProdukRating) ? $produk_rating : 0
                ]
            ], 200);
        } else {
            return response()->json([
                'message' => 'Produk tidak terdaftar',
                'status' => 200,
                'content' => ['serial_number' => $request->serial_number, 'pin' => $pin],
            ], 200,);
        }
    }

    public function rating(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'ipAddress' => 'required|ipv4',
            'rating' => 'required|numeric',
            'serial_number' => 'required|string|min:5|max:10'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'errors input',
                'status' => 200,
                'content' => $validator->errors()
            ], 200);
        }
        $produk = QrCode::join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->where('qr_codes.serial_number', $req->serial_number)
            ->select('products.id')
            ->first();
        $cek = ProdukRating::where('product_id', $produk->id)->where('visitor', $req->ipAddress)->first();
        if (!isset($cek)) {
            DB::table('produk_ratings')->insert([
                'product_id' => $produk->id,
                'produk_rated' => $req->rating,
                'visitor' => $req->ipAddress,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        $getProdukRating = ProdukRating::where('product_id', $produk->id)->get('produk_rated');
        $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
        $respon = [
            'message' => $cek->visitor == $req->ipAddress && $produk->id == $cek->product_id ? 'Terimkasih, anda sudah melakukan rating' : 'Terimakasih atas rating anda',
            'status' => 200,
            'content' => $produk_rating,
        ];
        return response()->json($respon, 200);
    }

    public function report(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'serial_number' => 'required|string|min:5|max:10',
            'fullname' => 'required|string|max:20',
            'telepon' => 'required|string',
            'kronologi' => 'required|string',
            'lampiran' => 'required|mimes:jpg,png,pdf,jpeg|max3048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'errors input',
                'status' => 200,
                'content' => $validator->errors()
            ], 200);
        }
        $produk = QrCode::where('serial_number', $req->serial_number)
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->get(['qr_codes.id'])->toArray();

        $filename = $req->file('lampiran')->hashName();

        $report = new Report();
        $report->qr_code_id = $produk[0]['id'];
        $report->fullname = $req->fullname;
        $report->phone_number = $req->telepon;
        $report->kronologi = $req->kronologi;
        $report->file = $filename;
        $report->save();

        if ($req->file('lampiran') && $req->file('lampiran')->isValid()) {
            $path = "/public/uploads/laporan/";
            $req->file('lampiran')->storeAs($path, $filename);
        }
        return response()->json([
            'message' => 'thanks for your report',
            'status' => 200,
            'content' => $report
        ], 200);
    }
}

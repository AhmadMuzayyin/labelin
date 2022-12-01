<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use Yajra\DataTables\Html\Builder;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserScanController extends Controller
{
    protected $htmlBuilder;
    public function __construct(Builder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
    }
    public function index()
    {
        if (auth()->user()) {
            $userscan = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                ->join('products', 'request_qrs.product_id', '=', 'products.id')
                ->join('businesses', 'products.business_id', '=', 'businesses.id')
                ->orderBy('product_scanneds.id', 'desc')
                ->get(['products.name as nama_produk', 'product_scanneds.*', 'businesses.name as business_name', 'qr_codes.serial_number', 'qr_codes.id as id_qrcode', 'qr_codes.status'])
                ->groupBy('id_qrcode');
            $user = array();
            foreach ($userscan as $value) {
                array_push($user, [
                    'serial_number' => $value[0]->serial_number,
                    'nama_produk' => $value[0]->nama_produk,
                    'waktu_scan' => $value[0]->created_at->format('Y-m-d H:i:s'),
                    'jml_scan' => $value->count(),
                    'id_qrcode' => $value[0]->id_qrcode,
                    'status' => $value[0]->status,
                    'business_name' => $value[0]->business_name
                ]);
            }
            // dd($user);
            // dd($userscan);
            $collect = collect($user);
            $sorted = $collect->sortByDesc('jml_scan');
            if (request()->ajax()) {
                return DataTables::collection($sorted->values()->all())
                    ->addIndexColumn()
                    ->addColumn('action', 'pageBackEnd.user-scan.include.action')
                    ->make(true);
            }
            $columns = [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#',],
                ['data' => 'serial_number', 'name' => 'serial_number', 'title' => 'Serial Number'],
                ['data' => 'nama_produk', 'name' => 'nama_produk', 'title' => 'Nama Produk'],
                ['data' => 'waktu_scan', 'name' => 'waktu_scan', 'title' => 'Waktu Scan'],
                ['data' => 'jml_scan', 'name' => 'jml_scan', 'title' => 'Total Scan'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action']
            ];
            $html = $this->htmlBuilder->columns($columns);

            return view('pageBackEnd.user-scan.index', compact('html'));
        } else {
            $userscan = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                ->join('products', 'request_qrs.product_id', '=', 'products.id')
                ->where('request_qrs.partner_id', session()->get('id-partner'))
                ->get(['fullname as nama_lengkap', 'serial_number', 'products.name as nama_produk', 'gender', 'product_scanneds.created_at', 'product_scanneds.id', 'qr_codes.status', 'qr_codes.id as id_qrcode'])
                ->groupBy('id_qrcode');
            $user = array();
            foreach ($userscan as $value) {
                array_push($user, [
                    'serial_number' => $value[0]->serial_number,
                    'nama_produk' => $value[0]->nama_produk,
                    'waktu_scan' => $value[0]->created_at->format('Y-m-d H:i:s'),
                    'jml_scan' => $value->count(),
                    'id_qrcode' => $value[0]->id_qrcode,
                    'status' => $value[0]->status
                ]);
            }
            // dd($user);
            $collect = collect($user);
            $sorted = $collect->sortByDesc('jml_scan');
            if (request()->ajax()) {
                return DataTables::collection($sorted->values()->all())
                    ->addIndexColumn()
                    ->addColumn('action', 'pageBackEnd.pageBackEndPartner.user-scan.include.action')
                    ->toJson();
            }
            $columns = [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#',],
                ['data' => 'serial_number', 'name' => 'serial_number', 'title' => 'Serial Number'],
                ['data' => 'nama_produk', 'name' => 'nama_produk', 'title' => 'Nama Produk'],
                ['data' => 'waktu_scan', 'name' => 'waktu_scan', 'title' => 'Waktu Scan'],
                ['data' => 'jml_scan', 'name' => 'jml_scan', 'title' => 'Total Scan'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action']
            ];
            $html = $this->htmlBuilder->columns($columns);
            return view('pageBackEnd.pageBackEndPartner.user-scan.index', compact('html'));
        }
    }
    public function show($id)
    {
        $product = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->where('request_qrs.partner_id', session()->get('id-partner'))
            ->where('qr_code_id', $id)
            ->get(['fullname as nama_lengkap', 'serial_number', 'products.name as nama_produk', 'gender', 'qr_codes.id as id_qrcode', 'birth_date'])
            ->groupBy('id_qrcode');

        if (auth()->user()) {
            $product = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                ->join('products', 'request_qrs.product_id', '=', 'products.id')
                ->where('qr_code_id', $id)
                ->get(['fullname as nama_lengkap', 'serial_number', 'products.name as nama_produk', 'gender', 'qr_codes.id as id_qrcode', 'birth_date'])
                ->groupBy('id_qrcode');
            return view('pageBackEnd.user-scan.show', compact('product', 'id'));
        } else {
            return view('pageBackEnd.pageBackEndPartner.user-scan.show', compact('product', 'id'));
        }
    }
    public function edit(Request $request)
    {
        $qr = QrCode::firstWhere('id', $request->id);
        $qr->status = $request->status == 1 ? 0 : 1;
        $qr->save();
        if ($qr->status == true) {
            Alert::toast('Berhasil mengunci serial number', 'success');
        } else {
            Alert::toast('Berhasil membuka serial number', 'success');
        }
        return redirect()->back();
    }
}

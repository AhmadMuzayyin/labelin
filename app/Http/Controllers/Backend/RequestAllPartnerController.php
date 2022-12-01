<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\RequestQr;


class RequestAllPartnerController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $requestQrs = RequestQr::with('product:id,code,name', 'type_qr:id,name');

            return Datatables::of($requestQrs)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    return $row->product ? $row->product->name : '';
                })->addColumn('type_qr', function ($row) {
                    return $row->type_qr ? $row->type_qr->name : '';
                })
                ->addColumn('action', 'pageBackEnd.request.include.action')
                ->toJson();
        }

        return view('pageBackEnd.request.index');
    }

    public function show($id)
    {
        $request = DB::table('request_qrs')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->join('type_qrs', 'request_qrs.type_qr_id', '=', 'type_qrs.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('partners', 'businesses.partner_id', '=', 'partners.id')
            ->select('request_qrs.*', 'products.name as nama_produk', 'type_qrs.name as nama_type', 'type_qrs.price as harga_satuan', 'partners.name as nama_partner', 'partners.id as id_partner')
            ->where('request_qrs.id', '=', $id)
            ->get();
        return view('pageBackEnd.request.show', [
            'requestQr' => $request,
        ]);
    }

    public function generateQR(Request $request)
    {
        $jml = $request->qty_qr;
        DB::beginTransaction();
        try {
            for($i=1; $i<=$jml; $i++){
                $sn = $this->generateRandomString($request->sn_length);
                $pin = $this->generateRandomPin();
                // insert ke table qr
                DB::table('qr_codes')->insert([
                    'request_qr_id' =>$request->request_qr_id,
                    'serial_number' => $sn,
                    'pin' => $pin,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            // update table request qr
            $affected = DB::table('request_qrs')
              ->where('id', $request->request_qr_id)
              ->update(['is_generate' => 'Sudah Generate']);
              if($affected){
                echo "success";
              }else{
                echo "error";
              }
        } catch (\Throwable $th) {
            DB::rollBack();
            echo "error";
        } finally {
            DB::commit();
        }
    }

    public function upProgress(Request $request){
        // insert ke table qr
        DB::table('history_requests')->insert([
            'request_qr_id' =>$request->request_qr_id,
            'status' => 'Proses Cetak QR',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $affected = DB::table('request_qrs')
              ->where('id', $request->request_qr_id)
              ->update(['status' => 'Proses Cetak QR']);
              if($affected){
                echo "success";
              }else{
                echo "error";
              }
    }

    public function upResi(Request $request){
        // insert ke table qr
        DB::table('history_requests')->insert([
            'request_qr_id' =>$request->request_qr_id,
            'status' => 'Dalam Pengiriman',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        $affected = DB::table('request_qrs')
        ->where('id', $request->request_qr_id)
        ->update([
            'status' => 'Dalam Pengiriman',
            'jasa_kirim' => $request->jasa_kirim,
            'no_resi' => $request->resi,
        ]);
        Alert::toast('Nomor Resi Berhasil Di Update', 'success');
        return redirect()->back();
    }

    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return str($randomString)->upper();
    }
    function generateRandomPin($length =6)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return str($randomString)->upper();
    }
}

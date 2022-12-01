<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{Business, Category, Partner, Product, ProductScanned, RequestQr};
use Illuminate\Http\Request;
use App\Models\SettingWeb;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalPartner = Partner::count();
        $totalBusiness = Business::count();
        $totalProduct = Product::count();
        $totalRequestQr = RequestQr::count();
        $totalCategory = Category::count();
        $awal = $request->get('start_date') . ' ' . '00:00:01';
        $akhir = $request->get('end_date') . ' ' . '23:59:59';
        switch ($request->exists('start_date') && $request->exists('end_date')) {
            case true:
                $totalProductScanned = ProductScanned::where('product_scanneds.created_at', '>=', $awal)
                    ->where('product_scanneds.created_at', '<=', $akhir)->count();

                $totalGender = DB::table('product_scanneds')
                    ->where('product_scanneds.created_at', '>=', $awal)
                    ->where('product_scanneds.created_at', '<=', $akhir)

                    ->select('gender', DB::raw('count(*) as total_gender'))
                    ->groupBy('gender')
                    ->get();
                break;
            default:
                $totalProductScanned = ProductScanned::count();
                $totalGender = DB::table('product_scanneds')
                    ->select('gender', DB::raw('count(*) as total_gender'))
                    ->groupBy('gender')
                    ->get();
                break;
        }

        $topSN = $this->topSn();
        $topDuplicate = array();
        if (!empty($topSN) && count($topSN) == 3) {
            $topDuplicate = $this->topDuplicate($this->tigaDuplicate($topSN));
        }
        // dd($topDuplicate);
        return view('pageBackEnd.dashboard.index',  compact(
            'totalPartner',
            'totalBusiness',
            'totalProduct',
            'totalRequestQr',
            'totalProductScanned',
            'totalGender',
            'totalCategory',
            'topDuplicate'
        ));
    }
    public function topSn()
    {
        $userscan = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->get(['fullname as nama_lengkap', 'serial_number', 'products.name as nama_produk', 'gender', 'product_scanneds.created_at', 'product_scanneds.id', 'qr_codes.status', 'qr_codes.id as id_qrcode'])
            ->groupBy('id_qrcode');
        $user = array();
        foreach ($userscan as $value) {
            array_push(
                $user,
                $value->count()
            );
        }

        return $user;
    }
    public function topDuplicate($sn)
    {
        $userscan = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
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

        $dataTop = array();
        foreach ($user as $key => $item) {
            for ($i = 0; $i < 3; $i++) {
                if ($item['jml_scan'] == $sn[$i]) {
                    array_push($dataTop, $item);
                }
            }
        }
        return $dataTop;
    }
    public function tigaDuplicate($array)
    {
        $i = 0;
        $satu = 0;
        $dua = 0;
        $tiga = 0;

        $tiga = $satu = $dua = PHP_INT_MIN;
        for ($i = 0; $i < 3; $i++) {
            // jika elemen saat ini adalah
            // lebih besar dari $satu
            if ($array[$i] > $satu) {
                $tiga = $dua;
                $dua = $satu;
                $satu = $array[$i];
            }

            // Jika array[i] berada di antara $fist dan $dua
            // lalu perbarui $dua
            else if ($array[$i] > $dua) {
                $tiga = $dua;
                $dua = $array[$i];
            } else if ($array[$i] > $tiga)
                $tiga = $array[$i];
        }

        $top = [$satu, $dua, $tiga];
        return $top;
    }
}

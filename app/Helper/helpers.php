<?php

use App\Models\QrCode;
use App\Models\BusinessVideo;
use Illuminate\Support\Facades\Http;

if (!function_exists('set_active')) {
    function set_active($uri)
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) { // jika route sekarang sama dengan variable u
                    return 'active';
                }
            }
        } else {
            if (Route::is($uri)) { // jika route sekarang sama dengan variable u
                return 'active';
            }
        }
    }
    function getProduk($sn)
    {
        $produk = QrCode::join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('qr_codes.serial_number', $sn)
            ->select(['logo'])
            ->first();
        return $produk;
    }
    function getVideo($param)
    {
        $qrcode = QrCode::where('serial_number', $param)
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->get('business_id');

        $video = BusinessVideo::where('business_id', $qrcode[0]->business_id)->first();
        return $video;
    }
}

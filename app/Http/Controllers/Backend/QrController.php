<?php

namespace App\Http\Controllers\Backend;

use App\Exports\QrExport;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

use App\Models\QrCode;
use App\Models\RequestQr;
use Maatwebsite\Excel\Facades\Excel;

class QrController extends Controller
{
    public function export($id)
    {
        $setName = RequestQr::join('partners', 'request_qrs.partner_id', '=', 'partners.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('request_qrs.id', $id)
            ->select('partners.name as nama_partner', 'products.name as nama_produk', 'businesses.name as nama_bisnis')
            ->first();
        return Excel::download(new QrExport($id), $setName->nama_partner . '-' . $setName->nama_bisnis . '-' . $setName->nama_produk . '.xlsx');
    }
}

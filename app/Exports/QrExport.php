<?php

namespace App\Exports;

use App\Models\QrCode;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class QrExport implements FromView
{

    public function __construct(string $keyword)
    {
        $this->request_qr_id = $keyword;
    }

    public function view(): View
    {
        $data = DB::table('qr_codes')
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->select('qr_codes.*', 'products.name as nama_produk')
            ->where('qr_codes.request_qr_id', '=', $this->request_qr_id)
            ->get();
        $batch_code = DB::table('batch_codes')
            ->join('request_qrs', 'batch_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->where('batch_codes.request_qr_id', '=', $this->request_qr_id)
            ->select('batch_codes.batch_code')
            ->get();
        return view('pageBackEnd.request.export', [
            'data' => $data,
            'batch_code' => $batch_code
        ]);
    }
}

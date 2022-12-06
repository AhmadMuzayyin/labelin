<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PartnerQrExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(string $id)
    {
        $this->request_qr_id = $id;
    }
    public function view(): View
    {
        $data = DB::table('qr_codes')
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->select('qr_codes.*', 'products.name as nama_produk')
            ->where('qr_codes.request_qr_id', '=', $this->request_qr_id)
            ->get();
        return view('pageBackEnd.pageBackEndPartner.request-qrs.export', [
            'data' => $data
        ]);
    }
}

<?php

namespace App\Http\Controllers\Backend\partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeQr;

class TypeQrController extends Controller
{
    public function index()
    {
        $qr = TypeQr::all();
        return view('pageBackEnd.pageBackEndPartner.qr',[
            'qr' => $qr,
        ]);
    }

}

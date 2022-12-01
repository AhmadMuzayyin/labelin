<?php

namespace App\Http\Controllers\Backend;

use App\Exports\QrExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\QrCode;


use Maatwebsite\Excel\Facades\Excel;

class QrController extends Controller
{
    public function export($id)
    {
        return Excel::download(new QrExport($id), 'Qr.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        $report = Report::all();
        if (request()->ajax()) {
            return DataTables::of($report)
                ->addIndexColumn()
                ->toJson();
        }
        return view('pageBackEnd.report.index');
    }
}

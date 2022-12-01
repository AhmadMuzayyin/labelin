<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessPartnerRequest;
use App\Models\Business;
use App\Models\Partner;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class BusinessPartnerController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $business = DB::table('businesses')
        ->select('businesses.*')
        ->where('businesses.partner_id', $id)
        ->get();
        return view('pageBackEnd.business.get',[
            'business' => $business
        ]);
    }
}

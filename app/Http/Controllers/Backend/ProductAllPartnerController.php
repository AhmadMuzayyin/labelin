<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Business, Category};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProductAllPartnerController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $products = Product::with('category:id,name', 'business.partner');
            return Datatables::of($products)
                ->addIndexColumn()
                ->addColumn('description', function ($row) {
                    return str($row->description)->limit(100);
                })
                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : '';
                })
                ->addColumn('partner', function ($row) {
                    return $row->business->partner ? $row->business->partner->name : '';
                })
                ->addColumn('business', function ($row) {
                    return $row->business ? $row->business->name : '';
                })
                ->addColumn('photo', function ($row) {
                    if ($row->photo == null) {
                        return 'https://via.placeholder.com/350?text=No+Image+Avaiable';
                    }
                    return asset('storage/uploads/photos/' . $row->photo);
                })
                ->addColumn('action', 'pageBackEnd.produk.include.action')
                ->toJson();
        }

        return view('pageBackEnd.produk.index');
    }

    public function show($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('partners', 'businesses.partner_id', '=', 'partners.id')
            ->select('products.*', 'categories.name as nama_kategori', 'businesses.name as nama_bisnis', 'partners.name as nama_partner')
            ->where('products.id', $id)
            ->get();
        return view('pageBackEnd.produk.show', [
            'product' => $product,
        ]);
    }
}

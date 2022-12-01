<?php

namespace App\Http\Controllers\Backend\partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\{StoreProductRequest, UpdateProductRequest};
use App\Models\{Product, Business, Category};
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\{Gate, Session};
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:product_show')->only('index');
        // $this->middleware('permission:product_create')->only('create', 'store');
        // $this->middleware('permission:product_update')->only('edit', 'update');
        // $this->middleware('permission:product_delete')->only('delete');
        // $this->middleware('permission:product_detail')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
        $products = Product::with('category:id,name', 'business:id,name')->where('partner_id', session()->get('id-partner'));

        return Datatables::of($products)
            ->addIndexColumn()
            ->addColumn('description', function ($row) {
                return str($row->description)->limit(100);
            })
            ->addColumn('category', function ($row) {
                return $row->category ? $row->category->name : '';
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
            ->addColumn('action', 'pageBackEnd.pageBackEndPartner.products.include.action')
            ->toJson();
        }

        return view('pageBackEnd.pageBackEndPartner.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'code', 'name')->orderBy('id')->limit(500)->get();

        $businessPartners = Business::where('partner_id', Session::get('id-partner'))->orderBy('name')->get();

        return view('pageBackEnd.pageBackEndPartner.products.create', compact('categories', 'businessPartners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $attr = $request->validated();
        $attr['slug'] = str($attr['name'])->slug();
        $attr['partner_id'] = session()->get('id-partner');

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $path = storage_path('app/public/uploads/photos/');
            $filename = $request->file('photo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            $attr['photo'] = $filename;
        }

        Product::create($attr);

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // dd($product->partner_id, session()->get('id-partner'), session()->get('id-partner') == $product->partner_id);

        // Gate::allowIf(fn () => session()->get('id-partner') == $product->partner_id);
        abort_if(session()->get('id-partner') != $product->partner_id, Response::HTTP_FORBIDDEN);

        $product->load('category:id,name', 'business:id,code,name');

        return view('pageBackEnd.pageBackEndPartner.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $product->partner_id);
        abort_if(session()->get('id-partner') != $product->partner_id, Response::HTTP_FORBIDDEN);

        $product->load('category:id,name');

        $categories = Category::select('id', 'code', 'name')->orderBy('id')->limit(500)->get();
        $businessPartners = Business::where('partner_id', Session::get('id-partner'))
        ->orderBy('name')
        ->get();

        return view('pageBackEnd.pageBackEndPartner.products.edit', compact('product', 'categories', 'businessPartners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $product->partner_id);
        abort_if(session()->get('id-partner') != $product->partner_id, Response::HTTP_FORBIDDEN);

        $attr = $request->validated();
        $attr['slug'] = str($attr['name'])->slug();

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $path = storage_path('app/public/uploads/photos/');
            $filename = $request->file('photo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            // delete old photo from storage
            if ($product->photo != null && file_exists($path . $product->photo)) {
                unlink($path . $product->photo);
            }

            $attr['photo'] = $filename;
        }

        $product->update($attr);

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $product->partner_id);
        abort_if(session()->get('id-partner') != $product->partner_id, Response::HTTP_FORBIDDEN);

        try {
            $path = storage_path('app/public/uploads/photos/');

            if ($product->photo != null && file_exists($path . $product->photo)) {
                unlink($path . $product->photo);
            }

            $product->delete();

            Alert::toast('Data berhasil digapus', 'success');

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            Alert::error('Data gagal dihapus', 'success');

            return redirect()->route('products.index');
        }
    }
}

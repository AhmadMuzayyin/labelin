<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Http\Requests\Partners\{StorePartnerRequest, UpdatePartnerRequest};
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Image;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:partner_show')->only('index');
        $this->middleware('permission:partner_create')->only('create', 'store');
        $this->middleware('permission:partner_update')->only('edit', 'update');
        $this->middleware('permission:partner_delete')->only('delete');
        $this->middleware('permission:partner_detail')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $partner = Partner::select('id', 'code', 'name', 'email', 'phone', 'pic');

            return DataTables::of($partner)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    if ($row->photo == null) {
                        return 'https://via.placeholder.com/350?text=No+Image+Avaiable';
                    }
                    return asset('storage/uploads/photos/' . $row->photo);
                })
                ->addColumn('action', 'pageBackEnd.partners.include.action')
                ->toJson();
        }

        return view('pageBackEnd.partners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pageBackEnd.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerRequest $request)
    {
        $attr = $request->validated();
        $attr['password'] = bcrypt($request->password);

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

        Partner::create($attr);

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return view('pageBackEnd.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return view('pageBackEnd.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $attr = $request->validated();

        switch (is_null($request->password)) {
            case true:
                unset($attr['password']);
                break;
            default:
                $attr['password'] = bcrypt($request->password);
                break;
        }

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
            if ($partner->photo != null && file_exists($path . $partner->photo)) {
                unlink($path . $partner->photo);
            }

            $attr['photo'] = $filename;
        }

        $partner->update($attr);

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        try {
            $path = storage_path('app/public/uploads/photos/');

            if ($partner->photo != null && file_exists($path . $partner->photo)) {
                unlink($path . $partner->photo);
            }

            $partner->delete();

            Alert::toast('Data berhasil dihapus', 'success');

            return redirect()->route('partners.index');
        } catch (\Throwable $th) {

            Alert::toast('Data gagal dihapus', 'success');

            return redirect()->route('partners.index');
        }
    }
}

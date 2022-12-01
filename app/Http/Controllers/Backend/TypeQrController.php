<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TypeQr;
use App\Http\Requests\TypeQrs\{StoreTypeQrRequest, UpdateTypeQrRequest};
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class TypeQrController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:type_qr_show')->only('index');
        $this->middleware('permission:type_qr_create')->only('create', 'store');
        $this->middleware('permission:type_qr_update')->only('edit', 'update');
        $this->middleware('permission:type_qr_delete')->only('delete');
        $this->middleware('permission:type_qr_detail')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $typeQrs = TypeQr::query();

            return DataTables::of($typeQrs)
                ->addIndexColumn()
                ->addColumn('action', 'pageBackEnd.type-qrs.include.action')
                ->toJson();
        }

        return view('pageBackEnd.type-qrs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pageBackEnd.type-qrs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeQrRequest $request)
    {
        $attr = $request->validated();

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

        TypeQr::create($attr);

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('type-qrs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeQr  $typeQr
     * @return \Illuminate\Http\Response
     */
    public function show(TypeQr $typeQr)
    {
        return view('pageBackEnd.type-qrs.show', compact('typeQr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeQr  $typeQr
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeQr $typeQr)
    {
        return view('pageBackEnd.type-qrs.edit', compact('typeQr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeQr  $typeQr
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeQrRequest $request, TypeQr $typeQr)
    {
        $attr = $request->validated();

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
            if ($typeQr->photo != null && file_exists($path . $typeQr->photo)) {
                unlink($path . $typeQr->photo);
            }

            $attr['photo'] = $filename;
        }

        $typeQr->update($attr);

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('type-qrs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeQr  $typeQr
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeQr $typeQr)
    {
        try {
            $path = storage_path('app/public/uploads/photos/');

            if ($typeQr->photo != null && file_exists($path . $typeQr->photo)) {
                unlink($path . $typeQr->photo);
            }

            $typeQr->delete();

            Alert::toast('Data berhasil dihapus', 'success');

            return redirect()->route('type-qrs.index');
        } catch (\Throwable $th) {

            Alert::toast('Data gagal dihapus', 'success');

            return redirect()->route('type-qrs.index');
        }
    }

    public function getPrice(int $id){
        $typeQr = TypeQr::select('id','price')->find($id);

        if($typeQr){
            return response()->json(['message' => 'success', 'type_qr' => $typeQr], 200);
        }

        return response()->json(['message' => 'data not found', 'type_qr' => []], 404);
    }
}

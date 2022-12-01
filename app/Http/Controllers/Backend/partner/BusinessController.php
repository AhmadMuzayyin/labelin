<?php

namespace App\Http\Controllers\Backend\partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\{StoreBusinessRequest, UpdateBusinessRequest};
use App\Models\Business;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $business = Business::where('partner_id', session()->get('id-partner'));

            return DataTables::of($business)
                ->addIndexColumn()
                ->addColumn('action', 'pageBackEnd.pageBackEndPartner.business.include.action')
                ->toJson();
        }

        return view('pageBackEnd.pageBackEndPartner.business.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pageBackEnd.pageBackEndPartner.business.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessRequest $request)
    {
        $attr = $request->validated();

        if ($request->file('logo') && $request->file('logo')->isValid()) {

            $path = storage_path('app/public/uploads/logos/');
            $filename = $request->file('logo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('logo')->getRealPath())->resize(400, 400, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            $attr['logo'] = $filename;
        }

        $attr['partner_id'] = session()->get('id-partner');

        Business::create($attr);

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('part-bus.business.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        // dd($business, $business->partner_id, session()->get('id-partner'), session()->get('id-partner') == $business->partner_id);
        // Gate::allowIf(fn () => session()->get('id-partner') === $business->partner_id);

        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        return view('pageBackEnd.pageBackEndPartner.business.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $business->partner_id);
        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        return view('pageBackEnd.pageBackEndPartner.business.edit', compact('business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $business->partner_id);
        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        $attr = $request->validated();

        if ($request->file('logo') && $request->file('logo')->isValid()) {

            $path = storage_path('app/public/uploads/logos/');
            $filename = $request->file('logo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('logo')->getRealPath())->resize(400, 400, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            // delete old logo from storage
            if ($business->logo != null && file_exists($path . $business->logo)) {
                unlink($path . $business->logo);
            }

            $attr['logo'] = $filename;
        }

        $business->update($attr);

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('part-bus.business.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $business->partner_id);
        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        try {
            $path = storage_path('app/public/uploads/logos/');

            if ($business->logo != null && file_exists($path . $business->logo)) {
                unlink($path . $business->logo);
            }

            $business->delete();

            Alert::toast('Data berhasil dihapus', 'success');

            return redirect()->route('part-bus.business.index');
        } catch (\Throwable $th) {

            Alert::toast('Data gagal dihapus', 'success');

            return redirect()->route('part-bus.business.index');
        }
    }
}

<?php

namespace App\Http\Controllers\Backend\partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\{StoreBusinessRequest, UpdateBusinessRequest};
use App\Models\Business;
use App\Models\BusinessVideo;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BusinessController extends Controller
{
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

    public function create()
    {
        return view('pageBackEnd.pageBackEndPartner.business.create');
    }

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

        $bis = Business::create($attr);
        if ($request->file('video') && $request->file('video')->isValid()) {

            $path = storage_path('app/public/uploads/video/');
            $filename = $request->file('video')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $request->file('video')->move($path, $filename);

            $video = new BusinessVideo();
            $video->business_id = $bis->id;
            $video->video = $filename;
            $video->save();
        }

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('part-bus.business.index');
    }

    public function show(Business $business)
    {
        // dd($business, $business->partner_id, session()->get('id-partner'), session()->get('id-partner') == $business->partner_id);
        // Gate::allowIf(fn () => session()->get('id-partner') === $business->partner_id);

        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        $video = BusinessVideo::firstWhere('business_id', $business->id);
        return view('pageBackEnd.pageBackEndPartner.business.show', compact('business', 'video'));
    }

    public function edit(Business $business)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $business->partner_id);
        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        $video = BusinessVideo::firstWhere('business_id', $business->id);
        return view('pageBackEnd.pageBackEndPartner.business.edit', compact('business', 'video'));
    }

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
        if ($request->file('video') && $request->file('video')->isValid()) {

            $path = storage_path('app/public/uploads/video/');
            $filename = $request->file('video')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $request->file('video')->move($path, $filename);

            $video = BusinessVideo::firstWhere('business_id', $business->id);
            $video->video = $filename;
            $video->save();
        }

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('part-bus.business.index');
    }

    public function destroy(Business $business)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $business->partner_id);
        abort_if(session()->get('id-partner') != $business->partner_id, Response::HTTP_FORBIDDEN);

        try {
            $path = storage_path('app/public/uploads/logos/');

            if ($business->logo != null && file_exists($path . $business->logo)) {
                unlink($path . $business->logo);
            }
            $video = BusinessVideo::firstWhere('business_id', $business->id);
            $path_video = storage_path('app/public/uploads/video/');

            if ($video->video != null && file_exists($path . $video->video)) {
                unlink($path_video . $video->video);
            }

            $video->delete();

            Alert::toast('Data berhasil dihapus', 'success');

            return redirect()->route('part-bus.business.index');
        } catch (\Throwable $th) {

            Alert::toast('Data gagal dihapus', 'success');

            return redirect()->route('part-bus.business.index');
        }
    }
}

<?php

namespace App\Http\Controllers\Backend\partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePartnerRequest;
use App\Models\Partner;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilePartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = Partner::find(session()->get('id-partner'));

        return view('pageBackEnd.pageBackEndPartner.profile', compact('partner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilePartnerRequest $request, int $id)
    {
        $partner = Partner::findOrFail($id);

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

        session()->put('id-partner', $partner->id);
        session()->put('name-partner', $partner->name);
        session()->put('email-partner', $partner->email);
        session()->put('photo-partner', $partner->photo);
        session()->put('login-partner', TRUE);

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('PartnerDashboard');
    }
}

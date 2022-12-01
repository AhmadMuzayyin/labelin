<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SettingWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SettingWebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $setting_web = SettingWeb::all()->first();
        return view('pageBackEnd.settingWeb.index', ['setting_web' => $setting_web]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_website' => 'required|string',
                'telpon' => 'required|string',
                'email' => 'required|string',
                'deskripsi' => 'required|string',
                'is_aktif_website' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();

        try {
            $setting_web = SettingWeb::findOrFail($id);
            // dd($request->file('logo_dark') != null);

            if ($request->file('logo_dark') != null || $request->file('logo_dark') != '') {
                //hapus old logo
                Storage::disk('local')->delete('public/img/setting_web/' . $setting_web->logo_dark);
                //upload new logo
                $logo = $request->file('logo_dark');
                $logo->storeAs('public/img/setting_web', $logo->hashName());
                $setting_web->update([
                    'logo_dark'     => $logo->hashName(),
                ]);
            }

            if ($request->file('logo_light') != "" || $request->file('logo_light') != null) {
                Storage::disk('local')->delete('public/img/setting_web/' . $setting_web->logo_light);
                $banner = $request->file('logo_light');
                $banner->storeAs('public/img/setting_web', $banner->hashName());
                $setting_web->update([
                    'logo_light'     => $banner->hashName(),
                ]);
            }
            $setting_web->update([
                'nama_website' => $request->nama_website,
                'telpon' => $request->telpon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'is_aktif_website' => $request->is_aktif_website,
            ]);
            if ($setting_web) {
                Alert::toast('Data berhasil diupdate', 'success');
                return redirect()->route('settingWeb.index', 1);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::toast('Data gagal diupdate', 'error');
            return redirect()->route('settingWeb.index', 1);
        } finally {
            DB::commit();
        }
    }
}

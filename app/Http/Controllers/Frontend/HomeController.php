<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Sosmed;
use App\Models\Partner;
use App\Models\RequestQr as RequestQrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\RegisterPartnerRequest;
use Illuminate\Support\Facades\{Hash, Session, Validator, DB};
use App\Models\{Kontak, ProductScanned, RequestQr, SettingWeb};

class HomeController extends Controller
{
    private $settings;

    public function __construct()
    {
        $settings = SettingWeb::first();
        $this->settings = $settings;
    }

    public function index()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }

        return view('pageFrontEnd.index', [
            'setting_web' => $this->settings,
        ]);
    }

    public function login()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }
        return view('pageFrontEnd.login', [
            'setting_web' => $this->settings,
        ]);
    }

    public function register()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }

        return view('pageFrontEnd.register', [
            'setting_web' => $this->settings,
        ]);
    }

    public function scan($sn)
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }

        return view('pageFrontEnd.scan', [
            'setting_web' => $this->settings,
        ]);
    }

    public function DoLogin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => "required|email",
                'password' => 'required|string',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $partner = Partner::where('email', $request->email)->first();

        if ($partner && Hash::check($request->password, $partner->password)) {
            Session::put('id-partner', $partner->id);
            Session::put('name-partner', $partner->name);
            Session::put('email-partner', $partner->email);
            Session::put('login-partner', TRUE);

            return redirect()->route('PartnerDashboard');
        } else {
            Alert::error('Failed', 'Email atau Password anda salah!');

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    public function DoLogout(Request $request)
    {
        $request->session()->forget('id-partner');
        $request->session()->forget('name-partner');
        $request->session()->forget('email-partner');
        $request->session()->forget('photo-partner');
        $request->session()->forget('login-partner');

        return redirect()->route('web_login');
    }

    public function doRegister(RegisterPartnerRequest $request)
    {
        $attr = $request->validated();
        $attr['password'] = bcrypt($request->password);

        $partner =  Partner::create($attr);

        Session::put('id-partner', $partner->id);
        Session::put('name-partner', $partner->name);
        Session::put('email-partner', $partner->email);
        Session::put('photo-partner', $partner->photo);
        Session::put('login-partner', TRUE);

        $partner->update([
            'code' => str(uniqid())->upper()
        ]);

        Alert::success('Success', 'Kamu berhasil register!');

        return redirect()->route('PartnerDashboard');
    }

    public function kontak(Request $request)
    {
        try {
            Kontak::create([
                'nama_lengkap'   => $request->nama_lengkap,
                'email'   => $request->email,
                'subjek'   => $request->subjek,
                'deskripsi'   => $request->deskripsi,
            ]);

            Alert::success('Success', 'Pesan berhasil dikirim');

            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Failed', 'Pesan gagal dikirim');

            return redirect()->back();
        }
    }

    public function cek_produk(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required'],
            'tgl_lahir' => ['required'],
            'jk_kelamin' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        $pin = $request->satu . '' . $request->dua . '' . $request->tiga . '' . $request->empat . '' . $request->lima . '' . $request->enam;
        $cek = DB::table('qr_codes')
            ->where('pin', '=', $pin)
            ->where('serial_number', '=', $request->sn)
            ->first();
        // ambil data produk
        if ($cek) {
            $produk = DB::table('qr_codes')
                ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                ->join('products', 'request_qrs.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('businesses', 'products.business_id', 'businesses.id')
                ->where('qr_codes.serial_number', $request->sn)
                ->where('qr_codes.pin', $pin)
                ->select('products.name as nama_produk', 'categories.name as nama_kategori', 'businesses.logo as logo_brand', 'businesses.brand as nama_brand')
                ->first();

            // cek duplicate data
            $duplicate = ProductScanned::where('qr_code_id', $cek->id)->first();
            if ($duplicate) {
                $get_QR = $duplicate->load('qr_code');
                if ($get_QR) {
                    if ($get_QR->qr_code->status == true) {
                        //inser ke table scan
                        DB::table('product_scanneds')->insert([
                            'qr_code_id' => $cek->id,
                            'fullname' => $request->nama_lengkap,
                            'birth_date' => $request->tgl_lahir,
                            'gender' => $request->jk_kelamin,
                            'lat' => $request->latitude,
                            'long' => $request->longitude,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                        Alert::toast('Congratulations !!! Produk Terdaftar', 'warning');
                        return view('pageFrontEnd.duplicate', [
                            'setting_web' => $this->settings,
                            'sn' => $request->sn,
                            'pin' => $pin,
                            'produk' => $produk,
                            'duplicate' => $duplicate
                        ]);
                    }
                }
            }

            //inser ke table scan
            DB::table('product_scanneds')->insert([
                'qr_code_id' => $cek->id,
                'fullname' => $request->nama_lengkap,
                'birth_date' => $request->tgl_lahir,
                'gender' => $request->jk_kelamin,
                'lat' => $request->latitude,
                'long' => $request->longitude,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // get sosmed link
            $getPartnerId = RequestQrCode::firstWhere('id', $cek->request_qr_id);
            $sosmed = Sosmed::where('partner_id', $getPartnerId->id)->get();
            Alert::toast('Congratulations !!! Produk Terdaftar', 'success');
            return view('pageFrontEnd.ada', [
                'setting_web' => $this->settings,
                'sn' => $request->sn,
                'pin' => $pin,
                'produk' => $produk,
                'sosmed' => $sosmed
            ]);
        } else {
            Alert::toast('Warning !!! Produk Tidak Terdaftar', 'error');
            return view('pageFrontEnd.tidak_ada', [
                'setting_web' => $this->settings,
                'sn' => $request->sn,
                'pin' => $pin,
            ]);
        }
    }

    public function policy()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }
        return view('pageFrontEnd.policy', [
            'setting_web' => $this->settings,
        ]);
    }
    public function disclaimer()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }
        return view('pageFrontEnd.disclaimer', [
            'setting_web' => $this->settings,
        ]);
    }
    public function termcondtion()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }
        return view('pageFrontEnd.termcondition', [
            'setting_web' => $this->settings,
        ]);
    }
    public function sitemap()
    {
        if ($this->settings->is_aktif_website === 'T') {
            return view('pageFrontEnd.mt', ['setting_web' => $this->settings]);
        }
        $xml = file_get_contents(public_path('sitemap.xml'));
        $object = simplexml_load_file($xml);
        return $object;
    }
}
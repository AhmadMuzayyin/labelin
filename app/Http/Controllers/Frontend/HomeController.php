<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Sosmed;
use App\Models\Partner;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\RequestQr as RequestQrCode;
use App\Http\Requests\RegisterPartnerRequest;
use Illuminate\Support\Facades\{Hash, Session, Validator, DB};
use App\Models\{BusinessVideo, Kontak, ProductScanned, ProdukRating, QrCode, Report, RequestQr, SettingWeb};

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
            'setting_web' => $this->settings
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
        if ($request->isMethod('get')) {
            abort(404);
        }
        $request->validate([
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        $pin = $request->satu . '' . $request->dua . '' . $request->tiga . '' . $request->empat . '' . $request->lima . '' . $request->enam;
        $cek = DB::table('qr_codes')
            ->where('pin', '=', $pin)
            ->where('serial_number', '=', $request->sn)
            ->first();
        // get ipv4 address client
        $ipClient = \Request::getClientIp(true);
        // ambil data produk
        if ($cek) {
            $produk = DB::table('qr_codes')
                ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                ->join('products', 'request_qrs.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('businesses', 'products.business_id', 'businesses.id')
                ->where('qr_codes.serial_number', $request->sn)
                ->where('qr_codes.pin', $pin)
                ->select('products.name as nama_produk', 'categories.name as nama_kategori', 'businesses.logo as logo_brand', 'businesses.brand as nama_brand', 'products.bpom', 'products.photo', 'products.id', 'products.kemasan')
                ->first();

            // cek duplicate data
            $duplicate = ProductScanned::where('qr_code_id', $cek->id)->first();
            if ($duplicate) {
                $get_QR = $duplicate->load('qr_code');
                if ($get_QR) {
                    if ($get_QR->qr_code->status == true) {
                        //inser ke table scan
                        $getVisitor = ProductScanned::where('qr_code_id', $cek->id)->where('visitor', $ipClient)->first();
                        if (isset($getVisitor)) {
                            if ($getVisitor->visitor != $ipClient) {
                                DB::table('product_scanneds')->insert([
                                    'qr_code_id' => $cek->id,
                                    'lat' => $request->latitude,
                                    'long' => $request->longitude,
                                    'visitor' => $ipClient,
                                    'created_at' => date('Y-m-d H:i:s'),
                                ]);
                            }
                        } else {
                            DB::table('product_scanneds')->insert([
                                'qr_code_id' => $cek->id,
                                'lat' => $request->latitude,
                                'long' => $request->longitude,
                                'visitor' => $ipClient,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
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
            $getVisitor = ProductScanned::where('qr_code_id', $cek->id)->where('visitor', $ipClient)->first();
            if (isset($getVisitor)) {
                if ($getVisitor->visitor != $ipClient) {
                    DB::table('product_scanneds')->insert([
                        'qr_code_id' => $cek->id,
                        'lat' => $request->latitude,
                        'long' => $request->longitude,
                        'visitor' => $ipClient,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } else {
                DB::table('product_scanneds')->insert([
                    'qr_code_id' => $cek->id,
                    'lat' => $request->latitude,
                    'long' => $request->longitude,
                    'visitor' => $ipClient,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            // get sosmed link
            $getPartnerId = RequestQrCode::firstWhere('id', $cek->request_qr_id);
            $sosmed = Sosmed::where('partner_id', $getPartnerId->partner_id)->get();
            $rating = DB::table('produk_ratings')->where('product_id', $produk->id)->where('visitor', $ipClient)->first();
            $getProdukRating = ProdukRating::where('product_id', $produk->id)->get('produk_rated');
            $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
            Alert::toast('Congratulations !!! Produk Terdaftar', 'success');
            return view('pageFrontEnd.ada', [
                'setting_web' => $this->settings,
                'sn' => $request->sn,
                'pin' => $pin,
                'produk' => $produk,
                'sosmed' => $sosmed,
                'rating' => $rating != null ? true : false,
                'produk_rating' => isset($getProdukRating) ? $produk_rating : 0
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

    public function rating(Request $req, $id)
    {
        // get ipv4 address client
        $ipClient = \Request::getClientIp(true);
        $produk = QrCode::join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->where('qr_codes.serial_number', $id)
            ->select('products.id')
            ->first();
        $cek = ProdukRating::where('product_id', $produk->id)->where('visitor', $ipClient)->first();
        if (!isset($cek)) {
            DB::table('produk_ratings')->insert([
                'product_id' => $produk->id,
                'produk_rated' => $req->rating,
                'visitor' => $ipClient,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        $getProdukRating = ProdukRating::where('product_id', $produk->id)->get('produk_rated');
        $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
        $respon = [
            'message' => $cek->visitor == $ipClient && $produk->id == $cek->product_id ? 'Terimkasih, anda sudah melakukan rating' : 'Terimakasih atas rating anda',
            'rating' => $produk_rating,
        ];
        return response()->json($respon, 200);
    }

    public function report(Request $req, $id)
    {
        $produk = QrCode::where('serial_number', $id)
            ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
            ->join('products', 'request_qrs.product_id', '=', 'products.id')
            ->get(['qr_codes.id'])->toArray();

        $filename = $req->file('lampiran')->hashName();

        $report = new Report();
        $report->qr_code_id = $produk[0]['id'];
        $report->fullname = $req->nama;
        $report->phone_number = $req->telp;
        $report->kronologi = $req->kronologi;
        $report->file = $filename;
        $report->save();

        if ($req->file('lampiran') && $req->file('lampiran')->isValid()) {
            $path = "/public/uploads/laporan/";
            // if (!file_exists($path)) {
            //     mkdir($path, 0777, true);
            // }
            $req->file('lampiran')->storeAs($path, $filename);
        }
        return response()->json($report, 200);
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

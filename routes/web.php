<?php

// FrontEnd
use App\Models\SettingWeb;

// Backend
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\UserScanController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\partner\TypeQrController as PartnerTypeQrController;
use App\Http\Controllers\Backend\partner\BusinessController as PartnerBusinessController;
use App\Http\Controllers\Backend\partner\{DashboardPartnerController, ProductController, RequestQrController, ProfilePartnerController};
use App\Http\Controllers\Backend\{UserController, RolesController, DashboardController, SettingWebController, BusinessController, BusinessPartnerController, CategoryController, PartnerController, TypeQrController, KontakController, ProductAllPartnerController, QrController, RequestAllPartnerController};
use App\Http\Controllers\ReportController;

Auth::routes(['register' => false]);
// Route Front end
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/privacy-policy', [HomeController::class, 'policy'])->name('privacy.policy');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/terms&conditions', [HomeController::class, 'termcondtion'])->name('termcondtion');
Route::get('/sitemap.xml', [HomeController::class, 'index'])->name('sitemap');
Route::post('/kontak', [HomeController::class, 'kontak'])->name('send_kontak');
Route::get('/scan/{id}', [HomeController::class, 'scan'])->name('scan');
Route::any('/cek_produk', [HomeController::class, 'cek_produk'])->name('cek_produk');
Route::post('/rating/{id}', [HomeController::class, 'rating'])->name('produk_rating');
Route::post('/report/{id}', [HomeController::class, 'report'])->name('produk_report');
Route::get('ketentuan', function () {
    $settings = SettingWeb::first();
    return view('pageFrontEnd.ketentuan', ['setting_web' => $settings]);
});
Route::controller(HomeController::class)->middleware('partner_guest')->group(function () {
    Route::get('/partner/register', 'register')->name('web_register');
    Route::get('/partner/login', 'login')->name('web_login');
    Route::post('/partner/DoLogin', 'DoLogin')->name('auth-partner');
    Route::post('/partner/register', 'doRegister')->name('partner.register');
});

// Route Back End Partner
Route::prefix('partner')->middleware('PartnerLogin')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('PartnerDashboard'));
    Route::get('/', [DashboardPartnerController::class, 'index'])->name('PartnerDashboard');
    Route::get('/logout', [HomeController::class, 'DoLogout'])->name('signout-partner');
    Route::get('/profile', [ProfilePartnerController::class, 'index'])->name('partner.profile');
    Route::put('/profile/{id}', [ProfilePartnerController::class, 'update'])->name('partner.profile.update');
    Route::name('part-bus')->resource('/business', PartnerBusinessController::class);
    Route::get('/partnerTypeQr', [PartnerTypeQrController::class, 'index'])->name('partnerTypeQr');
    Route::resource('/products', ProductController::class);

    Route::get('/request-qrs', [RequestQrController::class, 'index'])->name('request-qrs.index');
    Route::get('/request-qrs/{requestQr}/show', [RequestQrController::class, 'show'])->name('request-qrs.show');
    Route::get('/request-qrs/{id}/upload', [RequestQrController::class, 'uploadView'])->name('request-qrs.upload');
    Route::put('/request-qrs/{id}/upload', [RequestQrController::class, 'upload'])->name('request-qrs.upload.save');
    Route::get('/request-qrs/export/{id}', [QrController::class, 'export'])->name('request-qrs.export');
    Route::get('/request-qrs/{filename}/download', [RequestQrController::class, 'download'])->name('partner.request-qrs.download');

    Route::controller(SosmedController::class)->group(function () {
        Route::get('/custom_link', 'index')->name('custom.link.index');
        Route::get('custom_link/create', 'create')->name('custom.link.create');
        Route::post('/custom_link', 'store')->name('custom.link.store');
        Route::get('/custom_link/edit/{id}', 'edit')->name('custom.link.edit');
        Route::put('/custom_link/update/{id}', 'update')->name('custom.link.update');
        Route::delete('/custom_link/destroy/{id}', 'destroy')->name('custom.link.destroy');
    });
    Route::controller(UserScanController::class)->group(function () {
        Route::get('user-scan', 'partner')->name('user.scan.partner');
        Route::get('user-scan/show/{id}', 'showPartner')->name('user.scan.showPartner');
    });
    Route::patch('kunci-sn', [UserScanController::class, 'edit'])->name('kunci');
});

// Route Back End Admin
Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
    Route::controller(SettingWebController::class)->group(function () {
        Route::get('/settingWeb/{id}', 'index')->name('settingWeb.index');
        Route::put('/settingWeb/update/{id}', 'update')->name('settingWeb.update');
    });
    Route::controller(UserController::class)->group(function () {
        Route::put('/updatePassword', 'updatePassword')->name('updatePassword.update');
    });
    Route::controller(BusinessPartnerController::class)->group(function () {
        Route::get('/partners/{id}/business', 'get')->name('business-partners.get');
    });
    Route::controller(RequestAllPartnerController::class)->group(function () {
        Route::get('/requestAll', 'index')->name('requestAll');
        Route::get('/requestAll/{id}', 'show')->name('requestAll.show');
        Route::post('/generateQR', 'generateQR')->name('generateQR');
        Route::post('/upProgress', 'upProgress')->name('upProgress');
        Route::post('/upResi', 'upResi')->name('upResi');
    });
    Route::controller(RequestQrController::class)->group(function () {
        Route::get('/request-qrs/create', 'create')->name('request-qrs.create');
        Route::post('/request-qrs/store', 'store')->name('request-qrs.store');
        Route::get('/request-qrs/{requestQr}/edit', 'edit')->name('request-qrs.edit');
        Route::put('/request-qrs/update/{requestQr}', 'update')->name('request-qrs.update');
        Route::delete('/request-qrs/destroy/{requestQr}', 'destroy')->name('request-qrs.destroy');
        Route::get('/request-qrs/{filename}/download', 'download')->name('request-qrs.download');
    });
    Route::controller(QrController::class)->group(function () {
        Route::get('/export/{id}', 'export')->name('export.qr');
    });

    Route::controller(ProductAllPartnerController::class)->group(function () {
        Route::get('/productAll', 'index')->name('productAll');
        Route::get('/productAll/{id}', 'show')->name('productAll.show');
    });
    Route::controller(UserScanController::class)->group(function () {
        Route::get('customer', 'admin')->name('customer.admin');
        Route::get('customor/show/{id}', 'showAdmin')->name('customer.showAdmin');
    });
    Route::patch('kunci-sn', [UserScanController::class, 'edit'])->name('customer.kunci');
    Route::controller(KontakController::class)->group(function () {
        Route::get('/kontak', 'index')->name('kontak.index');
    });
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::resource('/roles', RolesController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/business', BusinessController::class);
    Route::resource('/partners', PartnerController::class);
    Route::resource('/type-qrs', TypeQrController::class);
});

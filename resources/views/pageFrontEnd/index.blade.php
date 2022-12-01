@extends('pageFrontEnd.layouts.app')
@section('content')
    <!-- hero -->
    <div class="container mb-4" id="home" style="padding-top: 10%">
        <div class="p-2 mb-4 rounded-5 bg-light">
            <div class="container py-5 branding">
                <div class="row">
                    <div class="col-md-6 col-sm">
                        <h1 class="fw-bold">Lindungi Merek Bisnismu Dari Pemalsuan Produk
                        </h1>
                        <p class="my-4 text-muted">Mengatasi segala pelanggaran dan melindungi merek serta pelanggan
                            dari
                            bahaya produk
                            palsu dan imitasi.</p>
                        <a href="#about" class="btn btn-secondary btn-md more" role="button">Pelajari Lebih
                            Lanjut</a>
                        <a href="{{ route('web_register') }}" class="btn btn-primary btn-md try" role="button">Coba
                            Sekarang</a>
                    </div>
                    <div class="col-md-6 col-sm text-center">
                        <img src="{{ url('img/device.png') }}" alt="device" class="img-fluid position-absolute device"
                            width="300">
                        <img src="{{ url('img/authentic.png') }}" alt="authentic"
                            class="img-fluid position-absolute authentic" width="300">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero -->

    {{-- Kategori --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#5adaaa" fill-opacity="1"
            d="M0,256L40,229.3C80,203,160,149,240,144C320,139,400,181,480,213.3C560,245,640,267,720,234.7C800,203,880,117,960,106.7C1040,96,1120,160,1200,186.7C1280,213,1360,203,1400,197.3L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
    <section class="section overflow-hidden active" id="team" style="background-color: #5adaaa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2" data-aos="fade-up" data-aos-duration="500">
                        <h1 class="h1 mb-3 text-white">
                            Kategori Produk Yang Kami Lindungi</h1>
                        <p class="para-desc mx-auto text-white mb-0">
                            Beberapa Kategori Produk Yang Kami Lindungi agar terjamin keasliannya.</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/makanan.png') }}" alt="makanan">
                            <h5 class="mb-1">Bahan Makanan</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/elektronik.png') }}" alt="elektronik">
                            <h5 class="mb-1">Elektronik</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/dokumen.png') }}" alt="dokumen">
                            <h5 class="mb-1">Dokumen</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/farmasi.png') }}" alt="farmasi">
                            <h5 class="mb-1">Farmasi</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/kosmetik.png') }}" alt="kosmetik">
                            <h5 class="mb-1">Kosmetik Parfume</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/perhiasan.png') }}" alt="perhiasan">
                            <h5 class="mb-1">Perhiasan</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 col-6 mt-4 pt-2">
                    <div class="card border-0 text-center shadow border-0 overflow-hidden rounded">
                        <div class="card-body">
                            <img src="{{ url('img/produk/fashion.png') }}" alt="fashion">
                            <h5 class="mb-1">Fashion</h5>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!---end row--->
        </div>
        <!--end container-->
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#5adaaa" fill-opacity="1"
            d="M0,288L48,256C96,224,192,160,288,154.7C384,149,480,203,576,229.3C672,256,768,256,864,229.3C960,203,1056,149,1152,154.7C1248,160,1344,224,1392,256L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
        </path>
    </svg>
    {{-- end Kategori --}}

    <!-- FEATURES START -->
    <section class="section bg-light" id="about">
        <div class="section-title text-center mb-4 pb-2">
            <h1 class="h1 mb-3">Tentang Labelin.co</h1>
        </div>
        <div class="container mt-100 mt-60">
            <div style="background: url('{{ asset('template/frontend/images/map.png') }}') center center;">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="position-relative me-lg-5">
                            <img src="{{ asset('img/Image.png') }}" class="rounded img-fluid mx-auto d-block"
                                alt="">
                            <div class="play-icon">
                                <a href="#!" data-type="youtube" data-id="yba7hPeTSjk" class="play-btn lightbox">
                                    <i class="mdi mdi-play text-primary rounded-circle bg-white shadow"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end col-->

                    <div class="col-lg-6 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                        <div class="section-title">
                            <h4 class="title mb-3">Tentang Kami</h4>
                            <p class="text-muted" style="text-align: justify">{{ $setting_web->deskripsi }}</p>
                            <a href="#" class="title h6 text-dark">Visi Kami</a>
                            <p class="text-muted" style="text-align: justify">
                                Menjadi perusahaan pengembang kemasan dengan teknologi Internet Of Thing (IoT)
                                terpercaya di Indonesia dengan kemampuan bersaing secara universal dan memberi nilai
                                tambah kedapa seluruh pemilik bisnis atau business owner.</p>
                            <a href="#" class="title h6 text-dark">Misi Kami</a>
                            <ul class="list-unstyled text-muted" style="text-align: justify">
                                <li class="mb-1">
                                    <span class="text-primary h5 me-2">
                                        <i class="uil uil-check-circle align-middle"></i>
                                    </span>Menyediakan produk
                                    yang berkualitas, aman dan menyeluruh.
                                </li>
                                <li class="mb-1">
                                    <span class="text-primary h5 me-2">
                                        <i class="uil uil-check-circle align-middle"></i>
                                    </span>
                                    Memberikan solusi dan kepercayaan kepada business owner dan konsumen agar terhindar dari
                                    produk-produk palsu.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </div>
        <!--end container-->

        <div class="container mt-5">
            <div class="section-title text-center mb-4 pb-2">
                <h1 class="h1 text-center mb-3">More Than <span class="number text-primary"
                        data-val="100000">000000</span>+ Product Trust are Secured
                    by labelin.co</h1>
            </div>
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/shopee.png') }}" alt="shopee" height="40">
                        </h3>
                        <span class="counter-head text-muted">Shopee</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->

                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/lazada.png') }}" alt="lazada" height="40">
                        </h3>
                        <span class="counter-head text-muted">Lazada</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->

                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/tokopedia.png') }}" alt="tokopedia" height="50">
                        </h3>
                        <span class="counter-head text-muted">Tokopedia</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->

                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/tiktok.png') }}" alt="tiktok" height="60">
                        </h3>
                        <span class="counter-head text-muted">Tiktok Shop</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row mt-4">
                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/whatsapp.png') }}" alt="whatsapp" height="40">
                        </h3>
                        <span class="counter-head text-muted">whatsapp.com</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->

                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/linktree.png') }}" alt="linktree" height="40">
                        </h3>
                        <span class="counter-head text-muted">Linktr.ee</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->

                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/youtube.png') }}" alt="youtube" height="30">
                        </h3>
                        <span class="counter-head text-muted">Youtube.com</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->

                <div class="col-md-3 col-6">
                    <div class="counter-box position-relative text-center">
                        <h3 class="mb-0 fw-semibold mt-2">
                            <img src="{{ url('img/perusahaan/mailchimp.png') }}" alt="mailchimp" height="50">
                        </h3>
                        <span class="counter-head text-muted">Mailchimp.com</span>
                    </div>
                    <!--end counter box-->
                </div>
                <!--end col-->
            </div>
            {{-- end row  --}}
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End -->

    <!-- Start Blog -->
    <section class="section bg-light" id="layanan" itemscope itemtype="http://schema.org/service">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="section-title text-center mb-4 pb-2">
                        <h1 class="mb-3 h1"><strong>Layanan Kami</strong>
                            <img src="{{ url('/img/mantap.png') }}" alt="mantap" class="img-fluid">
                        </h1>
                        <img src="{{ url('img/garis.png') }}" alt="garis" class="img-fluid" style="margin-top: -5%">
                        <p class="text-muted para-desc mb-0 mx-auto">Mengapa memilih layanan kami merupakan opsi
                            terbaik untuk bisnis anda ? <br> Kami memiliki support service yang menjadi nilai jual
                        </p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row text-center">
                <div class="col-lg col-md mt-2 pt-2">
                    <div class="card shadow-lg bg-body" style="height: 250px;">
                        <div class="card-body  p-0">
                            <div class="p-4">
                                <img src="{{ url('img/layanan/qr.png') }}" alt="qrcode">
                                <a href="#" class="h5 title text-dark d-block mb-0" itemprop="name"
                                    content="Smart Label">Smart
                                    Label</a>
                                <p class="mt-2 mb-0" itemprop="description">{{ $setting_web->nama_website }} Membantu
                                    dalam pembuatan
                                    label
                                    barcode dan nomor seri produk, yang digunakan untuk mengetahui keaslian produk
                                    berbasis Qrcode & RFID/NFC.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md mt-2 pt-2">
                    <div class="card shadow-lg bg-body" style="height: 250px;">
                        <div class="card-body  p-0">
                            <div class="p-4">
                                <img src="{{ url('img/layanan/tracking.png') }}" alt="tracking">
                                <a href="#" class="h5 title text-dark d-block mb-0" itemprop="name"
                                    content="Distribution Tracking System">Distribution
                                    Tracking
                                    System</a>
                                <p class="mt-2 mb-0" itemprop="description">Bersama {{ $setting_web->nama_website }}
                                    Dengan sistem
                                    pelacakan
                                    produk, kamu dapat mengetahui persebaran penjualan produkmu di setiap wilayah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End Blog -->

    <!-- Start Why -->
    <section class="section bg-light" id="why">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="section-title text-center mb-4 pb-2">
                        <div class="section-title text-center mb-4 pb-2">
                            <h1 class="h1 mb-3">Why Us</h1>
                            <p class="text-muted para-desc mb-0 mx-auto">Mengapa memilih layanan kami merupakan
                                opsi
                                terbaik untuk bisnis anda ? <br> Kami memiliki support service yang menjadi nilai
                                jual
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-6 col-md-6 mt-5">
                    <div class="card blog blog-primary shadow-lg bg-body text-center" style="height: 250px">
                        <div class="card-body content p-0">
                            <div class="p-4">
                                <img src="{{ url('/img/layanan/smart.png') }}" alt="smart">
                                <a href="#" class="h5 title text-dark d-block mb-0">Solusi</a>
                                <p class="text-muted mt-2 mb-0" style="text-align: justify">
                                    {{ $setting_web->nama_website }} merupakan solusi nyata dari permasalahan
                                    pemalsuan
                                    produk didalam bisnismu.
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- end card --}}

                    <div class="card blog blog-primary shadow-lg bg-body mt-3 text-center" style="height: 250px">
                        <div class="card-body content p-0">
                            <div class="p-4">
                                <img src="{{ url('/img/layanan/qr.png') }}" alt="qr">
                                <a href="#" class="h5 title text-dark d-block mb-0">Perlindungan</a>
                                <p class="text-muted mt-2 mb-0" style="text-align: justify">Kami mampu mengatasi
                                    segala pelanggaran dan melindungi merek dari pemalsuan produk, sehingga
                                    pelanggan
                                    tidak perlu khawatir dalam membeli produkmu.</p>
                            </div>
                        </div>
                    </div>
                    {{-- end card --}}
                </div>

                <div class="col-lg-6 col-md-6 mt-5">
                    <div class="card blog blog-primary shadow-lg bg-body text-center" style="height: 250px">
                        <div class="card-body content p-0">
                            <div class="p-4">
                                <img src="{{ url('/img/layanan/smart.png') }}" alt="smart">
                                <a href="#" class="h5 title text-dark d-block mb-0">Kepercayaan</a>
                                <p class="text-muted mt-2">Bersama
                                    {{ $setting_web->nama_website }} kita bangun relasi yang baik dengan pelanggan,
                                    guna meningkatkan produktivitas bisnismu.
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- end card --}}
                    <div class="card blog blog-primary shadow-lg bg-body mt-3 text-center" style="height: 250px">
                        <div class="card-body content p-0">
                            <div class="p-4">
                                <img src="{{ url('/img/layanan/tracking.png') }}" alt="tracking">
                                <a href="#" class="h5 title text-dark d-block mb-0">Distribusi</a>
                                <p class="text-muted mt-2 mb-0">Kembangkan bisnis dengan
                                    memantau distribusi produk yang dijual disetiap wilayah.</p>
                            </div>
                        </div>
                    </div>
                    {{-- end card --}}
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End Why -->

    <!-- Start Pricing -->
    <section class="section bg-light" id="pricing">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <div class="section-title text-center mb-4 pb-2">
                            <h1 class="h1 mb-3">Harga Paket</h1>
                            <p class="para-desc text-muted mx-auto mb-0">Dapatkan harga terbaik dari layanan
                                {{ $setting_web->nama_website }}<br>
                                Ayo tunggu apalagi Pesan sekarang Juga!
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                    <div class="card border-0 shadow">
                        <div class="p-4 border-bottom border-light">
                            <h6 class="fw-semibold mb-3 text-uppercase">Free</h6>
                            <p class="text-muted mb-0">Untuk mendapatkan sample label</p>

                            <div class="d-flex my-4">
                                <span class="price h3 fw-semibold mb-0">Rp. 0</span>
                                <span class="text-muted align-self-end mb-1">/Pcs</span>
                            </div>
                            <a href="https://wa.me/6281299903331?text=Apakah%20saya%20bisa%20mendapatkan%20sample%20QrCode%20dari%20labelin.co?"
                                class="btn btn-primary w-100">Ajukan Sample</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                    <div class="card border-0 shadow">
                        <div class="p-4 border-bottom border-light">
                            <h6 class="fw-semibold mb-3 text-uppercase">Startups</h6>
                            <p class="text-muted mb-0">Mendapatkan label bahan thermal 2D</p>

                            <div class="d-flex my-4">
                                <span class="price h3 fw-semibold mb-0">Rp. 350</span>
                                <span class="text-muted align-self-end mb-1">/Pcs</span>
                            </div>

                            <a href="{{ route('partner.register') }}" class="btn btn-primary w-100">Beli
                                Sekarang</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                    <div class="card border-0 shadow">
                        <div class="p-4 border-bottom border-light">
                            <h6 class="fw-semibold mb-3 text-uppercase">Business</h6>
                            <p class="text-muted mb-0">Mendapatkan label digital printing</p>

                            <div class="d-flex my-4">
                                <span class="price h3 fw-semibold mb-0">Rp. 900</span>
                                <span class="text-muted align-self-end mb-1">/Pcs</span>
                            </div>

                            <a href="{{ route('partner.register') }}" class="btn btn-primary w-100">Beli
                                Sekarang</a>
                        </div>

                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                    <div class="card border-0 shadow">
                        <div class="p-4 border-bottom border-light">
                            <h6 class="fw-semibold mb-3 text-uppercase">Premium</h6>
                            <p class="text-muted mb-0">Mendapatkan label hologram 3D</p>

                            <div class="d-flex my-4">
                                <span class="price h3 fw-semibold mb-0">Rp. 1000</span>
                                <span class="text-muted align-self-end mb-1">/Pcs</span>
                            </div>

                            <a href="{{ route('partner.register') }}" class="btn btn-primary w-100">Beli
                                Sekarang</a>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End Pricing -->

    <!-- CTA Start -->
    <section class="section" style="background: url('{{ asset('template/frontend/images/bg/cta.png') }}') center">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="section-title text-center">
                        <h4 class="title text-white mb-3">Mulai perjalanan bisnis Anda lebih baik bersama
                            Labelin.co
                        </h4>
                        <p class="text-white-50 mx-auto para-desc mb-0" style="color:white">Buat agenda dengan tim
                            Labelin.co, selama 30 menit kedepan melalui Google Meet.</p>

                        <div class="mt-4 pt-2">
                            <a href="https://calendly.com/labelinco/bicara-dengan-tim-labelinco" target="blank"
                                class="btn btn-primary">Buat Agenda Meeting Online</a>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- CTA End -->

    <!-- Start Contact -->
    <section class="section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title mb-3">Kontak Kami</h4>
                        <p class="text-muted para-desc mb-0 mx-auto">Untuk pertanyaan seputar layanan
                            {{ $setting_web->nama_website }}, hubungi kami dengan mengisi form dibawah ini.
                        </p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 order-md-2 order-1 mt-4 pt-2">
                    <div class="p-4 rounded shadow bg-white">
                        <form method="post" name="myForm" action="{{ route('send_kontak') }}">
                            @csrf
                            <p class="mb-0" id="error-msg"></p>
                            <div id="simple-msg"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input id="name" type="text" class="form-control" name="nama_lengkap"
                                            placeholder="Nama Lengkap" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <input id="email" type="email" class="form-control" name="email"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-12">
                                    <div class="mb-4">
                                        <input id="subject" class="form-control" name="subjek" placeholder="Subject"
                                            required>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-12">
                                    <div class="mb-4">
                                        <textarea id="comments" rows="4" name="deskripsi" required class="form-control"
                                            placeholder="Deskripsi Pesan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" id="submit" name="send" class="btn btn-primary">Kirim
                                        Pesan</button>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 order-md-1 order-2 mt-4 pt-2">
                    <div class="me-lg-4">
                        <div class="d-flex">
                            <div class="icons text-center mx-auto">
                                <i class="uil uil-phone d-block rounded h4 mb-0"></i>
                            </div>

                            <div class="flex-1 ms-3">
                                <h5 class="mb-2">Telepon</h5>
                                <a href="tel:{{ $setting_web->telpon }}"
                                    class="text-muted">{{ $setting_web->telpon }}</a>
                            </div>
                        </div>

                        <div class="d-flex mt-4">
                            <div class="icons text-center mx-auto">
                                <i class="uil uil-envelope d-block rounded h4 mb-0"></i>
                            </div>

                            <div class="flex-1 ms-3">
                                <h5 class="mb-2">Email</h5>
                                <a href="mailto:{{ $setting_web->email }}"
                                    class="text-muted">{{ $setting_web->email }}</a>
                            </div>
                        </div>

                        <div class="d-flex mt-4">
                            <div class="icons text-center mx-auto">
                                <i class="uil uil-map-marker d-block rounded h4 mb-0"></i>
                            </div>

                            <div class="flex-1 ms-3">
                                <h5 class="mb-2">Alamat</h5>
                                <p class="text-muted mb-2">{{ $setting_web->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- End Contact -->
@endsection

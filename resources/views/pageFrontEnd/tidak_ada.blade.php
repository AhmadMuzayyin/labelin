<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Seri Tidak Terdaftar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/main.css') }}">

    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KR4KHT6');</script>
<!-- End Google Tag Manager -->
</head>

<body>
    <div class="bg-dark container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="row">
                    <div class="bg-light py-3 text-center">
                        <img src="{{ url('assets/img/image 34.png') }}" alt="Labelin">
                    </div>

                    <!-- Serial Number -->
                    <div class="gradient-main py-5">
                        <div class="text-center mb-3">
                            <img src="{{ url('assets/img/Group 4108.png') }}">
                        </div>
                        <div class="text-center text-light">
                            <div class="fw-semibold fs-4">Oops!...</div>
                            <small>Nomor Seri <strong>{{ $sn }}</strong> Tidak Terdaftar</small>
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="content bg-light pt-5 pb-5 px-3">

                        <!-- Alert -->
                        <div class="alert alert-danger d-flex rounded-4 mb-5"
                        style="border-color: #DB2424; background-color: #FDF4F4;" role="alert">
                            <svg class="bi flex-shrink-0 me-3 mt-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00001 0.00499725C3.58277 0.00499725 0.00500488 3.58276 0.00500488 8C0.00500488 12.4172 3.58277 15.995 8.00001 15.995C12.4172 15.995 15.995 12.4172 15.995 8C15.995 3.58276 12.4172 0.00499725 8.00001 0.00499725ZM7.00063 12.9969V10.9981H8.99938V12.9969H7.00063ZM7.00063 3.00312V9.99875H8.99938V3.00312H7.00063Z" fill="#DB2424"/>
                            </svg>

                            <small>Mohon maaf nomor seri yang Anda cari tidak terdaftar pada produk manapun saat ini. Waspada produk palsu atau tiruan!</small>
                        </div>

                        <!-- Tombol Pengaduan -->
                        <div class="d-grid">
                            <button type="button" class="btn text-light btn-block bg-main mb-3" data-bs-toggle="modal" data-bs-target="#pengaduanModal">Pengaduan Produk</button>
                            <a href="https://wa.me/6281299903331?text=Hallo%20admin,%20saya%20ingin%20...." type="button" class="btn btn-block border" target="_blank">Hubungi WhatsApp</a>
                        </div>

                        <div class="text-center" style="margin-top: 8rem;">
                            <a href="{{ route('scan', $sn) }}" class="color-main text-decoration-none">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pengaduanModal" tabindex="-1" aria-labelledby="pengaduanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center px-3 px-md-5">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="modal-content py-2" style="border-radius: 1rem;">
                                <div class="modal-body">
                                    <div class="fw-semibold fs-5 mb-4">Formulir Pengaduan Perlindungan Konsumen</div>
                                    <form action="{{ route('produk_report',$sn) }}" class="mb-5" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama lengkap" required autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_telp" class="form-label fw-medium">No. Telp</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="no telp" required>
                                        </div>
                                        <div class="mb-3">
                                          <label for="kronologi" class="form-label fw-medium">Pengaduan / Kronologis</label>
                                          <textarea class="form-control" id="kronologi" name="kronologi" rows="3" placeholder="pengaduan kronologis" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lampiran" class="form-label">Lampiran Pendukung</label>
                                            <input class="form-control" type="file" id="lampiran" name="lampiran" required>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-main btn-block" >Kirim Laporan</button>
                                            {{-- data-bs-dismiss="modal" --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
        @include('sweetalert::alert')

        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KR4KHT6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>

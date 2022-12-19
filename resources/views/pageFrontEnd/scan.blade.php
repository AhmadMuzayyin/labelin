<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Produk</title>
    <link rel="shortcut icon" href="{{ url('template/frontend/images/icon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/main.css') }}">
    <style>
        .badge-panduan {
            color: #3366FF;
            background-color: #EBF0FF;
            width: 1.35rem;
            height: 1.35rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KR4KHT6');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <div class="bg-dark container-fluid">
        <div class="row justify-content-center">

            <div class="lebar">
                <div class="row">
                    <div class="bg-light py-3 text-center">
                        <img src="{{ getProduk(Request::segment(2)) != null ? Storage::url('public/uploads/logos/') . getProduk(Request::segment(2))->logo : url('assets/img/image 34.png') }}"
                            alt="error" class="img-fluid" width="100">
                    </div>

                    <!-- Serial Number -->
                    <div class="gradient-main pt-5 pb-5">
                        <div class="text-center mb-3">
                            <img src="{{ url('assets/img/Black.png') }}" alt="scan_qrcodes">
                        </div>
                        <div class="text-center text-light">
                            <small>Serial Number</small>
                            <div class="fw-semibold fs-4">{{ Request::segment(2) }}</div>
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="content bg-light py-5 px-3">
                        @if (getVideo(Request::segment(2)))
                            @php
                                $video = getVideo(Request::segment(2));
                            @endphp
                            <div class="justify-content-center text-center align-items-center">
                                <video id="video" width="300" height="250" autoplay loop name="media" muted>
                                    <source src="{{ asset('storage/uploads/video/' . $video->video) }}"
                                        type="video/mp4">
                                    Browser anda tidak suport untuk menampilkan video.
                                </video>
                            </div>
                        @endif
                        <form action="{{ route('cek_produk') }}" method="POST">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="sn" value="{{ Request::segment(2) }}">
                            <div class="mb-5">
                                <div class="fs-6 text-center">Masukkan Pin</div>
                                <div class="row justify-content-center mt-3 mb-2">
                                    <div class="col-8">
                                        <div class="row g-1">
                                            <div class="col-2">
                                                <input type="text" name="satu" id="satu"
                                                    class="form-control input" maxlength="1" required
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="dua" id="dua" class="form-control"
                                                    maxlength="1" required autocomplete="off">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="tiga" id="tiga" class="form-control"
                                                    maxlength="1" required autocomplete="off">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="empat" id="empat" class="form-control"
                                                    maxlength="1" required autocomplete="off">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="lima" id="lima" class="form-control"
                                                    maxlength="1" required autocomplete="off">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="enam" id="enam" class="form-control"
                                                    maxlength="1" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fs-6 text-center text-muted">*Pin terdapat pada label QR</div>
                            </div>
                            <div class="d-grid mb-5">
                                <button type="submit" class="btn btn-main btn-block">Cek
                                    Produk</button>
                            </div>
                        </form>
                        <div class="d-flex align-items-center justify-content-center">
                            <svg class="me-2" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6 0C2.685 0 0 2.685 0 6C0 9.315 2.685 12 6 12C9.315 12 12 9.315 12 6C12 2.685 9.315 0 6 0ZM6.75 2.25V3.75H5.25V2.25H6.75ZM4.5 9V9.75H7.5V9H6.75V4.5H4.5V5.25H5.25V9H4.5Z"
                                    fill="#8C8CA2" />
                            </svg>
                            <small>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="text-decoration-none text-secondary" role="button">Panduan
                                    Penggunaan</a>
                            </small>
                        </div>

                        <div class="d-flex align-items-center justify-content-center pt-5 mt-5">
                            <div class="text-secondary">Didukung oleh</div>
                            <div class="mx-1"></div>
                            <img src="{{ url('assets/img/image 34.png') }}" alt="Labelin">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center px-3 px-md-5">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="modal-content py-2" style="border-radius: 1rem;">
                                <div class="modal-body">
                                    <div class="fw-semibold fs-5 text-center mb-5">Panduan Penggunaan</div>
                                    <ul class="list-group mb-5">
                                        <li class="list-group-item d-flex p-0 mb-3 border-0">
                                            <span class="badge badge-panduan me-3 mt-1">1</span>
                                            Temukan QR code pada kemasan produk Anda
                                        </li>
                                        <li class="list-group-item d-flex p-0 mb-3 border-0">
                                            <span class="badge badge-panduan me-3 mt-1">2</span>
                                            Scan menggunakan QR code Reader pada aplikasi atau Pindai dengan kamera
                                            ponsel Anda
                                        </li>
                                        <li class="list-group-item d-flex p-0 border-0">
                                            <span class="badge badge-panduan me-3 mt-1">3</span>
                                            Masukin 6 digit PIN yang terletak pada label produk, lalu cek produk.
                                        </li>
                                    </ul>
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-block border"
                                            data-bs-dismiss="modal">Oke</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // untuk memeriksa jika browser tidak support maka akan muncul alert
            if (!navigator.geolocation)
                return alert("Geolocation is not supported.");
            // jika browser support maka fungsi ini akan dijalankan
            navigator.geolocation.getCurrentPosition((position) => {
                // tambahkan callback untuk menampilkan latitude dan longitude
                $("#latitude").val(`${position.coords.latitude}`);
                $("#longitude").val(`${position.coords.longitude}`);
            });
            $('#satu').keyup(function() {
                if (this.value.length == this.maxLength) {
                    $('#dua').focus();
                }
            })
            $('#dua').keyup(function(e) {
                if (this.value.length == this.maxLength) {
                    $('#tiga').focus();
                } else if (e.which == 8) {
                    $('#satu').focus();
                }
            })
            $('#tiga').keyup(function(e) {
                if (this.value.length == this.maxLength) {
                    $('#empat').focus();
                } else if (e.which == 8) {
                    $('#dua').focus();
                }
            })
            $('#empat').keyup(function(e) {
                if (this.value.length == this.maxLength) {
                    $('#lima').focus();
                } else if (e.which == 8) {
                    $('#tiga').focus();
                }
            })
            $('#lima').keyup(function(e) {
                if (this.value.length == this.maxLength) {
                    $('#enam').focus();
                } else if (e.which == 8) {
                    $('#empat').focus();
                }
            })
            $('#enam').keyup(function(e) {
                if (e.which == 8) {
                    $('#lima').focus();
                }
            })
        });
    </script>
    @error('latitude')
        <script>
            alert(
                "System tidak mendapatkan izin untuk mengakses lokasi dari browser anda, silahkan periksa pengaturan perizinan lokasi browser anda dan coba lagi"
            );
        </script>
    @enderror
    @include('sweetalert::alert')

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KR4KHT6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>

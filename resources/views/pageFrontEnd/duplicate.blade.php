<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);

        * {
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #86E7BB;
        }

        .card {
            width: 350px;
            cursor: pointer;
            border-radius: 10px;
        }

        .image img {
            transition: all 0.5s
        }

        .image:hover img {
            transform: scale(1.5)
        }

        .btnImage {
            height: 140px;
            width: 140px;
            border-radius: 50%
        }

        .name {
            font-size: 22px;
            font-weight: bold
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }

        .number {
            font-size: 22px;
            font-weight: bold
        }

        .follow {
            font-size: 12px;
            font-weight: 500;
            color: #444444
        }

        .btnLapor {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #DC3545;
            color: #aeaeae;
            font-size: 15px;
            border-radius: 10px;
        }

        .btn1 {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #000;
            color: #aeaeae;
            font-size: 15px;
            border-radius: 10px;
        }

        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500
        }

        .icons i {
            font-size: 19px
        }

        hr .new1 {
            border: 1px solid
        }

        .join {
            font-size: 14px;
            color: #a0a0a0;
            font-weight: bold
        }

        .date {
            background-color: #ccc
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-4 shadow-lg">
            <div class="image d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ Storage::url('public/uploads/logos/') . $produk->logo_brand }}" width="100%" />
            </div>
            <h3 class="h3 mt-3">Nomor Seri Terduplikasi</h3>

            <hr>
            <div class="text text-center">
                <span>
                    Serial Number <b>{{ $sn }}</b> & PIN <b>{{ $pin }}</b> sudah digunakan oleh user
                    atas nama <strong>{{ $duplicate->fullname }}</strong>
                </span>
            </div>
            <hr>
            <div class="text text-center">
                <span style="font-size: 10px;">
                    <b>Untuk pembeli baru :</b> <br>
                    <p class="mt-1">
                        Pastikan nomer seri & pin terdaftar di
                        {{ $setting_web->nama_website }}, untuk memastikan pencegahan duplikasi nomer seri, segera
                        input nama, usia, dan jenis kelamin.
                    </p>
                </span>
            </div>

            <!-- laporkan -->
            <div class="d-flex justify-content-center mt-2">
                <a href="https://wa.me/6281299903331?text=Saya%20mau%20melaporkan%20Serial%20Number%20{{ $sn }}%20dengan%20nama%20produk%20{{ $produk->nama_produk }}"
                    class="btnLapor btn-danger justify-content-center text-decoration-none p-2" role="button"
                    target="_blank">
                    <i class="fa-brands fa-whatsapp"></i> Laporkan
                </a>
            </div>
            <!-- back -->
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('scan', $sn) }}" role="button"
                    class="btn1 btn-dark text-decoration-none p-2">Kembali</a>
            </div>

        </div>
    </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Scan Produk</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="icon" href="{{ asset('template/scan/assets/web-images/lock.png') }}" sizes="16x16" type="image/png">
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

        .border-pin {
            display: flex;
        }

        .num {
            color: #000;
            background-color: transparent;
            width: 17%;
            height: 60px;
            text-align: center;
            outline: none;
            padding: 1rem 1rem;
            margin: 0 1px;
            font-size: 24px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: .5rem;
            color: rgba(0, 0, 0, 0.5);
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div class="container p-3 d-flex justify-content-center">
        <div class="card p-4 shadow-lg">
            <!-- logo -->
            <div class="row">
                <div class="col-sm-12 mb-3 image" style="text-align: center;">
                    <img src="{{ Storage::url('public/img/setting_web/') . $setting_web->logo_dark }}"
                        class="img-fluid center-block">
                </div>
            </div>
            @error('latitude')
                <div class="alert alert-danger" role="alert">
                    System tidak mendapatkan izin untuk mengakses lokasi dari browser anda, silahkan periksa pengaturan perizinan lokasi browser anda dan coba lagi.
                </div>
            @enderror
            <!-- Form -->
            <form action="{{ route('cek_produk') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="sn" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" name="sn" id="sn"
                        value="{{ Request::segment(2) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                        placeholder="Nama Lengkap" required autofocus value="{{ old('nama_lengkap') }}">
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir" class="form-label">Usia</label>
                    <input type="number" class="form-control" name="tgl_lahir" id="tgl_lahir" required min="13"
                        placeholder="Usia" value="{{ old('tgl_lahir') }}">
                </div>
                <div class="mb-3">
                    <label for="jk_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jk_kelamin" id="jk_kelamin" aria-label="Default select example"
                        required>
                        <option value="">--- Pilih ---</option>
                        <option value="Laki-Laki" {{ old('jk_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="Perempuan" {{ old('jk_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jk_kelamin">Masukan PIN</label>
                    <div class="border-pin">
                        <input type="number" name="satu" id="satu" class="num" maxlength="1" required>
                        <input type="number" name="dua" id="dua" class="num" maxlength="1" required>
                        <input type="number" name="tiga" id="tiga" class="num" maxlength="1" required>
                        <input type="number" name="empat" id="empat" class="num" maxlength="1" required>
                        <input type="number" name="lima" id="lima" class="num" maxlength="1" required>
                        <input type="number" name="enam" id="enam" class="num" maxlength="1" required>
                    </div>
                    <span style="color: red; font-size:10px">* PIN terdapat pada label QR</span>
                </div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <!-- Cek Produk -->
                <div class="d-flex justify-content-center mt-2">
                    <button type="submit" class="btn1 btn-dark">Cek Produk</button>
                </div>
            </form>

        </div>
    </div>
    </div>

    @include('sweetalert::alert')
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
                $('#dua').focus();
            })
            $('#dua').keyup(function() {
                $('#tiga').focus();
            })
            $('#tiga').keyup(function() {
                $('#empat').focus();
            })
            $('#empat').keyup(function() {
                $('#lima').focus();
            })
            $('#lima').keyup(function() {
                $('#enam').focus();
            })
        });
    </script>
</body>

</html>

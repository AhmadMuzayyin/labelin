<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting_web->nama_website }}</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Msramdan" />
    <meta name="email" content="{{ $setting_web->email }}" />
    <meta name="version" content="1.0" />
    <link href="{{ asset('template/frontend/images/icon.png') }}" rel="shortcut icon">
    <link href="{{ asset('template/frontend/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('template/frontend/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/frontend/css/line.css') }}" rel="stylesheet">
    <link href="{{ asset('template/frontend/css/style.min.css') }}" rel="stylesheet" type="text/css" id="theme-opt" />
</head>

<body>
    <div class="back-to-home">
        <a href="{{ route('home') }}" class="btn btn-primary"><i data-feather="arrow-left" class="icons"></i> Back To
            Home</a>
    </div>
    <!-- Hero Start -->
    <section class="cover-user bg-white">
        <div class="container-fluid px-0">
            <div class="row g-0 position-relative">
                <div class="col-lg-4 cover-my-30 order-2">
                    <div class="cover-user-img d-flex align-items-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-column auth-hero">
                                    <div class="mt-md-5 text-center">
                                        <a href="#">
                                            <img src="{{ Storage::url('public/img/setting_web/') . $setting_web->logo_dark }}"
                                                alt style="width: 250px">
                                        </a>
                                    </div>
                                    <div class="title-heading my-lg-auto">
                                        <div class="card border-0" style="z-index: 1">
                                            <div class="card-body p-0">
                                                <h4 class="card-title">Signup</h4>

                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <form class="login-form mt-4" action="{{ route('partner.register') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="name">Nama Lengkap
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="First Name" name="name"
                                                                    id="name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="email">Your Email
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control"
                                                                    id="email" placeholder="Email" name="email"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="phone">Phone<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control"
                                                                    placeholder="phone" name="phone" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="address">Address<span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class="form-control" id="address" placeholder="address" name="address" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="password">Password <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="password" class="form-control"
                                                                    id="password" name="password"
                                                                    placeholder="Password" required>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="password-confirmation">Password Confirmation
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="password" class="form-control"
                                                                    name="password_confirmation"
                                                                    placeholder="Password Confirmation"
                                                                    id="password-confirmation" required>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-md-12">
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input mt-0" type="checkbox" id="checkbox" name="syarat"
                                                                    value="true"
                                                                    aria-label="Checkbox for following text input" required>
                                                                    <label for="checkbox"  class="form-check-label">
                                                                        <a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><span class="text-dark">Setujui</span> Syarat dan Ketentuan Berlaku.</a>
                                                                    </label>
                                                            </div>
                                                            <div class="d-grid">
                                                                <button class="btn btn-primary">Register</button>
                                                            </div>
                                                        </div>
                                                        <!--end col-->

                                                        <div class="mx-auto">
                                                            <p class="mb-0 mt-3"><small class="text-dark me-2">Already
                                                                    have an account ?</small> <a
                                                                    href="{{ route('web_login') }}"
                                                                    class="text-dark fw-bold">Sign in</a></p>
                                                        </div>
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div> <!-- end about detail -->
                </div> <!-- end col -->

                <div class="col-lg-8 offset-lg-4 padding-less img order-1"
                    style="background-image:url('/template/frontend/images/bg/1.jpg')" data-jarallax='{"speed": 0.5}'>
                </div><!-- end col -->
            </div>
            <!--end row-->
        </div>
        <!--end container fluid-->
    </section>
    <!--end section-->
    <!-- Hero End -->
    @include('pageFrontEnd.ketentuan')
    <!-- javascript -->
    <script src="{{ asset('template/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Icons -->
    <script src="{{ asset('template/frontend/js/feather.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('template/frontend/js/plugins.init.js') }}"></script>
    <script src="{{ asset('template/frontend/js/app.js') }}"></script>
    @include('sweetalert::alert')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>

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
        <a href="{{ route('home') }}" class=" btn btn-primary"><i data-feather="arrow-left" class="icons"></i> Back To Home</a>
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
                                        <a href="#"><img src="{{ Storage::url('public/img/setting_web/') . $setting_web->logo_dark }}" alt="" style="width: 250px"></a>
                                    </div>
                                    <div class="title-heading my-lg-auto">
                                        <div class="card login-page border-0" style="z-index: 1">
                                            <div class="card-body p-0">
                                                <h4 class="card-title">Login</h4>
                                                <form class="login-form mt-4" method="post" action="{{ route('auth-partner') }}">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required="">
                                                                @error('password')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="">
                                                                @error('email')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="myFunction()">
                                                                    <label class="form-check-label">Show Password</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 mb-0">
                                                            <div class="d-grid">
                                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="mb-0 mt-3"><small class="text-dark me-2">Don't have an account ?</small> <a href="{{ route('web_register') }}" class="text-dark fw-semibold">Sign Up</a></p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div> <!-- end about detail -->
                </div> <!-- end col -->

                <div class="col-lg-8 offset-lg-4 padding-less img order-1" style="background-image: url('/template/frontend/images/bg/1.jpg')"></div>
            </div>
            <!--end row-->
        </div>
        <!--end container fluid-->
    </section>
    <!--end section-->
    <!-- Hero End -->

    <!-- javascript -->
    <script src="{{ asset('template/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Icons -->
    <script src="{{ asset('template/frontend/js/feather.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('template/frontend/js/plugins.init.js') }}"></script>
    <script src="{{ asset('template/frontend/js/app.js') }}"></script>
    @include('sweetalert::alert')
    <script>
		function myFunction() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>
</body>

</html>

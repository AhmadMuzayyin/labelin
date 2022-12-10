<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="{{ asset('template/backend/assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/backend/assets/css/material/app.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class='pace-top'>
    <div id="app" class="app">
        <div class="login login-v2 fw-bold">
            <div class="login-cover">
                <div class="login-cover-img" style="background-image: url({{ asset('template/backend/assets/img/login-bg/login-bg-13.jpg') }})" data-id="login-cover-image"></div>
                <div class="login-cover-bg"></div>
            </div>
            <div class="login-container">
                <div class="login-header">
                    <div class="brand">
                        <div class="d-flex align-items-center">
                            <img src="{{ url('img/logo_White.png') }}" alt="labelin" class="img-fluid-responsive" height="50px">
                        </div>
                        <small>Please login to start session</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="login-content">
                    {{-- content --}}
                    @yield('content')
                </div>
            </div>
        </div>
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('template/backend/assets/js/vendor.min.js') }}" type="1dcc4dafd62983dc732657cb-text/javascript"></script>
    <script src="{{ asset('template/backend/assets/js/app.min.js') }}" type="1dcc4dafd62983dc732657cb-text/javascript"></script>
    <script src="{{ asset('template/backend/assets/js/demo/login-v2.demo.js') }}" type="1dcc4dafd62983dc732657cb-text/javascript"></script>
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

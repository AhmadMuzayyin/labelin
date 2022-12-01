<!-- START NAVBAR -->
<nav id="navbar" class="navbar navbar-expand-lg fixed-top sticky">
    <div class="container-fluid mx-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="logo-light-mode" itemscope>
                <img itemprop="image" src="{{ url('img/logo_Black.png') }}" alt="" style="width:160px">
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i data-feather="menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-navlist">
                <li class="nav-item">
                    <a class="nav-link" href="{{ !Request::is('/') ? url('/#home') : '#home' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ !Request::is('/') ? url('/#about') : '#about' }}">Tentang Labelin.co</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ !Request::is('/') ? url('/#layanan') : '#layanan' }}">Layanan & Teknologi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ !Request::is('/') ? url('/#why') : '#why' }}">Why Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ !Request::is('/') ? url('/#pricing') : '#pricing' }}">Harga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ !Request::is('/') ? url('/#contact') : '#contact' }}">Kontak</a>
                </li>
            </ul>

            <ul class="list-inline menu-social mb-0 ps-lg-4 ms-2">
                <li class="list-inline-item"><a href="{{ route('web_login') }}"
                        class="btn btn-outline-primary btn-navbar">Login</a></li>
            </ul>
        </div>
        <!--end collapse-->
    </div>
    <!--end container-->
</nav>
<!-- END NAVBAR -->

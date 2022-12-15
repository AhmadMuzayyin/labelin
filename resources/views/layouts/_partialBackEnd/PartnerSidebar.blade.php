<div id="sidebar" class="app-sidebar" data-disable-slide-animation="true">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        @if (Session::get('photo-partner') == null)
                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Session::get('email-partner')))) }}&s=30"
                                alt="Photo" />
                        @else
                            <img src="{{ asset('storage/uploads/photos/' . session()->get('photo-partner')) }}"
                                alt="Photo" />
                        @endif
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            Partner - {{ Session::get('name-partner') }}
                        </div>
                    </div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('PartnerDashboard') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">home</i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('part-bus.business.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">store</i>
                    </div>
                    <div class="menu-text">Bisnis</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('products.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Product</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('request-qrs.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">insert_drive_file</i>
                    </div>
                    <div class="menu-text">Request QR</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('partnerTypeQr') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-qrcode" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Type QR</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('partner.profile') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Profile</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('user.scan.partner') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="menu-text">Custemer Data</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('sosmed.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-share-nodes" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Sosmed</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('signout-partner') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Logout</div>
                </a>
            </div>
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
    </div>
</div>

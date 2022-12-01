<div id="sidebar" class="app-sidebar" data-disable-slide-animation="true">

    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email))) }}&s=30" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                </a>
            </div>
            <div class="menu-item {{ set_active(['dashboard*']) }}">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">home</i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>
            @can('partner_show')
            <div class="menu-item {{ set_active(['partners*', 'business*']) }}">
                <a href="{{ route('partners.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">store</i>
                    </div>
                    <div class="menu-text">Partner</div>
                </a>
            </div>
            @endcan

            @can('product_show')
            <div class="menu-item {{ set_active(['productAll*']) }}">
                <a href="{{ route('productAll') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Partner Produk</div>
                </a>
            </div>
            @endcan
            <div class="menu-item {{ set_active(['requestAll*']) }}">
                <a href="{{ route('requestAll') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">insert_drive_file</i>
                    </div>
                    <div class="menu-text">Request QR</div>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('customer.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="menu-text">Custemer Data</div>
                </a>
            </div>
            @can('kontak_show')
            <div class="menu-item {{ set_active(['kontak*']) }}">
                <a href="{{ route('kontak.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">Kontak</div>
                </a>
            </div>
            @endcan
            @canany(['category_show','type_qr_show'])
            <div class="menu-item has-sub {{ set_active(['categories*','type-qrs*']) }} ">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">list</i>
                    </div>
                    <div class="menu-text">Master Data</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @can('category_show')
                    <div class="menu-item {{ set_active(['categories*']) }}">
                        <a href="{{ route('categories.index') }}" class="menu-link ">
                            <div class="menu-text">Kategori Produk</div>
                        </a>
                    </div>
                    @endcan
                    @can('type_qr_show')
                    <div class="menu-item {{ set_active(['type-qrs*']) }}">
                        <a href="{{ route('type-qrs.index') }}" class="menu-link ">
                            <div class="menu-text">Type QR</div>
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
            @endcanany

            @canany(['user_show', 'role_show', 'setting_web_show'])
            <div class="menu-item has-sub {{ set_active(['user*', 'roles*','settingWeb*']) }} ">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="material-icons">settings</i>
                    </div>
                    <div class="menu-text">Utilities</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @can('user_show')
                    <div class="menu-item {{ set_active(['user*']) }}">
                        <a href="{{ route('user.index') }}" class="menu-link ">
                            <div class="menu-text">User</div>
                        </a>
                    </div>
                    @endcan

                    @can('role_show')
                    <div class="menu-item {{ set_active(['roles*']) }}">
                        <a href="{{ route('roles.index') }}" class="menu-link ">
                            <div class="menu-text">Roles</div>
                        </a>
                    </div>
                    @endcan

                    @can('setting_web_show')
                    <div class="menu-item {{ set_active(['settingWeb*']) }}">
                        <a href="{{ route('settingWeb.index', 1) }}" class="menu-link ">
                            <div class="menu-text">Setting Website</div>
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
            @endcanany

            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>

        </div>

    </div>

</div>

<!DOCTYPE html>
<html lang="en">
{{-- head --}}
@include('layouts._partialBackEnd.head')

<body>
    <div class="modal fade" id="ajaxModelEditPassword"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('updatePassword.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h4 class="modal-title">Update Password <span id="attr_sku_kode"></span> </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="password">Password Baru</label>
                                <input id="password" class="form-control" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.passcon.pattern = this.value;" placeholder="Password Baru" required>
                            </div>
                            <div class="form-group">
                                <label for="passcon">Konfirmasi Password</label>
                                <input class="form-control" id="passcon" name="passcon" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="Konfirmasi Password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                            <button type="submit" href="javascript:;" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="app" class="app app-header-fixed app-sidebar-fixed  app-with-wide-sidebar">
        {{-- header --}}
        @include('layouts._partialBackEnd.PartnerHeader')
        {{-- sidebar --}}
        @include('layouts._partialBackEnd.PartnerSidebar')

        <div class="app-sidebar-bg"></div>
        <div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

        {{-- content --}}
        @yield('content')

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>
    {{-- script --}}
    @include('layouts._partialBackEnd.script')
    <script>
        $('#ubahPassword').click(function() {
            $('#ajaxModelEditPassword').modal('show');
        });
    </script>
    @stack('js')
    @include('sweetalert::alert')

</body>

</html>

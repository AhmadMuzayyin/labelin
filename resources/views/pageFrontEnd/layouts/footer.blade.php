<!-- Footer Start -->
<footer class="bg-footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-py-60">
                    <div class="row">
                        <div class="col-lg-3 col-12 mb-lg-0 mb-md-4 pb-lg-0 pb-md-2">
                            <a href="#" class="logo-footer">
                                <img src="{{ asset('img/logo_White.png') }}" height="50" alt="logo_white">
                            </a>
                            <p class="mt-4 mb-0" style="text-align: justify">{{ $setting_web->deskripsi }}
                            </p>
                        </div>
                        <!--end col-->

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Links</h5>
                            <ul class="list-unstyled footer-list mt-4">
                                <li>
                                    <a href="{{ url('/privacy-policy') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/disclaimer') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Disclaimer
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/terms&conditions') }}" class="text-foot">
                                        <i class="uil uil-angle-right-b me-1"></i> Terms & Conditions
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end col-->

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Get In Touch</h5>

                            <p class="mt-4">{{ $setting_web->alamat }}</p>
                            <ul class="list-unstyled footer-list mt-3">
                                <li>Phone: <a href="tel:{{ $setting_web->telpon }}"
                                        class="text-light">{{ $setting_web->telpon }}</a></li>
                                <li>Email: <a href="mailto:{{ $setting_web->email }}"
                                        class="text-light">{{ $setting_web->email }}</a></li>
                            </ul>
                        </div>
                        <!--end col-->

                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h5 class="footer-head">Terhubung Dengan Kami</h5>
                            <ul class="list-unstyled social-icon text-md foot-social-icon mb-0">
                                <li class="list-inline-item">
                                    <a href="https://www.instagram.com/labelin_co/?igshid=YmMyMTA2M2Y%3D"
                                        target="_blank" class="rounded">
                                        <i class="uil uil-instagram align-middle" title="instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</footer>
<!--end footer-->

<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top rounded-pill fs-5"><i data-feather="arrow-up"
        class="fea icon-sm icons align-middle"></i></a>
<!-- Back to top -->

<!-- Chat width admin -->
<a href="https://wa.me/6281299903331?text=Saya%20tertarik%20dengan%20layanan%20labelin.co, ingin%20mendapatkan%20informasi%20lebih%20lanjut"
    class="chat-admin rounded-pill" target="_blank">
    <i class="fa-brands icon-wa fa-whatsapp"></i>
</a>
<!-- Chat width admin -->

<!-- JAVASCRIPTS -->
<script src="{{ asset('template/frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/frontend/js/swiper.min.js') }}"></script>
<script src="{{ asset('template/frontend/js/tobii.min.js') }}"></script>
<script src="{{ asset('template/frontend/js/contact.js') }}"></script>
<script src="{{ asset('template/frontend/js/gumshoe.js') }}"></script>
<script src="{{ asset('template/frontend/js/feather.min.js') }}"></script>
<!-- Custom -->
<script src="{{ asset('template/frontend/js/plugins.init.js') }}"></script>
<script src="{{ asset('template/frontend/js/app.js') }}"></script>
@include('sweetalert::alert')
<script>
    let values = document.querySelectorAll(".number");
    let interval = 90000;
    values.forEach((value) => {
        let start = 90000;
        let end = parseInt(value.getAttribute("data-val"));
        let duration = Math.floor(interval / end);
        let counter = setInterval(function() {
            start += 1;
            value.textContent = start;
            if (start == end) {
                clearInterval(counter);
            }
        }, duration);
    });
</script>

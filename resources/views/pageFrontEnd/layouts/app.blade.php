<!doctype html>
<html lang="en">
  @include('pageFrontEnd.layouts.head')
<body>
  @include('pageFrontEnd.layouts.navbar')
  @yield('content')
  @include('pageFrontEnd.layouts.footer')
  @include('pageFrontEnd.layouts.script')

  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KR4KHT6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>
</html>
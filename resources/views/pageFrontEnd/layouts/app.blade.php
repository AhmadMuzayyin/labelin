<!doctype html>
<html lang="en">
  @include('pageFrontEnd.layouts.head')
<body>
  @include('pageFrontEnd.layouts.navbar')
  @yield('content')
  @include('pageFrontEnd.layouts.footer')
  @include('pageFrontEnd.layouts.script')
</body>
</html>
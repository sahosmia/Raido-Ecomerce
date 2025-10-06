<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>
    <title>@yield('page_title') - {{ config('app.name', 'Riode') }}</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Riode - Ultimate eCommerce Template" />
    <meta name="author" content="D-THEMES" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/icons/favicon.png')}}" />

    <script>
      WebFontConfig = {
        google: { families: ["Poppins:300,400,500,600,700,800"] },
      };
      (function (d) {
        var wf = d.createElement("script"),
          s = d.scripts[0];
        wf.src = "js/webfont.js";
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
      })(document);
    </script>

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.min.css') }}"/>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/magnific-popup/magnific-popup.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/owl-carousel/owl.carousel.min.css') }}"/>
    <!-- Custom CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/custom.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/photoswipe/photoswipe.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/photoswipe/default-skin/default-skin.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/nouislider/nouislider.min.css') }}">
    @yield('exta_css')
    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.min.css') }}"/>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/demo1.min.css') }}"/> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.min.css') }}"/> --}}
  </head>

  <body class="home">
    <div class="page-wrapper">

    <!-- Header -->
    @include('include.frontend.header')


      


    @yield('content')


      </main>

      <!-- End of Main -->
         @include('include.frontend.footer')

      <!-- End Footer -->
    </div>
    <!-- Sticky Footer -->
    @include('include.frontend.sticky_footer')

    <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="d-icon-arrow-up"></i></a>


    <!-- MobileMenu -->
    @include('include.frontend.mobile_menu')

    <!-- newslatter -->
    {{-- @include('include.frontend.newslatter') --}}



    <!-- Plugins JS File -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/elevatezoom/jquery.elevatezoom.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('frontend/assets/js/custom.js')}}"></script>
    <script src="{{ asset('frontend/vendor/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('frontend/photoswipe/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>
     @yield('exta_js')
    <!-- Main JS File -->
    <script src="{{ asset('frontend/js/main.min.js')}}"></script>
  </body>
</html>

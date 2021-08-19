<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('signin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('signin/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('signin/css/iofrm-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('signin/css/iofrm-theme16.css')}}">
</head>
<body>
    <div class="form-body without-side">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="{{asset('signin/images/logo-light.svg')}}" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('signin/images/graphic3.svg')}}" alt="">
                </div>
            </div>

              @yield('content')
        </div>
    </div>
<script src="{{ asset('signin/js/jquery.min.js')}}"></script>
<script src="{{ asset('signin/js/popper.min.js')}}"></script>
<script src="{{ asset('signin/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('signin/js/main.js')}}"></script>
</body>
</html>

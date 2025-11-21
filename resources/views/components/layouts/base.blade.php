@props(['title' => '', 'css' => '', 'js' => ''])



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('static/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('static/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('static/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('static/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('static/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
    {{ $css }}

    <title>{{ $title }} | Royal Pixies Bridal Solution</title>


</head>

<body>

    <x-layouts.top />

    {{-- ----------------------MAIN---------------------- --}}
    {{ $slot }}


    <x-layouts.footer />


    <!-- loader -->
    {{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> --}}


    <script src="{{ asset('static/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('static/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('static/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('static/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('static/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('static/js/aos.js') }}"></script>
    <script src="{{ asset('static/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('static/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('static/js/google-map.js') }}"></script>
    <script src="{{ asset('static/js/main.js') }}"></script>
    {{ $js }}

</body>

</html>

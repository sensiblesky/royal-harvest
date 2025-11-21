<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin || HEET</title>
    <link href="{{ asset('static/img/spina.png')  }}" rel="shortcut icon" />

    <link rel="stylesheet" href="{{ asset('admins/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/dist/css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset("images/IAAlogo.svg") }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->

        <x-admin.top-admin />
        {{-- <x-aside /> --}}
        <x-admin.side-admin/>
    
     
        <div class="content-wrapper">
            <div class="m-2">
                <x-admin.alert />
            </div>
            {{ $slot }}
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        <x-admin.footer-admin />
    </div>



    <script src="{{ asset('admins/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admins/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <script src="{{ asset('admins/dist/js/adminlte.js') }}"></script>

    <script src="{{ asset('admins/dist/js/demo.js') }}"></script>

    <script src="{{ asset('admins/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('admins/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admins/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('admins/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <script src="{{ asset('admins/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admins/dist/js/pages/dashboard2.js') }}"></script>
</body>

</html>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/sitelogo.png') }}" type="image/x-icon" />
    <!--=== fontawesome-free-5.15.2 ===-->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">
    <!--=== Google Fonts ===-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap"rel="stylesheet">
    <!--=== Bootstrap 4 ===-->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <!--=== Main Css ===-->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/default.css') }}">
    <!--=== Style & Responsive  Css ===-->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <!--=== Responsive Css ===-->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/responsive.css') }}" />
    @yield('css')

</head>

<body class="sidebar-toggled">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <div id="content-wrapper" class="contentWrapper d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.partials.header')
                <!-- End of Topbar -->
                <!-- Start of Container -->
                @yield('content')

                <!-- End of Container -->
            </div>
        </div>
        <!-- End of Sidebar -->
    </div>

    <!--=== All Plugin ===-->
    <!--============= Jquery-3.6.0 =============-->
    <script type="text/javascript" src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!--=== Bootstrap4 js ===-->
    <script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <!--=== Main js ===-->
    <script type="text/javascript" src="{{ asset('assets/admin/js/main.js') }}"></script>
    @yield('js')

</body>

</html>

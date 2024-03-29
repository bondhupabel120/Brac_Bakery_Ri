<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FUDGE - The Best Bakery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset ('img/favicon.ico')}}" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset ('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset ('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset ('css/style.min.css')}}" rel="stylesheet">
    <link href="{{ asset ('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="/" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">FUDGE</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="{{ url('/') }}" class="nav-item nav-link @if(Request::is('/')) active @endif">Home</a>
                    <a href="{{ url('about') }}" class="nav-item nav-link @if(Request::is('about')) active @endif">About</a>
                    <a href="{{ url('products') }}" class="nav-item nav-link @if(Request::is('products')) active @endif">Menu</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="reservation.html" class="dropdown-item">Reservation</a>
                            <a href="#bottom" class="dropdown-item">Testimonial</a>
                        </div>
                    </div> --}}
                    <a href="{{ url('contact') }}" class="nav-item nav-link @if(Request::is('contact')) active @endif">Contact</a>
                    @if (Auth::check())
                        <a href="{{ url('/main/successlogin') }}" class="nav-item nav-link">{{ Auth::user()->name }}</a>
                        <a href="{{ url('/main/logout') }}" class="nav-item nav-link">Logout</a>
                    @else
                        <a href="{{ url('login') }}" class="nav-item nav-link @if(Request::is('login')) active @endif">Login</a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
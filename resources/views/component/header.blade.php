<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Landing Page ASABRI</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="{{asset ('assets/landingpage/img/icon-asabri.png')}}" rel="icon">
  <link href="{{asset ('assets/landingpage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{asset ('assets/landingpage/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/css/style.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/css/custom.css')}}" rel="stylesheet">
  <link href="{{asset ('assets/landingpage/css/datatables.min.css')}}" rel="stylesheet">
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
  @stack('style')
</head>

<body>

  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="#">ASABRI</a></h1>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="nav-link {{Request::url() == route('index') ? 'active' : ''}}" href="{{route('index')}}">Home</a></li>
          @if (getToken())
            <li><a class="nav-link {{ ( Request::url() == route('myapp') ) ||  ( Request::url() == route('listapp') ) ? 'active' : ''}}" href="{{route('myapp')}}">My Application</a></li>
            <li><a class="nav-link" href="#">Documentation</a></li>
            <li><a class="nav-link" href="{{route('logout')}}">Logout</a></li>
          @else
            <li><a class="nav-link" href="{{route('loginpage')}}">Login</a></li>
            {{-- <li><a class="nav-link " href="#about">About</a></li> --}}
            {{-- <li><a class="nav-link " href="#team">Team</a></li> --}}
            {{-- <li><a class="nav-link  " href="#portfolio">Portfolio</a></li> --}}
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <div class="header-social-links d-flex align-items-center">
        @if(getToken())
          <a href="#" class="twitter text-success"><i class='bx bxs-polygon' data-toggle="tooltip" data-placement="top"
            title="you are logged in"></i></a>
        @else
          <a href="#" class="twitter text-danger"><i class='bx bxs-polygon' data-toggle="tooltip" data-placement="top"
            title="you are not logged in"></i></a>
        @endif
      </div>

    </div>
  </header>
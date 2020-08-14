<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kings Scheduler</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/profile.css')}}">
  <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="">
    <div class="container d-flex align-items-center">
      
    <h1 class="logo mr-auto"><a href="{{route('index')}}">Kings Scheduler<span>.</span></a></h1>
    @if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class = "alert alert-danger">
            {{$error}}
        </div>    
    @endforeach
@endif

@if(session('message'))
    <div class = "alert alert-success">
        {{session('message')}}
    </div>    
@endif

@if(session('error'))
    <div class = "alert alert-danger">
        {{session('error')}}
    </div>    
@endif
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{route('home')}}">Home</a></li>
        @guest
            <li><a href="{{route('login')}}">Login</a></li> 
        @endguest
        @if(Auth::user()->role == 1)
        <li><a href="{{route('entry')}}">New Entry</a></li>
        @endif
        <li><a href="{{route('schedules')}}">Pending Schedules</a></li>
        <li><a href="{{route('allSchedules')}}">All Schedules</a></li>
        <li><a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
       </a>

       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
       </form>
      </li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
@yield('content')

<footer id="footer">

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Kings</span></strong>
      </div>
      <div class="credits">
        
        Modified by <a href="https://bootstrapmade.com/">Solomon</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>

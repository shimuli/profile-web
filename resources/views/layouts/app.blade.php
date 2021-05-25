<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('img/logo.png') }}" rel="icon">

    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

       {{--  Vendor CSS Files  --}}
    <link href="{{ asset('css/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    {{--  Js  --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Cedric Shimuli - @yield('title') </title>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <h1 class="logo me-auto me-lg-0"><a href="{{ route('home.index') }}">Cedric</a></h1>
            {{--  <!-- Uncomment below if you prefer to use an image logo -->  --}}
            {{--  <a href="index.html" class="logo"><img src="{{ asset('img/favicon.png') }}" alt="" class="img-fluid"></a>  --}}

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a href="{{ route('about.index') }}">About</a></li>
                    <li><a href="{{ route('resume.index') }}">Resume</a></li>
                    <li><a href="{{ route('services.index') }}">Projects</a></li>
                    <li><a href="{{ route('articles.index') }}">Blogs</a></li>
                    <li><a href="{{ route('home.contact') }}">Contact</a></li>
                    <li><a href="{{ route('articles.create')}}">Create Article</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="header-social-links">
                <a href="" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>

        </div>

    </header><!-- End Header -->
    <div>
        @if (session('status'))
            <div style="background: red; color:white">{{ session('status') }}</div>
        @endif
        @yield('content')
    </div>
    
</body>

</html>

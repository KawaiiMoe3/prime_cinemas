<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Font Awesome CSS --}}
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    
    @yield('styles')
    
    <title>@yield('title')</title>
</head>
<body>
    <!-- Include Header Component -->
    <x-header />

    @yield('content')
    @stack('scripts')

    <!-- Include Footer Component -->
    <x-footer />

    <!-- jQuery-->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Swiper JS -->
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <!-- index JS -->
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
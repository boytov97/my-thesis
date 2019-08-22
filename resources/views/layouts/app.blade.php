<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('h1')
        <title>@yield('h1')</title>
    @else
        <title>Башкы баракча</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ assert('/favicons/favicon.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-i.jpg') }}">
    <link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/index-anim.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/categories.css') }}">

    @stack('css')
</head>
<body>
    @include('common.header')

    <div class="main-ownContent">
        <div class="ownWrapper">
            @yield('content')
        </div>
    </div>

    <div class="on_footer"></div>
    <div class="ownModal" id="ownModal"></div>
    <div class="onMenuModal" id="onMenuModal"></div>

    @include('common.footer')

    <script src="{{ asset('/js/jquery-2.2.4.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>

    @stack('js')
</body>
</html>

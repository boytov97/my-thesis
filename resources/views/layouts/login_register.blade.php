<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Англист тилин акысыз, онлайн үйрөнүү</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ assert('/favicons/favicon.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-i.jpg') }}">
    <link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/signup.css') }}">

<!-- Styles -->
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<body>
    <div id="lby-headen">
        <div id="lby-logo">
            <a href="{{ url('/') }}">
                <h2>Learn by<span class="yourself">YOURSELF</span></h2>
            </a>
        </div>
        <div id="enterBlock">
            @if(Route::is('register'))
                <a href="{{ route('login') }}" id="enter">К и р ү ү</a>
            @elseif(Route::is('login'))
                <a href="{{ route('register') }}" id="enter">К а т т а л у у</a>
            @endif
        </div>
    </div>

    <div class="main-ownContent">
        <div id="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
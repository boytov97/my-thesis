<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/js/refresh.js') }}"></script>

    <!-- Fonts -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/favicon.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-i.jpg') }}">
    <link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admin.css') }}">

</head>
<body>
@include('admin.common.header')

<div class="page__main">
    <div class="wrapper__adm">
        <div class="colum__0">
            @include('admin.common.menu')
        </div>

        <div class="colum__1">
            @yield('page_content')
        </div>
    </div>

    @include('admin.common.footer')
</div>

<div class="ownModal" id="ownModal">
</div>

<script src="{{ asset('/js/jquery-2.2.4.js') }}"></script>
<script src="{{ asset('/js/admin.js') }}"></script>

@stack('js')

<script>
    window.FontAwesomeConfig = {searchPseudoElements: true};
</script>
</body>
</html>
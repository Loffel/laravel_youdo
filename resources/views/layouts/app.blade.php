<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fydw') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors/blue.css') }}">
</head>
<body class="{{ Route::current()->getPrefix() == 'tasks' ? 'gray' : ''}}">
    <div id="wrapper" class="{{ Route::currentRouteName() == 'welcome' ? 'wrapper-with-transparent-header' : ''}}">
        @include('includes/header')

        @yield('intro')
        @yield('content')

        @include('includes/footer')
        
        @guest
            @include('includes/login_popup')
        @endguest
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/mmenu.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/tippy.all.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/simplebar.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/bootstrap-slider.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/snackbar.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/clipboard.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/magnific-popup.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    {{--  <script type="application/javascript" src="{{ asset('js/custom.js') }}"></script>  --}}
    {{--  <script type="application/javascript" src="{{ asset('js/bundle.min.js') }}"></script>  --}}
    @stack('scripts')
</body>
</html>

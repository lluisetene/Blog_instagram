<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('lib/adminlte-3.0.5/plugins/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/myjs.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Fontawesome -->
    <link href="{{ asset('lib/adminlte-3.0.5/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">

    @stack('script_files')

</head>
<body>
    <div id="app">

        @include('layouts.navbar')

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    @stack('script')
    @yield('scripts')
</body>
</html>

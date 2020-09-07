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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 5%;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @guest
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                @else
                    <div class="input-group col-md-4 offset-md-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-navbar" placeholder={{ __('Search...') }} aria-label="Search" aria-describedby="basic-addon1">
                    </div>

                    <div class="col-md-3 offset-md-2 collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">
                                @include('includes.avatar', ['style' => 'float:right;', 'user' => Auth::user()])
                            </a>
                            <li class="dropdown user user-menu">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="hidden-xs"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="col-md">
                                            <a href="{{ route('user.show',['id' => Auth::user()->id]) }}" style="color:black;">
                                                <span>
                                                    <i class="fas fa-user-circle" style="margin-right:5%;"></i>{{ __('Profile') }}
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md">
                                            <a href="{{ route('user.update', ['id' => Auth::user()->id]) }}" style="color:black;">
                                                <span>
                                                    <i class="fas fa-cog" style="margin-right:5%;"></i>{{ __('Configure') }}
                                                </span>
                                            </a>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="col-md">
                                            <a href="#" style="color:black;" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                                <span>
                                                    <i class="fas fa-sign-out-alt" style="margin-right:5%;"></i>{{ __('Logout') }}
                                                </span>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    @stack('script')
    @yield('scripts')
</body>
</html>

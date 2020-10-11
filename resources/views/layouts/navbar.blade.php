<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        @guest
            <div class="row" style="width:100%;">
                <!-- 'Instagram' -->
                <div class="col-md-2 offset-md-1">
                    <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 5%;">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <!-- Buscador, botones, ajustes usuario -->
                <div class="col-md-3 offset-md-6">
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
                </div>
            </div>
        @else
        <!-- 'Instagram' -->
            <div class="col-md-2 offset-md-1">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 5%;">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <!-- Buscador, botones, ajustes usuario -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Buscador -->
                    <div class="col-md-4 offset-md-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            </div>
                            <input type="text" class="form-control form-control-navbar" placeholder={{ __('Search...') }} aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <!-- botones y ajustes cuenta usuario -->
                    <div class="col-md-4 offset-md-2 collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <div class="row">
                            <ul class="navbar-nav ml-auto" style="margin-top:1%;">
                                <a href="{{ route('index') }}" style="color:black;">
                                    <i class="fas fa-home fa-lg"></i>
                                </a>
                                <a href="{{ route('index') }}" style="color:black; margin-left:10%;">
                                    <i class="far fa-comment-alt fa-lg"></i>
                                </a>
                                <a href="{{ route('index') }}" style="color:black; margin-left:10%;">
                                    <i class="fas fa-compass fa-lg"></i>
                                </a>
                                <a href="{{ route('index') }}" style="color:black; margin-left:10%;">
                                    <i class="far fa-heart fa-lg"></i>
                                </a>

                                <!-- Authentication Links -->
                                <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">
                                    @include('includes.avatar', ['style' => 'float:right;', 'user' => Auth::user(), 'other_username' => ''])
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
                                                <a href="#" style="color:black;">
                                                    <span>
                                                        <i class="far fa-bookmark" style="margin-right:6%; margin-left:1%"></i>{{ __('Saved') }}
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
                    </div>
                </div>
        @endguest
    </div>
</nav>
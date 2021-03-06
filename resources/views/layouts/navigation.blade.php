<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-utensils"></i> Recipes
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>



            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                @auth
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="{{ route('recipes.create') }}">
                            <i class="fas fa-plus-square"></i>   {{ __('New recipe') }}</a>
                    </li>
                @endauth
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('has_access')
{{--                                <a class="dropdown-item" href="{{ route('admin') }}"--}}
{{--                                >--}}
{{--                                    <i class="fas fa-user-shield"></i>   {{ __('Admin panel') }}--}}
{{--                                </a>--}}

                                <a class="dropdown-item" href="{{ route('categories.index') }}">
                                    {{ __('Categories') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('recipes.softDeletes') }}">
                                    {{ __('Recipes') }}
                                </a>
                            @endcan

                            <a class="dropdown-item" href="{{ route('users.edit', auth()->id()) }}"
                            >
                                <i class="fas fa-user mr-1"></i>   {{ __('Edit profile') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1"></i>   {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

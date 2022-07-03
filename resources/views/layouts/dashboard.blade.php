<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'MyShop') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->is_admin)
                                    <a class="dropdown-item" href="{{route('dashboard.products')}}">
                                        {{ __('Dashboard') }}
                                    </a>
                                @else
                                    <a class="dropdown-item" href="{{route('dashboard.orders')}}">
                                        {{ __('Dashboard') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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

    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                <div id="dashboardSidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary rounded-end" style="width: 300px">
                    <a href="{{ url('/') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                        <span class="fs-4">{{__('Shop')}}</span>
                    </a>
                    <hr>
                    @if (Auth::user()->is_admin)
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="{{url('dashboard/products')}}"
                                   class="nav-link text-white @if(preg_match('/products/i' , $pathInfo)) active @endif">
                                    {{__('Products')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('dashboard/orders')}}"
                                   class="nav-link text-white  @if(preg_match('/orders/i' , $pathInfo)) active @endif">
                                    {{__('Orders')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('dashboard/users')}}"
                                   class="nav-link text-white  @if(preg_match('/users/i' , $pathInfo)) active @endif">
                                    {{__('Users')}}
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    {{__('Orders')}}
                                </a>
                            </li>
                        </ul>
                    @endif

                </div>
                <div id="dashboardMainbar" class="col-md-9">
                    @yield('mainbar')
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

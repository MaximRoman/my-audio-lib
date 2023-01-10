<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href={{ asset("/pictures/icons/favicon.png") }}>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
    <script src="https://kit.fontawesome.com/736804efb5.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @vite([ 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app" class="min-vh-100 row justify-content-center p-4_5 bg-dark text-light w-100 m-0">
        <nav class="border-bottom border-dark navbar rounded-top d-flex p-0 ">
            <div class="col-3 h-100 d-flex align-items-center justify-content-center bg-secondary rounded-top-start-4">
                <a class="navbar-brand m-0 d-flex align-items-center h75" href="/">
                    <h3 class="m-0 p-0 text-success">{{ config('app.name', 'Laravel') }}</h3>
                </a>
            </div>
            <div class="col-9 bg-gray h-100 d-flex align-items-center rounded-top-end-4 justify-content-between border-start border-dark" id="navbarSupportedContent">
                <top-navbar></top-navbar>
                <div class="col-4 d-flex justify-content-center">
                    @guest
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-success p-2 pt-1 pb-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Вход
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">    
                            @if (Route::has('login'))
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    {{ __('Авторизация') }}
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    {{ __('Зарегистрироваться') }}
                                </a>  
                            @endif
                        </div>
                    </div>
                    @else
                        @if (Auth::user()->email_verified_at !== null)
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/add-book">{{ __('Добавить Книгу') }}</a>
                                    <a class="dropdown-item" href="/admins">{{ __('Права Администраторов') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else 
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endguest
                </div>
            </div>
        </nav>

        <div class="container d-flex p-0 min-vh-80">
            <div class="col-3">
                <categories-menu></categories-menu>       
            </div>
            <main class="col-9 border-start border-dark">
                <div class="card rounded-0 bg-gray border-0 h-100">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>

        <footer class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm rounded-bottom-4 border-top border-dark">
            <div class="container">            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto text-success">
                        <li><h5>Copyright &copy; 2022 | Design by Roman Maxim</h5></li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item "><a class="nav-link link-success" href="https://www.facebook.com/maxim.roman.18" target="_blank"><h5><i class="fa-brands fa-facebook-f"></i></h5></a></li>
                        <li class="nav-item"><a class="nav-link link-success" href="https://www.linkedin.com/in/maxim-roman-392888253/" target="_blank"><h5><i class="fa-brands fa-linkedin-in"></i></h5></a></li>
                        <li class="nav-item"><a class="nav-link link-success" href="https://github.com/MaximRoman" target="_blank"><h5><i class="fa-brands fa-github"></i></h5></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

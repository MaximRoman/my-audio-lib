<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/736804efb5.js" crossorigin="anonymous"></script>
    @vite([ 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app" class="min-vh-100 w-100 row justify-content-center p-4_5 bg-dark text-light">
        <nav class="border-bottom border-dark navbar rounded-top d-flex p-0 ">
            <div class="col-3 h-100 d-flex align-items-center justify-content-center bg-secondary rounded-top-start-4">
                <a class="navbar-brand m-0 d-flex align-items-center h75" href="/">
                    <h3 class="m-0 p-0 text-success">{{ config('app.name', 'Laravel') }}</h3>
                </a>
            </div>
            <div class="col-9 bg-gray h-100 d-flex align-items-center rounded-top-end-4 justify-content-between border-start border-dark" id="navbarSupportedContent">
                <ul class="col-6 nav mr-auto d-flex align-items-center d-flex h-100">
                    <li class="nav-item col-2 h-100 d-flex align-items-center justify-content-center ">
                      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src={{ asset("/pictures/icons/search.png") }} alt=""></a>
                    </li>
                    <li class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
                      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src={{ asset("/pictures/icons/fav.png") }} alt=""></a>
                    </li>
                    <li class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
                      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src={{ asset("/pictures/icons/obshalka.png") }} alt=""></a>
                    </li>
                    <li class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
                      <a class="nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" href="#"><img src={{ asset("/pictures/icons/faq1.png") }} alt=""></a>
                    </li>
                    <li class="nav-item col-2 h-100 d-flex align-items-center justify-content-center">
                      <a class="text-dark nav-link h-100 w-100 btn btn-outline-gray d-flex align-items-center justify-content-center border-top-0 border-bottom-0 border-start-0 border-end-2 rounded-0" id="theme-btn"><h1><i class="fa-solid fa-moon" ></i></h1></a>
                    </li>
                </ul>
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
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/add-book">{{ __('Добавить Книгу') }}</a>
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
                    @endguest
                </div>
            </div>
        </nav>

        <div class="container d-flex p-0 min-vh-80">
            <div class="col-3">
                    <div class="card border-0 rounded-0 bg-secondary h-100 d-flex flex-column align-items-center">
                        <div class="card-body">
                            <h3 class="d-flex align-items-center gap-2"><img src={{ asset("/pictures/icons/left-menu.png") }} alt=""> Категории:</h3>
                            <ul class="list-group">
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/audiospektakl">Аудиоспектакль</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/alternativnaya-istoriya">Альтернативная история</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/biznes">Бизнес</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/biografiya">Биографии, мемуары</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/boevik">Боевик</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/detektivy-trillery">Детективы, триллеры</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/dlya-detey">Для детей</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/istoriya">История</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/klassika">Классика</a>
                                </li>
                                {{-- <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/lyubovnyy-romani">Любовный роман</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/lyubovnoe-fentezi">Любовное фэнтези</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/medicina-zdorove">Медицина, здоровье</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/nauchno-populyarnoe">Научно-популярное</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/obuchenie">Обучение</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/poznavatelnaya-literatura">Познавательная литература</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/postapokalipsis">Постапокалипсис</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/poeziya">Поэзия</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/priklyucheniya">Приключения</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/psihologiya-filosofiya">Психология, философия</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/ranobe">Ранобэ</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/raznoe">Разное</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/religiya">Религия</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/roman-proza">Роман, проза</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/skazki">Сказки</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/uzhasy-mistika">Ужасы, мистика</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/ezoterika">Эзотерика</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/yumor-satira">Юмор, сатира</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/fantastika-fenteze">Фантастика, фэнтези</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/stalker">S.T.A.L.K.E.R.</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/s-t-i-k-s">S-T-I-K-S</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/litrpg">LitRPG</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/metro-2033">Метро 2033</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/etnogenez">Этногенез</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/tehnotma">Технотьма</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/eve-online">EVE online</a>
                                </li>
                                <li class="list-group-item border-0 bg-secondary p-0 pb-1 pt-1">
                                    <a class="btn btn-outline-success w-100 text-start" href="/popadanci">Попаданцы</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>                
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

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Balneario') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/layout.js') }}" defer></script>
    <script src="{{ asset('js/fontSizes.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adult.css') }}" rel="stylesheet">
    <link href="{{ asset('css/juvenil.css') }}" rel="stylesheet">
    <link href="{{ asset('css/child.css') }}" rel="stylesheet">
    <title>DemoLaravel </title>
</head>

<body class="">
    @php
    $pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
    @endphp
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
                Balneario Playa Caribe
            </a>
            <div class="container w-auto">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    Menu</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="d-flex">
                            <select name="theme" id="theme-select" class="mr-2 " onchange="actualizarTheme()">
                                {{-- <option value="1" class="border-0">adulto</option>
                                <option value="2" class="border-0">juvenil</option>
                                <option value="3" class="border-0">niño</option> --}}
                            </select>
                            <button id="switch" class="border-0 rounded">switches</button>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif --}}
                        @else
                        @if (Session::has('menu'))
                        @foreach (Session::get('menu') as $navbarItem)
                        @if (count($navbarItem['subMenu']) == 0)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route($navbarItem['file'] . '.index') }}">{{ $navbarItem['name'] }}</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $navbarItem['name'] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($navbarItem['subMenu'] as $accion)
                                @if(Session::has('idRolUser') && Session::get('idRolUser')==2)
                                @if($navbarItem['file'] . '.' . $accion['param']!= 'ambientes.create')
                                <a class="dropdown-item" id="accion-{{$navbarItem['file'] . '-' . $accion['param']}}"
                                    href="{{ route($navbarItem['file'] . '.' . $accion['param']) }}">{{ $accion['name'] }}</a>
                                @endif
                                @else
                                @if($navbarItem['file'] . '.' . $accion['param']!= 'mantenimientos.create')
                                <a class="dropdown-item"
                                    href="{{ route($navbarItem['file'] . '.' . $accion['param']) }}">{{ $accion['name'] }}</a>
                                @endif
                                @endif
                                @endforeach

                            </div>
                        </li>
                        @endif
                        @endforeach
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        <br>
        @yield('content_header')
        <main class="py-4 h-auto main-1">
            @yield('content')
        </main>
    </div>
    {{-- FOOTER --}}
    <footer>
        <div class="row-12 text-center footer-1" style="height: 2.5rem;">
            Bienvenido Al Sitio Web Balnerio Playa Caribe
        </div>
        <div class="row-11 d-flex justify-content-between align-items-center footer-2">

            <div class="col text-white text-center p-2">
                <img src="{{ asset('images/p1.png') }}" alt='Fotos' style='width: 50px; height: 50px;'>
                <img src="{{ asset('images/p2.png') }}" alt='Fotos' style='width: 50px; height: 50px;'>
                <img src="{{ asset('images/p3.png') }}" alt='Fotos'
                    style='width: 50px; height: 50px; border-radius: 50%;'>
                <img src="{{ asset('images/p4.png') }}" alt='Fotos'
                    style='width: 50px; height: 50px; border-radius: 50%;'>

            </div>
            <div class="col text-white text-center p-2">
                <p>Copyright(c) UAGRM-FICCT GRUPO-04-SC: 2023</p>
                <button class="f-btn" id="aumentar">
                    <span class="text-white m-3" href="">+ tamaño del texto</span>
                </button>
                <button class="f-btn" id="disminuir">
                    <span class="text-white">- tamaño del texto</span>
                </button>
            </div>
            <div class="col text-white text-center p-2">
                <h3>visitas : {{ $pagina->visitas }}</h3>
            </div>

        </div>
    </footer>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
</body>

</html>
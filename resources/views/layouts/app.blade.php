<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel sticky-top shadow">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>
          @guest

          @else
            <ul class="navbar-nav nav-masthead">
                @if (Auth::user()->archive)
                  <li class="nav-item mr-3 dropdown">
                    <a id='drop' class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                      <i data-feather="users"></i>
                      Archivo
                    </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#drop">
                    <router-link class="dropdown-item" to='/room/machines'>
                      Salas
                    </router-link>
                    <router-link class="dropdown-item" to='/room/massive'>
                      Ingreso Masivo
                    </router-link>
                  </div>
                </li>
                @endif
                @if (Auth::user()->find)
                  <li class="nav-item mr-3">
                    <a class="nav-link" href="#">
                      <i data-feather="search"></i>
                      Consulta
                    </a>
                  </li>
                @endif
              @if (Auth::user()->report)
                <li class="nav-item mr-3">
                  <router-link class="nav-link" to='/report'>
                    <i data-feather="bar-chart"></i>
                    Estadistico
                  </router-link>
                </li>
              @endif
                @if (Auth::user()->setting)
                  <li class="nav-item mr-3 dropdown">
                    <a id='dropUtils' class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                      <i data-feather="settings"></i>
                      Mantenimiento
                    </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#dropUtils">
                    <router-link class="dropdown-item" to="/machine">
                      Mant. Maquinas
                    </router-link>
                    <router-link class="dropdown-item" to="/user">
                      Mant. Usuarios
                    </router-link>
                    <router-link class="dropdown-item" to="/room">
                      Mant. Salas
                    </router-link>
                  </div>
                </li>
                @endif
            </ul>
          @endguest

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              {{-- <li class="nav-item">
                @if (Route::has('register'))
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
              </li> --}}
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  {{-- Shared Components --}}

  <message></message>

  <main class="py-3">
    @yield('content')
    <div class="container">
      @auth
        <router-view></router-view>
        <vue-snotify></vue-snotify>
      @endauth
    </div>
  </main>
</div>
</body>
</html>

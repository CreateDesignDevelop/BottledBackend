<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Little Notes') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" media="screen" href=" {{asset('css/style.css?v=1')}}">

</head>
<body>
    <div id="app">
    <!-- Authentication Links -->
    <div class="nav">
      @if (Auth::guest())
          <!-- <li><a href="{{ url('/login') }}">Login</a></li> -->
      @else
          <li>
              <a href="{{ url('/admin') }}">Admin</a>
          </li>
          <li>
              <a href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout
              </a>

              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>
      @endif
    </div>

      <div class="content" style="background:transparent url('img/background.png') center top no-repeat; background-size:cover;">
        @yield('content')
      </div>
      <div class="world-map-background" style="background:transparent url('img/world-map.png') center top no-repeat; background-size:cover;"></div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

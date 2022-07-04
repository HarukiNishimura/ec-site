<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcSite') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/Ec.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom">
  <a class="navbar-brand ml-5" href="{{ url('/') }}">Atelier Marry</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
    </ul>
    <ul class="navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
      </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Shop
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"id='a' >All Items</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/category/1">Broach</a>
          
          <a class="dropdown-item" href="/category/2">Necklace</a>

          <a class="dropdown-item" href="/category/3">Ring</a>
          @if(Auth::check())
          <hr>
          <a class="dropdown-item" href="{{route('bought')}}">購入履歴</a>
          @endif
        </div>
      </li>
      @if(Auth::check())
      <li class="nav-item mr-4">
      <div class="d-flex">
                        <a href="{{route('mycart')}}" class="btn btn-outline-dark" >
                          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            
                            <span class="badge bg-dark text-white ms-1 rounded-pill">{{ $count ?? '' }}</span>
                        </a>
                    </div>
      </li>
      @endif
            <li class="nav-item d-flex align-items-center ">
                @if(Auth::check())
                <span class="my-navbar-item">{{ Auth::user()->name }}</span>
                /
                <a href="/logout" id="logout" class="my-navbar-item">ログアウト</a>
            @else
              <a class="my-navbar-item" href="{{route('login')}}">ログイン</a>
              /
              <a class="my-navbar-item" href="{{route('register')}}">会員登録</a>
              @endif
            </li>
            
     </ul>
    </div>
</nav>
@yield('content')
</body>
</html>
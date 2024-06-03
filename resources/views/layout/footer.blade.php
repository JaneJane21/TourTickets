<nav class="navbar navbar-expand-lg">
    <div class="container d-flex flex-column">

    <hr style="color: #FFC600; height: 3px; width: 100%;">
      <div class="collapse navbar-collapse d-flex justify-content-around" style="width: 100%;" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex flex-column">


          <li class="nav-item">
            <p>8 (800)100-10-10</p>
        </li>
        @guest
          <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="{{ route('reg') }}">Регистрация</a>
          </li>
          <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="{{ route('login') }}">Авторизация</a>
          </li>
        @endguest
          
          @auth
            <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="{{ route('profile') }}">Личный кабинет</a>
          </li>
          @if (Illuminate\Support\Facades\Auth::user()->role != 0)
            <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="{{route('control')}}">Панель управления</a>
          </li>
          @endif
          @endauth
          <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="#">Поиск тура</a>
          </li>
          <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="#">Путеводитель</a>
          </li>
          @auth
          <li class="nav-item">
            <a style="text-decoration: underline" class="nav-link" href="{{route('logout')}}">Выход</a>
          </li>
          @endauth
          

        </ul>
        <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('public\logo\logo.jpg') }}" alt="logo"></a>
      </div>
    </div>
  </nav>

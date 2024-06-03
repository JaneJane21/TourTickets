<nav class="navbar navbar-expand-lg d-flex flex-column align-items-center">

    <div class="container d-flex flex-column align-items-center">
        <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('public\logo\logo.jpg') }}" alt="logo"></a>
    </div>
    <div class="container d-flex flex-column align-items-center">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div style="width: 100%;" class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul style="width: 100%;" class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-around">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">путеводитель</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('catalog') }}">поиск</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('reg') }}">регистрация</a>
          </li>
          @auth
            <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">личный кабинет</a>
          </li>
          @endauth
          

        </ul>

      </div>
      <hr style="color: #FFC600; height: 3px; width: 100%;">
    </div>
  </nav>

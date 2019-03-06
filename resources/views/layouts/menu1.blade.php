<nav class="navbar navbar-expand-sm py-0">
  <div class="collapse navbar-collapse flex-row-reverse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Idioma') }}</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">{{ __('ES') }}</a></li>
          <li><a class="dropdown-item" href="#">{{ __('CA') }}</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/img/mapa_parc.jpg">{{ __('Mapa') }}</a>
      </li>
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Registre') }}</a>
        </li>
        @endif
      @elseif(Auth::user()->id_rol == 3)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nom }} {{ Auth::user()->cognom1 }}</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="{{ route('perfil') }}">{{ __('Perfil') }}</a></li>
          <li><a class="dropdown-item" href="{{ route('incidencia') }}">{{ __('Incidències') }}</a></li>

          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </li>
      @elseif(Auth::user()->id_rol == 2)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nom }} {{ Auth::user()->cognom1 }}</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="{{ route('perfil') }}">{{ __('Perfil') }}</a></li>
          <li><a class="dropdown-item" href="{{ route('incidencia') }}">{{ __('Incidències') }}</a></li>
          <li><a class="dropdown-item" href="{{ route('gestio') }}">{{ __('Gestió') }}</a></li>

          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </li>
      @elseif(Auth::user()->id_rol == 1)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nom }} {{ Auth::user()->cognom1 }}</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="{{ route('perfil') }}">{{ __('Perfil') }}</a></li>
          <li><a class="dropdown-item" href="{{ route('incidencia') }}">{{ __('Incidències') }}</a></li>

          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </li>
      @endguest
      <li>
        <button type="button" class="btn btn-default btn-sm" onclick="#">
          <img src="/img/carrito.png">
        </button>
      </li>
    </ul>
  </div>
</nav>
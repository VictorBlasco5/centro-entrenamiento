<style>
    .navbar {
        background-color: #000000ff;
        font-family: var(--font-jost-regular);
        display: flex;
        justify-content: center;
        padding: 10px 20px;
    }

    .navbar .nav-items {
        display: flex;
        align-items: center;
        gap: 30px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .navbar a,
    .navbar button {
        color: white;
        text-decoration: none;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .navbar a:hover,
    .navbar button:hover {
        color: #f0f0f0;
        text-decoration: underline;
    }

    .navbar .logo img {
        height: 35px;
    }
</style>

<nav class="navbar">
    <ul class="nav-items">
        @guest
        <li><a href="{{ route('dashboard') }}">Inicio</a></li>
        <li><a href="{{ url('/trainers') }}">Entrenadores</a></li>
        <li><a href="{{ url('/contact') }}">Contacto</a></li>
        <li class="logo">
            <a href="{{ route('dashboard') }}">
                <img src="/images/logo.png" alt="Logo">
            </a>
        </li>
        <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
        <li><a href="{{ route('register') }}">Registro</a></li>
        @else
        @if(Auth::user()->role === 'client')
        <li><a href="{{ route('dashboard') }}">Inicio</a></li>
        <li><a href="{{ url('/trainers') }}">Entrenadores</a></li>
        <li><a href="{{ url('/contact') }}">Contacto</a></li>
        <li class="logo">
            <a href="{{ route('dashboard') }}">
                <img src="/images/logo.png" alt="Logo">
            </a>
        </li>
        <li><a href="{{ route('sessions.calendar') }}">Calendario</a></li>
        <li><a href="{{ route('sessions') }}">Mis sesiones</a></li>
        <li><a href="{{ route('profile.edit') }}">Perfil</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </li>
        @elseif(Auth::user()->role === 'coach' || Auth::user()->role === 'admin')
        <li><a href="{{ route('coach') }}">Sesiones</a></li>
        <li class="logo">
            <a href="{{ route('dashboard') }}">
                <img src="/images/logo.png" alt="Logo">
            </a>
        </li>
        <li><a href="{{ route('profile.edit') }}">Perfil</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </li>
        @endif
        @endguest
    </ul>
</nav>
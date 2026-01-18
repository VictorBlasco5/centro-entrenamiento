<nav class="navbar">
    <li class="logo mobile-logo">
        <img src="/images/logo.png" alt="Logo">
    </li>
    <div class="hamburger" id="hamburger" onclick="toggleMenu()">☰</div>

    <ul class="nav-items">
        @guest
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="{{ url('/trainers') }}">Entrenadores</a></li>
        <li><a href="{{ url('/contact') }}">Contacto</a></li>
        <li class="logo desktop-logo">
            <img src="/images/logo.png" alt="Logo">
        </li>

        <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
        <li><a href="{{ route('register') }}">Registro</a></li>
        @else
        @if(Auth::user()->role === 'client')
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="{{ url('/trainers') }}">Entrenadores</a></li>
        <li><a href="{{ url('/contact') }}">Contacto</a></li>
        <li class="logo">
            <a href="{{ route('calendar') }}">
                <img src="/images/logo.png" alt="Logo">
            </a>
        </li>
        <li><a href="{{ route('calendar') }}">Calendario</a></li>
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
            <a href="{{ route('calendar') }}">
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


<script>
    function toggleMenu() {
        const menu = document.querySelector('.nav-items');
        const hamburger = document.getElementById('hamburger');

        menu.classList.toggle('active');

        if (menu.classList.contains('active')) {
            hamburger.textContent = '✕';
        } else {
            hamburger.textContent = '☰';
        }
    }
</script>
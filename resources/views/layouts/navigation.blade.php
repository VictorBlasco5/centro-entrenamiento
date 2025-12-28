<style>
    .navbar {
        background-color: #000000ff;
    }

    .navbar-container {
        padding: 16px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .navbar-logo {
        height: 40px;
        width: auto;
        display: block;
    }

    .navbar-links {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn {
        text-decoration: none;
        font-size: 14px;
        padding: 8px 14px;
        border-radius: 4px;
        cursor: pointer;
        border: none;
    }

    .btn-link {
        background: none;
        color: #ffffffff;
    }

    .btn-link:hover {
        text-decoration: underline;
        color: white;
    }
</style>

<header class="navbar">
    <div class="navbar-container">
        <nav class="navbar-links">
            <a href="{{ url('/') }}" class="btn btn-link">
                Inicio
            </a>
            <a href="" class="btn btn-link">
                Contacto
            </a>
            <a href="{{ url('/trainers') }}" class="btn btn-link">
                Entrenadores
            </a>
            <a class="navbar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-logo">
            </a>
            @auth
            <a href="{{ route('dashboard') }}" class="btn btn-link">
                Calendario
            </a>
            <a href="{{ route('profile.edit') }}" class="btn btn-link">
                Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">
                    Logout
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-link">
                Iniciar sesión
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-link">
                Registro
            </a>
            @endif
            @endauth
        </nav>

    </div>
</header>
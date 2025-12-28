<style>
    .navbar {
        background-color: #000000ff;
    }

    .navbar-container {
        width: 100%;
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

    .navbar-user {
        font-size: 14px;
        color: #ffffffff;
    }

    .btn {
        text-decoration: none;
        font-size: 14px;
        padding: 8px 14px;
        border-radius: 4px;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background-color: #111;
        color: #fff;
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
            @auth
            <span class="navbar-user">
                Hola, {{ Auth::user()->name }}
            </span>

            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">
                    Logout
                </button>
            </form>
            @else
            <a href="{{ url('/') }}" class="navbar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-logo">
            </a>
            <a href="" class="btn btn-link">
                Inicio
            </a>
            <a href="" class="btn btn-link">
                Contacto
            </a>
            <a href="" class="btn btn-link">
                Entrenadores
            </a>

            <a href="{{ route('login') }}" class="btn btn-link">
                Login
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-primary">
                Register
            </a>
            @endif
            @endauth
        </nav>

    </div>
</header>
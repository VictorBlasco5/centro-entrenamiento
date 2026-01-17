
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="container-footer">
    <div class="row">
        <div class="links-footer">

            <!-- Persona no logueada -->
            {{-- Persona no logueada --}}
            @if(!Auth::check())
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ url('/trainers') }}">Entrenadores</a>
            <a href="{{ url('/contact') }}">Contacto</a>
            @endif

            <!-- Cliente -->
            @auth
            @if(Auth::user()->role === 'client')
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ url('/trainers') }}">Entrenadores</a>
            <a href="{{ url('/contact') }}">Contacto</a>
            <a href="{{ route('calendar') }}">Calendario</a>
            <a href="{{ route('sessions') }}">Mis sesiones</a>
            @elseif(Auth::user()->role === 'coach' || Auth::user()->role === 'admin')
            <!-- Coach/Admin -->
            <a href="{{ route('coach') }}">Mis sesiones</a>
            @endif
            @endauth

        </div>

        <div class="copyright">
            © 2026 Centro de Entrenamiento. Todos los derechos reservados.
        </div>

        <div class="instagram">
            <a href="https://www.instagram.com">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>
    </div>
</section>
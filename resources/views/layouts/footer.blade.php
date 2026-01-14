<style>
    .container-footer {
        background-color: #000000ff;
        color: white;
        font-size: 12px;
    }

    .row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 20px 60px 20px 60px;
    }

    .links-footer {
        display: flex;
        flex-direction: row;
        gap: 15px;
        width: auto;
    }

    .links-footer a {
        padding: 0;
        font-size: 12px;
    }

    .copyright {
        padding-right: 120px;
    }

    .instagram {
        width: 20px;
        height: 20px;
    }

    .instagram i {
        font-size: 20px
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<section class="container-footer">
    <div class="row">
        <div class="links-footer">
            <a href="{{ url('/') }}" class="btn btn-link">Inicio</a>
            @auth
            <a href="{{ route('dashboard') }}" class="btn btn-link">Calendario</a>
            @endauth
            <a href="{{ url('/trainers') }}" class="btn btn-link">Entrenadores</a>
            <a href="{{ url('/contact') }}" class="btn btn-link">Contacto</a>
        </div>
        <div class="copyright">© 2026 Centro de Entrenamiento. Todos los derechos reservados.</div>
        <div class="instagram"> <a href="https://www.instagram.com" class="btn btn-link"><i class="fa-brands fa-instagram"></i></a></div>
    </div>
</section>
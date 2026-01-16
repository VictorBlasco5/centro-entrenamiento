
<section class="container-contact">
    <div class="subcontainer-contact">
        <div class="left-contact">

            <h1>CONTACTO</h1>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <input
                    class="input-name"
                    type="text"
                    name="nombre"
                    placeholder="Nombre"
                    required>

                <input
                    class="input-name"
                    type="email"
                    name="email"
                    placeholder="Email"
                    required>

                <textarea
                    class="text-contact"
                    name="mensaje"
                    placeholder="Deja tu mensaje"
                    required></textarea>

                <div class="cont-button-contact">
                    <button type="submit" class="btn btn-contact">
                        Enviar
                    </button>
                </div>
            </form>
            @if(session('success'))
            <div id="toast" class="toast">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div class="right-contact">
            <div class="street">
                <i class="fa-solid fa-location-dot"></i>
                <a href="https://www.google.com/maps/search/?api=1&query=C.%20de%20Campos%20Crespo%2C%2016%2C%20Patraix%2C%2046017%20Val%C3%A8ncia%2C%20Valencia"
                    target="_blank"
                    class="link">
                    C. de Campos Crespo, 16, Patraix, 46017 València
                </a>

            </div>
            <div class="phone">
                <i class="fa-solid fa-phone"></i>
                <a href="tel:+34600123456">+34 600 123 456</a>
            </div>
            <div class="email">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:victor.blasco.17@gmail.com">info@contacto.com</a>
            </div>
            <div class="hour">
                <i class="fa-solid fa-clock"></i>
                <p>Horario:</p>
                <p>Lun. - Vie. 8h - 14h y 16h - 22h</p>
            </div>
        </div>
    </div>
</section>
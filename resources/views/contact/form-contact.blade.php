<style>
    body {
        margin: 0;
        font-family: var(--font-jost-regular);
    }

    .container-contact {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        background-image: url('../images/transforma.png');
        background-position: bottom;
        background-size: cover;
    }

    .subcontainer-contact {
        width: 80vw;
        height: 70vh;
        display: flex;
        justify-content: center;
        flex-direction: row;
    }

    .left-contact {
        width: 70vw;
        background-color: #0f0f0fa4;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 0px 60px 0px 60px;
    }

    .right-contact {
        width: 70vw;
        background-color: #0f0f0fa4;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-direction: column;
        color: white;
        padding: 0px 60px 0px 60px;
    }

    .left-contact h1 {
        width: 100%;
        color: white;
        display: flex;
        justify-content: flex-start;
        font-size: 50px;
        font-weight: bold;
    }

    .input-name {
        width: 100%;
        height: 40px;
        margin: 10px 0px 10px 0px;
        border: none;
        font-size: 12px;
    }

    .input-name:focus {
        outline: none;
    }

    .input-name::placeholder {
        color: black;
        opacity: 1;
        font-size: 12px;
    }

    .text-contact {
        width: 100%;
        height: 80px;
        margin: 10px 0px 10px 0px;
        resize: none;
        border: none;
        font-size: 12px;
    }

    .text-contact::placeholder {
        color: black;
        opacity: 1;
        font-size: 12px;
    }

    .text-contact:focus {
        outline: none;
    }

    .cont-button-contact {
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

    .btn-contact {
        width: 150px;
        margin: 10px 10px 10px 10px;
        background-color: black;
        color: white;
        border-radius: 0;
        border: 1px solid #373737a4; 
    }

    .btn-contact:hover {
        background-color: #373737a4;
    }

    .street a,
    .email a,
    .phone a {
        color: white;
        text-decoration: none;
        margin: 10px 0px 10px 0px;

    }

    .street,
    .phone,
    .email,
    .hour {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.5em;
    }

    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #ffffffff;
        color: black;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s, transform 0.5s;
        z-index: 1000;
    }

    .toast.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

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


<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('toast');
        if (toast) {
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });
</script>
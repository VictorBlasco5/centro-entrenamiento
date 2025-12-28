<style>
    body {
        margin: 0;
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
    }

    .input-name {
        width: 100%;
        height: 40px;
        margin: 10px 10px 10px 10px;
        border: none;
    }

    .input-name:focus {
        outline: none;
    }

    .input-name::placeholder {
        color: black;
        opacity: 1;
    }

    .text-contact {
        width: 100%;
        height: 80px;
        margin: 10px 10px 10px 10px;
        resize: none;
        border: none;
    }

    .text-contact::placeholder {
        color: black;
        opacity: 1;
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
</style>

<section class="container-contact">
    <div class="subcontainer-contact">
        <div class="left-contact">
            <h1>CONTACTO</h1>
            <input class="input-name" type="text" placeholder="Nombre">
            <input class="input-name" type="text" placeholder="Email">
            <textarea class="text-contact" name="" id="" placeholder="Deja tu mensaje"></textarea>
            <div class="cont-button-contact">
                <button class="btn btn-contact">Enviar</button>
            </div>
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
                <a href="mailto:info@contacto.com">info@contacto.com</a>
            </div>
            <div class="hour">
                <i class="fa-solid fa-clock"></i>
                <p>Horario:</p>
                <p>Lun. - Vie. 8h - 14h y 16h - 22h</p>
            </div>
        </div>
    </div>
</section>
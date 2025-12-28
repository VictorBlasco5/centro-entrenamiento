<style>
    body {
        margin: 0;
    }

    .container-trainers {
        background-color: #000000f4;
        color: black;
    }

    .container-trainers h1 {
        margin: 0;

        color: white;
        font-size: 50px;
        padding-left: 4em;
        padding-top: 0.5em;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(3, 15em);
        gap: 4em;
        justify-content: center;
        padding: 20px;
    }

    .card-trainer {
        width: 15em;
        color: white;
    }

    .card-trainer h4 {
        font-size: 18px;
        margin-top: 10px;
        margin-bottom: 0;
    }

    .card-trainer h5 {
        font-size: 15px;
        margin: 10px 0px 10px 0px;
    }

    .card-trainer p {
        font-size: 13px;
        margin: 10px 0px 10px 0px;
    }

    .card-img {
        width: 15em;
        height: 18em;
    }
</style>


<section class="container-trainers">
    <h1>Entrenadores</h1>
    <div class="cards-container">
        <div class="card-trainer">
            <img class="card-img" src="/images/entrenadora1.png" alt="">
            <h4>Valeria</h4>
            <h5>Entrenadora personal</h5>
            <p>Experta en fuerza y resistencia, Valeria adapta cada rutina a tus objetivos, combinando técnica y diversión para alcanzar tu mejor versión.</p>
        </div>
        <div class="card-trainer">
            <img class="card-img" src="/images/entrenador2.png" alt="">
            <h4>Conrado</h4>
            <h5>Entrenador personal</h5>
            <p>Apasionado del fitness y la motivación, Conrado transforma tus entrenamientos en resultados visibles, siempre con energía y buen humor.</p>
        </div>
        <div class="card-trainer">
            <img class="card-img" src="/images/entrenador3.png" alt="">
            <h4>Javier</h4>
            <h5>Entrenador personal</h5>
            <p>Con un enfoque integral en bienestar y rendimiento, Javier te guía con programas personalizados que equilibran cuerpo y mente.</p>
        </div>
    </div>
</section>
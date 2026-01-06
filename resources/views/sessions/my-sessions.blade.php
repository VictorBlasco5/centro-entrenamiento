<style>
    .container-my-sessions {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        font-weight: bold;
        font-family: var(--font-jost-regular);
        background-color: black;
        color: white;
    }

    .container-my-sessions h1 {
        font-size: 40px;
    }

    .buttons-my-sessions {
        display: flex;
        gap: 20px;
        margin: 20px 0px 20px 0px;
    }

    .buttons-my-sessions a {
        padding: 5px 15px;
        background-color: #222222;
        color: white;
        border: 1px solid #d0d0d05d;
    }

    .buttons-my-sessions a:hover {
        background-color: #000000ff;
    }

    .box-sessions {
        height: auto;
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 30px;
    }

    .card-my-sessions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 80px;
        padding: 25px;
        background-color: #1E1F26;
    }

    .box-card-my-sessions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 50%;
        /* border: 1px solid green; */
    }

    .date-my-sessions {
        display: flex;
        flex-direction: column;
        position: relative;
        padding-right: 25px;
        width: 40%;
        /* border: 1px solid blueviolet; */
    }

    .date-my-sessions h5 {
        font-size: 15px;
    }

    .date-my-sessions p {
        font-size: 12px;
        color: grey;
    }

    .separator {
        padding: 0 15px;
    }


    .type-my-sessions {
        display: flex;
        flex-direction: column;
        width: 100%;
        /* border: 1px solid orange; */
        padding-left: 30px;
    }

    .type-my-sessions h5 {
        font-size: 15px;
    }

    .type-my-sessions p {
        font-size: 12px;
        color: grey;
    }

    .card-my-sessions button {
        background-color: #222222;
        color: white;
        border: 1px solid #d0d0d05d;
        padding: 4px 10px;
        font-size: 15px;
    }

    .card-my-sessions button:hover {
        background-color: #000000ff;
    }
</style>

<section class="container-my-sessions">
    <h1>MIS SESIONES DE ENERO</h1>
    <div class="buttons-my-sessions">
        <a>Ver calendario anual</a>
        <a>Historial completo </a>
    </div>
    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>Lunes 12 enero</h5>
                    <p>12:00-13:00</p>
                </div>
                <div class="separator">-</div>
                <div class="type-my-sessions">
                    <h5>Boxeo</h5>
                    <p>con Valeria</p>
                </div>
            </div>
            <button>Cancelar</button>
        </div>
    </div>

    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>Jueves 15 enero</h5>
                    <p>8:00-9:00</p>
                </div>
                <div class="separator">-</div>
                <div class="type-my-sessions">
                    <h5>Steps</h5>
                    <p>con Conrado</p>
                </div>
            </div>
            <button>Cancelar</button>
        </div>
    </div>
    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>Martes 20 enero</h5>
                    <p>10:00-11:00</p>
                </div>
                <div class="separator">-</div>
                <div class="type-my-sessions">
                    <h5>TRX</h5>
                    <p>con Conrado</p>
                </div>
            </div>
            <button>Cancelar</button>
        </div>
    </div>
    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>Miércoles 21 Septiembre</h5>
                    <p>16:00-17:00</p>
                </div>
                <div class="separator">-</div>
                <div class="type-my-sessions">
                    <h5>CrossFit</h5>
                    <p>con Javier</p>
                </div>
            </div>
            <button>Cancelar</button>
        </div>
    </div>
</section>
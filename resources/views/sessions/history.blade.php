<style>
    .container-my-sessions {
        min-height: 80vh;
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
        text-transform: uppercase;
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
        width: 45%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border: 1px solid red;
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
        width: 100%;
        /* border: 1px solid green; */
    }

    .date-my-sessions {
        display: flex;
        flex-direction: column;
        position: relative;
        padding-right: 25px;
        width: 100%;
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
    <h1>MIS SESIONES DE  {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F') }}</h1>
    <div class="buttons-my-sessions">
        <a>Ver calendario anual</a>
        <a href="{{ route('sessions') }}">Sesiones del mes </a>
    </div>
    @forelse($sessions as $session)
    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>{{ $session->start_time->translatedFormat('l d F') }}</h5>
                    <p>
                        {{ $session->start_time->format('H:i') }} -
                        {{ $session->end_time->format('H:i') }}
                    </p>
                </div>

                <div class="separator">-</div>

                <div class="type-my-sessions">
                    <h5>{{ $session->title }}</h5>
                    <p>con {{ $session->trainer->name ?? 'Sin asignar' }}</p>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p>No estás apuntado a ninguna sesión.</p>
    @endforelse
</section>
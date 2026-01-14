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

    .buttons-details {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        padding: 5px 15px;
        background-color: #222222;
        color: white;
        border: 1px solid #d0d0d05d;
        text-decoration: none;
        width: 15%;
    }

    .buttons-details:hover {
        background-color: black;
    }

    .box-sessions {
        height: auto;
        width: 70%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 30px;
    }

    .card-my-sessions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 80%;
        height: 20px;
        padding: 10px;
        background-color: #1E1F26;
    }

    .box-card-my-sessions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .date-my-sessions {
        display: flex;
        flex-direction: column;
        position: relative;
        width: 15%;
    }

    .date-my-sessions h5 {
        font-size: 12px;
        margin: 0;
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
        align-items: center;
        width: 100%;
        gap: 20px;
    }

    .type-my-sessions h5 {
        font-size: 12px;
        margin: 0;
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

    .card-my-sessions.past {
        background-color: #111;
        opacity: 0.6;
    }

    .card-my-sessions.past h5,
    .card-my-sessions.past p {
        color: #888;
    }

    .container-my-sessions h2 {
        width: 62%;
        font-size: 20px;
        border-bottom: 1px solid #444;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }
</style>


<section class="container-my-sessions">
    <h1>Sesiones de la semana</h1>

    @forelse($weeklySessions as $day => $sessions)
    @php
    $dateObj = \Carbon\Carbon::parse($day);
    $dayName = $dateObj->locale('es')->translatedFormat('l j \\d\\e F');
    @endphp

    <h2>{{ ucfirst($dayName) }}</h2>

    @foreach($sessions as $session)
    <div class="box-sessions" style="cursor:pointer;">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</h5>
                </div>

                <div class="separator">-</div>

                <div class="type-my-sessions">
                    <h5>{{ $session->title }}</h5>
                    <p>{{ $session->reservations_count ?? 0 }} clientes</p>
                </div>
                <a class="buttons-details" href="">Ver detalles</a>
            </div>
        </div>
    </div>
    @endforeach
    @empty
    <p>No hay sesiones programadas para esta semana.</p>
    @endforelse
</section>
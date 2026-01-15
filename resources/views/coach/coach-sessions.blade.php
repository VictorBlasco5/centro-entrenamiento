<style>
    .container-my-sessions {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        font-family: var(--font-jost-regular);
        background-color: black;
        color: white;
        padding: 30px 0;
    }

    .container-my-sessions h1 {
        font-size: 40px;
        text-transform: uppercase;
        padding-bottom: 20px;
        font-weight: bold;
    }

    .container-my-sessions h2 {
        width: 62%;
        font-size: 18px;
        border-bottom: 1px solid #444;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }

    .accordion-toggle {
        display: flex;
        align-items: center;
        flex-direction: row;
        padding-left: 5px;
    }

    .accordion-toggle i {
        padding-left: 5px;
        cursor: pointer;
    }

    .accordion-content {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.4s ease;
    }

    .box-sessions {
        height: auto;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 30px;
    }

    .card-my-sessions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 60%;
        height: 40px;
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
        width: 25%;
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
        width: 25%;
    }

    .buttons-details:hover {
        background-color: black;
    }
</style>


<section class="container-my-sessions">
    <h1>Sesiones de la semana</h1>

    @forelse($weeklySessions as $day => $sessions)
    @php
    $dateObj = \Carbon\Carbon::parse($day);
    $dayName = $dateObj->locale('es')->translatedFormat('l j \\d\\e F');
    @endphp

    <h2 class="accordion-toggle">
        {{ ucfirst($dayName) }}
        <i class="fa-solid fa-angle-down"></i>
    </h2>

    <div class="accordion-content">
        @foreach($sessions as $session)
        <div class="box-sessions">
            <div class="card-my-sessions">
                <div class="box-card-my-sessions">
                    <div class="date-my-sessions">
                        <h5>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</h5>
                    </div>
                    <div class="separator">-</div>
                    <div class="type-my-sessions">
                        <h5>{{ $session->title }}</h5>
                        <p>{{ $session->reservations->count() }} clientes</p>
                    </div>
                    <a class="buttons-details" href="{{ route('coach.session-detail', $session) }}">Ver detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @empty
    <p>No hay sesiones programadas para esta semana.</p>
    @endforelse
</section>


<script>
    document.querySelectorAll('.accordion-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const content = toggle.nextElementSibling;
            const icon = toggle.querySelector('i');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

            if (isOpen) {
                content.style.maxHeight = '0';
                icon.classList.remove('fa-angle-up');
                icon.classList.add('fa-angle-down');
            } else {
                content.style.maxHeight = 'none';
                const height = content.scrollHeight;
                content.style.maxHeight = '0';
                content.offsetHeight;
                content.style.maxHeight = height + 'px';

                icon.classList.remove('fa-angle-down');
                icon.classList.add('fa-angle-up');
            }
        });
    });
</script>
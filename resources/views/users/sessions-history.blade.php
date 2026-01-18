<section class="container-my-sessions">
    <h1>HISTORIAL DE SESIONES</h1>
    <div class="buttons-my-sessions">
        <a href="{{ route('users.my-sessions-calendar') }}">Ver en calendario</a>
        <a href="{{ route('sessions') }}">Sesiones del mes </a>
    </div>
    @php
    // Agrupamos por año-mes
    $groupedSessions = $sessions->groupBy(function($session) {
    return $session->start_time->format('Y-m');
    });
    @endphp

    @forelse($groupedSessions as $yearMonth => $monthSessions)
    @php
    $dateObj = \Carbon\Carbon::createFromFormat('Y-m', $yearMonth);
    $year = $dateObj->format('Y');
    $monthName = $dateObj->locale('es')->translatedFormat('F');
    @endphp

    <h2 style="margin-top:20px;">{{ ucfirst($monthName) }} {{ $year }}</h2>

    @foreach($monthSessions as $session)
    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>{{ ucfirst($session->start_time->locale('es')->translatedFormat('l j \\d\\e F')) }}</h5>
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
    @endforeach
    @empty
    <p>No hay sesiones en el historial.</p>
    @endforelse
</section>
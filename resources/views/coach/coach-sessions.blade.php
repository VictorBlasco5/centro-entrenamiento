<section class="container-my-sessions-coach">
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
        <div class="box-sessions-coach">
            <div class="card-my-sessions-coach">
                <div class="box-card-my-sessions-coach">
                    <div class="date-my-sessions-coach">
                        <h5>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</h5>
                    </div>
                    <div class="separator">-</div>
                    <div class="type-my-sessions-coach">
                        <h5>{{ $session->title }}</h5>
                        <p>{{ $session->reservations->count() }} clientes</p>
                    </div>
                    <button type="button" onclick="openSessionModal('{{ $session->id }}')">
                        Ver detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal oculto-->
        <div id="modal-{{ $session->id }}" class="session-modal" style="display:none;">
            <div class="session-modal-content">
                <span class="session-modal-close" onclick="closeSessionModal('{{ $session->id }}')">&times;</span>
                <h2>{{ $session->title }}</h2>
                <p><strong>Fecha:</strong> {{ $session->start_time->locale('es')->translatedFormat('l j \\d\\e F Y') }}</p>
                <p><strong>Horario:</strong> {{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</p>
                <p><strong>Clientes inscritos:</strong> {{ $session->reservations->count() }}</p>
                <ul>
                    @foreach($session->reservations as $res)
                    <li>· {{ $res->user->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>

    @empty
    <p>No hay sesiones programadas para esta semana.</p>
    @endforelse
</section>
<section class="container-my-sessions">
    <h1>MIS SESIONES DE {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F') }}</h1>
    <div class="buttons-my-sessions">
        <a href="{{ route('users.my-sessions-calendar') }}">Ver en calendario</a>
        <a href="{{ route('users.sessions-history') }}">Historial completo </a>
    </div>
    @forelse($futureSessions as $session)
    <div class="box-sessions">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>{{ $session->start_time->locale('es')->translatedFormat('l j \\d\\e F') }}</h5>
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

            <form method="POST" action="{{ route('sessions.cancel', $session->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Estás seguro de que quieres cancelar esta sesión?')">Cancelar</button>
            </form>
        </div>
    </div>
    @empty
    <p>No tienes sesiones futuras.</p>
    @endforelse

    @if($pastSessions->count())
    <h2 style="margin-top:40px;">Sesiones pasadas</h2>

    @foreach($pastSessions as $session)
    <div class="box-sessions">
        <div class="card-my-sessions past">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>{{ $session->start_time->locale('es')->translatedFormat('l j \\d\\e F') }}</h5>
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
            {{-- SIN BOTÓN --}}
        </div>
    </div>
    @endforeach
    @endif
</section>
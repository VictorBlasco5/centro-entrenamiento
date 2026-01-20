<!-- FullCalendar CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>

<section class="container-calendar">
    <div class="calendar-bg">

        @if(request()->routeIs('dashboard'))
        <div class="banner-calendar">
            <h2>Bienvenido a tu centro de entrenamiento</h2>
            <p>Reserva tus clases, sigue tus entrenamientos y gestiona tu progreso de forma fácil y rápida.</p>
        </div>
        @elseif(request()->routeIs('sessions.calendar'))
        <div class="buttons-my-sessions">
            <a href="{{ route('sessions') }}">Listado de {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F') }}</a>
            <a href="{{ route('users.sessions-history') }}">Listado del historial</a>
        </div>
        @endif

        <!-- Calendario integrado -->
        <div id="calendar"></div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Traemos las sesiones desde PHP
        var sessions = @json($sessions);
        // Convertimos las sesiones al formato de FullCalendar
        var events = sessions.map(function(session) {
            return {
                id: session.id,
                title: session.title,
                start: session.start_time,
                end: session.end_time,
                extendedProps: {
                    maxClients: session.max_clients,
                    trainer: session.trainer,
                    reservationsCount: session.reservationsCount,
                    sessionId: session.id,
                    sessionType: session.title
                }
            };
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            height: 'auto',
            initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
            allDaySlot: false,
            slotMinTime: '08:00:00',
            slotMaxTime: '23:00:00',
            slotDuration: '00:15:00',
            slotLabelInterval: '01:00:00',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: events,

            eventClick: function(info) {
                info.jsEvent.preventDefault();

                calendar.gotoDate(info.event.start);
                calendar.changeView('timeGridDay');
            },

            dateClick: function(info) {
                calendar.gotoDate(info.date);
                calendar.changeView('timeGridDay');
            },

            // Contenido dinámico según vista
            eventContent: function(arg) {
                const view = arg.view.type;
                const props = arg.event.extendedProps;

                let start = arg.event.start.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                let end = arg.event.end ? arg.event.end.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                }) : '';
                let slots = props.reservationsCount + '/' + props.maxClients;

                // VISTA SEMANA → tipo + reservas + botón
                if (view === 'timeGridWeek') {
                    return {
                        html: `
                    <div class="event-content week-event">
                        <span><b>${props.sessionType}</b></span>
                    </div>
                    `
                    };
                }

                // VISTA DÍA → toda la info
                if (view === 'timeGridDay') {
                    return {
                        html: `
                    <div class="event-content day-event">
                        <div>
                            <span><b>${props.sessionType}</b></span>
                            <span>${start} - ${end}</span>
                            <span>Entrenador: ${props.trainer}</span>
                            <span>Reservas: ${slots}</span>
                            </div>
                        <div>
                            <button class="btn-reserve" onclick="reserve(${props.sessionId})">Apuntarme</button>
                        </div>
                    </div>
                    `
                    };
                }
            },
        });

        calendar.render();
    });


    // Función para apuntarse a una sesión
    function reserve(sessionId) {
        if (!confirm('¿Quieres apuntarte a esta sesión?')) return;

        fetch(`/sessions/${sessionId}/reserve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message || 'Reserva realizada');
                location.reload();
            })
            .catch(err => alert('Error al reservar'));
    }
</script>
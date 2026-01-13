<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        .container-calendar {
            font-family: var(--font-jost-regular);
        }

        .calendar-bg {
            position: relative;
            background-image: url('../images/calendar/gym_general_view.png');
            background-size: cover;
            background-position: center;
        }

        .calendar-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(58, 58, 58, 0.7);
            z-index: 0;
        }

        .banner-calendar {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
        }

        .buttons-my-sessions {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            gap: 20px;
        }

        .banner-calendar h2 {
            color: white;
            font-size: 40px;
            margin: 0;
        }

        .banner-calendar p {
            color: white;
            font-size: 14px;
            margin: 0;
        }

        .banner-calendar,
        .buttons-my-sessions,
        #calendar {
            position: relative;
            z-index: 1;
            color: #fff;
            padding-top: 30px;
        }

        .buttons-my-sessions a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 15px;
            background-color: #222222;
            color: white;
            border: 1px solid #d0d0d05d;
            width: 170px;
        }

        .buttons-my-sessions a:hover {
            background-color: #000000ff;
        }

        /* ESTILOS FULLCALENDAR */
        #calendar {
            max-width: 1200px;
            margin: 0px auto;
            padding: 30px;
            color: white;
        }

        /* botones navegación calendario, flechas + mes, semana y dia */
        .fc-header-toolbar .fc-toolbar-chunk button {
            background-color: #222222;
            border: none;
        }

        .fc-header-toolbar .fc-toolbar-chunk button:hover {
            background-color: #d0d0d05d;
            border: none;
        }

        .fc-header-toolbar .fc-toolbar-chunk button:focus {
            outline: none !important;
            box-shadow: none !important;
            background-color: #d0d0d05d !important;
        }

        /* Botón activo (Mes / Semana / Día) */
        .fc .fc-button.fc-button-active {
            background-color: #d0d0d05d !important;
        }

        /* Botón Hoy*/
        .fc .fc-today-button {
            background-color: #222222 !important;
            border: none !important;
        }


        /* Fondo del dia en vista MES /SEMANA / DÍA */
        .fc .fc-daygrid-day.fc-day-today,
        .fc .fc-timegrid-col.fc-day-today {
            background-color: #ffffff2d !important;
        }

        /* Quitar cuadrícula */
        .fc-timegrid-slot {
            border-top: none !important;
        }



        /*CALENDARIO MES */

        .fc-event {
            cursor: pointer;
        }

        .fc-event:hover {
            background-color: transparent !important;
        }

        .fc-daygrid-day-events {
            display: flex;
            flex-wrap: wrap;
            padding: 5px;
        }

        /* Número del día clicable */
        .fc-daygrid-day-number {
            cursor: pointer;
        }

        /* Añadir h en horas mes */
        .fc-daygrid-event .fc-event-time::after {
            content: "h";
            font-size: 11px;
        }

        .fc-daygrid-event-dot {
            display: none;
        }

        /* Fondo oscuro para la fila de los días de la semana */
        .fc .fc-col-header-cell {
            background-color: #222222;
        }

        /* Añadir un punto antes de cada evento */
        .fc-daygrid-day-events .fc-daygrid-event-harness {
            display: flex;
            align-items: center;
            color: white;
            font-size: 12px;
        }

        .fc-daygrid-day-events .fc-daygrid-event-harness::before {
            content: "•";
            display: flex;
            align-items: center;
            margin-left: 4px;
            margin-right: 4px;
            font-size: 8px;
        }

        /*CALENDARIO SEMANA */

        /* Fondo en vista semana / día */
        .fc .fc-timegrid-event,
        .fc .fc-timegrid-event:active,
        .fc .fc-timegrid-event.fc-event-selected {
            background-color: #d0d0d05d !important;
            border-color: #d0d0d05d !important;
            box-shadow: none !important;
        }


        /*CALENDARIO DIA */

        /* Vista DÍA: eventos en fila */
        .fc-timeGridDay-view .fc-event-main {
            display: flex;
            align-items: center;
        }

        .fc-timeGridDay-view .event-content {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 16px;
        }

        /* Añadir un punto delante de cada elemento */
        .fc-timeGridDay-view .event-content.day-event>*::before {
            content: "•";
            margin: 0 8px 0 0;
            color: #ffffff;
            font-size: 12px;
        }

        /* Quitar el punto del botón */
        .fc-timeGridDay-view .event-content.day-event>button::before {
            content: none;
        }

        /* Botón Apuntarse */
        .btn-reserve {
            background-color: #222222;
            color: white;
            border: 1px solid #d0d0d05d;
            padding: 4px 10px;
        }

        .btn-reserve:hover {
            background-color: #000000ff;
        }

        .fc-timegrid-axis {
            background-color: #222222;
        }
    </style>

    <!-- FullCalendar CDN -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
    @vite('resources/css/app.css')



</head>

<body>
    <header>
        @include('layouts.navigation')
    </header>

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
                <a href="{{ route('sessions.history') }}">Listado del historial</a>
            </div>
            @endif

            <!-- Calendario integrado -->
            <div id="calendar"></div>
        </div>
    </section>



    <footer>
        @include('layouts.footer')
    </footer>



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
                initialView: 'dayGridMonth',
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '23:00:00',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
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
                        <span><b>${props.sessionType}</b></span>
                        <span>${start} - ${end}</span>
                        <span>Entrenador: ${props.trainer}</span>
                        <span>Reservas: ${slots}</span>
                        <button class="btn-reserve" onclick="reserve(${props.sessionId})">Apuntarme</button>
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
</body>

</html>
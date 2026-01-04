<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Entrenamiento</title>
    <style>
        .container-calendar {
            background-color: #171717;
            font-family: var(--font-jost-regular);
        }

        .banner-calendar {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
        }

        .banner-calendar h2 {
            background-color: #171717;
            color: white;
            font-size: 40px;
            margin: 0;
        }

        .banner-calendar p {
            background-color: #171717;
            color: white;
            font-size: 14px;
            margin: 0;
        }

        footer {
            background-color: #111827;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        /* ESTILOS FULLCALENDAR */
        #calendar {
            max-width: 1100px;
            margin: 50px auto;
            background-color: #171717;
            padding: 15px;
            color: white;
        }

        /* botones navegación calendario, flechas + mes, semana y dia */
        .fc-header-toolbar .fc-toolbar-chunk button {
            background-color: #222222;
            border: none;
        }

        .fc-header-toolbar .fc-toolbar-chunk button:hover {
            background-color: #4c4c4cff;
            border: none;
        }

        .fc-header-toolbar .fc-toolbar-chunk button:focus {
            outline: none !important;
            box-shadow: none !important;
            background-color: #4c4c4cff !important;
        }

                /* Botón activo (Mes / Semana / Día) */
        .fc .fc-button.fc-button-active {
            background-color: #4c4c4cff !important;
        }

        /* Botón Hoy*/
        .fc .fc-today-button {
            background-color: #222222 !important;
            border: none !important;
        }

        /* Evitar azul en vista semana / día */
        .fc .fc-timegrid-event,
        .fc .fc-timegrid-event:active,
        .fc .fc-timegrid-event.fc-event-selected {
            background-color: #222222 !important;
            border-color: #222222 !important;
            box-shadow: none !important;
        }

        /* Fondo del dia en vista MES /SEMANA / DÍA */
        .fc .fc-daygrid-day.fc-day-today,
        .fc .fc-timegrid-col.fc-day-today {
            background-color: #2a2a2a !important;
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
            background-color: #222222 !important;
        }
        
        /* Cambiar color de eventos */
        .fc-daygrid-event-harness {
            background-color: #222222;
            color: white;
        }

        /* Número del día clicable */
        .fc-daygrid-day-number {
            cursor: pointer;
        }

        /* Quitar hora en vista MES */
        .fc-daygrid-dot-event .fc-event-time {
            display: none !important;
        }

        .fc-daygrid-event-dot {
            display: none;
        }



        /*CALENDARIO SEMANA */



        /*CALENDARIO DIA */

        .btn-reserve {
            width: 150px;
            background-color: #222222;
            border: 1px solid #4c4c4c;
        }

        .btn-reserve:hover {
            background-color: #4c4c4cff;
        }

        /* Vista DÍA: eventos en fila */
        .fc-timeGridDay-view .fc-event-main {
            display: flex;
            align-items: center;
        }

        .fc-timeGridDay-view .event-content {
            flex-direction: row;
            align-items: center;
        }

        /* Botón Apuntarse */
        .btn-reserve {
            background-color: #222222;
            color: white;
            border: 1px solid #4c4c4c;
            padding: 4px 10px;
        }

        .btn-reserve:hover {
            background-color: #4c4c4cff;
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
        <div class="banner-calendar">

            <h2>Bienvenido a tu centro de entrenamiento</h2>
            <p>Reserva tus clases, sigue tus entrenamientos y gestiona tu progreso de forma fácil y rápida.</p>
        </div>

        <!-- Calendario integrado -->
        <div id="calendar"></div>
    </section>


    <footer>
        &copy; {{ date('Y') }} Centro de Entrenamiento. Todos los derechos reservados.
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
                        <span>Reservas: ${slots}</span>
                        <button class="btn-reserve" onclick="reserve(${props.sessionId})">Apuntarme</button>
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
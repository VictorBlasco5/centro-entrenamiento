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

        /* Estilos para FullCalendar */
        #calendar {
            max-width: 1100px;
            margin: 50px auto;
            background-color: #171717;
            padding: 15px;
            color: white;
        }

        /* Cambiar color de eventos */
        .fc-event {
            background-color: #222222;
            color: white;
        }

        .btn-reserve {
            width: 150px;
            background-color: #222222;
            border: 1px solid #4c4c4c;
        }

        .btn-reserve:hover {
            background-color: #4c4c4cff;
        }

        /* evento por dia */
        .fc-event:hover {
            background-color: #222222 !important;
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

        /* Fondo del dia en vista MES */
        .fc .fc-daygrid-day.fc-day-today {
            background-color: #2a2a2a !important;
        }

        /* Fondo del dia en vista SEMANA / DÍA */
        .fc .fc-timegrid-col.fc-day-today {
            background-color: #2a2a2a !important;
        }

        .event-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Vista DÍA: eventos en fila */
        .fc-timeGridDay-view .fc-event-main {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 12px;
            white-space: normal;
        }

        /* Evitar que el texto se comprima */
        .fc-timeGridDay-view .fc-event-title,
        .fc-timeGridDay-view .fc-event-time {
            white-space: normal;
        }

        /* Permitir que el evento crezca en altura */
        .fc-timeGridDay-view .fc-timegrid-event {
            height: auto !important;
            min-height: 60px;
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
                        sessionId: session.id
                    }
                };
            });


            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: events,
                eventContent: function(arg) {
                    // Solo hora en formato HH:MM
                    let start = arg.event.start.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    let end = arg.event.end ? arg.event.end.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    }) : '';
                    let slots = arg.event.extendedProps.reservationsCount + '/' + arg.event.extendedProps.maxClients;

                    return {
                        html: `
                        <div class="event-content">
                        <span><b>${arg.event.title}</b></span>
                        <span><b>${start} - ${end}</b></span>
                        <span>Entrenador: ${arg.event.extendedProps.trainer}</span>
                        <span>Reservas: ${slots}</span>
                        <button class="btn-reserve" onclick="reserve(${arg.event.extendedProps.sessionId})">Apuntarme</button>
                        </div>
                        `
                    };
                }

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
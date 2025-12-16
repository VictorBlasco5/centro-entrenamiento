<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Entrenamiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #000000ff;
            color: white;
            padding: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            display: inline-block;
        }

        nav {
            float: right;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            text-align: center;
            padding: 40px 20px;
        }

        main h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        main p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        main a {
            text-transform: capitalize;
            color: black;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        main a:hover {
            background-color: #484848ff;
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
            background: white;
            padding: 20px;
            border-radius: 0px;
        }
    </style>

    <!-- FullCalendar CDN -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>


</head>

<body>
    <header>
        <h1>Ummah Athletes</h1>
        <nav>
            <a href="{{ route('profile.edit') }}">Perfil</a>
        </nav>
    </header>

    <main>
        <h2>Bienvenido a tu centro de entrenamiento</h2>
        <p>Reserva tus clases, sigue tus entrenamientos y gestiona tu progreso de forma fácil y rápida.</p>

        <!-- Calendario integrado -->
        <div id="calendar"></div>
    </main>

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
            <div style="display: flex; flex-direction: column; text-align: left; line-height: 1.2;">
                <span><b>${arg.event.title}</b></span>
                <span><b>${start} - ${end}</b></span>
                <span>Entrenador: ${arg.event.extendedProps.trainer}</span>
                <span>Reservas: ${slots}</span>
                <button style="margin-top:5px; font-size: 0.8em;" onclick="reserve(${arg.event.extendedProps.sessionId})">Apuntarse</button>
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
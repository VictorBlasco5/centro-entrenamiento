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

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                firstDay: 1,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [{
                        title: 'Yoga',
                        start: '2025-12-18T10:00:00',
                        end: '2025-12-18T11:00:00',
                        extendedProps: {
                            maxClients: 4,
                            trainer: 'Ana'
                        }
                    },
                    {
                        title: 'Crossfit',
                        start: '2025-12-19T12:00:00',
                        end: '2025-12-19T13:00:00',
                        extendedProps: {
                            maxClients: 4,
                            trainer: 'Luis'
                        }
                    }
                ],
                eventContent: function(arg) {
                    // Contenido en columna usando <div> y <br>
                    return {
                        html: `
                <div style="display: flex; flex-direction: column; text-align: left;">
                    <span><b>${arg.event.title}</b></span>
                    <span>Entrenador: ${arg.event.extendedProps.trainer}</span>
                    <span>Max Clientes: ${arg.event.extendedProps.maxClients}</span>
                </div>
            `
                    };
                }
            });



            calendar.render();
        });
    </script>


</body>

</html>
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

    #calendar {
        position: relative;
        z-index: 1;
        color: #fff;
        padding-top: 30px;
    }

    /* ESTILOS FULLCALENDAR */
    #calendar {
        max-width: 1200px;
        margin: 0px auto;
        padding: 30px;
        color: white;
    }

    /* botones navegación calendario */
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
    }

    /* Botón Hoy*/
    .fc .fc-today-button {
        background-color: #222222 !important;
        border: none !important;
        cursor: pointer;
    }

    .fc .fc-today-button:hover {
        background-color: #d0d0d05d!important;
    }


    /* Fondo del dia en vista MES /SEMANA / DÍA */
    .fc .fc-daygrid-day.fc-day-today {
        background-color: #ffffff2d !important;
    }

    /* Quitar cuadrícula */
    .fc-timegrid-slot {
        border-top: none !important;
    }

    /*CALENDARIO MES */

    .fc-event:hover {
        background-color: transparent !important;
    }

    .fc-daygrid-day-events {
        display: flex;
        flex-wrap: wrap;
        padding: 5px;
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
</style>

<section class="container-calendar">
    <div class="calendar-bg">
        <div id="calendar"></div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const calendarEl = document.getElementById('calendar');
        const sessions = @json($calendarSessions);

        const events = sessions.map(s => ({
            id: s.id,
            title: s.title,
            start: s.start_time,
            end: s.end_time,
            extendedProps: {
                reservationsCount: s.reservations_count,
                maxClients: s.max_clients
            }
        }));

        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            events: events,
        });

        calendar.render();
    });
</script>
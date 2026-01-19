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
            height: 'auto',
            initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: window.innerWidth < 768 ? '' : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: events,
        });

        calendar.render();
    });
</script>
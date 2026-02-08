<!-- FullCalendar CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<!-- SweetAlert2 CSS y JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <div id="toast-container"></div>
    </div>
</section>

<script>
    let calendar;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Traemos las sesiones desde PHP
        var sessions = @json($sessions);
        // Convertimos las sesiones al formato de FullCalendar
        var events = sessions.map(function(session) {
            return {
                id: String(session.id),
                title: session.title,
                start: session.start_time,
                end: session.end_time,
                extendedProps: {
                    maxClients: Number(session.max_clients),
                    trainer: session.trainer,
                    reservationsCount: Number(session.reservationsCount || 0),
                    sessionId: session.id,
                    sessionType: session.title
                }
            };
        });

        calendar = new FullCalendar.Calendar(calendarEl, {
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
                const reservationsCount = Number(props.reservationsCount || 0);
                const maxClients = Number(props.maxClients || 0);
                let slots = reservationsCount + '/' + maxClients;

                if (view === 'timeGridWeek') {
                    return {
                        html: `<div class="event-content week-event"><span><b>${props.sessionType}</b></span></div>`
                    };
                }

                if (view === 'timeGridDay') {
                    let isFull = reservationsCount >= maxClients;
                    let buttonHTML = isFull ? '<button class="btn-reserve" disabled>Llena</button>' :
                        `<button class="btn-reserve" onclick="reserve(${props.sessionId})">Apuntarme</button>`;

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
                            ${buttonHTML}
                        </div>
                    </div>
                    `
                    };
                }
            },
        });

        calendar.render();
    });

    // Reemplaza la lógica para forzar re-render: eliminamos y re-agregamos el evento
    function updateEventReservations(sessionId, newCount) {
        const event = calendar.getEventById(String(sessionId));
        if (!event) return;

        const eventData = {
            id: event.id,
            title: event.title,
            start: event.start, // Date object ok
            end: event.end,
            extendedProps: Object.assign({}, event.extendedProps, {
                reservationsCount: Number(newCount)
            })
        };

        event.remove();
        calendar.addEvent(eventData);
    }

    // Función para apuntarse a una sesión
    const result = await Swal.fire({
        title: '<span style="font-weight:600; font-size:20px; color:#1f2937;">Confirmar reserva</span>',
        showCancelButton: true,
        confirmButtonText: 'Reservar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        buttonsStyling: false,
        customClass: {
            popup: 'swal-fine-popup',
            confirmButton: 'swal-fine-confirm',
            cancelButton: 'swal-fine-cancel',
            icon: 'swal-fine-icon'
        }
    });

    if (!result.isConfirmed) return;

    try {
        const res = await fetch(`/sessions/${sessionId}/reserve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });

        const data = await res.json();

        if (!res.ok) throw new Error(data.message || 'Error al reservar');

        showSuccessToast(data.message || 'Reserva realizada');

        // Si el backend devuelve reservationsCount lo usamos (recomendado). Si no, incrementamos localmente.
        const newCount = (typeof data.reservationsCount !== 'undefined') ?
            Number(data.reservationsCount) :
            (Number(calendar.getEventById(String(sessionId)).extendedProps.reservationsCount || 0) + 1);

        updateEventReservations(sessionId, newCount);
    } catch (err) {
        showErrorToast(err.message || 'Error al reservar');
    }

    const TOAST_DURATION = 3000;

    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<span>${message}</span><div class="toast-progress"></div>`;
        container.appendChild(toast);
        // Barra de progreso animada
        const progress = toast.querySelector('.toast-progress');
        progress.style.width = '100%';
        setTimeout(() => {
            progress.style.transition = `width ${TOAST_DURATION}ms linear`;
            progress.style.width = '0%';
        }, 50);
        setTimeout(() => {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 400);
        }, TOAST_DURATION);
    }

    function showSuccessToast(msg) {
        showToast(msg, 'success');
    }

    function showErrorToast(msg) {
        showToast(msg, 'error');
    }
</script>
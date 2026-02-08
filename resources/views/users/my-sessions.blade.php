<!-- SweetAlert2 CSS y JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="container-my-sessions">
    <div id="toast-container"></div>
    <h1>MIS SESIONES DE {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F') }}</h1>
    @forelse($futureSessions as $session)
    <div class="box-sessions" id="session-{{ $session->id }}">
        <div class="card-my-sessions">
            <div class="box-card-my-sessions">
                <div class="date-my-sessions">
                    <h5>{{ $session->start_time->locale('es')->translatedFormat('l j') }}</h5>
                    <p>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</p>
                </div>
                <div class="separator">-</div>
                <div class="type-my-sessions">
                    <h5>{{ $session->title }}</h5>
                    <p>con {{ $session->trainer->name ?? 'Sin asignar' }}</p>
                </div>
            </div>

            <button type="button" onclick="confirmCancelFetch({{ $session->id }})">Cancelar</button>
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
                    <h5>{{ $session->start_time->locale('es')->translatedFormat('l j') }}</h5>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const TOAST_DURATION = 3000;

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span>${message}</span><div class="toast-progress"></div>`;
            container.appendChild(toast);

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

        window.showSuccessToast = (msg) => showToast(msg, 'success');
        window.showErrorToast = (msg) => showToast(msg, 'error');
    });

    // Cancelar sesión con fetch + SweetAlert2 + toast
    function confirmCancelFetch(sessionId) {
        Swal.fire({
            title: '<span style="font-weight:600; font-size:20px; color:#1f2937;">Confirmar cancelación</span>',
            text: '¿Estás seguro de que quieres cancelar esta sesión?',
            showCancelButton: true,
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No',
            reverseButtons: true,
            buttonsStyling: false,
            customClass: {
                popup: 'swal-fine-popup',
                confirmButton: 'swal-fine-confirm',
                cancelButton: 'swal-fine-cancel',
                icon: 'swal-fine-icon'
            }
        }).then((result) => {
            if (!result.isConfirmed) return;

            fetch(`/sessions/${sessionId}/cancel`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error al cancelar');
                    return res.json();
                })
                .then(data => {
                    showSuccessToast(data.message || 'Sesión cancelada');
                    const el = document.getElementById(`session-${sessionId}`);
                    if (el) el.remove(); // eliminar del DOM
                })
                .catch(() => showErrorToast('Error al cancelar la sesión'));
        });
    }
</script>
<section class="container-my-sessions-coach">
    <h1>Sesiones de la semana</h1>
    <div class="week-navigation">
        <div class="left">
            <a href="#" id="prev-week" class="week-nav-btn" data-week="{{ $prevWeekStart }}">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>

        <div class="week-label">
            <div id="week-range" class="week-range">{{ $displayWeekLabel }}</div>
        </div>

        <div class="right">
            <a href="#" id="next-week" class="week-nav-btn" data-week="{{ $nextWeekStart }}">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <div id="weekly-sessions-container">
        @forelse($weeklySessions as $day => $sessions)
        @php
        $dateObj = \Carbon\Carbon::parse($day);
        $dayName = $dateObj->locale('es')->translatedFormat('l j');
        @endphp

        <h2 class="accordion-toggle">
            {{ ucfirst($dayName) }}
            <i class="fa-solid fa-angle-down"></i>
        </h2>

        <div class="accordion-content">
            @foreach($sessions as $session)
            <div class="box-sessions-coach">
                <div class="card-my-sessions-coach">
                    <div class="box-card-my-sessions-coach">
                        <div class="card-info-my-sessions">
                            <div class="date-my-sessions-coach">
                                <h5>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</h5>
                            </div>
                            <div class="separator">-</div>
                            <div class="type-my-sessions-coach">
                                <h5>{{ $session->title }}</h5>
                                <p>{{ $session->reservations->count() }} clientes</p>
                            </div>
                        </div>
                        <button type="button" onclick="openSessionModal('{{ $session->id }}')">Ver detalles</button>
                    </div>
                </div>
            </div>

            <div id="modal-{{ $session->id }}" class="session-modal" style="display:none;">
                <div class="session-modal-content">
                    <span class="session-modal-close" onclick="closeSessionModal('{{ $session->id }}')">&times;</span>
                    <h2>{{ $session->title }}</h2>
                    <p><strong>Fecha:</strong> {{ $session->start_time->locale('es')->translatedFormat('l j \\d\\e F Y') }}</p>
                    <p><strong>Horario:</strong> {{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</p>
                    <p><strong>Clientes inscritos:</strong> {{ $session->reservations->count() }}</p>
                    <ul>
                        @foreach($session->reservations as $res)
                        <li>· {{ $res->user->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        @empty
        <p>No hay sesiones programadas para esta semana.</p>
        @endforelse
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fetchWeek = (weekStart) => {
            fetch(`{{ route('coach') }}?week_start=${weekStart}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const temp = document.createElement('div');
                    temp.innerHTML = html;
                    const newSessions = temp.querySelector('#weekly-sessions-container').innerHTML;
                    const newLabel = temp.querySelector('#week-range').textContent;
                    const prevWeek = temp.querySelector('#prev-week').dataset.week;
                    const nextWeek = temp.querySelector('#next-week').dataset.week;

                    document.getElementById('weekly-sessions-container').innerHTML = newSessions;
                    document.getElementById('week-range').textContent = newLabel;
                    document.getElementById('prev-week').dataset.week = prevWeek;
                    document.getElementById('next-week').dataset.week = nextWeek;

                    initAccordions();
                    initModals();
                })
                .catch(console.error);
        }

        document.getElementById('prev-week').addEventListener('click', e => {
            e.preventDefault();
            fetchWeek(e.currentTarget.dataset.week);
        });

        document.getElementById('next-week').addEventListener('click', e => {
            e.preventDefault();
            fetchWeek(e.currentTarget.dataset.week);
        });

        const initAccordions = () => {
            document.querySelectorAll('.accordion-toggle').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const content = toggle.nextElementSibling;
                    const icon = toggle.querySelector('i');
                    const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
                    if (isOpen) {
                        content.style.maxHeight = '0';
                        icon.classList.remove('fa-angle-up');
                        icon.classList.add('fa-angle-down');
                    } else {
                        content.style.maxHeight = 'none';
                        const height = content.scrollHeight;
                        content.style.maxHeight = '0';
                        content.offsetHeight;
                        content.style.maxHeight = height + 'px';
                        icon.classList.remove('fa-angle-down');
                        icon.classList.add('fa-angle-up');
                    }
                });
            });
        }

        window.openSessionModal = function(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.style.display = 'flex';

            const clickOutsideHandler = function(e) {
                if (!e.target.closest('.session-modal-content')) {
                    modal.style.display = 'none';
                    modal.removeEventListener('click', clickOutsideHandler);
                }
            };

            modal.addEventListener('click', clickOutsideHandler);
        }

        window.closeSessionModal = function(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.style.display = 'none';
        }

        initAccordions();
        initModals();
    });
</script>
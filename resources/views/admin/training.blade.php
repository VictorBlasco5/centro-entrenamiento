<x-app-layout>
    <div class="max-w-7xl mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6">Administración de sesiones</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- Formulario de creación -->
        <div class="mb-6 p-4 border rounded">
            <h2 class="font-bold mb-2">Crear nueva sesión</h2>
            <form action="{{ route('training.store') }}" method="POST" class="space-y-3">
                @csrf
                <input type="text" name="title" placeholder="Título" class="w-full border p-2" required>
                <textarea name="description" placeholder="Descripción" class="w-full border p-2"></textarea>
                <input type="number" name="trainer_id" placeholder="ID entrenador" class="w-full border p-2" required>
                <input type="datetime-local" name="start_time" class="w-full border p-2" required>
                <input type="datetime-local" name="end_time" class="w-full border p-2" required>
                <input type="number" name="max_clients" placeholder="Plazas máximas" class="w-full border p-2" required>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
            </form>
        </div>

        {{-- Listado de sesiones --}}
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Título</th>
                    <th class="p-2 border">Descripción</th>
                    <th class="p-2 border">Entrenador</th>
                    <th class="p-2 border">Inicio</th>
                    <th class="p-2 border">Fin</th>
                    <th class="p-2 border">Plazas</th>
                    <th class="p-2 border">Edición</th>
                    <th class="p-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                <tr>

                    {{-- FORMULARIO (vacío visualmente) --}}
                    <form id="form-{{ $session->id }}"
                        action="{{ route('training.update', $session) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                    </form>

                    <td class="p-2 border">
                        <input type="text"
                            name="title"
                            value="{{ $session->title }}"
                            disabled
                            form="form-{{ $session->id }}"
                            class="border p-1 w-full editable">
                    </td>
                    <td><input type="text"
                            name="description"
                            value="{{ $session->description }}"
                            disabled
                            form="form-{{ $session->id }}"
                            class="border p-1 w-full editable"></td>
                            
                    <td><input type="text"
                            name="trainer_id"
                            value="{{ $session->trainer_id }}"
                            disabled
                            form="form-{{ $session->id }}"
                            class="border p-1 w-full editable"></td>

                    <td class="p-2 border">
                        <input type="datetime-local"
                            name="start_time"
                            value="{{ $session->start_time->format('Y-m-d\TH:i') }}"
                            disabled
                            form="form-{{ $session->id }}"
                            class="border p-1 w-full editable">
                    </td>

                    <td class="p-2 border">
                        <input type="datetime-local"
                            name="end_time"
                            value="{{ $session->end_time->format('Y-m-d\TH:i') }}"
                            disabled
                            form="form-{{ $session->id }}"
                            class="border p-1 w-full editable">
                    </td>

                    <td class="p-2 border text-center">
                        <input type="number"
                            name="max_clients"
                            value="{{ $session->max_clients }}"
                            disabled
                            form="form-{{ $session->id }}"
                            class="border p-1 w-20 text-center editable">
                    </td>

                    <td class="p-2 border space-x-2">
                        <button type="button"
                            class="edit-btn bg-blue-600 text-white px-2 py-1 rounded">
                            Editar
                        </button>

                        <button type="submit"
                            form="form-{{ $session->id }}"
                            class="save-btn bg-green-600 text-white px-2 py-1 rounded hidden">
                            Guardar
                        </button>
                    </td>

                    <td class="p-2 border">
                        <form action="{{ route('training.destroy', $session) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-2 py-1 rounded"
                                onclick="return confirm('¿Eliminar sesión?')">
                                Eliminar
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script para habilitar edición -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {

                    const row = button.closest('tr');

                    row.querySelectorAll('.editable').forEach(input => {
                        input.disabled = false;
                    });

                    row.querySelector('.save-btn').classList.remove('hidden');
                    button.classList.add('hidden');
                });
            });

        });
    </script>

</x-app-layout>
<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Reservar una sesión
    public function store(TrainingSession $session)
    {
        $user = Auth::user();

        // Verificar si ya está inscrito
        if ($session->reservations()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Ya estás apuntado a esta sesión.');
        }

        // Verificar límite de clientes
        if ($session->reservations()->count() >= $session->max_clients) {
            return back()->with('error', 'Esta sesión ya está llena.');
        }

        // Crear reserva
        Reservation::create([
            'training_session_id' => $session->id,
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Te has apuntado correctamente.');
    }

    // Cancelar reserva
    public function destroy(Reservation $reservation)
    {
        $user = Auth::user();

        // Solo el dueño puede cancelar
        if ($reservation->user_id != $user->id) {
            abort(403);
        }

        // No cancelar si falta menos de 24h
        if (Carbon::now()->diffInHours($reservation->session->start_time, false) < 24) {
            return back()->with('error', 'No puedes cancelar dentro de las 24 horas previas a la sesión.');
        }

        $reservation->delete();

        return back()->with('success', 'Reserva cancelada correctamente.');
    }
}

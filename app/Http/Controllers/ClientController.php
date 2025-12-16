<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Mostrar dashboard del cliente
    public function dashboard()
    {
        $sessions = TrainingSession::with('trainer', 'reservations')->get()->map(function ($session) {
            return [
                'id' => $session->id,
                'title' => $session->title,
                'start_time' => $session->start_time->toDateTimeString(),
                'end_time' => $session->end_time->toDateTimeString(),
                'max_clients' => $session->max_clients,
                'trainer' => $session->trainer->name ?? 'Sin asignar',
                'reservationsCount' => $session->reservations->count(),
            ];
        });

        return view('dashboard', compact('sessions'));
    }




    // Reservar una sesión
public function reserve(Request $request, TrainingSession $session)
{
    $userId = Auth::id();

    //Comprobar si el usuario ya está apuntado
    $alreadyReserved = $session->reservations()
        ->where('user_id', $userId)
        ->exists();

    if ($alreadyReserved) {
        return response()->json(['message' => 'Ya estás apuntado a esta sesión'], 400);
    }

    // Comprobar si quedan menos de 24h


    //Comprobar si la sesión está llena
    if ($session->reservations()->count() >= $session->max_clients) {
        return response()->json(['message' => 'Sesión llena'], 400);
    }

    //Crear la reserva
    Reservation::create([
        'training_session_id' => $session->id,
        'user_id' => $userId,
    ]);

    return response()->json(['message' => 'Reserva realizada con éxito']);
}

}

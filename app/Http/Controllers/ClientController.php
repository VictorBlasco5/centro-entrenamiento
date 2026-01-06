<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function mySessions()
    {
        $user = Auth::user();
        $now = Carbon::now(); // fecha actual

        $sessions = TrainingSession::whereHas('reservations', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('trainer')
            ->whereMonth('start_time', $now->month)   // solo mes actual
            ->whereYear('start_time', $now->year)    // solo año actual
            ->orderBy('start_time', 'asc')
            ->get();

        return view('sessions', compact('sessions'));
    }

    public function cancel(TrainingSession $session)
    {
        $userId = Auth::id();

        $reservation = Reservation::where('training_session_id', $session->id)
            ->where('user_id', $userId)
            ->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'No estás apuntado a esta sesión');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Reserva cancelada');
    }
}

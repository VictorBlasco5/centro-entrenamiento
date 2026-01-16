<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CoachController extends Controller
{
    public function coachSessions()
    {
        $coach = Auth::user();

        // 🔹 SESIONES DE LA SEMANA (listado)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        $weeklySessions = TrainingSession::with('reservations.user')
            ->where('trainer_id', $coach->id)
            ->whereBetween('start_time', [$startOfWeek, $endOfWeek])
            ->orderBy('start_time')
            ->get()
            ->groupBy(fn($s) => $s->start_time->format('Y-m-d'));

        // 🔹 SESIONES DEL MES (calendario)
        $calendarSessions = TrainingSession::withCount('reservations')
            ->where('trainer_id', $coach->id)
            ->orderBy('start_time')
            ->get();

        return view('coach', compact(
            'weeklySessions',
            'calendarSessions'
        ));
    }
}

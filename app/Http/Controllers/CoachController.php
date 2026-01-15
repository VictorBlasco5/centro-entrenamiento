<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CoachController extends Controller
{
    public function mySessions()
    {
        $coach = Auth::user();
        $now = Carbon::now();

        $futureSessions = TrainingSession::where('trainer_id', $coach->id)
            ->where('start_time', '>=', $now)
            ->orderBy('start_time', 'asc')
            ->get();

        $pastSessions = TrainingSession::where('trainer_id', $coach->id)
            ->where('start_time', '<', $now)
            ->orderBy('start_time', 'desc')
            ->get();

        return view('coach.coach-sessions', compact('futureSessions', 'pastSessions'));
    }

    public function weeklySessions()
    {
        $coach = Auth::user();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $sessions = TrainingSession::with('reservations.user')
            ->where('trainer_id', $coach->id)
            ->whereBetween('start_time', [$startOfWeek, $endOfWeek])
            ->orderBy('start_time')
            ->get();

        $weeklySessions = $sessions->groupBy(function ($session) {
            return $session->start_time->format('Y-m-d');
        });

        return view('coach', compact('weeklySessions'));
    }

    public function sessionDetail(TrainingSession $session)
    {
        if ($session->trainer_id !== Auth::id()) {
            abort(403);
        }

        $session->load('reservations.user');

        return view('coach.session-detail', compact('session'));
    }
}

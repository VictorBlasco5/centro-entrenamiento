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
}

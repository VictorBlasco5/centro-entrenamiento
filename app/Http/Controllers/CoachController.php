<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CoachController extends Controller
{
    public function coachSessions(Request $request)
    {
        $coach = Auth::user();

        if ($request->filled('week_start')) {
            try {
                $startOfWeek = Carbon::parse($request->query('week_start'))->startOfWeek();
            } catch (\Exception $e) {
                $startOfWeek = Carbon::now()->startOfWeek();
            }
        } else {
            $startOfWeek = Carbon::now()->startOfWeek();
        }

        $endOfWeek = (clone $startOfWeek)->endOfWeek();

        $weeklySessions = TrainingSession::with('reservations.user')
            ->where('trainer_id', $coach->id)
            ->whereBetween('start_time', [$startOfWeek, $endOfWeek])
            ->orderBy('start_time')
            ->get()
            ->groupBy(fn($s) => $s->start_time->format('Y-m-d'));

        $displayWeekLabel = $startOfWeek->locale('es')->isoFormat('D [de] MMM Y')
            . ' - ' . $endOfWeek->locale('es')->isoFormat('D [de] MMM Y');

        $prevWeekStart = (clone $startOfWeek)->subWeek()->toDateString();
        $nextWeekStart = (clone $startOfWeek)->addWeek()->toDateString();

        $calendarSessions = TrainingSession::withCount('reservations')
            ->where('trainer_id', $coach->id)
            ->orderBy('start_time')
            ->get();

        return view('coach', compact(
            'weeklySessions',
            'calendarSessions',
            'displayWeekLabel',
            'prevWeekStart',
            'nextWeekStart',
            'startOfWeek'
        ));
    }
}

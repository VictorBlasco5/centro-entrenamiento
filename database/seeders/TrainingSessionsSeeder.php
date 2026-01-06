<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingSession;
use Carbon\Carbon;

class TrainingSessionsSeeder extends Seeder
{
    public function run(): void
    {
        $sessionTypes = [
            'Yoga',
            'Pilates',
            'Crossfit',
            'HIIT',
            'Spinning',
            'Boxeo',
            'Fuerza',
            'Funcional',
        ];

        $timeSlots = [
            '08:00',
            '09:00',
            '10:00',
            '12:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
        ];

        $trainers = [1, 2, 3];

        // Enero 2026
        $startDate = Carbon::create(2026, 1, 6);
        $endDate   = Carbon::create(2026, 1, 31);

        while ($startDate->lte($endDate)) {

            // Número de sesiones por día (entre 3 y 6)
            $sessionsPerDay = rand(3, 6);

            // Evitar repetir horarios el mismo día
            $dailySlots = collect($timeSlots)->shuffle()->take($sessionsPerDay);

            foreach ($dailySlots as $slot) {

                $start = Carbon::parse($startDate->format('Y-m-d') . ' ' . $slot);
                $end   = $start->copy()->addHour();

                TrainingSession::create([
                    'title'       => collect($sessionTypes)->random(),
                    'description' => 'Sesión grupal de entrenamiento',
                    'trainer_id'  => collect($trainers)->random(),
                    'start_time'  => $start,
                    'end_time'    => $end,
                    'max_clients' => rand(4, 6),
                ]);
            }

            $startDate->addDay();
        }
    }
}

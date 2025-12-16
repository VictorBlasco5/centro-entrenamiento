<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingSession;
use Carbon\Carbon;

class TrainingSessionsSeeder extends Seeder
{
    public function run()
    {
        $sessions = [
            [
                'title' => 'Yoga',
                'start_time' => '2025-12-18 10:00:00',
                'end_time' => '2025-12-18 11:00:00',
                'max_clients' => 4,
                'trainer_id' => 1,
            ],
            [
                'title' => 'Crossfit',
                'start_time' => '2025-12-19 12:00:00',
                'end_time' => '2025-12-19 13:00:00',
                'max_clients' => 4,
                'trainer_id' => 1,
            ],
            [
                'title' => 'Pilates',
                'start_time' => '2025-12-20 09:00:00',
                'end_time' => '2025-12-20 10:00:00',
                'max_clients' => 4,
                'trainer_id' => 2,
            ],
            [
                'title' => 'Spinning',
                'start_time' => '2025-12-21 18:00:00',
                'end_time' => '2025-12-21 19:00:00',
                'max_clients' => 4,
                'trainer_id' => 1,
            ],
            [
                'title' => 'Boxeo',
                'start_time' => '2025-12-22 17:00:00',
                'end_time' => '2025-12-22 18:00:00',
                'max_clients' => 4,
                'trainer_id' => 2,
            ],
            [
                'title' => 'HIIT',
                'start_time' => '2025-12-23 16:00:00',
                'end_time' => '2025-12-23 17:00:00',
                'max_clients' => 4,
                'trainer_id' => 3,
            ],
        ];

        foreach ($sessions as $s) {
            TrainingSession::create([
                'title' => $s['title'],
                'start_time' => Carbon::parse($s['start_time']),
                'end_time' => Carbon::parse($s['end_time']),
                'max_clients' => $s['max_clients'],
                'trainer_id' => $s['trainer_id'],
            ]);
        }
    }
}

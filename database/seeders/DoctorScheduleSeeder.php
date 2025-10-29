<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_schedules')->insert([
            [
                'doctor_id' => 1,
                'schedule_date' => '2025-10-29',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'session_label' => 'Noon',
                'remarks' => 'General checkups',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'schedule_date' => '2025-10-30',
                'start_time' => '09:00:00',
                'end_time' => '11:30:00',
                'session_label' => 'Morning',
                'remarks' => 'Follow-up appointments',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'schedule_date' => '2025-10-29',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
                'session_label' => 'Evening',
                'remarks' => 'Available for surgery prep',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

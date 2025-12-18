<?php

namespace Database\Seeders;

use App\Models\HMS\Doctor;
use App\Models\HMS\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['saturday','sunday','monday','tuesday','wednesday','thursday','friday'];

        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {
            foreach ($days as $day) {
                $slotsCount = rand(1, 3); // 1-3 slots per day
                $startHour = 9;

                for ($i = 0; $i < $slotsCount; $i++) {
                    $from = $startHour;
                    $to = $from + rand(1, 3); // 1-3 hours slot

                    if($to > 22) $to = 22; // max 10pm

                    Schedule::create([
                        'doctor_id' => $doctor->id,
                        'day' => $day,
                        'from_time' => sprintf("%02d:00:00", $from),
                        'to_time' => sprintf("%02d:00:00", $to),
                        'status' => true,
                    ]);

                    $startHour = $to + 1; // next slot starts after this
                    if($startHour >= 22) break;
                }
            }
        }
    }
}

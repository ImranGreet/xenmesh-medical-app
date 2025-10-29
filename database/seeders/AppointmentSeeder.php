<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->insert([
            [
                'patient_id' => 1,
                'appointed_doctor_id' => 2,
                'added_by_id' => 3,
                'appointment_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'appointment_time' => '09:00:00',
                'status' => 'scheduled',
                'room_number' => '101',
                'appointment_fee' => 150.00,
                'reason' => 'Regular Checkup',
                'notes' => 'First visit for patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'appointed_doctor_id' => 1,
                'added_by_id' => 3,
                'appointment_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'appointment_time' => '10:30:00',
                'status' => 'scheduled',
                'room_number' => '102',
                'appointment_fee' => 450.00,

                'reason' => 'Follow-up',
                'notes' => 'Patient follow-up after surgery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'appointed_doctor_id' => 2,
                'added_by_id' => 1,
                'appointment_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'appointment_time' => '14:00:00',
                'status' => 'pending',
                'room_number' => '103',
                'appointment_fee' => 750.00,

                'reason' => 'Consultation',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'appointed_doctor_id' => 2,
                'added_by_id' => 1,
                'appointment_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'appointment_time' => '14:00:00',
                'status' => 'pending',
                'room_number' => '103',
                'appointment_fee' => 750.00,

                'reason' => 'Consultation',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

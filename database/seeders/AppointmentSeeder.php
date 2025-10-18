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
                'patient_id' => 1, // Make sure this patient exists
                'doctor_id' => 2,  // Make sure this doctor exists
                'added_by' => 3,   // User who created the appointment
                'appointment_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'appointment_time' => '09:00:00',
                'status' => 'Scheduled',
                'room_number' => '101',
                'reason' => 'Regular Checkup',
                'notes' => 'First visit for patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'doctor_id' => 1,
                'added_by' => 3,
                'appointment_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'appointment_time' => '10:30:00',
                'status' => 'Scheduled',
                'room_number' => '102',
                'reason' => 'Follow-up',
                'notes' => 'Patient follow-up after surgery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'doctor_id' => 2,
                'added_by' => 1,
                'appointment_date' => Carbon::now()->addDays(3)->format('Y-m-d'), 
                'appointment_time' => '14:00:00',
                'status' => 'Pending',
                'room_number' => '103',
                'reason' => 'Consultation',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

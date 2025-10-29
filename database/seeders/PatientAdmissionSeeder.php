<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PatientAdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // ps4-naming conventions are not following
    public function run(): void
    {
        DB::table('patient_admissions')->insert([
            [
                'patient_id' => 1,
                'hospital_id' => 1,
                'admitted_by_doctor_id' => 1, 
                'room_id' => 1,
                'added_by_id' => 1, 
                'admission_id' => Str::uuid(),
                'bed_number' => 'B-101',
                'symptoms' => 'High fever, cough, fatigue',
                'diagnosis' => 'Viral infection',
                'admission_notes' => 'Patient admitted for observation and treatment.',
                'admission_date' => Carbon::now()->subDays(2),
                'expected_discharge_date' => Carbon::now()->addDays(3),
                'discharge_date' => null,
                'status' => 'admitted',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'hospital_id' => 1,
                'admitted_by_doctor_id' => 1,
                'room_id' => 2,
                'added_by_id' => 2,
                'admission_id' => Str::uuid(),
                'bed_number' => 'C-204',
                'symptoms' => 'Chest pain and shortness of breath',
                'diagnosis' => 'Cardiac problem',
                'admission_notes' => 'Referred to cardiology department for further tests.',
                'admission_date' => Carbon::now()->subDays(4),
                'expected_discharge_date' => Carbon::now()->addDays(2),
                'discharge_date' => null,
                'status' => 'admitted',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'hospital_id' => 1,
                'admitted_by_doctor_id' => 1,
                'room_id' => 3,
                'added_by_id' => 2,
                'admission_id' => Str::uuid(),
                'bed_number' => 'A-301', 
                'symptoms' => 'Headache and nausea',
                'diagnosis' => 'Migraine',
                'admission_notes' => 'Stable condition, under observation.',
                'admission_date' => Carbon::now()->subDays(1),
                'expected_discharge_date' => Carbon::now()->addDays(1),
                'discharge_date' => null,
                'status' => 'admitted',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

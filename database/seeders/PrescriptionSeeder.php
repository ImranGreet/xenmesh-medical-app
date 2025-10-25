<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prescriptions')->insert([
            [
                'patient_id' => 1, 
                'doctor_id' => 1,  
                'prescription_date' => Carbon::parse('2025-10-25'),
                'diagnosis' => 'Common cold and fever',
                'notes' => 'Patient advised rest and hydration',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'doctor_id' => 2,
                'prescription_date' => Carbon::parse('2025-10-24'),
                'diagnosis' => 'Stomach pain and acid reflux',
                'notes' => 'Avoid spicy foods. Prescribed omeprazole.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'doctor_id' => 1,
                'prescription_date' => Carbon::parse('2025-10-20'),
                'diagnosis' => 'High blood pressure',
                'notes' => 'Monitor BP daily. Low salt diet recommended.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

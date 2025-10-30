<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        
         
         DB::table('doctors')->insert([
            [
                'doctor_id' => 1, 
                'department_id' => 1,
                'description' => 'Heart specialist focusing on surgery',
                'specialization' => 'Heart Surgery',
                'qualification' => 'MD, Cardiology',
                'experience_years' => 10,
                'gender' => 'Male',
                'address' => '123 Main Street',
                'hospital_id' => 1, 
                'added_by_id' => 1,    
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2, 
                'department_id' => 1,
                'description' => 'Brain specialist',
                'specialization' => 'Brain Surgery',
                'qualification' => 'MD, Neurology',
                'experience_years' => 8,
                'gender' => 'Female',
                'address' => '456 Elm Street',
                'hospital_id' => 1,
                'added_by_id' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 3, 
                'department_id' => 2,
                'description' => 'Child care specialist',
                'specialization' => 'Child Care',
                'qualification' => 'MD, Pediatrics',
                'experience_years' => 5,
                'gender' => 'Male',
                'address' => '789 Oak Avenue',
                'hospital_id' => 2,
                'added_by_id' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
}

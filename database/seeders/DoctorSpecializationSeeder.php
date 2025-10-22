<?php

namespace Database\Seeders;

use App\Models\HMS\DoctorSpecialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitalIds = [1, 2]; 

        $specializations = [
            [
                'department_name' => 'Cardiologist',
                'description' => 'Heart specialist',
                'hospital_id' => $hospitalIds[0],
                'is_active' => true,
            ],
            [
                'department_name' => 'Nephrologist',
                'description' => 'Kidney specialist',
                'hospital_id' => $hospitalIds[0],
                'is_active' => true,
            ],
            [
                'department_name' => 'Ophthalmologist',
                'description' => 'Eye specialist',
                'hospital_id' => $hospitalIds[1],
                'is_active' => true,
            ],
            [
                'department_name' => 'Physiotherapy',
                'description' => 'Rehabilitation and therapy',
                'hospital_id' => $hospitalIds[1],
                'is_active' => true,
            ],
        ];
         
        foreach ($specializations as $specialization) {
            DoctorSpecialization::create($specialization);
        }

    }
}

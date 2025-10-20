<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // Make sure hospital and user records exist before running this seeder
        $hospital = DB::table('hospital_infos')->first();
        $user = DB::table('users')->first();

        if (!$hospital || !$user) {
            echo "⚠️  Please seed 'users' and 'hospital_infos' tables first.\n";
            return;
        }

        DB::table('patients')->insert([
            [
                'patient_name' => 'John Doe',
                'age' => 28,
                'sex' => 'male',
                'date_of_birth' => '1997-03-12',
                'blood_group' => 'A+',
                'phone_number' => '01710000001',
                'email' => 'john.doe@example.com',
                'address' => 'Dhaka, Bangladesh',
                'emergency_contact_name' => 'Jane Doe',
                'emergency_contact_phone' => '01710000002',
                'allergies' => 'Peanuts',
                'chronic_diseases' => 'Asthma',
                'hospital_id' => $hospital->id,
                'added_by_id' => $user->id,
                'is_active' => true,
                'patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_name' => 'Maria Rahman',
                'age' => 35,
                'sex' => 'female',
                'date_of_birth' => '1990-05-20',
                'blood_group' => 'O+',
                'phone_number' => '01710000003',
                'email' => 'maria.rahman@example.com',
                'address' => 'Chittagong, Bangladesh',
                'emergency_contact_name' => 'Hasan Rahman',
                'emergency_contact_phone' => '01710000004',
                'allergies' => 'None',
                'chronic_diseases' => 'Hypertension',
                'hospital_id' => $hospital->id,
                'added_by_id' => $user->id,
                'is_active' => true,
                'patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_name' => 'Abdul Karim',
                'age' => 40,
                'sex' => 'male',
                'date_of_birth' => '1985-01-15',
                'blood_group' => 'B+',
                'phone_number' => '01710000005',
                'email' => 'abdul.karim@example.com',
                'address' => 'Sylhet, Bangladesh',
                'emergency_contact_name' => 'Rahima Karim',
                'emergency_contact_phone' => '01710000006',
                'allergies' => 'Penicillin',
                'chronic_diseases' => 'Diabetes',
                'hospital_id' => $hospital->id,
                'added_by_id' => $user->id, 
                'is_active' => true,
                'patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

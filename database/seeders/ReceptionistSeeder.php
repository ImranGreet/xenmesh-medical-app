<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('receptionists')->insert([
            [
                'patient_name' => 'John Doe',
                'age' => 32,
                'sex' => 'male',
                'date_of_birth' => '1993-05-14',
                'blood_group' => 'O+',
                'phone_number' => '01710000000',
                'email' => 'john.doe@example.com',
                'address' => '123 Main Street, Dhaka',
                'emergency_contact_name' => 'Jane Doe',
                'emergency_contact_phone' => '01810000000',
                'allergies' => 'Peanuts',
                'chronic_diseases' => 'Diabetes',
                'hospital_id' => 1, // make sure hospital_infos table has ID 1
                'added_by' => 1,    // make sure users table has ID 1
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'patient_name' => 'Amina Rahman',
                'age' => 27,
                'sex' => 'female',
                'date_of_birth' => '1998-08-20',
                'blood_group' => 'A+',
                'phone_number' => '01920000000',
                'email' => 'amina.rahman@example.com',
                'address' => '45 Green Road, Chittagong',
                'emergency_contact_name' => 'Rafi Rahman',
                'emergency_contact_phone' => '01630000000',
                'allergies' => 'None',
                'chronic_diseases' => 'Asthma',
                'hospital_id' => 1,
                'added_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HospitalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hospital_infos')->insert([
            [
                'hospital_name' => 'Green Valley Medical Center',
                'code' => Str::upper(Str::random(6)),
                'address' => '123 Green Street',
                'city' => 'Dhaka',
                'state' => 'Dhaka',
                'country' => 'Bangladesh',
                'postal_code' => '1207',
                'phone_number' => '+8801712345678',
                'email' => 'info@greenvalleymedical.com',
                'website' => 'https://greenvalleymedical.com',
                'established_year' => 2010,
                'number_of_beds' => 250,
                'description' => 'A leading multi-specialty hospital providing quality healthcare services.',
                'is_active' => true,
                'added_by' => 1, // Make sure user with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hospital_name' => 'Sunrise General Hospital',
                'code' => Str::upper(Str::random(6)),
                'address' => '456 Sunrise Avenue',
                'city' => 'Chittagong',
                'state' => 'Chittagong',
                'country' => 'Bangladesh',
                'postal_code' => '4000',
                'phone_number' => '+8801811223344',
                'email' => 'contact@sunrisehospital.com',
                'website' => 'https://sunrisehospital.com',
                'established_year' => 2015,
                'number_of_beds' => 180,
                'description' => 'Trusted healthcare facility known for patient care and advanced treatment.',
                'is_active' => true,
                'added_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    } 
}

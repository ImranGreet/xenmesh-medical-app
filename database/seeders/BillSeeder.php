<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bills')->insert([
            [
                'patient_id' => 1,
                'consultation_fee' => 500.00,
                'room_charges' => 1500.00,
                'total' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'consultation_fee' => 700.00,
                'room_charges' => 1800.00,
                'total' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'consultation_fee' => 600.00,
                'room_charges' => 1200.00,
                'total' => 1800.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]); 
    }
}

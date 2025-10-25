<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrescribedMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prescribed_medicines')->insert([
            [
                'name' => 'Paracetamol 500mg',
                'price' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amoxicillin 250mg',
                'price' => 25.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cough Syrup 100ml',
                'price' => 45.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ibuprofen 400mg',
                'price' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Antacid Tablet',
                'price' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]); 
    }
}

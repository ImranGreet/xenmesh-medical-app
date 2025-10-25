<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bill_medicines')->insert([
            [
                'bill_id' => 1,
                'prescribed_medicine_id' => 1, // Paracetamol 500mg
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 1,
                'prescribed_medicine_id' => 3, // Cough Syrup
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 2,
                'prescribed_medicine_id' => 2, // Amoxicillin 250mg
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 3,
                'prescribed_medicine_id' => 4, // Ibuprofen 400mg
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 3,
                'prescribed_medicine_id' => 5, // Antacid Tablet
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]); 
    }
}

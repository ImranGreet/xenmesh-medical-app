<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultationFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultation_fees')->insert([
            [
                'patient_id' => 1,
                'effective_date' => Carbon::parse('2025-01-01'),
                'fee_amount' => 500.00,
                'effective_to' => Carbon::parse('2025-12-31'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'effective_date' => Carbon::parse('2025-03-01'),
                'fee_amount' => 750.00,
                'effective_to' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3,
                'effective_date' => Carbon::parse('2025-05-15'),
                'fee_amount' => 1000.00,
                'effective_to' => Carbon::parse('2026-05-15'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $tests = [
            [
                'test_name' => 'X-Ray',
                'description' => 'Standard X-Ray imaging.',
                'fee' => 250.00,
                'category' => 'Radiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'MRI Scan',
                'description' => 'Magnetic Resonance Imaging scan.',
                'fee' => 850.00,
                'category' => 'Radiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'CVC Test',
                'description' => 'Complete blood count test.',
                'fee' => 450.00,
                'category' => 'Pathology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'ECG',
                'description' => 'Electrocardiogram for heart.',
                'fee' => 300.00,
                'category' => 'Cardiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'Blood Sugar Test',
                'description' => 'Fasting blood sugar test.',
                'fee' => 150.00,
                'category' => 'Pathology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];  

        DB::table('lab_tests')->insert($tests);
    }
}

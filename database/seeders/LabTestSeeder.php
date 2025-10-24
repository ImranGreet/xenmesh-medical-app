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
                'created_by' => 1,
                'description' => 'Standard X-Ray imaging.',
                'fee' => 250.00,
                'category' => 'Radiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'MRI Scan',
                'created_by' => 1,
                'description' => 'Magnetic Resonance Imaging scan.',
                'fee' => 850.00,
                'category' => 'Radiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'CVC Test',
                'created_by' => 1,
                'description' => 'Complete blood count test.',
                'fee' => 450.00,
                'category' => 'Pathology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'ECG',
                'created_by' => 1,
                'description' => 'Electrocardiogram for heart.',
                'fee' => 300.00,
                'category' => 'Cardiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_name' => 'Blood Sugar Test',
                'created_by' => 1,
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

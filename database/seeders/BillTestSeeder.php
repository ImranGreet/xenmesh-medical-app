<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bill_tests')->insert([
            [
                'bill_id' => 1,
                'lab_test_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 1, 
                'lab_test_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 2,
                'lab_test_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bill_id' => 3,
                'lab_test_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('floors')->insert([
            [
                'floor_name' => 'Ground Floor',
                'level' => 0,
                'department' => 'Emergency',
                'total_cabins' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_name' => '1st Floor',
                'level' => 1,
                'department' => 'Surgery',
                'total_cabins' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_name' => '2nd Floor',
                'level' => 2,
                'department' => 'ICU',
                'total_cabins' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_name' => '3rd Floor',
                'level' => 3,
                'department' => 'Pediatrics',
                'total_cabins' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]); 
    }
}

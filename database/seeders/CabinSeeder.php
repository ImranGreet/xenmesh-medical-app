<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cabins')->insert([
            [
                'cabin_number' => 'C-101',
                'type' => 'general',
                'floor_number' => 1,
                'bed_count' => 1,
                'price_per_day' => 800.00,
                'is_occupied' => false,
                'patient_id' => 1,
                'notes' => 'Near nurse station'
            ],
            [
                'cabin_number' => 'C-102',
                'type' => 'deluxe',
                'floor_number' => 1,
                'bed_count' => 2,
                'price_per_day' => 1500.00,
                'is_occupied' => true,
                'patient_id' => 2,
                'notes' => 'Deluxe cabin with attached bathroom'
            ],
            [
                'cabin_number' => 'C-201',
                'type' => 'ICU',
                'floor_number' => 2,
                'bed_count' => 1,
                'price_per_day' => 2500.00,
                'is_occupied' => false,
                'patient_id' => 3,
                'notes' => 'Equipped with oxygen and monitoring system'
            ],
            [
                'cabin_number' => 'C-202',
                'type' => 'general',
                'floor_number' => 2,
                'bed_count' => 1,
                'price_per_day' => 900.00,
                'is_occupied' => false,
                'patient_id' => null,
                'notes' => null
            ],
        ]);
    }
}

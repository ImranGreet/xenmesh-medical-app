<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('rooms')->insert([
            [
                'hospital_id' => 1, // Must exist in hospital_infos
                'user_id' => 1,     // Must exist in users table
                'room_number' => 'A-101',
                'room_type' => 'General Ward',
                'floor' => '1',
                'wing' => 'A',
                'total_beds' => 10,
                'available_beds' => 7,
                'price_per_day' => 1500.00,
                'facilities' => json_encode(['AC', 'Fan', 'Attached Bathroom']),
                'description' => 'Spacious room suitable for general patients.',
                'is_available' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hospital_id' => 1,
                'user_id' => 1,
                'room_number' => 'A-202',
                'room_type' => 'ICU',
                'floor' => '2',
                'wing' => 'B',
                'total_beds' => 5,
                'available_beds' => 2,
                'price_per_day' => 4500.00,
                'facilities' => json_encode(['AC', 'Monitor', 'Oxygen Support']),
                'description' => 'ICU room with modern facilities.',
                'is_available' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'hospital_id' => 1,
                'user_id' => 1,
                'room_number' => 'B-301',
                'room_type' => 'Private',
                'floor' => '3',
                'wing' => 'B',
                'total_beds' => 2,
                'available_beds' => 1,
                'price_per_day' => 7000.00,
                'facilities' => json_encode(['AC', 'TV', 'Refrigerator', 'Private Bathroom']),
                'description' => 'Luxury private room for VIP patients.',
                'is_available' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

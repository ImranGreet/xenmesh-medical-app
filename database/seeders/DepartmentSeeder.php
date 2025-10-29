<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('departments')->insert([
            [
                'department_name' => 'Cardiology',
                'description' => 'Handles disorders of the heart and blood vessels.',
                'is_active' => true,
                'added_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Ophthalmology',
                'description' => 'Deals with diagnosis and treatment of eye disorders.',
                'is_active' => true,
                'added_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Neurology',
                'description' => 'Focuses on treating diseases of the nervous system.',
                'is_active' => true,
                'added_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Orthopedics',
                'description' => 'Specializes in musculoskeletal system issues.',
                'is_active' => true,
                'added_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Dermatology',
                'description' => 'Treats skin, hair, and nail conditions.',
                'is_active' => true,
                'added_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

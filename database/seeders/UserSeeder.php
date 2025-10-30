<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'username' => 'admin001',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Receptionist User',
                'email' => 'reception@example.com',
                'role' => 'receptionist',
                'username' => 'reception001',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Xennifer Ahmed',
                'email' => 'xennifer.ahmed@example.com',
                'role' => 'doctor',
                'username' => 'doctor001',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Zaman Rishad',
                'email' => 'zaman.rishad@example.com',
                'role' => 'doctor',
                'username' => 'doctor002',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Amina Chowdhury',
                'email' => 'amina.chowdhury@example.com',
                'role' => 'doctor',
                'username' => 'doctor003',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Karim Rahman',
                'email' => 'karim.rahman@example.com',
                'role' => 'doctor',
                'username' => 'doctor004',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Mahfuz Alam',
                'email' => 'mahfuz.alam@example.com',
                'role' => 'doctor',
                'username' => 'doctor005',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Shaila Nahar',
                'email' => 'shaila.nahar@example.com',
                'role' => 'doctor',
                'username' => 'doctor006',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Tanvir Hasan',
                'email' => 'tanvir.hasan@example.com',
                'role' => 'doctor',
                'username' => 'doctor007',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Nusrat Jahan',
                'email' => 'nusrat.jahan@example.com',
                'role' => 'doctor',
                'username' => 'doctor008',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Farhan Kabir',
                'email' => 'farhan.kabir@example.com',
                'role' => 'doctor',
                'username' => 'doctor009',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Sadiya Rahman',
                'email' => 'sadiya.rahman@example.com',
                'role' => 'doctor',
                'username' => 'doctor010',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

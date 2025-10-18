<?php

namespace Database\Seeders;

use App\Models\HMS\HospitalInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default users
        $this->seedUsers();
        $this->call(DoctorSeeder::class);
        $this->call(HospitalInfo::class);

        // Seed appointments
        $this->call(AppointmentSeeder::class);
    }

    /**
     * Seed default users into the users table.
     */
    private function seedUsers(): void
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
                'name' => 'Doctor User',
                'email' => 'doctor@example.com',
                'role' => 'doctor',
                'username' => 'doctor001',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(HospitalInfoSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(PatientAdmissionSeeder::class);
        $this->call(LabTestSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(ConsultationFeeSeeder::class);
        $this->call(PrescriptionSeeder::class);
        $this->call(BillMedicineSeeder::class);
        $this->call(BillTestSeeder::class);
        $this->call(PrescribedMedicinesSeeder::class);
        $this->call(RolePermissionSeeder::class);
    }
}

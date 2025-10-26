<?php

namespace Database\Seeders;

use App\Models\HMS\PrescribedMedicine;
use App\Models\HMS\Prescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescribedMedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure prescriptions exist before seeding prescribed medicines
        $prescriptions = Prescription::all(); 

        if ($prescriptions->isEmpty()) {
            $this->command->warn('No prescriptions found. Seed prescriptions first.');
            return;
        }

        foreach ($prescriptions as $prescription) {
            PrescribedMedicine::create([
                'prescription_id' => $prescription->id,
                'medicine_name' => fake()->word(),
                'form' => fake()->randomElement(['Tablet', 'Capsule', 'Syrup']),
                'strength' => fake()->randomElement(['250mg', '500mg', '1g']),
                'dosage' => fake()->randomElement(['1 tablet', '2 capsules']),
                'frequency' => fake()->randomElement(['Once a day', 'Twice a day', 'Every 8 hours']),
                'duration' => fake()->randomElement(['5 days', '7 days', '10 days']),
                'instructions' => fake()->sentence(),
            ]);
        }
    }
}

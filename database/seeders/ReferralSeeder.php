<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('referrals')->insert([
            [
                'patient_id' => 1,
                'from_doctor_id' => 2,
                'to_doctor_id' => 5,
                'department_id' => 3,
                'reason' => 'Patient has high creatinine levels, refer to nephrologist.',
                'urgency' => 'high',
                'status' => 'pending',
                'appointment_id' => null,
            ],
            [
                'patient_id' => 2,
                'from_doctor_id' => 3,
                'to_doctor_id' => 6,
                'department_id' => 4,
                'reason' => 'Recurring urinary tract infections, nephrology consultation needed.',
                'urgency' => 'medium',
                'status' => 'pending',
                'appointment_id' => null,
            ],
            [
                'patient_id' => 3,
                'from_doctor_id' => 2,
                'to_doctor_id' => 5,
                'department_id' => 3,
                'reason' => 'Abnormal kidney function tests.',
                'urgency' => 'high',
                'status' => 'scheduled',
                'appointment_id' => 10,
            ],
            [
                'patient_id' => 4,
                'from_doctor_id' => 3,
                'to_doctor_id' => 6,
                'department_id' => 4,
                'reason' => 'Patient reports swelling in legs, possible renal issue.',
                'urgency' => 'medium',
                'status' => 'pending',
                'appointment_id' => null,
            ],
            [
                'patient_id' => 5,
                'from_doctor_id' => 2,
                'to_doctor_id' => 5,
                'department_id' => 3,
                'reason' => 'Chronic hypertension affecting kidneys.',
                'urgency' => 'high',
                'status' => 'scheduled',
                'appointment_id' => 11,
            ],
            [
                'patient_id' => 6,
                'from_doctor_id' => 3,
                'to_doctor_id' => 6,
                'department_id' => 4,
                'reason' => 'Protein in urine, nephrology check recommended.',
                'urgency' => 'medium',
                'status' => 'pending',
                'appointment_id' => null,
            ],
            [
                'patient_id' => 7,
                'from_doctor_id' => 2,
                'to_doctor_id' => 5,
                'department_id' => 3,
                'reason' => 'Recurrent kidney stones.',
                'urgency' => 'low',
                'status' => 'pending',
                'appointment_id' => null,
            ],
            [
                'patient_id' => 8,
                'from_doctor_id' => 3,
                'to_doctor_id' => 6,
                'department_id' => 4,
                'reason' => 'Blood in urine, nephrologist referral needed.',
                'urgency' => 'high',
                'status' => 'scheduled',
                'appointment_id' => 12,
            ],
            [
                'patient_id' => 9,
                'from_doctor_id' => 2,
                'to_doctor_id' => 5,
                'department_id' => 3,
                'reason' => 'Elevated creatinine and urea levels.',
                'urgency' => 'medium',
                'status' => 'pending',
                'appointment_id' => null,
            ],
            [
                'patient_id' => 10,
                'from_doctor_id' => 3,
                'to_doctor_id' => 6,
                'department_id' => 4,
                'reason' => 'Patient shows early signs of CKD.',
                'urgency' => 'high',
                'status' => 'scheduled',
                'appointment_id' => 13,
            ],
        ]);
    }
}

<?php

namespace App\Services\HMS;

use App\Models\HMS\Prescription;

class PrescriptionService
{
    public function getAllPrescriptions()
    {
        return Prescription::all();
    }

    public function getPrescriptionsByPatientId($patientId)
    {
        return Prescription::where('patient_id', $patientId)->get();
    }
    public function getPrescriptionByPatientId($patientId)
    {
        return Prescription::where('patient_id', $patientId)->first();
    }
}

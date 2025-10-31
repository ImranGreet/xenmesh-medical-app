<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function getAllPrescriptions()
    {
        $prescriptions = Prescription::with(['patient','doctor','prescribedMedicines'])->get();
        
        return response()->json($prescriptions);
    }
    public function getPrescriptionById($id)
    {
        $prescription = Prescription::with(['patient','doctor','prescribedMedicines'])->find($id);

        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }
        return response()->json($prescription);
    }

    public function getPrescriptionsByPatientId($patientId)
    {
        $prescriptions = Prescription::with(['patient','doctor','prescribedMedicines'])
            ->where('patient_id', $patientId)
            ->get();

        return response()->json($prescriptions);
    }
    public function getPrescriptionsByDoctorId($doctorId)
    {
        $prescriptions = Prescription::with(['patient','doctor','prescribedMedicines'])
            ->where('doctor_id', $doctorId)
            ->get();

        return response()->json($prescriptions);
    }
}

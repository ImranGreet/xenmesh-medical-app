<?php

namespace App\Http\Controllers\GlobalAccess;

use App\Http\Controllers\Controller;
use App\Models\HMS\Patient;
use Illuminate\Http\Request;

class PatientSelfController extends Controller
{
     public function viewPatientProfileByPatientId($patientId)
    {
        $patientProfile = Patient::where('generated_patient_id', $patientId)->first();
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => "Viewing profile for patient ID: {$patientId}",
            'patientProfile' => $patientProfile,
        ]); 
    }
}

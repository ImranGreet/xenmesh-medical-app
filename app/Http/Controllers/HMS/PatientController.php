<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function getPatientList(){
        $patients = Patient::all();
        return response()->json([
            "message"=>"Patient list retrived",
            "patientsList"=>$patients,
        ]);
    }


    // prescription related methods can be added here
    public function getPatientPrescriptionsByPatientId($patientId){
        $patient = Patient::with('prescriptions.prescribedMedicines')->find($patientId);
        if(!$patient){
            return response()->json([
                "message"=>"Patient not found"
            ],404);
        }
        return response()->json([
            "message"=>"Patient prescriptions retrived",
            "prescriptionsList"=>$patient->prescriptions,
        ]);
    }
}

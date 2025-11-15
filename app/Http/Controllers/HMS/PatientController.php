<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Patient;
use App\Services\HMS\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function getPatientList()
    {
        $patients = $this->patientService->getAllPatients();
        return response()->json([
            "message" => "Patient list retrieved",
            "patientsList" => $patients,
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
            "message"=>"Patient prescriptions retrieved",
            "prescriptionsList"=>$patient->prescriptions,
        ]);
    }

    public function registerNewPatient(Request $request){
        
    }
}

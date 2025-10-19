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
}

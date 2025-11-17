<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Patient;
use App\Services\HMS\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{

    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function getPatientList()
    {
        $perPage = request()->query('per_page', 10);
        $patients = $this->patientService->getAllPatients($perPage);

        return response()->json([
            "success" => true,
            "message" => "Patient list retrieved",
            "meta" => [
                "current_page" => $patients->currentPage(),
                "per_page" => $patients->perPage(),
                "total" => $patients->total(),
                "last_page" => $patients->lastPage(),
                "from" => $patients->firstItem(),
                "to" => $patients->lastItem(),
                'has_more_pages' => $patients->hasMorePages(),
            ],
            'links' => [
                'next' => $patients->nextPageUrl(),
                'prev' => $patients->previousPageUrl(),
            ],
            'patientList' => $patients->items(),
        ]);
    }


    public function filterPatientList(Request $request)
    {
      $perpage = request()->query('per_page',10);
      $patientList = $this->patientService->filterPatients($request);
      return $patientList;
    }


    // prescription related methods can be added here
    public function getPatientPrescriptionsByPatientId($patientId)
    {
        $patient = Patient::with('prescriptions.prescribedMedicines')->find($patientId);

        if (!$patient) {
            return response()->json([
                "message" => "Patient not found"
            ], 404);
        }
        return response()->json([
            "message" => "Patient prescriptions retrieved",
            "prescriptionsList" => $patient->prescriptions,
        ]);
    }

    public function registerNewPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_name' => 'string|required',
            'email' => 'string|email',
            'phone_number' => 'string|required',
            'sex' => 'string|required',
            'is_admitted' => 'boolean',
            'blood_group' => 'string',
            'address' => 'string',
            'allergies' => 'string',
            'chronic_diseases' => 'string',
            'generated_patient_id' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $patient = Patient::create($validator->validated());

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $patient
        ], 201);
    }
}

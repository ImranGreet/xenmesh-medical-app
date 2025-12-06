<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Patient;
use App\Services\HMS\PatientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        try {
            $patientList = $this->patientService->filterPatients($request);

            return response()->json([
                "success" => true,
                "message" => "Patient List Retrieved Successfully!",
                "meta" => [
                    "current_page" => $patientList->currentPage(),
                    "per_page" => $patientList->perPage(),
                    "total" => $patientList->total(),
                    "last_page" => $patientList->lastPage(),
                    "from" => $patientList->firstItem(),
                    "to" => $patientList->lastItem(),
                    'has_more_pages' => $patientList->hasMorePages(),
                ],
                "links" => [
                    "next" => $patientList->nextPageUrl(),
                    "prev" => $patientList->previousPageUrl(),
                ],
                "patientList" => $patientList->items(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Failed to retrieve patient list",
                "error" => $e->getMessage()
            ], 500);
        }
    }



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

    public function getPatientDetailsById($patientId)
    {
        $patient = Patient::with('hospitalInfo', 'addedBy')->find($patientId);

        if (!$patient) {
            return response()->json([
                "message" => "Patient not found"
            ], 404);
        }
        return response()->json([
            "message" => "Patient details retrieved",
            "patientDetails" => $patient,
        ]);
    }

    public function retrievePatientInfo($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return response()->json([
            "message" => "Patient info retrieved",
            "patientInfo" => $patient,
        ]);
    }


    public function registerNewPatient(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string',
            'email' => 'nullable|string|email',
            'phone_number' => 'required|string',
            'sex' => 'required|string|in:male,female',
            'age' => 'required|integer',
            'blood_group' => 'nullable|string',
            'address' => 'nullable|string',
            'emergency_contact_phone' => 'nullable|string',
            'is_admitted' => 'boolean',
            'keep_records' => 'boolean',
            'allergies' => 'nullable|string',
            'chronic_diseases' => 'nullable|string',
            'hospital_id' => 'required|integer|exists:hospital_infos,id',
            'added_by_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ],
                422
            );
        }

        $data = $validator->validated();
        do {
            $generatedId = 'PAT-' . strtoupper(Str::random(6));
        } while (Patient::where('generated_patient_id', $generatedId)->exists());

        $data['generated_patient_id'] = $generatedId;
        $patient = Patient::create($data);

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $patient
        ], 201);
    }

    public function updatePatientInfo(Request $request, $patientId)
    {
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json([
                "message" => "Patient not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_name' => 'sometimes|required|string',
            'email' => 'sometimes|nullable|string|email',
            'phone_number' => 'sometimes|required|string',
            'sex' => 'sometimes|required|string|in:male,female',
            'age' => 'sometimes|required|integer',
            'blood_group' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'emergency_contact_phone' => 'sometimes|nullable|string',
            'is_admitted' => 'boolean',
            'keep_records' => 'boolean',
            'allergies' => 'sometimes|nullable|string',
            'chronic_diseases' => 'sometimes|nullable|string',
            'hospital_id' => 'sometimes|required|integer|exists:hospital_infos,id',
            'added_by_id' => 'sometimes|required|integer|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ],
                422
            );
        }
        $data = $validator->validated();
        // dd($data,'updated data',$request->all());
        $patient->update($data);

        return response()->json([
            "message" => "Patient info updated",
            "patientInfo" => $patient,
        ]);
    }

    public function deletePatient($patientId)
    {
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json([
                "message" => "Patient not found"
            ], 404);
        }

        $patient->delete();

        return response()->json([
            "message" => "Patient deleted successfully"
        ]);
    }

    public function updatePatientAdmissionStatus(Request $request, $patientId)
    {
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json([
                "message" => "Patient not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'is_admitted' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ],
                422
            );
        }

        $patient->is_admitted = $request->input('is_admitted');
        $patient->save();

        return response()->json([
            "message" => "Patient status updated",
            "patientInfo" => $patient,
        ]);
    }

    public function updatePatientRecordsPreference(Request $request, $patientId)
    {
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json([
                "message" => "Patient not found"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'keep_records' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ],
                422
            );
        }
        $patient->keep_records = $request->input('keep_records');
        $patient->save();

        return response()->json([
            "message" => "Patient records preference updated",
            "patientInfo" => $patient,
        ]);
    }
}

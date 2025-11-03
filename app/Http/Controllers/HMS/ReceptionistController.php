<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Bill;
use App\Models\HMS\Patient;
use App\Services\HMS\BillService;
use App\Services\HMS\DoctorService;
use App\Services\HMS\PatientService;
use Illuminate\Http\Request;


class ReceptionistController extends Controller
{

    protected $doctorService;
    protected $patientService;
    protected $billService;
    public function __construct(DoctorService $doctorService, PatientService $patientService, BillService $billService)
    {
        $this->doctorService = $doctorService;
        $this->patientService = $patientService;
        $this->billService = $billService;
    }

   

    /**
     * Collect bill from patient
     */
    public function getBillFromPatient(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount'     => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $bill = Bill::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Bill recorded successfully.',
            'data'    => $bill,
        ]);
    }

    /**
     * Update patient info
     */
    public function editPatientInfo(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'patient_name' => 'nullable|string|max:50',
            'age'          => 'nullable|integer|min:0|max:120',
            'sex'          => 'nullable|string|in:male,female,other',
            'address'      => 'nullable|string|max:255',
        ]);

        $patient->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Patient information updated successfully.',
            'data'    => $patient,
        ]);
    }

    /**
     * Delete patient info
     */
    public function deletePatientInfo($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Patient deleted successfully.',
        ]);
    }

    /**
     * View patient info
     */

    public function viewPatientList()
    {
        $patients = $this->patientService->getAllPatients();
        return response()->json([
            'success' => true,
            'patientsList' => $patients,
        ]);
    }
    public function viewPatientInfo($id)
    {
        
        $patient = $this->patientService->viewPatientInfo($id);
        return response()->json([
            'success' => true,
            'patientInfo' => $patient,
        ]);
    }

    /**
     * View all available doctors
     */

    public function viewDoctorList(Request $request)
    {
        $doctors = $this->doctorService->getAllDoctors($request);

        if (!$doctors) {
            return response()->json([
                'success' => false,
                'message' => 'No doctors found.',
                'data' => null,
            ], 404);
        }

        if ($doctors->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'No doctors found! Register doctors first.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Doctors retrieved successfully.',
            'data' => $doctors,
        ]);
    }


    public function viewPatientAppointments($id)
    {
        $appointments = $this->patientService->viewPatientAppointmentsInfo($id);
        return response()->json([
            'success' => true,
            'appointmentsWithDoctors' => $appointments,
        ]);
    }

    public function viewAppointedDoctors($id)
    {
        $doctors = $this->patientService->getPatientAppointedDoctors($id);
        return response()->json([
            'success' => true,
            'data' => $doctors,
        ]);
    }

    

    public function viewPatientPrescriptions($id)
    {
        $prescriptions = $this->patientService->viewPatientPrescriptionsInfo($id);
        return response()->json([
            'success' => true,
            'data' => $prescriptions,
        ]);
    }
    

}

<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Appointment;
use App\Models\HMS\Bill;
use App\Models\HMS\Doctor;
use App\Models\HMS\Patient;
use Illuminate\Http\Request;


class ReceptionistController extends Controller
{
    /**
     * Register a new patient
     */
     public function registerNewPatient(Request $request)
    {
    
        $request->validate([
            'patient_name'            => 'required|string|max:100',
            'age'                     => 'required|integer|min:0|max:120',
            'sex'                     => 'required|string|in:male,female,other',
            'date_of_birth'           => 'nullable|date',
            'blood_group'             => 'nullable|string|max:4',
            'phone_number'            => 'required|string|max:15',
            'email'                   => 'nullable|email|max:100',
            'address'                 => 'nullable|string|max:255',
            'emergency_contact_name'  => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:15',
            'allergies'               => 'nullable|string|max:255',
            'chronic_diseases'        => 'nullable|string|max:255',
            'hospital_id'             => 'required|integer|exists:hospital_infos,id',
            'added_by'                => 'required|integer|exists:users,id',
        ]);

        
        $patient = Patient::create([
            'patient_name'            => $request->patient_name,
            'age'                     => $request->age,
            'sex'                     => $request->sex,
            'date_of_birth'           => $request->date_of_birth,
            'blood_group'             => $request->blood_group,
            'phone_number'            => $request->phone_number,
            'email'                   => $request->email,
            'address'                 => $request->address,
            'emergency_contact_name'  => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'allergies'               => $request->allergies,
            'chronic_diseases'        => $request->chronic_diseases,
            'hospital_id'             => $request->hospital_id,
            'added_by'                => $request->added_by,
        ]);

        // ✅ Step 3: Return response
        return response()->json([
            'message' => 'Patient registered successfully.',
            'patient' => $patient
        ], 201);
    }

    /**
     * Admit a new patient
     */
    public function admitNewPatient(Request $request)
    {
        $validated = $request->validate([
            'patient_id'   => 'required|exists:patients,id',
            'room_number'  => 'required|string|max:10',
            'admission_date' => 'required|date',
        ]);

        $patient = Patient::findOrFail($validated['patient_id']);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient is not found',
                'data' => null,
            ], 404);
        }

        $patient->update([
            'is_admitted' => true,
            'room_number' => $validated['room_number'],
            'admission_date' => $validated['admission_date'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Patient admitted successfully.',
            'data'    => $patient,
        ]);
    }

    /**
     * Create new appointment
     */
    public function appointmentNewPatient(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id'  => 'required|exists:doctors,id',
            'date'       => 'required|date',
            'time'       => 'required|string',
            'note'       => 'nullable|string|max:255',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully.',
            'data'    => $appointment,
        ], 201);
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
    public function viewPatientInfo($id)
    {
        $patient = Patient::with(['appointments', 'bills'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $patient,
        ]);
    }

    /**
     * View all available doctors
     */
    public function viewDoctorList()
    {
        $doctors = Doctor::all();

        return response()->json([
            'success' => true,
            'data' => $doctors,
        ]);
    }
}

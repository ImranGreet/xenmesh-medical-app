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
        $validated = $request->validate([
            'patient_name' => 'required|string|max:50',
            'age'          => 'required|integer|min:0|max:120',
            'sex'          => 'required|string|in:male,female,other',
            'address'      => 'nullable|string|max:255',
        ]);

        $patient = Patient::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Patient registered successfully.',
            'data'    => $patient,
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

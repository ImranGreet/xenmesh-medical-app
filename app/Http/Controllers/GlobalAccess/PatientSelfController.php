<?php

namespace App\Http\Controllers\GlobalAccess;

use App\Http\Controllers\Controller;
use App\Models\HMS\Appointment;
use App\Models\HMS\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function patientAppoinment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'nullable|string',
            'room_number' => 'nullable|string',
            'reason' => 'nullable|string',
            'notes' => 'nullable|string',
            'added_by' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $appointment = Appointment::create($validator->validated());

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ], 201);
    }
}

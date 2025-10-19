<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
        public function createPatientAppointment(Request $request)
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
            'added_by' => 'nullable|exists:users,id'
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

    /**
     * Get all appointments
     */
    public function getAllAppointments()
    {
        $appointments = Appointment::with(['patient', 'doctor', 'addedBy'])->get();

        return response()->json($appointments);
    }

    /**
     * Get a single appointment by ID
     */
    public function getAppointment($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'addedBy'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment);
    }

    /**
     * Update an appointment
     */
    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable',
            'status' => 'nullable|string',
            'room_number' => 'nullable|string',
            'reason' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $appointment->update($validator->validated());

        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment
        ]);
    }

    /**
     *update assign doctor 
      */ 
    //   updateAssignDoctor()
    /**
     * Delete an appointment
     */
    public function deleteAppointment($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully']);
    }
}

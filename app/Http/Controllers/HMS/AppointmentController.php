<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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


    public function getAllAppointmentsByStatus($status)
    {
        $appointments = Appointment::with(['patient', 'doctor', 'addedBy'])
            ->where('status', $status)
            ->get();

        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No appointments found with the specified status'], 404);
        }


        return response()->json([
            'success' => true,
            'status' => $status,
            'message' => 'Appoinment By Status is retrieved',
            'appointments' => $appointments
        ]);
    }


    public function getAllAppointmentsByDoctorId($doctorId)
    {
        $appointments = Appointment::with('doctor')->where('appointed_doctor_id', $doctorId)->get();

        return response()->json($appointments);
    }

    

    /**
     * Get a single appointment by ID
     */
    public function getAppointmentById($id)
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


    public function deleteAppointment($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully']);
    }

    public function getDoctorAppointments($doctorId)
    {
        $appointments = Appointment::with(['doctor', 'patient', 'addedBy'])
            ->where('appointed_doctor_id', $doctorId)
            ->get();

        return response()->json($appointments);
    }

    public function getAppointmentByCreator($creatorId)
    {
        $appointments = DB::table('appointments')
            ->join('doctors', 'appointments.appointed_doctor_id', '=', 'doctors.id')
            ->where('appointments.added_by_id', $creatorId)
            ->select(
                'appointments.id',
                'appointments.appointment_date',
                'appointments.appointment_time',
                'appointments.status',
                'appointments.notes',
                'appointments.reason',
                'appointments.room_number',
                'appointments.patient_id',
                'appointments.appointed_doctor_id',
                'appointments.added_by_id',
                'appointments.created_at',
                'appointments.updated_at',
                'doctors.doctor_name',
                'doctors.email as doctor_email',
                'doctors.phone_number as doctor_phone',
                'doctors.specialization',
                'doctors.department'
            )
            ->get();

        return response()->json($appointments);
    }
}

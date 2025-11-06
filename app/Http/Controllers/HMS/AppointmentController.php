<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Appointment;
use App\Services\HMS\AppoinmentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    protected $appointmentService;
    public function __construct(AppoinmentService $appoinmentService){
            $this->appointmentService = $appoinmentService;
    }
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
    public function getAllAppointments(Request $request)
    {
        $appointments = $this->appointmentService->retrieveAllAppoinment($request);

        return response()->json([
            'success'=>true,
            'total'=>$appointments->count(),
            'per_page'=>$appointments->perPage(),
            'data' =>$appointments,
             
        ]);
    }

    public  function getAllAppointmentsInToday()
    {
        try {
            $today = Carbon::today()->toDateString();

            $appointments = Appointment::with(['patient', 'doctor', 'addedBy'])->whereDate('appointment_date', $today)->get();

            return response()->json([
                "success" => true,
                "todayPatientCount" => $appointments->count(),
            ]);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }


    public function retreiveAppointmentStatus()
    {
        try {
            $statuses = Appointment::select('status')->distinct()->pluck('status')->map(fn($status): string => ucfirst(string: $status));

            return response()->json([
                "success" => true,
                "message" => "Status retrieved successfully!",
                "statuses" => $statuses
            ]);
        } catch (Exception $e) {

            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function getAllAppointmentsByDoctorId($doctorId)
    {
        $appointments = $this->appointmentService->retrieveAppoinmentsByDoctorId($doctorId);

        return response()->json($appointments);
    }


    /**
     * Update an appointment
     */
    public function updateAppointment(Request $request, $id)
    {
        try {
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

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function deleteAppointment($id)
    {
        try {
            $appointment = Appointment::find($id);
            if (!$appointment) {
                return response()->json(['message' => 'Appointment not found'], 404);
            }

            $appointment->delete();

            return response()->json(['message' => 'Appointment deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    // filter multiple criteria
    public function filterAppointments(Request $request)
    {
        try{

        }
       catch (Exception $e) {   
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

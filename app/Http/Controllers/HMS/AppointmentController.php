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
    public function getAllAppointments()
    {
        // $appointments = Appointment::with(['patient', 'doctor', 'addedBy'])->get();
        $appointments = $this->appointmentService->retrieveAllAppoinment();

        return response()->json([
            'success'=>true,
            'total'=>$appointments->count(),
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


    public function getAllAppointmentsInMonth()
    {
        try {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();

            $appointments = Appointment::with(['patient', 'doctor', 'addedBy'])->whereBetween('appointment_date', [$startDate, $endDate])->get();
            return response()->json([
                'success'=> true,
                'patientCount'=> $appointments->count(),
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
        $appointments = $this->appointmentService->retrieveAppoinmentsByDoctorId($doctorId);

        return response()->json($appointments);
    }



    /**
     * Get a single appointment by ID
     */
    public function getAppointmentById($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'addedBy'])->find($id);

        if (!$appointment) {

            return response()->json(['message' => 'Appointment not found !'], 404);
        }

        return response()->json($appointment);
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

    public function getDoctorAppointments($doctorId)
    {
        dd("sex");
        try {
            $appointments = Appointment::with(['doctor', 'patient', 'addedBy'])
                ->where('appointed_doctor_id', $doctorId)
                ->get();

            return response()->json($appointments);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function getAppointmentsByDate($date)
    {
        try {
            $appointments = Appointment::where('appointment_date', $date)
                ->with(['doctor', 'patient', 'addedBy'])
                ->get();

            return response()->json($appointments);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function getAppointmentsByDateRange(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date'
            ]);

            $appointments = Appointment::whereBetween('appointment_date', [$request->start_date, $request->end_date])
                ->with(['doctor', 'patient', 'addedBy'])
                ->get();

            return response()->json($appointments);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
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


    // filter multiple criteria
    public function filterAppointments(Request $request)
    {
        try {

            $query = Appointment::query()->with(['patient', 'doctor.doctorDetails', 'addedBy']);


            if ($request->has('doctor_id')) {
                $query->where('appointed_doctor_id', $request->doctor_id);
            }

            if ($request->has('status')) {
                $statuses = explode(',', $request->status);
                $query->whereIn('status', $statuses);
            }

            if ($request->has('patient_id')) {
                $query->where('patient_id', $request->patient_id);
            }

            if ($request->has('room_number')) {
                $query->where('room_number', $request->room_number);
            }

            if ($request->has('start_date') && $request->has('end_date')) {
                $query->whereBetween('appointment_date', [$request->start_date, $request->end_date]);
            } elseif ($request->has('date')) {
                $query->where('appointment_date', $request->date);
            }

            // Optional: order by date/time
            $appointments = $query->orderBy('appointment_date', 'asc')
                ->orderBy('appointment_time', 'asc')
                ->get();

            return response()->json($appointments);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

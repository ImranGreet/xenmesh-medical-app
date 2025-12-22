<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\HMS\DoctorScheduleResource;
use App\Models\HMS\Doctor;
use App\Models\HMS\Schedule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorScheduleController extends Controller
{
    public function retrieveSchedules()
    {
        try {
            $doctors = Doctor::with([ 
                'doctorDetails:id,name',
                'schedules' => function ($q) {
                    $q->where('status', true);
                }
            ])->whereHas('schedules')->get();

            return response()->json([
                'success' => true,
                'data' => DoctorScheduleResource::collection($doctors),
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve schedules',
            ], 500);
        }
    }

    public function retrieveDoctorScheduleByID($doctorId)
    {
        try {
            $schedules = Schedule::where('doctor_id', $doctorId)->get();

            if ($schedules->isEmpty()) {
                return response()->json([
                    'message' => 'No schedule found for this doctor',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'message' => 'Doctor schedules retrieved successfully',
                'data' => $schedules
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createSchedulesByID(Request $request, $doctorId)
    {
        foreach ($request->schedules as $daySchedule) {
            foreach ($daySchedule['slots'] as $slot) {
                Schedule::create([
                    'doctor_id' => $doctorId,
                    'day'        => $daySchedule['day'],
                    'from_time'  => $slot['from_time'],
                    'to_time'    => $slot['to_time'],
                    'is_active'  => true
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Schedules created successfully',
        ], 201);
    }

    public function updateSchedulesByID(Request $request, $doctorId)
    {
        foreach ($request->schedules as $daySchedule) {
            foreach ($daySchedule['slots'] as $slot) {
                Schedule::updateOrCreate(
                    [
                        'doctor_id' => $doctorId,
                        'day'       => $daySchedule['day'],
                        'from_time' => $slot['from_time'],
                        'to_time'   => $slot['to_time'],
                    ],
                    [
                        'is_active' => true
                    ]
                );
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Schedules updated successfully',
        ], 200);
    }

    public function updateScheduleSlotStatus($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        $schedule->update([
            'is_active' => !$schedule->is_active
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Schedule slot status updated',
            'slot' => $schedule,
        ]);
    }

    public function getDoctorSlotsForAppointment($doctorId, $day)
    {
        $slots = Schedule::where('doctor_id', $doctorId)
            ->where('day', $day)
            ->where('is_active', true)
            ->get();

        return response()->json([
            'success' => true,
            'slots' => $slots
        ]);
    }
}

<?php

namespace App\Repositories;

use App\Models\HMS\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppoinmentRepository
{

    public function retrieveAppoinment(Request $request)
    {
        $appoinment = Appointment::paginate($request->get('per_page', 20));
        return $appoinment;
    }

    public function retrieveAppoinmentsByDoctor($doctor_id)
    {

        $appoinments = Appointment::with(['doctor', 'patient', 'addedBy'])->where("appointed_doctor_id", $doctor_id)->get();
        return $appoinments;
    }

    public function filterAppoinments(Request $request)
    {
        // Build the query first
        $query = Appointment::with(['patient', 'doctor.doctorDetails', 'addedBy']);

        // Apply filters conditionally
        if ($request->filled('doctor_id')) {

            $query->where('appointed_doctor_id', $request->doctor_id);
        }

        if ($request->filled('status')) {
            $statuses = explode(',', $request->status);
            $query->whereIn('status', $statuses);
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if ($request->filled('room_number')) {
            $query->where('room_number', $request->room_number);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('appointment_date', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('date')) {
            $query->where('appointment_date', $request->date);
        }

        if ($request->filled('creatorId')) {
            $query->where('added_by_id', $request->creatorId);
        }

        if ($request->filled('days')) {
            $days = (int) $request->days;
            $query->whereBetween('appointment_date', [
                Carbon::now()->toDateString(),
                Carbon::now()->addDays($days)->toDateString(),
            ]);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('patient_id', $search)
                    ->orWhere('reason', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('patient', function ($q2) use ($search) {
                        $q2->where('patient_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('doctor.doctorDetails', function ($q3) use ($search) {
                        $q3->where('name', 'like', "%{$search}%");
                    });
            });
        }







        // Execute query with sorting
        $appointments = $query
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->get();


        return $appointments;
    }
}

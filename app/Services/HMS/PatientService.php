<?php

namespace App\Services\HMS;

use App\Models\HMS\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PatientService
{

    public function getAllPatients($perPage)
    {
        return Patient::query()->with(['createdBy'])->paginate($perPage);
    }

    public function viewPatientInfo($id)
    {
        return Patient::findOrFail($id);
    }

    public function viewPatientAppointmentsInfo($id)
    {
        $patient = Patient::with('appointments.doctor.doctorDetails')->findOrFail($id);
        return $patient->appointments;
    }

    public function getPatientAppointedDoctors($id)
    {
        $patient = Patient::with('doctors.doctorDetails')->findOrFail($id);
        return $patient->doctors;
    }

    public function viewPatientPrescriptionsInfo($id)
    {
        $patient = Patient::with('prescriptions.prescribedMedicines')->findOrFail($id);
        return $patient->prescriptions;
    }

    public function filterPatients(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $query = Patient::query()
            ->with(['appointments', 'doctors', 'prescriptions', 'bills', 'createdBy']);

        if ($request->filled('patient_id')) {
            $query->where('generated_patient_id', $request->patient_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('patient_name')) {
            $query->where('patient_name', 'LIKE', "%{$request->patient_name}%");
        }

        if ($request->filled('creator_id')) {
            $query->where('added_by_id', $request->creator_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('days')) {
            $days = (int) $request->days;
            $query->whereBetween('created_at', [
                now()->startOfDay(),
                now()->addDays($days)->endOfDay(),
            ]);
        }

        if ($request->filled('is_admitted')) {
            $query->where('is_admitted', $request->is_admitted);
        }

        // Final execution
        return $query->paginate($perPage);
    }
}

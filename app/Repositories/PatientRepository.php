<?php

namespace App\Repositories;

use App\Models\HMS\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientRepository
{

    public function filterPatients(Request $request)
    {

        $query = Patient::query()->with(['appointments', 'bills', 'createdBy']);

        if ($request->filled('patient_id')) {
            $query->where('generated_patient_id', $request->patient_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        if ($request->filled('patient_name')) {
            $query->where('patient_name', 'LIKE', "%{$request->patient_name}%");
        }

        if ($request->filled('created_by')) {
            $creatorId = (int) $request->created_by;
            $query->where('added_by_id', $creatorId);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        if ($request->filled('days')) {
            $days = (int) $request->days;

            $query->whereBetween('created_at', [
                now()->subDays($days)->startOfDay(),
                now()->endOfDay(),
            ]);
        }


        if ($request->filled('is_admitted')) {
            $query->where('is_admitted', $request->is_admitted);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('generated_patient_id', 'like', "%{$search}%")
                    ->orWhere('patient_name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        return $query;
    }
}

<?php

namespace App\Services\HMS;

use App\Models\HMS\Doctor;

class DoctorService
{
    public function getAllDoctors()
    {
        return Doctor::all();
    }

    public function viewDoctorInfo($id)
    {
        return Doctor::find($id);
    }

    public function createDoctor(array $data)
    {
        return Doctor::create([

            'doctor_id' => (int) $data['doctor_id'],
            'department_id' => (int) $data['department_id'],
            'specialization' => $data['specialization'] ?? null,
            'qualification' => $data['qualification'] ?? null,
            'description' => $data['description'] ?? null,
            'experience_years' => $data['experience_years'] ?? null,
            'gender' => $data['gender'],
            'address' => $data['address'] ?? null,

            'hospital_id' => (int) $data['hospital_id'],
            'added_by_id' => (int) $data['added_by_id'],
            'is_active' => $data['is_active'] ?? true,
        ]);
    }
}

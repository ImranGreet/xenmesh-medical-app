<?php

namespace App\Repositories;

use App\Models\HMS\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorRepository
{
    public function retrieveDoctors(Request $request)
    {
        $query = User::with(['doctorProfile.department' => function ($q) {
            $q->select('id', 'department_name');
        }])
            ->where('role', 'doctor')
            ->select('id', 'name', 'email', 'username');

        $doctorList = $query->paginate($request->get('per_page', 10));

        $data = $doctorList->getCollection()->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'email' => $doctor->email,
                'username' => $doctor->username,
                'profile' => $doctor->doctorProfile ? [
                    'gender' => $doctor->doctorProfile->gender,
                    'address' => $doctor->doctorProfile->address,
                    'description' => $doctor->doctorProfile->description,
                    'specialization' => $doctor->doctorProfile->specialization,
                    'qualification' => $doctor->doctorProfile->qualification,
                    'experience_years' => $doctor->doctorProfile->experience_years,
                    'hospital_id' => $doctor->doctorProfile->hospital_id,
                    'is_active' => $doctor->doctorProfile->is_active,
                    'department' => $doctor->doctorProfile->department->department_name ?? null,
                ] : null,
            ];
        });

        // 🔹 Return both pagination and mapped data
        return [
            'pagination' => [
                'current_page' => $doctorList->currentPage(),
                'per_page' => $doctorList->perPage(),
                'total' => $doctorList->total(),
                'last_page' => $doctorList->lastPage(),
            ],
            'data' => $data,
        ];
    }


    public function createDoctor($data){ 
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

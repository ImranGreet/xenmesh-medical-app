<?php

namespace App\Repositories;

use App\Models\HMS\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function retrieveDoctorById(Request $request, $department_id)
    {
        try {
            $query = Doctor::with(['department', 'doctorDetails'])
                ->where('department_id', $department_id)
                ->whereHas('doctorDetails', function ($query) {
                    $query->where('role', 'doctor');
                });



            $doctorlist  = $query->paginate($request->get('per_page', 10));

            if ($doctorlist->total() === 0) {
                return [
                    "success" => false,
                    "message" => "No doctors found in the specified department",
                ];
            }


            $data = $doctorlist->getCollection()->map(function ($doctor) {
                return [
                    "id" => $doctor->id,
                    "name" => $doctor->doctorDetails ? $doctor->doctorDetails->name : null,
                    "email" => $doctor->doctorDetails ? $doctor->doctorDetails->email : null,
                    "department" => $doctor->department ? $doctor->department->department_name : null,
                ];
            });

            return [
                "success" => true,
                "message" => "Retrieve Doctor List By Department !",
                "current_page" => $doctorlist->currentPage(),
                'per_page' => $doctorlist->perPage(),
                "total" => $doctorlist->total(),
                "last_page" => $doctorlist->lastPage(),
                "doctorlist" => $data,

            ];
        } catch (Exception $e) {
            Log::error("" . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong while retrieving the doctor list",
            ], 500);
        }
    }


    public function createDoctor($data)
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
            'appointment_fees' => $data['appointment_fees'] ?? null,
            'hospital_id' => (int) $data['hospital_id'],
            'added_by_id' => (int) $data['added_by_id'],
            'is_active' => $data['is_active'] ?? true,
        ]);
    }
}

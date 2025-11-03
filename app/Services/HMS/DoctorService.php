<?php

namespace App\Services\HMS;

use App\Models\HMS\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorService
{
    public function getAllDoctors(Request $request)
    {
        
        try {
            $query = User::with(['doctorProfile' => function ($q) {
                $q->select(
                    'id',
                    'doctor_id',
                    'department_id',
                    'gender',
                    'address',
                    'description',
                    'specialization',
                    'qualification',
                    'experience_years',
                    'hospital_id',
                    'is_active'
                );
            }])->where('role', 'doctor')->select('id', 'name', 'email', 'username');


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
                        'department' => $doctor->doctorProfile->department ? $doctor->doctorProfile->department->department_name : null,
                    ] : null,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Doctors retrieved successfully.',
                'doctorList' => [
                    'current_page' => $doctorList->currentPage(),
                    'per_page' => $doctorList->perPage(),
                    'total' => $doctorList->total(),
                    'last_page' => $doctorList->lastPage(),
                    'data' => $data,
                ],
            ]);
        } catch (Exception $e) { 
            Log::error('Error fetching doctor list: ' . $e->getMessage()); 

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while retrieving the doctor list.',
                'error' => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
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

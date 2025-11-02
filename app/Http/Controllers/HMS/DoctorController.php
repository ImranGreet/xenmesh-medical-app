<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Department;
use App\Models\HMS\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function getDoctorList(Request $request)
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
                    'department' => $doctor->doctorProfile->department?$doctor->doctorProfile->department->department_name:null,
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



    public function retriveDoctorListByDepartment( Request $request, $department_id)
    {
        
        try {
            $query = Doctor::with(['department', 'doctorDetails'])
                ->where('department_id', $department_id)->whereHas('doctorDetails', function ($query) {
                    $query->where('role', 'doctor');
                });

                

              $doctorlist  = $query->paginate($request->get('per_page', 10));

              if ($doctorlist->total() === 0) {
                return response()->json([
                    "success" => false,
                    "message" => "No doctors found in the specified department",
                ], 404);
            }


              $data = $doctorlist->getCollection()->map(function ($doctor){
                  return [
                    "id"=> $doctor->id,
                    "name"=> $doctor->doctorDetails?$doctor->doctorDetails->name:null,
                    "email" => $doctor->doctorDetails?$doctor->doctorDetails->email:null,
                    "department"=> $doctor->department?$doctor->department->department_name:null,
                  ];
              });

            

            return response()->json([
                "success" => true,
                "message" => "Retrieve Doctor List By Department Success",
                "current_page"=>$doctorlist->currentPage(),
                'per_page' => $doctorlist->perPage(),
                "total"=> $doctorlist->total(),
                "last_page"=>$doctorlist->lastPage(),
                "doctorlist" => $data,

            ]);
        } catch (Exception $e) {
            Log::error("" . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong while retrieving the doctor list",
            ], 500);
        }
    }

    public function addNewDoctor(Request $request)
    {
        
        try {

            $validated = $request->validate([
            'doctor_id' =>'required|exists:users,id',
            'department_id' =>'required|exists:departments,id',
            'specialization' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'gender' => 'required|string',
            'address' => 'nullable|string|max:255',

            'hospital_id' => 'required|exists:hospital_infos,id',
            'added_by_id' => 'required|exists:users,id',
            'is_active' => 'nullable|boolean',
        ]);


            $doctor = Doctor::create([
                'doctor_id' =>(int) $validated['doctor_id'],
                'department_id' =>(int) $validated['department_id'],
                'specialization' => $validated['specialization'] ?? null,
                'qualification' => $validated['qualification'] ?? null,
                'experience_years' => $validated['experience_years'] ?? null,
                'gender' => $validated['gender'],
                'address' => $validated['address'] ?? null,

                'hospital_id' => (int) $validated['hospital_id'],
                'added_by_id' => (int) $validated['added_by_id'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Doctor added successfully.',
                'data' => $doctor
            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Failed to add doctor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update doctor information
     */
    public function updateDoctor(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'status' => false,
                'message' => 'Doctor not found.'
            ], 404);
        }

        $validated = $request->validate([
            'doctor_name' => 'nullable|string|max:100',
            'email' => "nullable|email|unique:doctors,email,$id",
            'phone_number' => "nullable|string|max:15|unique:doctors,phone_number,$id",
            'specialization' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'gender' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string|max:255',
            'hospital_id' => 'nullable|exists:hospital_infos,id',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $doctor->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Doctor updated successfully.',
                'data' => $doctor
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update doctor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Delete a doctor
     */
    public function deleteDoctor($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'status' => false,
                'message' => 'Doctor not found.'
            ], 404);
        }

        try {
            $doctor->delete();
            return response()->json([
                'status' => true,
                'message' => 'Doctor deleted successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete doctor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

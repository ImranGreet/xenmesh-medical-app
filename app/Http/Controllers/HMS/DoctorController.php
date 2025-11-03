<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\HMS\StoreDoctorInfo;
use App\Models\HMS\Doctor;
use App\Services\HMS\DoctorService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{

    protected $doctorService;
    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }
    public function getDoctorList(Request $request)
    {
        return $this->doctorService->getAllDoctors($request);
    }



    public function retriveDoctorListByDepartment(Request $request, $department_id)
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


            $data = $doctorlist->getCollection()->map(function ($doctor) {
                return [
                    "id" => $doctor->id,
                    "name" => $doctor->doctorDetails ? $doctor->doctorDetails->name : null,
                    "email" => $doctor->doctorDetails ? $doctor->doctorDetails->email : null,
                    "department" => $doctor->department ? $doctor->department->department_name : null,
                ];
            });



            return response()->json([
                "success" => true,
                "message" => "Retrieve Doctor List By Department Success",
                "current_page" => $doctorlist->currentPage(),
                'per_page' => $doctorlist->perPage(),
                "total" => $doctorlist->total(),
                "last_page" => $doctorlist->lastPage(),
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

    public function addNewDoctor(StoreDoctorInfo $request)
    {

        try {

            $validated = $request->validated();

            $doctor = $this->doctorService->createDoctor($validated);

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

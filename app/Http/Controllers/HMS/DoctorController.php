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
        $result = $this->doctorService->getAllDoctors($request);
        return response()->json($result);
    }



    public function retriveDoctorListByDepartment(Request $request, $department_id)
    {
        $result = $this->doctorService->retrieveDoctorListByDepartment($request, $department_id);
        return response()->json($result);
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
                'message' => 'Doctor not found !'
            ], 404);
        }

        $validated = $request->validate([
            'specialization' => 'nullable|string|max:100',
            'description'    => 'nullable|string|max:250',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string|max:255',
            'hospital_id' => 'nullable|exists:hospital_infos,id',
            'is_active' => 'nullable|integer',
            'department_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'added_by_id' => 'required|integer',
        ]);

        try {
            $doctor->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Doctor updated successfully.',
                'data' => $doctor->fresh(),
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
                'message' => 'Doctor not found !'
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

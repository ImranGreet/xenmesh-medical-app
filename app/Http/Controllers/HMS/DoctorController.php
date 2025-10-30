<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getDoctorList(Request $request)
    {
        $doctorlist = Doctor::all();

        return response()->json([
            "meesage" => "Success",
            "doctorlist" => $doctorlist,
        ]);
    }

    public function retriveDoctorListByDepartment(Request $request, $department_id)
    {
        $doctorlist = Doctor::with('department')
            ->where('department_id', $department_id)
            ->get();

            if ($doctorlist->isEmpty()) {
                return response()->json([
                    "success" => false,
                    "message" => "No doctors found in the specified department",
                ], 404);
            }
            
        return response()->json([
            "success" => true,
            "message" => "Retrieve Doctor List By Department Success",
            "doctorlist" => $doctorlist,
        ]);
    }

    public function addNewDoctor(Request $request)
    {
        $validated = $request->validate([
            'doctor_name' => 'required|string|max:100',
            'email' => 'required|email|unique:doctors,email',
            'phone_number' => 'required|string|max:15|unique:doctors,phone_number',
            'specialization' => 'required|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'nullable|string|max:255',
            'hospital_id' => 'required|exists:hospital_infos,id',
            'added_by' => 'required|exists:users,id',
            'is_active' => 'nullable|boolean',
        ]);

        try {

            $doctor = Doctor::create([
                'doctor_name' => $validated['doctor_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'specialization' => $validated['specialization'],
                'qualification' => $validated['qualification'] ?? null,
                'experience_years' => $validated['experience_years'] ?? null,
                'gender' => $validated['gender'],
                'address' => $validated['address'] ?? null,
                'hospital_id' => $validated['hospital_id'],
                'added_by' => $validated['added_by'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Doctor added successfully.',
                'data' => $doctor
            ], 201);
        } catch (\Exception $e) {

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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete doctor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}

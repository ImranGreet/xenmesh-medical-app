<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\HospitalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HospitalInfoController extends Controller
{
    public function getHospitalInfo(Request $request)
    {
        $hospital = HospitalInfo::all();

        if (!$hospital) {
            return response()->json([
                "status" => "error",
                "message" => "Hospital Management haven't set any information yet!"
            ]);
        }
        return response()->json([
            "status" => "success",
            "message" => "Information found properly!",
            "data"=> $hospital
        ]);
    }


   public function insertHospitalInfo(Request $request)
    {
        // 1. Validation
        // Using Validator::make to handle validation errors and return a custom API response
        $validator = Validator::make($request->all(), [
            'hospital_name' => 'required|string|max:100',
            'code' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:250',
            'city' => 'nullable|string|max:25',
            'state' => 'nullable|string|max:250',
            'country' => 'nullable|string|max:25',
            'postal_code' => 'nullable|string|max:25', 
            'phone_number' => 'required|string',
            'email' => 'nullable|string|max:25|email',
            'website' => 'nullable|string',
            'established_year' => 'nullable|string',
            'number_of_beds' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'added_by' => 'required|integer|exists:users,id',
        ]);

        

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
        
        $validatedData = $validator->validated();
    

       
        try {
            // create hospital Info, passing all validated data
            $hospital = HospitalInfo::create($validatedData);

            // 3. Success API Response
            return response()->json([
                'success' => true,
                'message' => 'Hospital information created successfully.',
                'data' => $hospital
            ], 201); // 201 Created

        } catch (\Exception $e) {
            // 4. Error API Response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the hospital record.',
                'error_details' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    public function editHospitalInfo(Request $request, $hospitalInfoId)
    {
        $hospital = HospitalInfo::find($hospitalInfoId);
        if (!$hospital) {
            return response()->json([
                "status" => "error",
                "message" => ""
            ]);
        }
        return response()->json([
            "status" => "success",
            "message" => "Hospital Information found"
        ]);
    }
    public function updateHospitalInfo(Request $request, $hospitalInfoId)
    {
        $hospital = HospitalInfo::find($hospitalInfoId);

        if (!$hospital) {
            return response()->json([
                "status" => "error",
                "message" => "",
            ]);
        }
        $hospital->update($request->all());
        return response()->json([
            "status" => "success",
            "message" => "",
        ]);
    }
}

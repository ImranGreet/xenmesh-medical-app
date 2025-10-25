<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showAllBills()
    {
        $bills = 0;

        try {
            $primaryBills = Bill::with('patient')->get();

            if ($primaryBills->isEmpty()) {
                return response()->json([
                    'message' => 'No bills found',
                    'success' => true,
                    'data' => [],
                ], 200);
            }
            
            $bills = $primaryBills->toArray();

            return response()->json([
                'message' => 'Bills retrieved successfully',
                'success' => true,
                'data' => $bills,
            ], 200);
        } catch (\Throwable $th) {
              return response()->json([
                    'message' => 'Failed to retrieve bills',
                    'success' => false,
                    'error' => $th->getMessage(),
                ], 500);   
        }
    }


    public function showBillByPatientId($patientId)
    {
        $bills = Bill::where('patient_id', $patientId)->with('patientDetails')->with('labtestFees')->get();

        if ($bills->isEmpty()) {

            return response()->json([
                'message' => 'No bills found for the specified patient',
                'success' => true,
                'data' => [],
            ], 200);

        }

        return response()->json([
            'message' => 'Bills retrieved successfully',
            'success' => true,
            'data' => $bills,
        ], 200);
    }


}

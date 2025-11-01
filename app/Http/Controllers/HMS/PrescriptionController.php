<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function getAllPrescriptions()
    {
        $prescriptions = Prescription::with(['patient','doctor','prescribedMedicines'])->get();
        
        return response()->json($prescriptions);
    }
    public function getPrescriptionById($id)
    {
        $prescription = Prescription::with(['patient','doctor','prescribedMedicines'])->find($id);

        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }
        return response()->json($prescription);
    }

    public function getPrescriptionsByPatientId($patientId)
    {
        $prescriptions = Prescription::with(['patient','doctor','prescribedMedicines'])
            ->where('patient_id', $patientId)
            ->get();

        return response()->json($prescriptions);
    }
    public function getPrescriptionsByDoctorId($doctorId)
    {
        $prescriptions = Prescription::with(['patient','doctor','prescribedMedicines'])
            ->where('doctor_id', $doctorId)
            ->get();

        return response()->json($prescriptions);
    }


     public function filterPrescriptions(Request $request)
    {
        $query = Prescription::with(['patient', 'doctor', 'prescribedMedicines']);

        
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        
        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

    
        if ($request->filled('urgency')) {
            $query->where('urgency', $request->urgency);
        }

        
        $prescriptions = $query->orderBy('created_at', 'desc')->get();

        if($prescriptions->isEmpty()){
            return response()->json([
                "succes"=>false,
                "message"=>"No prescription is found !",
                "prescriptions"=>null
            ]);
        }

        return response()->json([
            'success' => true,
            'count' => $prescriptions->count(),
            'prescriptions' => $prescriptions,
        ]);
    }


    public function generatePrescription(Request $request)
    {

       $validated = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'doctor_id' => 'required|exists:doctors,id',
        'diagnosis' => 'nullable|string',
        'notes' => 'nullable|string',
        'prescription_date' => 'nullable|date',
       ]);
       

    }


}

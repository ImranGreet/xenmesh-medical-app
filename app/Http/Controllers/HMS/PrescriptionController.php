<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\PrescribedMedicine;
use App\Models\HMS\Prescription;
use Exception;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function getAllPrescriptions()
    {
        $prescriptions = Prescription::with(['patient', 'doctor', 'prescribedMedicines'])->get();

        return response()->json($prescriptions);
    }
    public function getPrescriptionById($id)
    {
        $prescription = Prescription::with(['patient', 'doctor', 'prescribedMedicines'])->find($id);

        if (!$prescription) {
            return response()->json(['message' => 'Prescription not found'], 404);
        }
        return response()->json($prescription);
    }

    public function getPrescriptionsByPatientId($patientId)
    {
        $prescriptions = Prescription::with(['patient', 'doctor', 'prescribedMedicines'])
            ->where('patient_id', $patientId)
            ->get();

        return response()->json($prescriptions);
    }
    public function getPrescriptionsByDoctorId($doctorId)
    {
        $prescriptions = Prescription::with(['patient', 'doctor', 'prescribedMedicines'])
            ->where('doctor_id', $doctorId)
            ->get();

        return response()->json($prescriptions);
    }


    public function filterPrescriptions(Request $request)
    {
        try {
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

            if ($prescriptions->isEmpty()) {

                return response()->json([
                    "succes" => false,
                    "message" => "No prescription is found !",
                    "prescriptions" => null
                ]);
            }

            return response()->json([
                'success' => true,
                'count' => $prescriptions->count(),
                'prescriptions' => $prescriptions,
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function generatePrescription(Request $request)
    {

        // 🩺 Step 1: Validate prescription (main data)
        $prescriptionData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'nullable|string',
            'notes' => 'nullable|string',
            'prescription_date' => 'nullable|date',
        ]);

        // 💊 Step 2: Validate prescribed medicines separately
        $medicineData = $request->validate([
            'prescribed_medicines' => 'required|array',
            'prescribed_medicines.*.medicine_name' => 'required|string',
            'prescribed_medicines.*.form' => 'nullable|string',
            'prescribed_medicines.*.strength' => 'nullable|string',
            'prescribed_medicines.*.dosage' => 'nullable|string',
            'prescribed_medicines.*.frequency' => 'nullable|string',
            'prescribed_medicines.*.duration' => 'nullable|string',
            'prescribed_medicines.*.instructions' => 'nullable|string',
        ]);

        // ✅ Step 3: Create prescription record
        $prescription = Prescription::create([
            'patient_id' => $prescriptionData['patient_id'],
            'doctor_id' => $prescriptionData['doctor_id'],
            'diagnosis' => $prescriptionData['diagnosis'] ?? null,
            'notes' => $prescriptionData['notes'] ?? null,
            'prescription_date' => $prescriptionData['prescription_date'] ?? now(),
        ]);

        foreach ($medicineData['prescribed_medicines'] as $medicine) {
            PrescribedMedicine::create([
                'prescription_id' => $prescription->id,
                'medicine_name' => $medicine['medicine_name'],
                'form' => $medicine['form'] ?? null,
                'strength' => $medicine['strength'] ?? null,
                'dosage' => $medicine['dosage'] ?? null,
                'frequency' => $medicine['frequency'] ?? null,
                'duration' => $medicine['duration'] ?? null,
                'instructions' => $medicine['instructions'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'prescription' => $prescription,
            'prescribedMedicines' => PrescribedMedicine::where('prescription_id', $prescription->id)->first(),
        ]);
    }
}

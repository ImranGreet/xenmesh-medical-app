<?php

namespace App\Services\HMS;

use App\Models\HMS\Bill;
use App\Models\HMS\Patient;

class BillService
{
    public function viewPatientBillsDetails($patientId)
    {
        return Bill::with('labtestFees')->where('patient_id', $patientId)->get();
    }
}
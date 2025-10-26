<?php

namespace App\Services\HMS;

use App\Models\HMS\Patient;

class PatientService
{

    public function getAllPatients()
    {
        return Patient::all();
    }

    public function viewPatientInfo($id)
    {
        return Patient::find($id);
    }
}

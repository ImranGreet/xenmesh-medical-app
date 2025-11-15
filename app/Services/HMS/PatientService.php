<?php

namespace App\Services\HMS;

use App\Models\HMS\Patient;

class PatientService
{

    public function getAllPatients($perPage)
    {
        return Patient::paginate($perPage);
    }

    public function viewPatientInfo($id)
    {
        return Patient::findOrFail($id);
    }

    public function viewPatientAppointmentsInfo($id)
    {
        $patient = Patient::with('appointments.doctor.doctorDetails')->findOrFail($id);
        return $patient->appointments;
    }

    public function getPatientAppointedDoctors($id){
        $patient = Patient::with('doctors.doctorDetails')->findOrFail($id);
        return $patient->doctors;
    }

    public function viewPatientPrescriptionsInfo($id)
    {
        $patient = Patient::with('prescriptions.prescribedMedicines')->findOrFail($id);
        return $patient->prescriptions;
    }
    
}

<?php

namespace App\Services\HMS;

use App\Models\HMS\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\PatientRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class PatientService
{
    protected $patientsRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientsRepository = $patientRepository;
    }

    public function getAllPatients($perPage)
    {
        return Patient::query()->with(['createdBy'])->paginate($perPage);
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

    public function getPatientAppointedDoctors($id)
    {
        $patient = Patient::with('doctors.doctorDetails')->findOrFail($id);
        return $patient->doctors;
    }

    public function viewPatientPrescriptionsInfo($id)
    {
        $patient = Patient::with('prescriptions.prescribedMedicines')->findOrFail($id);
        return $patient->prescriptions;
    }

    public function filterPatients(Request $request)
    {

        try {
            $patientQuery = $this->patientsRepository->filterPatients($request);

            $perPage = $request->query('per_page', 10);
            $patientList = $patientQuery->paginate($perPage);

            return $patientList;
        } catch (Exception $e) {
            Log::error('Error filtering patients: ' . $e->getMessage());
            throw $e;
        }
    }
}

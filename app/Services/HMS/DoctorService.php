<?php

namespace App\Services\HMS;
use App\Repositories\DoctorRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorService
{
    protected $doctorRepository;
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }
    public function getAllDoctors(Request $request)
    {

        try {
            $result = $this->doctorRepository->retrieveDoctors($request);

            return [
                'success' => true,
                'message' => 'Doctors retrieved successfully.',
                'pagination' => $result['pagination'],
                'data' => $result['data'],
            ];
        } catch (Exception $e) {
            Log::error('Error fetching doctor list: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Something went wrong while retrieving the doctor list.',
                'error' => app()->environment('local') ? $e->getMessage() : null,
            ];
        }
    }

    public function retrieveDoctorListByDepartment(Request $request,$id)
    {
        $doctorProfile = $this->doctorRepository->retrieveDoctorById($request,$id);
        return $doctorProfile;
    }

    public function createDoctor(array $data)
    {
        try {
            return $this->doctorRepository->createDoctor($data);
            
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => '',
            ]);
        }
    }
}

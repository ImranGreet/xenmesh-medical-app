<?php

namespace App\Services\HMS;

use App\Repositories\AppoinmentRepository;
use Illuminate\Http\Request;

class AppoinmentService
{

    protected $appoinmentRepository;
    public function __construct(AppoinmentRepository $appoinmentRepository)
    {

        $this->appoinmentRepository = $appoinmentRepository;
    }

    public function retrieveAllAppoinment(Request $request)
    {
        return $this->appoinmentRepository->retrieveAppoinment($request);
    }

    public function retrieveAppoinmentsByDoctorId($doctorId)
    {

        $results = $this->appoinmentRepository->retrieveAppoinmentsByDoctor($doctorId);

        if ($results->count() > 0) {

            return $results;
        } else {
            return "The doctor has no appoinments yet !";
        }
    }

    public function filterAppoinment(Request $request)
    {
        $appoinments = $this->appoinmentRepository->filterAppoinments($request);
        
        if ($appoinments->count() > 0) {

            return response()->json([
                'success' => true,
                'data' => $appoinments,

            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Appoinments Found!',
            ]);
        }
    }
}

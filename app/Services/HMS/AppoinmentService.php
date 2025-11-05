<?php

namespace App\Services\HMS;

use App\Repositories\AppoinmentRepository;

class AppoinmentService
{

    protected $appoinmentRepository;
    public function __construct(AppoinmentRepository $appoinmentRepository)
    {

        $this->appoinmentRepository = $appoinmentRepository;
    }

    public function retrieveAllAppoinment(){
      return $this->appoinmentRepository->retrieveAppoinment();
    }

    public function retrieveAppoinmentsByDoctorId($doctorId){

       $results = $this->appoinmentRepository->retrieveAppoinmentsByDoctor($doctorId);

       if($results->count() > 0){

        return $results;

       }else{
           return "The doctor has no appoinments yet !";
       }
    }
}

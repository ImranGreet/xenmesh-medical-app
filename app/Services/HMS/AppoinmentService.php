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
       $this->appoinmentRepository->retrieveAppoinment();
    }
}

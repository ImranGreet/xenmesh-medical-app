<?php 
namespace App\Repositories;

use App\Models\HMS\Appointment;

class AppoinmentRepository {

    public function retrieveAppoinment(){
         $appoinment = Appointment::all();
         return $appoinment;
    }

}
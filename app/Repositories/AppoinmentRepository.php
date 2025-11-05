<?php 
namespace App\Repositories;

use App\Models\HMS\Appointment;

class AppoinmentRepository {

    public function retrieveAppoinment(){
         $appoinment = Appointment::all();
         return $appoinment;
    }

    public function retrieveAppoinmentsByDoctor($doctor_id){

        $appoinments = Appointment::with(['doctor','patient','addedBy'])->where("appointed_doctor_id", $doctor_id)->get();
        return $appoinments;
    }

}
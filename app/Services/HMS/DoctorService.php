<?php

namespace App\Services\HMS;

use App\Models\HMS\Doctor;

class DoctorService
{
    public function getAllDoctors()
    {
        return Doctor::all();
    }

    public function viewDoctorInfo($id)
    {
        return Doctor::find($id);
    }
}

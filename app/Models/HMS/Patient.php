<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'age',
        'sex',
        'date_of_birth',
        'blood_group',
        'phone_number',
        'email',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'allergies',
        'chronic_diseases',
        'hospital_id',
        'appointed_doctor_id',
        'added_by_id'
    ];
}

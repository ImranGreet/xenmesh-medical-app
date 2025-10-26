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
        'is_admitted',
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



    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }



    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class, Appointment::class, 'patient_id', 'id', 'id', 'appointed_doctor_id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    
}

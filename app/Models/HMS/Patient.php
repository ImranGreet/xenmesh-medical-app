<?php

namespace App\Models\HMS;

use App\Models\User;
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
        'keep_records',
        'phone_number',
        'email',
        'address',
        'emergency_contact_phone',
        'allergies',
        'chronic_diseases',
        'hospital_id',
        'added_by_id',
        'generated_patient_id'
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }
}

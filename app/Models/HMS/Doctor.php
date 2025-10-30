<?php

namespace App\Models\HMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'doctor_name',
        'email',
        'phone_number',
        'specialization',
        'qualification',
        'experience_years',
        'gender',
        'address',
        'hospital_id',
        'added_by',
        'is_active',
        'department_id',
    ];




    public function patients()
    {
        return $this->hasManyThrough(Patient::class, Appointment::class, 'appointed_doctor_id', 'id', 'id', 'patient_id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'appointed_doctor_id');
    }


    public function doctorDetails()
    {
        return $this->hasOne(User::class, 'id', 'doctor_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}

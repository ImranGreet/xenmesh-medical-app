<?php

namespace App\Models\HMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'specialization',
        'description',
        'qualification',
        'experience_years',
        'gender',
        'address',
        'hospital_id',
        'added_by_id',
        'is_active',
        'department_id',
        'doctor_id',
        'appointment_fees'
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

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}

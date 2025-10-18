<?php

namespace App\Models\HMS;

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
    ];
}

<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\DoctorSpecializationFactory> */
    use HasFactory;

    protected $fillable = [
        'department_name',
        'description',
        'hospital_id',
        'is_active'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdmission extends Model
{
    /** @use HasFactory<\Database\Factories\PatientAdmissionFactory> */
    use HasFactory;

      protected $fillable = [
        'patient_id',
        'hospital_id',
        'admitted_by_doctor_id',
        'room_id',
        'added_by',
        'admission_id',
        'bed_number',
        'symptoms',
        'diagnosis',
        'admission_notes',
        'admission_date',
        'discharge_date',
        'expected_discharge_date',
        'status',
        'is_active'
    ];
}

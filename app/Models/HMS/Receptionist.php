<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\ReceptionistFactory> */
    use HasFactory;

    protected $fillable = [
        'age',
        'sex',
        'date_of_birth',
        'blood_group',
        'email',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'allergies',
        'chronic_diseases',
        'hospital_id',
        'added_by'
    ];
}

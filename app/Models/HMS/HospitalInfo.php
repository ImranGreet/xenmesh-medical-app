<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalInfo extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\HospitalInfoFactory> */
    use HasFactory;

    protected $fillable = [
        'hospital_name',
        'code',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone_number',
        'email',
        'website',
        'established_year',
        'number_of_beds',
        'description',
        'is_active',
        'added_by_id',
    ];
}

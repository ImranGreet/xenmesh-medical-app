<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\CabinFactory> */
    use HasFactory;

    protected $fillable = [
        'cabin_number',
        'type',
        'floor_number',
        'bed_count',
        'price_per_day',
        'is_occupied',
        'patient_id',
        'notes',
    ];
}

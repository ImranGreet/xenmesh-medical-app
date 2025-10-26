<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescribedMedicine extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\PrescribedMedicineFactory> */
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'medicine_name',
        'form',
        'strength',
        'dosage',
        'frequency',
        'duration',
        'instructions',
    ];
}

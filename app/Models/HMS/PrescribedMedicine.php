<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescribedMedicine extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\PrescribedMedicineFactory> */
    use HasFactory;

    protected $fillable = [
        'medicine_name',
        'price',
    ];
}

<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillMedicine extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\BillMedicineFactory> */
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'prescribed_medicine_id',
        'quantity',
    ];
}

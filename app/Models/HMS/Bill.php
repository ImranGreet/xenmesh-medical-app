<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\BillFactory> */
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'consultation_fee',
        'room_charges',
        'total',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }
}

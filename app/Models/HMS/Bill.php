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
    public function patientDetails()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function labtestFees()
    {
        return $this->belongsToMany(LabTest::class, 'bill_tests', 'bill_id', 'lab_test_id')->withTimestamps();
    }

    public function otherFees()
    {
        // Define relationship for other fees if applicable
    }
}

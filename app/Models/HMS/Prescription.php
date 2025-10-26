<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\PrescriptionFactory> */
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'prescription_date',
        'diagnosis',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function prescribedMedicines()
    {
        return $this->hasMany(PrescribedMedicine::class);
    }

}

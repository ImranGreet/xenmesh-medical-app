<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\AppointmentFactory> */
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'added_by',
        'appointment_date',
        'appointment_time',
        'status',
        'room_number',
        'reason',
        'notes',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'appointed_doctor_id');
    }
}

<?php

namespace App\Models\HMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\ReferralFactory> */
    use HasFactory;

        protected $fillable = [
        'patient_id',
        'from_doctor_id',
        'to_doctor_id',
        'department_id',
        'reason',
        'urgency',
        'status',
        'appointment_id',
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function fromDoctor() {
        return $this->belongsTo(User::class, 'from_doctor_id');
    }

    public function toDoctor() {
        return $this->belongsTo(User::class, 'to_doctor_id');
    }

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }  
}

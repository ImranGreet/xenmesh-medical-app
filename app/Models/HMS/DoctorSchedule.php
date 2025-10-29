<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\DoctorScheduleFactory> */
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'schedule_date',
        'start_time',
        'end_time',
        'session_label',
        'remarks',
    ];
}

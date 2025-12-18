<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\ScheduleFactory> */
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'day',
        'from_time',
        'to_time'
    ];
    public function doctorSchedules()
    {
        return $this->belongsTo(Doctor::class);
    }
}

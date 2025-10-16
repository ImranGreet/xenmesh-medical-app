<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\RoomFactory> */
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'added_by',
        'room_number',
        'room_type',
        'floor',
        'wing',
        'total_beds',
        'available_beds',
        'price_per_day',
        'facilities',
        'description',
        'is_available',
        'is_active'
    ];
}

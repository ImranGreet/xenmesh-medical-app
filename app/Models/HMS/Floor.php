<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\FloorFactory> */
    use HasFactory;

    protected $fillable = [
        'floor_name',
        'level',
        'department',
        'total_cabins',
        'is_active',
    ];
}

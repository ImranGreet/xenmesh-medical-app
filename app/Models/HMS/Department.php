<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\DepartmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'hospital_id',
        'is_active',
    ];
}

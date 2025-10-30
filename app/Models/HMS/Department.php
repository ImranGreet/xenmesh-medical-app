<?php

namespace App\Models\HMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\DepartmentFactory> */
    use HasFactory;

    protected $fillable = [
        'department_name',
        'description',
        'added_by_id',
        'is_active',
    ];

    public function hospital()
    {
        return $this->belongsTo(HospitalInfo::class, 'hospital_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'department_id');
    }
} 

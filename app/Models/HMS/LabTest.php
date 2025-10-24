<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\LabTestFactory> */
    use HasFactory;
    protected $fillable = [
        'test_name',
        'created_by',
        'description',
        'fee',
        'category',
    ];
}

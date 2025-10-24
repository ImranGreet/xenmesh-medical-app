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
        'description',
        'fee',
        'category',
    ];
}

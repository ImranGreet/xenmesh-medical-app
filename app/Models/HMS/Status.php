<?php

namespace App\Models\HMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\StatusFactory> */
    use HasFactory;

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }
}

<?php

namespace App\Models\HMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillTest extends Model
{
    /** @use HasFactory<\Database\Factories\HMS\BillTestFactory> */
    use HasFactory;

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function labTest()
    {
        return $this->belongsTo(LabTest::class);
    }
}

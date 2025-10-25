<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showAllBills()
    {
        $bills = Bill::all();
        return response()->json($bills);
    }
}

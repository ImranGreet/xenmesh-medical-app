<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function retrieveStatus()
    {
        $status = Status::all();
        return  response()->json([
            'success' => true,
            'message' => 'Statuses retrieved successfully!',
            'statuses' => $status,
        ]);
    }
}

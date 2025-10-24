<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\LabTest;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    public function getLabTests()
    {
        $labtests = LabTest::all();
        return response()->json($labtests);
    }
}

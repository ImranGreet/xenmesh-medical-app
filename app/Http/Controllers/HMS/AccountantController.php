<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Services\HMS\BillService;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
     protected $billService;
    public function __construct( BillService $billService)
    {
        $this->billService = $billService;
    }

    public function viewPatientBills($id)
    {
        $bills = $this->billService->viewPatientBillsDetails($id);
        return response()->json([
            'success' => true,
            'data' => $bills,
        ]);
    }
}

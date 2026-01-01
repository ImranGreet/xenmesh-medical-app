<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getCardData()
    {
        $data = [
            'totalPatients' => 1200,
            'totalStaff' => 150,
            'appointmentsToday' => 45,
            'availableBeds' => 30,
            'admittedPatients' => 200,
            'dischargedPatients' => 180,
            'totalRevenue' => 500000,
            'totalExpenses' => 300000,
        ];

        return response()->json($data);
    }

    public function IncomeExpenseData()
    {
        $data = [
            'monthlyIncome' => [
                'January' => 50000,
                'February' => 60000,
                'March' => 55000,
                'April' => 70000,
                'May' => 65000,
                'June' => 72000,
            ],
            'monthlyExpense' => [
                'January' => 30000,
                'February' => 35000,
                'March' => 32000,
                'April' => 40000,
                'May' => 38000,
                'June' => 41000,
            ],
        ];

        return response()->json($data);
    }

    public function investigationData()
    {
        $data = [
            'totalInvestigations' => 800,
            'pendingInvestigations' => 50,
            'completedInvestigations' => 750,
        ];

        return response()->json($data);
    }

    public function sallaryData()
    {
        $data = [
            'totalSalariesPaid' => 120000,
            'pendingSalaries' => 5000,
            'lastPaymentDate' => '2024-06-15',
        ];

        return response()->json($data);
    }



}

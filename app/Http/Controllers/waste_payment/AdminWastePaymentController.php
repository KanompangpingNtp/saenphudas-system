<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\WastePayment;

class AdminWastePaymentController extends Controller
{
    //
    public function AdminWastePayment()
    {
        // return view("waste-payment.index");

        $monthlyData = WastePayment::selectRaw("
        MONTH(due_date) as month,
        COUNT(CASE WHEN payment_status = 3 THEN 1 END) as paid,
        COUNT(CASE WHEN payment_status = 1 THEN 1 END) as unpaid
    ")
            ->whereYear('due_date', now()->year)
            ->groupBy(DB::raw('MONTH(due_date)'))
            ->orderBy('month')
            ->get();


        $revenueData = WastePayment::selectRaw("
        YEAR(paid_at) as year,
        MONTH(paid_at) as month,
        SUM(CASE WHEN payment_status = 3 THEN amount ELSE 0 END) as income,
        SUM(CASE WHEN payment_status != 3 THEN amount ELSE 0 END) as loss")
            ->whereYear('paid_at', now()->year)
            ->groupBy(DB::raw('YEAR(paid_at), MONTH(paid_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $paidCount = WastePayment::where('payment_status', 3)
            ->with('wasteManagement')
            ->distinct('waste_management_id')
            ->count('waste_management_id');

        $unpaidCount = WastePayment::where('payment_status', 1)
            ->with('wasteManagement')
            ->distinct('waste_management_id')
            ->count('waste_management_id');

        $verifyCount = WastePayment::where('payment_status', 2)
            ->with('wasteManagement')
            ->distinct('waste_management_id')
            ->count('waste_management_id');

        return view("waste-payment.index", compact('monthlyData', 'revenueData', 'paidCount', 'unpaidCount', 'verifyCount'));
    }
}

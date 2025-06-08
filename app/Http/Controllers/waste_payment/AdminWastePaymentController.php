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
        $now = now();

        // ข้อมูลกราฟ
        $monthlyData = WastePayment::selectRaw("
        MONTH(due_date) as month,
        COUNT(CASE WHEN payment_status = 3 THEN 1 END) as paid,
        COUNT(CASE WHEN payment_status = 1 THEN 1 END) as unpaid
    ")
            ->whereYear('due_date', $now->year)
            ->groupBy(DB::raw('MONTH(due_date)'))
            ->orderBy('month')
            ->get();

        $revenueData = WastePayment::selectRaw("
        YEAR(issued_at) as year,
        MONTH(issued_at) as month,
        SUM(CASE WHEN payment_status = 3 THEN amount ELSE 0 END) as income,
        SUM(CASE WHEN payment_status != 3 THEN amount ELSE 0 END) as loss
    ")
            ->whereYear('issued_at', $now->year)
            ->groupBy(DB::raw('YEAR(issued_at), MONTH(issued_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // 🟩 ผู้ชำระแล้ว (payment_status = 3)
        $paidManagement = WastePayment::where('payment_status', 3)
            ->whereNotNull('waste_management_id')
            ->distinct()
            ->count('waste_management_id');

        $paidAddress = WastePayment::where('payment_status', 3)
            ->whereNotNull('waste_address_id')
            ->distinct()
            ->count('waste_address_id');

        $paidCount = $paidManagement + $paidAddress;

        // 🟥 ผู้ขาดการชำระ (payment_status = 1)
        $unpaidManagement = WastePayment::where('payment_status', 1)
            ->whereNotNull('waste_management_id')
            ->distinct()
            ->count('waste_management_id');

        $unpaidAddress = WastePayment::where('payment_status', 1)
            ->whereNotNull('waste_address_id')
            ->distinct()
            ->count('waste_address_id');

        $unpaidCount = $unpaidManagement + $unpaidAddress;

        // 🟨 รอตรวจสอบการชำระ (payment_status = 2)
        $verifyManagement = WastePayment::where('payment_status', 2)
            ->whereNotNull('waste_management_id')
            ->distinct()
            ->count('waste_management_id');

        $verifyAddress = WastePayment::where('payment_status', 2)
            ->whereNotNull('waste_address_id')
            ->distinct()
            ->count('waste_address_id');

        $verifyCount = $verifyManagement + $verifyAddress;

        return view("waste-payment.index", compact(
            'monthlyData',
            'revenueData',
            'paidCount',
            'unpaidCount',
            'verifyCount'
        ));
    }
}

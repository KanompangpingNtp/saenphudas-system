<?php

namespace App\Http\Controllers\non_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;

class NonPaymentController extends Controller
{
    // public function NonPaymentPage()
    // {
    //     $nonPayments = WastePayment::with('wasteManagement.user')
    //         ->where('payment_status', 1)
    //         ->orderByDesc('due_date')
    //         ->get();

    //     return view("waste-payment.admin.non_payment.page", compact('nonPayments'));
    // }

    public function NonPaymentPage(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 1);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $nonPayments = $query->orderByDesc('due_date')->get();

        $availableMonths = WastePayment::where('payment_status', 1)
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 1)
            ->selectRaw('DISTINCT YEAR(due_date) as year')
            ->pluck('year')
            ->toArray();

        return view('waste-payment.admin.non_payment.page', compact(
            'nonPayments',
            'month',
            'year',
            'availableMonths',
            'availableYears'
        ));
    }
}

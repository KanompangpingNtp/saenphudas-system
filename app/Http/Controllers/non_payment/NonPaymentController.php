<?php

namespace App\Http\Controllers\non_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;

class NonPaymentController extends Controller
{
    public function NonPaymentPage()
    {
        $nonPayments = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 1)
            ->orderByDesc('due_date')
            ->get();

        return view("waste-payment.admin.non_payment.page", compact('nonPayments'));
    }
}

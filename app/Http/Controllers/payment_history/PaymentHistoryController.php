<?php

namespace App\Http\Controllers\payment_history;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;

class PaymentHistoryController extends Controller
{
    public function PaymentHistoryPage()
    {
        $payments = WastePayment::with('wasteManagement')
            ->where('payment_status', '3')
            ->get();

        return view('waste-payment.admin.payment_history.page', compact('payments'));
    }
}

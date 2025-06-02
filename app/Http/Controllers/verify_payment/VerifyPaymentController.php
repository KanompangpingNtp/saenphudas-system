<?php

namespace App\Http\Controllers\verify_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;

class VerifyPaymentController extends Controller
{
    public function VerifyPaymentPage()
    {
        $payments = WastePayment::with('wasteManagement')
            ->where('payment_status', '2')
            ->whereNotNull('payment_slip')
            ->get();
        //  dd($payments);

        return view('waste-payment.admin.verify_payment.page', compact('payments'));
    }

    public function approvePayment($id)
    {
        $payment = WastePayment::findOrFail($id);
        $payment->payment_status = 3;
        $payment->save();

        return redirect()->back()->with('success', 'ยืนยันการชำระเงินเรียบร้อยแล้ว');
    }
}

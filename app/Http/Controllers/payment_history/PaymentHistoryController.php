<?php

namespace App\Http\Controllers\payment_history;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;
use Illuminate\Support\Facades\Storage;

class PaymentHistoryController extends Controller
{
    // public function PaymentHistoryPage()
    // {
    //     $payments = WastePayment::with('wasteManagement')
    //         ->where('payment_status', '3')
    //         ->get();

    //     return view('waste-payment.admin.payment_history.page', compact('payments'));
    // }

    public function PaymentHistoryPage(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement')
            ->where('payment_status', 3);

        if ($month) {
            $query->whereMonth('paid_at', $month);
        }

        if ($year) {
            $query->whereYear('paid_at', $year);
        }

        $payments = $query->get();

        $availableMonths = WastePayment::where('payment_status', 3)
            ->selectRaw('DISTINCT MONTH(paid_at) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 3)
            ->selectRaw('DISTINCT YEAR(paid_at) as year')
            ->pluck('year')
            ->toArray();

        return view('waste-payment.admin.payment_history.page', compact(
            'payments',
            'month',
            'year',
            'availableMonths',
            'availableYears'
        ));
    }

    public function uploadBill(Request $request, $id)
    {
        $request->validate([
            'bill' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $payment = WastePayment::findOrFail($id);

        if ($payment->bill && Storage::exists('public/bills/' . $payment->bill)) {
            Storage::delete('public/bills/' . $payment->bill);
        }

        $filename = uniqid() . '.' . $request->file('bill')->getClientOriginalExtension();
        $request->file('bill')->storeAs('public/bills', $filename);

        $payment->bill = $filename;
        $payment->save();

        return redirect()->back()->with('success', 'อัปโหลดบิลเรียบร้อยแล้ว');
    }
}

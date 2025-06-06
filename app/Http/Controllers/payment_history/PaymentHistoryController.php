<?php

namespace App\Http\Controllers\payment_history;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentHistoryController extends Controller
{
    // public function PaymentHistoryPage(Request $request)
    // {
    //     $month = $request->input('month');
    //     $year = $request->input('year');

    //     $query = WastePayment::with('wasteManagement')
    //         ->where('payment_status', 3);

    //     if ($month) {
    //         $query->whereMonth('issued_at', $month);
    //     }

    //     if ($year) {
    //         $query->whereYear('issued_at', $year);
    //     }

    //     $payments = $query->get();

    //     $availableMonths = WastePayment::where('payment_status', 3)
    //         ->selectRaw('DISTINCT MONTH(issued_at) as month')
    //         ->pluck('month')
    //         ->toArray();

    //     $availableYears = WastePayment::where('payment_status', 3)
    //         ->selectRaw('DISTINCT YEAR(issued_at) as year')
    //         ->pluck('year')
    //         ->toArray();

    //     return view('waste-payment.admin.payment_history.page', compact(
    //         'payments',
    //         'month',
    //         'year',
    //         'availableMonths',
    //         'availableYears'
    //     ));
    // }

    public function PaymentHistoryPage(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 3);

        if ($month) {
            $query->whereMonth('issued_at', $month);
        }

        if ($year) {
            $query->whereYear('issued_at', $year);
        }

        $payments = $query->get()
            ->groupBy(fn($payment) => optional($payment->wasteManagement)->user_id)
            ->map(function ($group) {
                $latest = $group->sortByDesc('paid_at')->first();
                $latest->setAttribute('total_amount', $group->sum('amount'));
                $latest->setAttribute('payment_count', $group->count());
                $latest->setAttribute('has_missing_bill', $group->contains(fn($p) => is_null($p->bill)));
                return $latest;
            })
            ->values();

        $availableMonths = WastePayment::where('payment_status', 3)
            ->selectRaw('DISTINCT MONTH(issued_at) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 3)
            ->selectRaw('DISTINCT YEAR(issued_at) as year')
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

    public function PaymentHistoryDetail(Request $request)
    {
        $userId = $request->input('user_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 3)
            ->whereHas('wasteManagement', fn($q) => $q->where('users_id', $userId));

        if ($month) {
            $query->whereMonth('issued_at', $month);
        }

        if ($year) {
            $query->whereYear('issued_at', $year);
        }

        $payments = $query->orderByDesc('issued_at')->get();

        $availableMonths = WastePayment::where('payment_status', 3)
            ->whereHas('wasteManagement', fn($q) => $q->where('users_id', $userId))
            ->selectRaw('DISTINCT MONTH(issued_at) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 3)
            ->whereHas('wasteManagement', fn($q) => $q->where('users_id', $userId))
            ->selectRaw('DISTINCT YEAR(issued_at) as year')
            ->pluck('year')
            ->toArray();

        $user = User::find($userId);
        $totalAmount = $payments->sum('amount');

        return view('waste-payment.admin.payment_history.detail', compact(
            'payments',
            'month',
            'year',
            'availableMonths',
            'availableYears',
            'userId',
            'user',
            'totalAmount'
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

    public function PaymentHistoryExportPDF(Request $request)
    {
        $userId = $request->input('user_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 3)
            ->whereHas('wasteManagement', fn($q) => $q->where('users_id', $userId));

        if ($month) {
            $query->whereMonth('issued_at', $month);
        }

        if ($year) {
            $query->whereYear('issued_at', $year);
        }

        $payments = $query->orderByDesc('issued_at')->get();
        $user = User::find($userId);
        $totalAmount = $payments->sum('amount');

        $pdf = Pdf::loadView('waste-payment.admin.payment_history.pdf', compact(
            'payments',
            'user',
            'month',
            'year',
            'totalAmount'
        ));

        return $pdf->stream('ประวัติการชำระเงิน.pdf');
    }
}

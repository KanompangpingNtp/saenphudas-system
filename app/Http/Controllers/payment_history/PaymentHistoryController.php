<?php

namespace App\Http\Controllers\payment_history;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;
use App\Models\User;
use App\Models\WasteAddress;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentHistoryController extends Controller
{
    // public function PaymentHistoryPage(Request $request)
    // {
    //     $month = $request->input('month');
    //     $year = $request->input('year');

    //     $query = WastePayment::with('wasteManagement.user')
    //         ->where('payment_status', 3);

    //     if ($month) {
    //         $query->whereMonth('issued_at', $month);
    //     }

    //     if ($year) {
    //         $query->whereYear('issued_at', $year);
    //     }

    //     $payments = $query->get()
    //         ->groupBy(fn($payment) => optional($payment->wasteManagement)->user_id)
    //         ->map(function ($group) {
    //             $latest = $group->sortByDesc('issued_at')->first();
    //             $latest->setAttribute('total_amount', $group->sum('amount'));
    //             $latest->setAttribute('payment_count', $group->count());
    //             $latest->setAttribute('has_missing_bill', $group->contains(fn($p) => is_null($p->bill)));
    //             return $latest;
    //         })
    //         ->values();

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

        $query = WastePayment::with(['wasteManagement.user', 'wasteAddress'])
            ->where('payment_status', 3);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $allPayments = $query->get();

        $paymentsByUser = $allPayments->filter(function ($payment) {
            return optional($payment->wasteManagement)->user !== null;
        })->groupBy(function ($payment) {
            return $payment->wasteManagement->user->id;
        });

        $paymentsByAddress = $allPayments->groupBy('waste_address_id');

        $availableMonths = WastePayment::where('payment_status', 3)
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 3)
            ->selectRaw('DISTINCT YEAR(due_date) as year')
            ->pluck('year')
            ->toArray();

        return view('waste-payment.admin.payment_history.page', compact(
            'paymentsByUser',
            'paymentsByAddress',
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
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();

        $availableMonths = WastePayment::where('payment_status', 3)
            ->whereHas('wasteManagement', fn($q) => $q->where('users_id', $userId))
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 3)
            ->whereHas('wasteManagement', fn($q) => $q->where('users_id', $userId))
            ->selectRaw('DISTINCT YEAR(due_date) as year')
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

    public function PaymentHistoryDetailAd(Request $request)
    {
        $wasteAddressId = $request->input('waste_address_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with(['wasteManagement', 'wasteAddress'])
            ->where('payment_status', 3)
            ->where('waste_address_id', $wasteAddressId);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();

        $availableMonths = WastePayment::where('payment_status', 3)
            ->where('waste_address_id', $wasteAddressId)
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 3)
            ->where('waste_address_id', $wasteAddressId)
            ->selectRaw('DISTINCT YEAR(due_date) as year')
            ->pluck('year')
            ->toArray();

        $wasteAddress = WasteAddress::find($wasteAddressId);
        $totalAmount = $payments->sum('amount');

        return view('waste-payment.admin.payment_history.detail_address', compact(
            'payments',
            'month',
            'year',
            'availableMonths',
            'availableYears',
            'wasteAddressId',
            'wasteAddress',
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
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();
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

    public function PaymentHistoryExportPDFAd(Request $request)
    {
        $wasteAddressId = $request->input('waste_address_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with(['wasteAddress', 'wasteManagement'])
            ->where('payment_status', 3)
            ->where('waste_address_id', $wasteAddressId);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();
        $wasteAddress = WasteAddress::find($wasteAddressId);
        $totalAmount = $payments->sum('amount');

        $pdf = Pdf::loadView('waste-payment.admin.payment_history.pdf_ad', compact(
            'payments',
            'wasteAddress',
            'month',
            'year',
            'totalAmount'
        ));

        return $pdf->stream('ประวัติการชำระเงิน.pdf');
    }
}

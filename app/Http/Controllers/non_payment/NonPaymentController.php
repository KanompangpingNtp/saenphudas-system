<?php

namespace App\Http\Controllers\non_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WastePayment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class NonPaymentController extends Controller
{
    // public function NonPaymentPage(Request $request)
    // {
    //     $month = $request->input('month');
    //     $year = $request->input('year');

    //     $query = WastePayment::with('wasteManagement.user')
    //         ->where('payment_status', 1);

    //     if ($month) {
    //         $query->whereMonth('due_date', $month);
    //     }

    //     if ($year) {
    //         $query->whereYear('due_date', $year);
    //     }

    //     $nonPayments = $query->get()->groupBy(function ($payment) {
    //         return $payment->wasteManagement->user->id ?? null;
    //     });

    //     $availableMonths = WastePayment::where('payment_status', 1)
    //         ->selectRaw('DISTINCT MONTH(due_date) as month')
    //         ->pluck('month')
    //         ->toArray();

    //     $availableYears = WastePayment::where('payment_status', 1)
    //         ->selectRaw('DISTINCT YEAR(due_date) as year')
    //         ->pluck('year')
    //         ->toArray();

    //     return view('waste-payment.admin.non_payment.page', compact(
    //         'nonPayments',
    //         'month',
    //         'year',
    //         'availableMonths',
    //         'availableYears'
    //     ));
    // }

    public function NonPaymentPage(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with(['wasteManagement.user', 'wasteAddress'])
            ->where('payment_status', 1);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        // ดึงข้อมูลครั้งเดียว แล้วแยกกลุ่มใน Blade
        $allNonPayments = $query->get();

        $nonPaymentsByUser = $allNonPayments->filter(function ($payment) {
            return optional($payment->wasteManagement)->user !== null;
        })->groupBy(function ($payment) {
            return $payment->wasteManagement->user->id;
        });

        $nonPaymentsByAddress = $allNonPayments->groupBy('waste_address_id');

        $availableMonths = WastePayment::where('payment_status', 1)
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 1)
            ->selectRaw('DISTINCT YEAR(due_date) as year')
            ->pluck('year')
            ->toArray();

        return view('waste-payment.admin.non_payment.page', compact(
            'nonPaymentsByUser',
            'nonPaymentsByAddress',
            'month',
            'year',
            'availableMonths',
            'availableYears'
        ));
    }

    public function NonPaymentDetail(Request $request)
    {
        $userId = $request->input('user_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 1)
            ->whereHas('wasteManagement.user', fn($q) => $q->where('id', $userId));

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();

        $availableMonths = WastePayment::where('payment_status', 1)
            ->whereHas('wasteManagement.user', fn($q) => $q->where('id', $userId))
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 1)
            ->whereHas('wasteManagement.user', fn($q) => $q->where('id', $userId))
            ->selectRaw('DISTINCT YEAR(due_date) as year')
            ->pluck('year')
            ->toArray();

        $user = User::find($userId);

        $totalAmount = $payments->sum('amount');

        return view('waste-payment.admin.non_payment.detail', compact(
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

    public function NonPaymentDetailAd(Request $request)
    {
        $wasteAddressId = $request->input('waste_address_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with(['wasteManagement.user', 'wasteAddress'])
            ->where('payment_status', 1)
            ->where('waste_address_id', $wasteAddressId);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();

        $availableMonths = WastePayment::where('payment_status', 1)
            ->where('waste_address_id', $wasteAddressId)
            ->selectRaw('DISTINCT MONTH(due_date) as month')
            ->pluck('month')
            ->toArray();

        $availableYears = WastePayment::where('payment_status', 1)
            ->where('waste_address_id', $wasteAddressId)
            ->selectRaw('DISTINCT YEAR(due_date) as year')
            ->pluck('year')
            ->toArray();

        $wasteAddress = \App\Models\WasteAddress::find($wasteAddressId);
        $totalAmount = $payments->sum('amount');

        return view('waste-payment.admin.non_payment.detail_address', compact(
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

    public function NonPaymentExportPDF(Request $request)
    {
        $userId = $request->input('user_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with('wasteManagement.user')
            ->where('payment_status', 1)
            ->whereHas('wasteManagement.user', fn($q) => $q->where('id', $userId));

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();
        $user = User::find($userId);
        $totalAmount = $payments->sum('amount');

        $pdf = Pdf::loadView('waste-payment.admin.non_payment.pdf', compact(
            'payments',
            'user',
            'month',
            'year',
            'totalAmount'
        ));

        return $pdf->stream('บิลที่รอการชำระเงิน.pdf');
    }

    public function NonPaymentExportPDFAd(Request $request)
    {
        $wasteAddressId = $request->input('waste_address_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $query = WastePayment::with(['wasteManagement.user', 'wasteAddress'])
            ->where('payment_status', 1)
            ->where('waste_address_id', $wasteAddressId);

        if ($month) {
            $query->whereMonth('due_date', $month);
        }

        if ($year) {
            $query->whereYear('due_date', $year);
        }

        $payments = $query->orderByDesc('due_date')->get();
        $wasteAddress = \App\Models\WasteAddress::find($wasteAddressId);
        $totalAmount = $payments->sum('amount');

        $pdf = Pdf::loadView('waste-payment.admin.non_payment.pdf', compact(
            'payments',
            'wasteAddress',
            'month',
            'year',
            'totalAmount'
        ));

        return $pdf->stream('บิลที่รอการชำระเงิน.pdf');
    }
}

<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WastePayment;
use Illuminate\Support\Facades\Storage;

class CheckValuetrashController extends Controller
{
    public function CheckValuetrash()
    {
        $user = Auth::user();

        $payments = WastePayment::whereHas('wasteManagement', function ($query) use ($user) {
            $query->where('users_id', $user->id);
        })->get();

        return view("home.check-valuetrash-page", compact("user", "payments"));
    }

    public function  CheckValuetrashUpdateSlip(Request $request, $id)
    {
        $request->validate([
            'payment_slip' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $payment = WastePayment::findOrFail($id);

        if ($payment->payment_slip) {
            Storage::delete('public/payment_slips/' . $payment->payment_slip);
        }

        $file = $request->file('payment_slip');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/payment_slips', $filename);

        $payment->payment_slip = $filename;
        $payment->payment_status = 2;
        $payment->issued_at = now();
        $payment->save();

        return back()->with('success', 'อัปโหลดสลิปเรียบร้อยแล้ว');
    }
}

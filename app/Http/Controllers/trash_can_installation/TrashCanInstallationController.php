<?php

namespace App\Http\Controllers\trash_can_installation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteManagement;
use App\Models\WastePayment;

class TrashCanInstallationController extends Controller
{
    public function TrashCanInstallationPage()
    {
        $forms = WasteManagement::where('status', 2)->get();

        return view("waste-payment.admin.trash_can_installation.page", compact('forms'));
    }

    public function TrashCanInstallationDetail($id)
    {
        $form = WasteManagement::findOrFail($id);

        return view('waste-payment.admin.trash_can_installation.detail', compact('form'));
    }

    public function updateTrashStatus($id)
    {
        $form = WasteManagement::findOrFail($id);
        $form->trash_can_status = 2;
        $form->save();

        return redirect()->back()->with('success', 'อัปเดตสถานะถังขยะเรียบร้อยแล้ว');
    }

    public function CreateBill($id)
    {
        $form = WasteManagement::findOrFail($id);
        $form->trash_can_status = 3;
        $form->save();

        $existing = WastePayment::where('waste_management_id', $id)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'มีรายการชำระเงินแล้ว');
        }

        $amount = 100.00;
        $createdAt = now();

        // วันที่ 20 เป็นต้นไป ให้เลื่อนไปอีก 2 เดือน
        if ($createdAt->day >= 20) {
            $dueDate = $createdAt->copy()->addMonthsNoOverflow(2)->startOfMonth();
        } else {
            $dueDate = $createdAt->copy()->addMonthNoOverflow()->startOfMonth();
        }

        WastePayment::create([
            'waste_management_id' => $id,
            'amount' => $amount,
            'payment_status' => 1,
            'due_date' => $dueDate,
            'issued_at' => $createdAt, // วันที่ออกบิล
        ]);

        return redirect()->back()->with('success', 'สร้างรายการชำระเงินเรียบร้อย');
    }
}

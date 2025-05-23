<?php

namespace App\Http\Controllers\trash_can_installation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteManagement;

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
}

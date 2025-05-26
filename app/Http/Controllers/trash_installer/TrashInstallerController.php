<?php

namespace App\Http\Controllers\trash_installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteManagement;
use App\Models\WastePayment;

class TrashInstallerController extends Controller
{
    public function TrashInstallerPage()
    {
        $forms = WasteManagement::withCount([
            'payments as unpaid_count' => function ($query) {
                $query->where('payment_status', 1); // เฉพาะค้างชำระ
            }
        ])
            ->where('status', 2)
            ->get();

        return view("waste-payment.admin.trash_installer.page", compact('forms'));
    }

    public function TrashInstallerDetail($id)
    {
         $form = WasteManagement::with('payments')->findOrFail($id);

        return view('waste-payment.admin.trash_installer.detail', compact('form'));
    }
}

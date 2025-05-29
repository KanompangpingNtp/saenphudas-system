<?php

namespace App\Http\Controllers\general_electricity_request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralElectricityRequestForm;
use App\Models\GeneralElectricityRequestReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminGeneralElectricityRequestController extends Controller
{
    public function GeneralElectricityRequestAdminShowData()
    {
        $forms = GeneralElectricityRequestForm::with(['user', 'gerFiles', 'gerReplies'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.general_electricity_request.show-data', compact('forms'));
    }

    public function GeneralElectricityRequestAdminExportPDF($id)
    {
        $form = GeneralElectricityRequestForm::find($id);

        $pdf = Pdf::loadView('users.general_electricity_request.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }

    public function GeneralElectricityRequestAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        GeneralElectricityRequestReplies::create([
            'ger_form_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function GeneralElectricityRequestUpdateStatus($id)
    {
        $form = GeneralElectricityRequestForm::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

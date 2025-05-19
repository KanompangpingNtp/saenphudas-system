<?php

namespace App\Http\Controllers\general_requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralRequestsForm;
use App\Models\GeneralRequestsReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminGeneralRequestsController extends Controller
{
    public function GeneralRequestsAdminShowData()
    {
        $forms = GeneralRequestsForm::with(['user', 'grAttachments', 'grReplies'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.general-requests.show-data', compact('forms'));
    }

    public function GeneralRequestsAdminExportPDF($id)
    {
        $form = GeneralRequestsForm::find($id);

        $pdf = Pdf::loadView('users.general-requests.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }

    public function GeneralRequestsAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        GeneralRequestsReplies::create([
            'gr_form_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function GeneralRequestsUpdateStatus($id)
    {
        $form = GeneralRequestsForm::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

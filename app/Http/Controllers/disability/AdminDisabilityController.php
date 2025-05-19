<?php

namespace App\Http\Controllers\disability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisabilityPerson;
use App\Models\DisabilityReply;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminDisabilityController extends Controller
{
    public function DisabilityAdminShowData()
    {
        $forms = DisabilityPerson::with(['user', 'disabilityAttachments', 'disabilityReplies'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.disability.show-data', compact('forms'));
    }

    public function DisabilityExportPDF($id)
    {
        $form = DisabilityPerson::with('disabilityTraders', 'disabilityOptions', 'disabilityBankAccounts')->find($id);

        if ($form->disabilityOptions->first() && $form->disabilityOptions->first()->welfare_type) {
            $welfareType = $form->disabilityOptions->first()->welfare_type;
            if (is_string($welfareType)) {
                $form->disabilityOptions->first()->welfare_type = json_decode($welfareType, true);
            }
        }

        $documentType = $form->disabilityOptions->first()->document_type ?? [];
        if (is_string($documentType)) {
            $documentType = json_decode($documentType, true);
        }

        $pdf = Pdf::loadView('users.disability.pdf-form', compact('form', 'documentType'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ' . $form->id . '.pdf');
    }

    public function DisabilityAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        DisabilityReply::create([
            'disability_people_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function DisabilityUpdateStatus($id)
    {
        $form = DisabilityPerson::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

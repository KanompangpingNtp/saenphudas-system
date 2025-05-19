<?php

namespace App\Http\Controllers\elderly_allowance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElderlyAllowancePeople;
use App\Models\ElderlyAllowanceReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminElderlyAllowanceController extends Controller
{
     public function ElderlyAllowanceAdminShowData()
    {
        $forms = ElderlyAllowancePeople::with(['user', 'files', 'replies'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.elderly_allowance.show-data', compact('forms'));
    }

    public function ElderlyAllowanceAdminExportPDF($id)
    {
        $form = ElderlyAllowancePeople::with('personsOption', 'bank')->find($id);

        if ($form->personsOption->first() && $form->personsOption->first()->welfare_type) {
            $welfareType = $form->personsOption->first()->welfare_type;
            if (is_string($welfareType)) {
                $form->personsOption->first()->welfare_type = json_decode($welfareType, true);
            }
        }

        $documentType = $form->personsOption->first()->document_type ?? [];
        if (is_string($documentType)) {
            $documentType = json_decode($documentType, true);
        }

        $pdf = Pdf::loadView('users.elderly_allowance.pdf-form', compact('form', 'documentType'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอยืนยันสิทธิรับเงินเบี้ยยังชีพผู้สูงอายุ' . $form->id . '.pdf');
    }

    public function ElderlyAllowanceAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ElderlyAllowanceReplies::create([
            'ea_people_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function ElderlyAllowanceUpdateStatus($id)
    {
        $form = ElderlyAllowancePeople::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

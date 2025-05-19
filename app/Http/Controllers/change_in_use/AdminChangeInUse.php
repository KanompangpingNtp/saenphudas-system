<?php

namespace App\Http\Controllers\change_in_use;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChangeInUseInformations;
use App\Models\ChangeInUseReplies;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminChangeInUse extends Controller
{
    public function ChangeInUseAdminPages()
    {
        $forms = ChangeInUseInformations::with(['user', 'replies'])->get();

        return view('admin.change_in_use.show-data', compact('forms'));
    }

    public function ChangeInUseAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ChangeInUseReplies::create([
            'change_in_use_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function ChangeInUseAdminExportPDF($id)
    {
        $form = ChangeInUseInformations::with('details')->find($id);

        $pdf = Pdf::loadView('users.change_in_use.pdf-form', compact('form'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('(ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง' . $form->id . '.pdf');
    }

    public function ChangeInUseUpdateStatus($id)
    {
        $form = ChangeInUseInformations::findOrFail($id);

        $form->form_status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

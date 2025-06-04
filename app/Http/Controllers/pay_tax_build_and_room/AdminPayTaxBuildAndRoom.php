<?php

namespace App\Http\Controllers\pay_tax_build_and_room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PayTaxBuildAndRoomInformations;
use App\Models\PayTaxBuildAndRoomReplies;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminPayTaxBuildAndRoom extends Controller
{
        public function PayTaxBuildAndRoomAdminPages()
    {
        $forms = PayTaxBuildAndRoomInformations::with(['user', 'files', 'replies'])->get();

        return view('admin.pay_tax_build_and_room.show-data', compact('forms'));
    }

    public function PayTaxBuildAndRoomAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        PayTaxBuildAndRoomReplies::create([
            'pay_tax_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function PayTaxBuildAndRoomAdminExportPDF($id)
    {
        $form = PayTaxBuildAndRoomInformations::with('details')->find($id);

        $pdf = Pdf::loadView('users.pay_tax_build_and_room.pdf-form', compact('form'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้างและห้องชุด' . $form->id . '.pdf');
    }

    public function PayTaxBuildAndRoomUpdateStatus($id)
    {
        $form = PayTaxBuildAndRoomInformations::findOrFail($id);

        $form->form_status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

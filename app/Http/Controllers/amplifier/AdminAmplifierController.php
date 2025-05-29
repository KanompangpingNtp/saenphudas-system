<?php

namespace App\Http\Controllers\amplifier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amplifier;
use App\Models\AmplifierReply;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminAmplifierController extends Controller
{
    public function AmplifierAdminPages()
    {
        $forms = Amplifier::with(['user', 'replies'])->get();

        return view('admin.amplifier.show-data', compact('forms'));
    }

    public function AmplifierAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        AmplifierReply::create([
            'amplifier_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function AmplifierAdminExportPDF($id)
    {
        $form = Amplifier::find($id);

        $pdf = Pdf::loadView('users.amplifier.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('คำร้องขออนุญาตทำการโฆษณาโดยใช้เครื่องขยายเสียง' . $form->id . '.pdf');
    }

    public function AmplifierUpdateStatus($id)
    {
        $form = Amplifier::findOrFail($id);

        $form->form_status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

<?php

namespace App\Http\Controllers\general_road_request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralRoadRequestForm;
use App\Models\GeneralRoadRequestReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminGeneralRoadRequestController extends Controller
{
    public function GeneralRoadRequestAdminShowData()
    {
        $forms = GeneralRoadRequestForm::with(['user', 'grrFiles', 'grrReplies'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.general_road_request.show-data', compact('forms'));
    }

    public function GeneralRoadRequestAdminExportPDF($id)
    {
        $form = GeneralRoadRequestForm::find($id);

        $pdf = Pdf::loadView('users.general_road_request.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }

    public function GeneralRoadRequestAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        GeneralRoadRequestReplies::create([
            'grr_form_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function GeneralRoadRequestUpdateStatus($id)
    {
        $form = GeneralRoadRequestForm::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

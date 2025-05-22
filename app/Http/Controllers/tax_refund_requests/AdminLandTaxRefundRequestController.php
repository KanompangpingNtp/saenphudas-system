<?php

namespace App\Http\Controllers\tax_refund_requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxRefundRequest;
use App\Models\TaxRefundRequestReply;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminLandTaxRefundRequestController extends Controller
{
     public function LandTaxRefundRequestAdminShowData()
    {
        $forms = TaxRefundRequest::with(['user', 'files', 'replies'])->get();

        return view('admin.tax_refund_requests.show-data', compact('forms'));
    }

    public function LandTaxRefundRequestAdminExportPDF($id)
    {
        $form = TaxRefundRequest::find($id);

        $pdf = Pdf::loadView('users.tax_refund_requests.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน' . $form->id . '.pdf');
    }

    public function LandTaxRefundRequestAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        TaxRefundRequestReply::create([
            'tax_refund_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function LandTaxRefundRequestUpdateStatus($id)
    {
        $form = TaxRefundRequest::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

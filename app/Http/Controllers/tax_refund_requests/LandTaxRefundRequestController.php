<?php

namespace App\Http\Controllers\tax_refund_requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxRefundRequest;
use App\Models\TaxRefundRequestFiles;
use App\Models\TaxRefundRequestReply;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LandTaxRefundRequestController extends Controller
{
    public function LandTaxRefundRequestPage()
    {
        return view('users.tax_refund_requests.page-form');
    }

    public function LandTaxRefundRequestFormCreate(Request $request)
    {
        $request->validate([
            'salutation' => 'nullable|string',
            'full_name' => 'nullable|string',
            'age' => 'nullable|string',
            'house_number' => 'nullable|string',
            'village' => 'nullable|string',
            'subdistrict' => 'nullable|string',
            'district' => 'nullable|string',
            'province' => 'nullable|string',
            'phone' => 'nullable|string',
            'tax_year' => 'nullable|string',
            'amount' => 'nullable|string',
            'receipt_number' => 'nullable|string',
            'dated' => 'nullable|date',
            'tax_money' => 'nullable|string',
            'other_documents' => 'nullable|string',
            'due_to_options' => 'nullable|array',
            'due_to_options.*' => 'string|in:option1,option2',
            'road' => 'nullable|string',
            'alley' => 'nullable|string',

            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // dd($request);

        $Form = TaxRefundRequest::create([
            'users_id' => auth()->id(),
            'status' => 1,
            'salutation' => $request->salutation,
            'full_name' => $request->full_name,
            'age' => $request->age,
            'house_number' => $request->house_number,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'phone' => $request->phone,
            'tax_year' => $request->tax_year,
            'amount' => $request->amount,
            'receipt_number' => $request->receipt_number,
            'dated' => $request->dated,
            'tax_money' => $request->tax_money,
            'other_documents' => $request->other_documents,
            'due_to_options' => json_encode($request->due_to_options),
            'road' => $request->road,
            'alley' => $request->alley,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('tax_refund_requests-files', $filename, 'public');

                TaxRefundRequestFiles::create([
                    'tax_refund_id' => $Form->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function LandTaxRefundRequestShowDetails()
    {
        $forms = TaxRefundRequest::with(['user', 'files', 'replies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.tax_refund_requests.account.show-detail', compact('forms'));
    }

    public function LandTaxRefundRequestUserExportPDF($id)
    {
        $form = TaxRefundRequest::find($id);

        $pdf = Pdf::loadView('users.tax_refund_requests.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน' . $form->id . '.pdf');
    }

    public function LandTaxRefundRequestUserReply(Request $request, $formId)
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
}

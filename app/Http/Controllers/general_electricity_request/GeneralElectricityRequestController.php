<?php

namespace App\Http\Controllers\general_electricity_request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralElectricityRequestForm;
use App\Models\GeneralElectricityRequestFiles;
use App\Models\GeneralElectricityRequestReplies;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GeneralElectricityRequestController extends Controller
{
    public function GeneralElectricityRequestFormPage()
    {
        return view('users.general_electricity_request.page-form');
    }

    public function GeneralElectricityRequestFormCreate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'subject' => 'nullable|string|max:255',
            'salutation' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'house_number' => 'nullable|string|max:50',
            'village' => 'nullable|string|max:100',
            'subdistrict' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'request_details' => 'nullable|string',
            'phone' => 'nullable|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'included' => 'nullable|string',
            'proceedings' => 'nullable|string'
        ]);

        // dd($request);

        $gerForm = GeneralElectricityRequestForm::create([
            'users_id' => auth()->id(),
            'status' => 1,
            'date' => $request->date,
            'subject' => $request->subject,
            'salutation' => $request->salutation,
            'name' => $request->name,
            'age' => $request->age,
            'house_number' => $request->house_number,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'phone' => $request->phone,
            'request_details' => $request->request_details,
            'included' => $request->included,
            'proceedings' => $request->proceedings,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('general_electricity_files', $filename, 'public');

                GeneralElectricityRequestFiles::create([
                    'ger_form_id' => $gerForm->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function GeneralElectricityRequestShowDetails()
    {
        $forms = GeneralElectricityRequestForm::with(['user', 'gerReplies', 'gerFiles'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.general_electricity_request.account.show-detail', compact('forms'));
    }

    public function GeneralElectricityRequestUserExportPDF($id)
    {
        $form = GeneralElectricityRequestForm::find($id);

        $pdf = Pdf::loadView('users.general_electricity_request.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }

    public function GeneralElectricityRequestUserReply(Request $request, $formId)
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

    public function GeneralElectricityRequestUserShowFormEdit($id)
    {
        $form = GeneralElectricityRequestForm::with('gerFiles')->findOrFail($id);

        return view('users.general_electricity_request.account.edit-data', compact('form'));
    }

    public function GeneralElectricityRequestUserUpdateForm(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'subject' => 'nullable|string|max:255',
            'salutation' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'house_number' => 'nullable|string|max:50',
            'village' => 'nullable|string|max:100',
            'subdistrict' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'request_details' => 'nullable|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'delete_attachments' => 'nullable|array',
            'delete_attachments.*' => 'integer',
            'included' => 'nullable|string',
            'proceedings' => 'nullable|string'
        ]);

        $gerForm = GeneralElectricityRequestForm::findOrFail($id);

        $gerForm->update([
            'date' => $request->date,
            'subject' => $request->subject,
            'salutation' => $request->salutation,
            'name' => $request->name,
            'age' => $request->age,
            'house_number' => $request->house_number,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'request_details' => $request->request_details,
            'included' => $request->included,
            'proceedings' => $request->proceedings,
        ]);

        if ($request->has('delete_attachments')) {
            foreach ($request->delete_attachments as $attachmentId) {
                $attachment = GeneralElectricityRequestFiles::find($attachmentId);
                if ($attachment) {
                    Storage::disk('public')->delete($attachment->file_path);
                    $attachment->delete();
                }
            }
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('general-electricity-request', $filename, 'public');

                GeneralElectricityRequestFiles::create([
                    'ger_form_id' => $gerForm->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'อัปเดตสำเร็จแล้ว!');
    }
}

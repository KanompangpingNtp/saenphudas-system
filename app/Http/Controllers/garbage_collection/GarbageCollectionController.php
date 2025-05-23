<?php

namespace App\Http\Controllers\garbage_collection;

use App\Http\Controllers\Controller;
use App\Models\WasteManagement;
use App\Models\WasteManagementFile;
use App\Models\WasteManagementReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GarbageCollectionController extends Controller
{
    public function GarbageCollectionForm()
    {
        return view("users.garbage_collection.page-form");
    }

    public function GarbageCollectionFormCreate(Request $request)
    {
        $request->validate([
            'salutation' => 'nullable|string|max:10',
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'village' => 'required|string|max:100',
            'sub_district' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'optione' => 'required|string|in:1,2,3,4,5',
            'optione_detail' => 'nullable|string|required_if:optione,5',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'user_latitude' => 'required|numeric',
            'user_longitude' => 'required|numeric',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // dd($request);

        $waste = WasteManagement::create([
            'users_id' => Auth::id(),
            'status' => 1,
            'salutation' => $request->salutation,
            'name' => $request->full_name,
            'address' => $request->address,
            'village' => $request->village,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'phone' => $request->phone,
            'optione' => $request->optione,
            'optione_detail' => $request->optione_detail,
            'lat' => $request->latitude,
            'lng' => $request->longitude,
            'user_latitude' => $request->user_latitude,
            'user_longitude' => $request->user_longitude,
            'trash_can_status' => 1,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('waste_files', $filename, 'public');

                WasteManagementFile::create([
                    'waste_management_id' => $waste->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function GarbageCollectionShowDetails()
    {
        $forms = WasteManagement::with(['user', 'files', 'replys'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.garbage_collection.account.show-detail', compact('forms'));
    }

    public function GarbageCollectionUserExportPDF($id)
    {
        $form = WasteManagement::find($id);

        $pdf = Pdf::loadView('users.garbage_collection.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอถังขยะ' . $form->id . '.pdf');
    }

    public function GarbageCollectionUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        WasteManagementReply::create([
            'waste_management_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
}

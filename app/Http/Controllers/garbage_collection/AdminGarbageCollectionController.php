<?php

namespace App\Http\Controllers\garbage_collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteManagement;
use App\Models\WasteManagementReply;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminGarbageCollectionController extends Controller
{
    public function GarbageCollectionAdminShowData()
    {
        $forms = WasteManagement::with(['user', 'files', 'replys'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.garbage_collection.show-data', compact('forms'));
    }

    public function GarbageCollectionAdminExportPDF($id)
    {
        $form = WasteManagement::find($id);

        $pdf = Pdf::loadView('users.garbage_collection.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอถังขยะ' . $form->id . '.pdf');
    }

    public function AdminGarbageCollectionAdminReply(Request $request, $formId)
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

    public function AdminGarbageCollectionUpdateStatus($id)
    {
        $form = WasteManagement::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

<?php

namespace App\Http\Controllers\land_building_tax_appeals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBuildingTaxAppeal;
use App\Models\LandBuildingTaxAppealFiles;
use App\Models\LandBuildingTaxAppealReply;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class LandBuildingTaxAppealController extends Controller
{
     public function LandBuildingTaxAppealPage ()
    {
        return view('users.land_building_tax_appeals.page-form');
    }

    public function LandBuildingTaxAppealFormCreate (Request $request)
    {
        $request->validate([
            'delivered_to' => 'nullable|string',
            'year' => 'nullable|string',
            'number' => 'nullable|string',
            'dated' => 'nullable|string',
            'received_date' => 'nullable|string',
            'salutation' => 'nullable|string',
            'full_name' => 'nullable|string',
            'due_to' => 'nullable|string',
            'documents' => 'nullable|string',

            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // dd($request);

        $Form = LandBuildingTaxAppeal::create([
            'users_id' => auth()->id(),
            'status' => 1,
            'delivered_to' => $request->delivered_to,
            'year' => $request->year,
            'number' => $request->number,
            'dated' => $request->dated,
            'received_date' => $request->received_date,
            'salutation' => $request->salutation,
            'full_name' => $request->full_name,
            'due_to' => $request->due_to,
            'documents' => $request->documents,

        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('land_building_tax_appeals-files', $filename, 'public');

                LandBuildingTaxAppealFiles::create([
                    'lbt_appeal_id' => $Form->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function LandBuildingTaxAppealShowDetails()
    {
        $forms = LandBuildingTaxAppeal::with(['user', 'files', 'replies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.land_building_tax_appeals.account.show-detail', compact('forms'));
    }

    public function LandBuildingTaxAppealUserExportPDF($id)
    {
        $form = LandBuildingTaxAppeal::find($id);

        $pdf = Pdf::loadView('users.land_building_tax_appeals.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง' . $form->id . '.pdf');
    }

    public function LandBuildingTaxAppealUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        LandBuildingTaxAppealReply::create([
            'lbt_appeal_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
}

<?php

namespace App\Http\Controllers\land_building_tax_appeals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBuildingTaxAppeal;
use App\Models\LandBuildingTaxAppealReply;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLandBuildingTaxAppealController extends Controller
{
     public function LandBuildingTaxAppealAdminShowData()
    {
        $forms = LandBuildingTaxAppeal::with(['user', 'files', 'replies'])->get();

        return view('admin.land_building_tax_appeals.show-data', compact('forms'));
    }

    public function LandBuildingTaxAppealAdminExportPDF($id)
    {
        $form = LandBuildingTaxAppeal::find($id);

        $pdf = Pdf::loadView('users.land_building_tax_appeals.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง' . $form->id . '.pdf');
    }

    public function LandBuildingTaxAppealAdminReply(Request $request, $formId)
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

    public function LandBuildingTaxAppealUpdateStatus($id)
    {
        $form = LandBuildingTaxAppeal::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

<?php

namespace App\Http\Controllers\change_in_use;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChangeInUseInformations;
use App\Models\ChangeInUseFormDetails;
use App\Models\ChangeInUseReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ChangeInUse extends Controller
{
    public function ChangeInUseFormPage()
    {
        return view('users.change_in_use.page-form');
    }

    public function ChangeInUseFormCreate(Request $request)
    {
        $request->validate([
            'salutation' => 'nullable|string|max:20',
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'village' => 'nullable|string',
            'road' => 'nullable|string|max:100',
            'subdistrict' => 'required|string',
            'district' => 'required|string',
            'province' => 'required|string',
        ]);

        $changeinuse = ChangeInUseInformations::create([
            'users_id' => auth()->id(),
            'form_status' => 1,
            'salutation' => $request->salutation,
            'full_name' => $request->full_name,
            'address' => $request->address,
            'village' => $request->village,
            'road' => $request->road,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
        ]);

        $changeinusedetail = ChangeInUseFormDetails::create([
            'change_in_use_id' => $changeinuse->id,
            'land_total' => $request->land_total,
            'land_on' => $request->land_on,
            'land_village' => $request->land_village,
            'land_road' => $request->land_road,
            'land_subdistrict' => $request->land_subdistrict,
            'land_district' => $request->land_district,
            'land_province' => $request->land_province,
            'land_deed' => $request->land_deed,
            'land_rai' => $request->land_rai,
            'land_unit' => $request->land_unit,
            'land_wa' => $request->land_wa,
            'land_default_use' => $request->land_default_use,
            'land_current_use' => $request->land_current_use,
            'land_current_date' => $request->land_current_date,
            'build_total' => $request->build_total,
            'build_on' => $request->build_on,
            'build_village' => $request->build_village,
            'build_road' => $request->build_road,
            'build_subdistrict' => $request->build_subdistrict,
            'build_district' => $request->build_district,
            'build_province' => $request->build_province,
            'build_deed' => $request->build_deed,
            'build_meter' => $request->build_meter,
            'build_default_use' => $request->build_default_use,
            'build_current_use' => $request->build_current_use,
            'build_current_date' => $request->build_current_date,
            'room_total' => $request->room_total,
            'room_name' => $request->room_name,
            'room_on' => $request->room_on,
            'room_village' => $request->room_village,
            'room_road' => $request->room_road,
            'room_subdistrict' => $request->room_subdistrict,
            'room_district' => $request->room_district,
            'room_province' => $request->room_province,
            'room_deed' => $request->room_deed,
            'room_meter' => $request->room_meter,
            'room_default_use' => $request->room_default_use,
            'room_current_use' => $request->room_current_use,
            'room_current_date' => $request->room_current_date,
        ]);

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function ChangeInUseShowDetails()
    {
        $forms = ChangeInUseInformations::with(['user', 'replies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.change_in_use.account.show-detail', compact('forms'));
    }

    public function ChangeInUseUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ChangeInUseReplies::create([
            'change_in_use_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function ChangeInUseUserExportPDF($id)
    {
        $form = ChangeInUseInformations::with('details')->find($id);

        $pdf = Pdf::loadView('users.change_in_use.pdf-form', compact('form'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('(ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง' . $form->id . '.pdf');
    }
}

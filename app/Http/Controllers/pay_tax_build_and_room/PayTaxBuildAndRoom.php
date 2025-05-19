<?php

namespace App\Http\Controllers\pay_tax_build_and_room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayTaxBuildAndRoomInformations;
use App\Models\PayTaxBuildAndRoomFormDetails;
use App\Models\PayTaxBuildAndRoomFormFiles;
use App\Models\PayTaxBuildAndRoomReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PayTaxBuildAndRoom extends Controller
{
     public function PayTaxBuildAndRoomFormPage()
    {
        return view('users.pay_tax_build_and_room.page-form');
    }

    public function PayTaxBuildAndRoomFormCreate(Request $request)
    {
        $request->validate([
            'salutation' => 'nullable|string|max:20',
        ]);

        $paytax = PayTaxBuildAndRoomInformations::create([
            'users_id' => auth()->id(),
            'form_status' => 1,
            'title_name' => $request->title_name,
        ]);

        $paytaxdetail = PayTaxBuildAndRoomFormDetails::create([
            'pay_tax_id' => $paytax->id,
            'personal_salutation' => $request->personal_salutation,
            'personal_full_name' => $request->personal_full_name,
            'personal_age' => $request->personal_age,
            'personal_id_card_number' => $request->personal_id_card_number,
            'personal_id_card_by' => $request->personal_id_card_by,
            'personal_id_card_date' => $request->personal_id_card_date,
            'personal_address' => $request->personal_address,
            'personal_village' => $request->personal_village,
            'personal_alley' => $request->personal_alley,
            'personal_road' => $request->personal_road,
            'personal_subdistrict' => $request->personal_subdistrict,
            'personal_district' => $request->personal_district,
            'personal_province' => $request->personal_province,
            'personal_telephone' => $request->personal_telephone,
            'personal_line' => $request->personal_line,
            'personal_email' => $request->personal_email,
            'org_salutation' => $request->org_salutation,
            'org_full_name' => $request->org_full_name,
            'org_address' => $request->org_address,
            'org_village' => $request->org_village,
            'org_alley' => $request->org_alley,
            'org_road' => $request->org_road,
            'org_subdistrict' => $request->org_subdistrict,
            'org_district' => $request->org_district,
            'org_province' => $request->org_province,
            'org_telephone' => $request->org_telephone,
            'org_salutation_2' => $request->org_salutation_2,
            'org_full_name_2' => $request->org_full_name_2,
            'org_age_2' => $request->org_age_2,
            'org_id_card_2' => $request->org_id_card_2,
            'org_id_card_by_2' => $request->org_id_card_by_2,
            'org_id_card_date_2' => $request->org_id_card_date_2,
            'org_certificate' => $request->org_certificate,
            'org_certificate_date' => $request->org_certificate_date,
            'org_line' => $request->org_line,
            'org_email' => $request->org_email,
            'year' => $request->year,
            'date' => $request->date,
            'total' => $request->total,
            'round_date_1' => $request->round_date_1,
            'round_total_1' => $request->round_total_1,
            'round_date_2' => $request->round_date_2,
            'round_total_2' => $request->round_total_2,
            'round_date_3' => $request->round_date_3,
            'round_total_3' => $request->round_total_3,
            'confirm' => $request->confirm,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('attachments', $filename, 'public');

                PayTaxBuildAndRoomFormFiles::create([
                    'pay_tax_id' => $paytax->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function PayTaxBuildAndRoomShowDetails()
    {
        $forms = PayTaxBuildAndRoomInformations::with(['user', 'files', 'replies'])
        ->where('users_id', Auth::id())
        ->get();

        return view('users.pay_tax_build_and_room.account.show-detail', compact('forms'));
    }

    public function PayTaxBuildAndRoomUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        PayTaxBuildAndRoomReplies::create([
            'pay_tax_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function PayTaxBuildAndRoomUserExportPDF($id)
    {
        $form = PayTaxBuildAndRoomInformations::with('details')->find($id);

        $pdf = Pdf::loadView('users.pay_tax_build_and_room.pdf-form', compact('form'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้างและห้องชุด' . $form->id . '.pdf');
    }
}

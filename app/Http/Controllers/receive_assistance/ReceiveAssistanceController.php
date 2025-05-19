<?php

namespace App\Http\Controllers\receive_assistance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssistPerson;
use App\Models\AssistImparting;
use App\Models\AssistReply;
use App\Models\AssistAttachment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ReceiveAssistanceController extends Controller
{
    public function ReceiveAssistanceFormPage()
    {
        return view('users.receive_assistance.page-form');
    }

    public function ReceiveAssistanceFormCreate(Request $request)
    {
        $birth_day = $request->birth_day ? Carbon::createFromFormat('d/m/Y', $request->birth_day)->format('Y-m-d') : null;
        $request->validate([
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // dd($request);

        $AssistPerson = AssistPerson::create([
            'users_id' => auth()->id(),
            'status' => 1,
            'written_at' => $request->written_at,
            'write_the_date' => $request->write_the_date,
            'learn' => $request->learn,
            'salutation' => $request->salutation,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_day' => $birth_day,
            'age' => $request->age,
            'nationality' => $request->nationality,
            'village' => $request->village,
            'alley' => $request->alley,
            'road' => $request->road,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'citizen_id' => $request->citizen_id,
            'community' => $request->community,
        ]);

        AssistImparting::create([
            'assist_people_id' => $AssistPerson->id,
            // 'accommodation' => $request->accommodation,
            'accommodation' => json_encode($request->accommodation),
            'accommodation_belongs_to' => $request->accommodation_belongs_to,
            'accommodation_relevant_as' => $request->accommodation_relevant_as,
            'away_from_home' => $request->away_from_home,
            'away_from_home_option' => $request->away_from_home_option,
            'away_from_home_option_dueto' => $request->away_from_home_option_dueto,
            'away_from_community' => $request->away_from_community,
            'away_from_community_option' => $request->away_from_community_option,
            'away_from_community_option_dueto' => $request->away_from_community_option_dueto,
            'stay_away_from_agency' => $request->stay_away_from_agency,
            'stay_away_from_agency_option' => $request->stay_away_from_agency_option,
            'stay_away_from_agency_option_dueto' => $request->stay_away_from_agency_option_dueto,
            'residence' => $request->residence,
            'residence_stay_alone_dueto' => $request->residence_stay_alone_dueto,
            'residence_stay_alone_dueto_detail' => $request->residence_stay_alone_dueto_detail,
            'residence_living_with' => $request->residence_living_with,
            'residence_living_with_detail' => $request->residence_living_with_detail,
            'residence_living_with_quantity' => $request->residence_living_with_quantity,
            'residence_living_with_working' => $request->residence_living_with_working,
            'residence_living_with_total_income' => $request->residence_living_with_total_income,
            'residence_living_with_non_workers' => $request->residence_living_with_non_workers,
            'total_income' => $request->total_income,
            'source_of_income' => $request->source_of_income,
            'used_for_expenses' => $request->used_for_expenses,
            'contact_person' => $request->contact_person,
            'contact_address_number' => $request->contact_address_number,
            'contact_road' => $request->contact_road,
            'contact_alley' => $request->contact_alley,
            'contact_village' => $request->contact_village,
            'contact_subdistrict' => $request->contact_subdistrict,
            'contact_district' => $request->contact_district,
            'contact_province' => $request->contact_province,
            'contact_postal_code' => $request->contact_postal_code,
            'contact_telephone' => $request->contact_telephone,
            'contact_fax' => $request->contact_fax,
            'contact_relevant_as' => $request->contact_relevant_as,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                AssistAttachment::create([
                    'assist_people_id' => $AssistPerson->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function TableReceiveAssistanceUsersPages()
    {
        $forms = AssistPerson::with(['user', 'assistAttachments', 'assistReplies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.receive_assistance.account.show-detail', compact('forms'));
    }

    public function ReceiveAssistanceUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        AssistReply::create([
            'assist_people_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function ReceiveAssistanceUserExportPDF($id)
    {
        $form = AssistPerson::with('assistImpartings')->find($id);

        if ($form && $form->assistImpartings->first() && $form->assistImpartings->first()->accommodation) {
            $accommodation = $form->assistImpartings->first()->accommodation;
            if (is_string($accommodation)) {
                $form->assistImpartings->first()->accommodation = json_decode($accommodation, true);
            }
        }

        $pdf = Pdf::loadView('users.receive_assistance.pdf-form', compact('form'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('คำขอรับเงินสงเคราะห์' . $form->id . '.pdf');
    }
}

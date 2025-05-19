<?php

namespace App\Http\Controllers\recruiting_children;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildInformation;
use App\Models\CaregiverInformation;
use App\Models\SurrenderTheChild;
use App\Models\ChildRegistration;
use App\Models\ChildAttachment;
use App\Models\ChildReply;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecruitingChildrenController extends Controller
{
     public function ChildApplyPage()
    {
        return view('users.recruiting_children.page-form');
    }

    public function ChildApplyFormCreate(Request $request)
    {
        $birthday = $request->birthday ? Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d') : null;
        $registration_birthday = $request->registration_birthday ? Carbon::createFromFormat('d/m/Y', $request->registration_birthday)->format('Y-m-d') : null;
        $request->validate([
            'full_name' => 'nullable|string|max:255',
            'ethnicity' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'age' => 'nullable|integer|min:0',
            'age_months' => 'nullable|integer|min:0',
            'citizen_id' => 'nullable|string|max:20',
            'age_since_date' => 'nullable|date',
            'regis_house_number' => 'nullable|string|max:255',
            'regis_village' => 'nullable|string|max:255',
            'regis_road' => 'nullable|string|max:255',
            'regis_subdistrict' => 'nullable|string|max:255',
            'regis_district' => 'nullable|string|max:255',
            'regis_province' => 'nullable|string|max:255',
            'current_house_number' => 'nullable|string|max:255',
            'current_village' => 'nullable|string|max:255',
            'current_road' => 'nullable|string|max:255',
            'current_subdistrict' => 'nullable|string|max:255',
            'current_district' => 'nullable|string|max:255',
            'current_province' => 'nullable|string|max:255',
            'current_phone_number' => 'nullable|string|max:20',
            'number_of_siblings' => 'nullable|string|max:255',
            'congenital_disease' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',

            // // Validation Rules for Caregiver Information
            'father_name' => 'nullable|string|max:255',
            'edu_qual_father' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'edu_qual_mother' => 'nullable|string|max:255',
            'care_option' => 'nullable|string|max:255',
            'care_option_other' => 'nullable|string|max:255',
            'care_option_relative_text' => 'nullable|string|max:255',

            'caretaker_income' => 'nullable|string|max:255',
            'applicants_name' => 'nullable|string|max:255',
            'applicants_relevant' => 'nullable|string|max:255',
            'child_carrier_name' => 'nullable|string|max:255',
            'child_carrier_relevant' => 'nullable|string|max:255',
            'child_carrier_phone' => 'nullable|string|max:20',
            'father_occupation' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',

            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',

            // //Validation Rules for surrender_the_child
            'surrender_salutation' => 'nullable|string|max:255',
            'surrender_full_name' => 'nullable|string|max:255',
            'surrender_age' => 'nullable|integer|min:1|max:120',
            'surrender_occupation' => 'nullable|string|max:255',
            'surrender_income' => 'nullable|string|max:255',
            'surrender_village' => 'nullable|string|max:255',
            'surrender_alley_road' => 'nullable|string|max:255',
            'surrender_subdistrict' => 'nullable|string|max:255',
            'surrender_district' => 'nullable|string|max:255',
            'surrender_province' => 'nullable|string|max:255',
            'surrender_phone_number' => 'nullable|string|max:255',
            'surrender_childs_name' => 'nullable|string|max:255',
            'surrender_contact_location' => 'nullable|string|max:255',
            'surrender_contact_phone' => 'nullable|string|max:255',
            'surrender_child_recipient' => 'nullable|string|max:255',
            'child_recipient_relevant' => 'nullable|string|max:255',
            'child_recipient_related' => 'nullable|string|max:255',
            'child_recipient_phone' => 'nullable|string|max:255',
            'child_recipient_salutation' => 'nullable|string|max:255',
            'the_child_number' => 'nullable|string|max:255',
            'surrender_hour_number' => 'nullable|string|max:255',
        ]);

    //    dd($request);

        // Prepare data for insertion
        $ChildInformation = ChildInformation::create([
            'users_id' => auth()->id(),
            'status' => '1',
            'admin_name_verifier' => null,
            'full_name' => $request->full_name,
            'ethnicity' => $request->ethnicity,
            'nationality' => $request->nationality,
            'birthday' => $birthday,
            'age' => $request->age,
            'age_months' => $request->age_months,
            'citizen_id' => $request->citizen_id,
            'age_since_date' => $request->age_since_date,
            'regis_house_number' => $request->regis_house_number,
            'regis_village' => $request->regis_village,
            'regis_road' => $request->regis_road,
            'regis_subdistrict' => $request->regis_subdistrict,
            'regis_district' => $request->regis_district,
            'regis_province' => $request->regis_province,
            'current_house_number' => $request->current_house_number,
            'current_village' => $request->current_village,
            'current_road' => $request->current_road,
            'current_subdistrict' => $request->current_subdistrict,
            'current_district' => $request->current_district,
            'current_province' => $request->current_province,
            'current_phone_number' => $request->current_phone_number,
            'number_of_siblings' => $request->number_of_siblings,
            'congenital_disease' => $request->congenital_disease,
            'blood_group' => $request->blood_group,
            'the_child_number' => $request->the_child_number,
        ]);

        $caregiverInformation = CaregiverInformation::create([
            'child_information_id' => $ChildInformation->id,
            'father_name' => $request->father_name,
            'edu_qual_father' => $request->edu_qual_father,
            'mother_name' => $request->mother_name,
            'edu_qual_mother' => $request->edu_qual_mother,
            'care_option' => $request->care_option,
            'care_option_other' => $request->care_option == 'Other' ? $request->care_option_other : null,
            'care_option_relative_text' => $request->care_option_relative_text,
            'caretaker_income' => $request->caretaker_income,
            'applicants_name' => $request->applicants_name,
            'applicants_relevant' => $request->applicants_relevant,
            'child_carrier_name' => $request->child_carrier_name,
            'child_carrier_relevant' => $request->child_carrier_relevant,
            'child_carrier_phone' => $request->child_carrier_phone,
            'father_occupation' => $request->father_occupation,
            'mother_occupation' => $request->mother_occupation
        ]);

        $SurrenderTheChild = SurrenderTheChild::create([
            'child_information_id' => $ChildInformation->id,
            'salutation' => $request->surrender_salutation,
            'full_name' => $request->surrender_full_name,
            'age' => $request->surrender_age,
            'occupation' => $request->surrender_occupation,
            'income' => $request->surrender_income,
            'hour_number' => $request->surrender_hour_number,
            'village' => $request->surrender_village,
            'alley_road' => $request->surrender_alley_road,
            'subdistrict' => $request->surrender_subdistrict,
            'district' => $request->surrender_district,
            'province' => $request->surrender_province,
            'phone_number' => $request->surrender_phone_number,
            'childs_name' => $request->surrender_childs_name,
            'contact_location' => $request->surrender_contact_location,
            'contact_phone' => $request->surrender_contact_phone,
            'child_recipient' => $request->surrender_child_recipient,
            'child_recipient_relevant' => $request->child_recipient_relevant,
            'child_recipient_phone' => $request->child_recipient_phone,
            'child_recipient_related' => $request->child_recipient_related,
            'child_recipient_salutation' => $request->child_recipient_salutation,
            'child_surrender_salutation' => $request->child_surrender_salutation,
            'child_surrender_salutation1' => $request->child_surrender_salutation1,
            'child_salutation' => $request->child_salutation,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                ChildAttachment::create([
                    'child_information_id' => $ChildInformation->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function TableChildApplyUsersPages()
    {
        $forms = ChildInformation::with(['user', 'attachments', 'replies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.recruiting_children.account.show-detail', compact('forms'));
    }

    public function ChildApplyUserExportPDF($id)
    {
        $form = ChildInformation::with('caregiverInformation', 'surrenderTheChild', 'childRegistration')->find($id);

        if ($form->childRegistration->first() && $form->childRegistration->first()->ge_immunity) {
            $geImmunity = $form->childRegistration->first()->ge_immunity;
            $form->childRegistration->first()->ge_immunity = json_decode($geImmunity, true); // Decode JSON to array
        }

        $selectedOptions = $form->childRegistration->first()->ge_immunity ?? [];

        $pdf = Pdf::loadView('users.recruiting_children.pdf-form', compact('form', 'selectedOptions'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก' . $form->id . '.pdf');
    }

    public function ChildApplyUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        ChildReply::create([
            'child_information_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
}

<?php

namespace App\Http\Controllers\elderly_allowance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ElderlyAllowancePeople;
use App\Models\ElderlyAllowancePersonsOptions;
use App\Models\ElderlyAllowanceFiles;
use App\Models\ElderlyAllowanceBank;
use App\Models\ElderlyAllowanceReplies;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ElderlyAllowanceController extends Controller
{
     public function ElderlyAllowanceFormPage()
    {
        return view('users.elderly_allowance.page-form');
    }

    public function ElderlyAllowanceFormCreate(Request $request)
    {
        $written_date = Carbon::now()->format('Y-m-d');
        $birth_day = $request->birth_day ? Carbon::createFromFormat('d/m/Y', $request->birth_day)->format('Y-m-d') : null;

        $request->validate([
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // dd($request);

        $eaPeople = ElderlyAllowancePeople::create([
            'users_id' => auth()->id(),
            'status' => 1,
            'written_at' => $request->written_at,
            'written_date' => $written_date,
            'salutation' => $request->salutation,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_day' => $birth_day,
            'age' => $request->age,
            'nationality' => $request->nationality,
            'house_number' => $request->house_number,
            'village' => $request->village,
            'alley' => $request->alley,
            'road' => $request->road,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'citizen_id' => $request->citizen_id,
            'marital_status' => $request->marital_status,
            'monthly_income' => $request->monthly_income,
            'occupation' => $request->occupation,
            'community' => $request->community,
        ]);

        $eaPersonsOptions = ElderlyAllowancePersonsOptions::create([
            'ea_people_id' => $eaPeople->id,
            'welfare_type' => json_encode($request->welfare_type),
            'welfare_other_types' => $request->welfare_other_types,
            'request_for_money_type' => $request->request_for_money_type,
            'document_type' => json_encode($request->document_type),
        ]);

        if ($request->has('bank_option') && $request->bank_option == 1 && $request->filled('bank_name') && $request->filled('account_number') && $request->filled('account_name')) {
            $eaBankacOption = ElderlyAllowanceBank::create([
                'ea_people_id' => $eaPeople->id,
                'bank_option' => 1,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
            ]);
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('attachments', $filename, 'public');

                ElderlyAllowanceFiles::create([
                    'ea_people_id' => $eaPeople->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function ElderlyAllowanceShowDetails()
    {
        $forms = ElderlyAllowancePeople::with(['user', 'files', 'replies'])->get();

        return view('users.elderly_allowance.account.show-detail', compact('forms'));
    }

    public function ElderlyAllowanceUserShowEdit($id)
    {
        $form = ElderlyAllowancePeople::with('personsOption', 'files', 'bank')->findOrFail($id);

        if ($form->personsOption->first() && $form->personsOption->first()->welfare_type) {
            $welfareType = $form->personsOption->first()->welfare_type;
            if (is_string($welfareType)) {
                $form->personsOption->first()->welfare_type = json_decode($welfareType, true);
            }
        }

        return view('users.elderly_allowance.account.edit-data', compact('form'));
    }

    public function ElderlyAllowanceUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ElderlyAllowanceReplies::create([
            'ea_people_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function ElderlyAllowanceUserExportPDF($id)
    {
        $form = ElderlyAllowancePeople::with('personsOption', 'bank')->find($id);

        if ($form->personsOption->first() && $form->personsOption->first()->welfare_type) {
            $welfareType = $form->personsOption->first()->welfare_type;
            if (is_string($welfareType)) {
                $form->personsOption->first()->welfare_type = json_decode($welfareType, true);
            }
        }

        $documentType = $form->personsOption->first()->document_type ?? [];
        if (is_string($documentType)) {
            $documentType = json_decode($documentType, true);
        }

        $pdf = Pdf::loadView('users.elderly_allowance.pdf-form', compact('form', 'documentType'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('แบบคำขอยืนยันสิทธิรับเงินเบี้ยยังชีพผู้สูงอายุ' . $form->id . '.pdf');
    }
}

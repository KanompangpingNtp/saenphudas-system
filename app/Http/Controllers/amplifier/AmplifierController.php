<?php

namespace App\Http\Controllers\amplifier;

use App\Http\Controllers\Controller;
use App\Models\Amplifier;
use App\Models\AmplifierFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AmplifierReply;
use Barryvdh\DomPDF\Facade\Pdf;

class AmplifierController extends Controller
{
    public function AmplifierFormPage()
    {
        return view("users.amplifier.page-form");
    }

    public function AmplifierFormCreate(Request $request)
    {
        // dd($request);

        $request->validate([
            'full_name' => 'required|string',
            'age' => 'required|string',
            'ethnicity' => 'required|string',
            'nationality' => 'required|string',
            'house_number' => 'required|string',
            'village' => 'required|string',
            'sub_district' => 'required|string',
            'district' => 'required|string',
            'province' => 'required|string',
            'registration_number1' => 'required|string',
            'registration_number2' => 'required|string',
            'registration_number3' => 'required|string',
            'have_intention' => 'required|string',
            'location_at' => 'required|string',
            'location_number' => 'required|string',
            'location_village' => 'required|string',
            'location_sub_district' => 'required|string',
            'location_district' => 'required|string',
            'location_province' => 'required|string',
            'license_number' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240'
        ]);

        $amplifier = Amplifier::create([
            'users_id' => auth()->id(),
            'form_status' => 1,
            'written_at' => $request->written_at,
            'full_name' => $request->salutation . $request->full_name,
            'age' => $request->age,
            'ethnicity' => $request->ethnicity,
            'nationality' => $request->nationality,
            'house_number' => $request->house_number,
            'road' => $request->road,
            'village' => $request->village,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'registration_number1' => $request->registration_number1,
            'registration_number2' => $request->registration_number2,
            'registration_number3' => $request->registration_number3,
            'have_intention' => $request->have_intention,
            'location_at' => $request->location_at,
            'location_number' => $request->location_number,
            'location_road' => $request->location_road,
            'location_village' => $request->location_village,
            'location_sub_district' => $request->location_sub_district,
            'location_district' => $request->location_district,
            'location_province' => $request->location_province,
            'location_set' => $request->location_set,
            'location_start' => $request->location_start,
            'location_end' => $request->location_end,
            'status' => 1,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('amplifier_attachments', $filename, 'public');

                AmplifierFile::create([
                    'amplifier_id' => $amplifier->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function AmplifierShowDetails()
    {
        $forms = Amplifier::with(['user', 'files', 'replies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.amplifier.account.show-detail', compact('forms'));
    }

    public function AmplifierFileUserExportPDF($id)
    {
        $form = Amplifier::find($id);

        $pdf = Pdf::loadView('users.amplifier.pdf-form', compact('form'))->setPaper('A4', 'portrait');

        return $pdf->stream('คำร้องขออนุญาตทำการโฆษณาโดยใช้เครื่องขยายเสียง' . $form->id . '.pdf');
    }

    public function AmplifierFileUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        AmplifierReply::create([
            'amplifier_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
}

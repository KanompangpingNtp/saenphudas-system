<?php

namespace App\Http\Controllers\license_tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LicenseTaxInformations;
use App\Models\LicenseTaxFormDetails;
use App\Models\LicenseTaxFormFiles;
use App\Models\LicenseTaxOption;
use App\Models\LicenseTaxReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LicenseTax extends Controller
{
    public function LicenseTaxFormPage()
    {
        return view('users.license_tax.page-form');
    }

    public function LicenseTaxFormCreate(Request $request)
    {
        $LicenseTax = LicenseTaxInformations::create([
            'users_id' => auth()->id(),
            'form_status' => 1,
        ]);

        $LicenseTaxdetail = LicenseTaxFormDetails::create([
            'license_tax_id' => $LicenseTax->id,
            'salutation' => $request->salutation,
            'full_name' => $request->full_name,
            'build_name' => $request->build_name,
            'address' => $request->address,
            'alley' => $request->alley,
            'village' => $request->village,
            'road' => $request->road,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'telephone' => $request->telephone,
            'emp_fullname' => $request->emp_fullname,
        ]);

        foreach ($request->thai as $rs) {
            if ($rs['wide'] != '' || $rs['long'] != '' || $rs['meter'] != '' || $rs['amount'] != '' || $rs['text'] != '' || $rs['place'] != '' || $rs['date'] != '' || $rs['remark'] != '') {
                $LicenseTaxOption = LicenseTaxOption::create([
                    'license_tax_id' => $LicenseTax->id,
                    'type' => 1,
                    'wide' => $rs['wide'],
                    'long' => $rs['long'],
                    'meter' => $rs['meter'],
                    'amount' => $rs['amount'],
                    'text' => $rs['text'],
                    'place' => $rs['place'],
                    'date' => $rs['date'],
                    'remark' => $rs['remark']
                ]);
            }
        }
        foreach ($request->thaieng as $rs) {
            if ($rs['wide'] != '' || $rs['long'] != '' || $rs['meter'] != '' || $rs['amount'] != '' || $rs['text'] != '' || $rs['place'] != '' || $rs['date'] != '' || $rs['remark'] != '') {
                $LicenseTaxOption = LicenseTaxOption::create([
                    'license_tax_id' => $LicenseTax->id,
                    'type' => 2,
                    'wide' => $rs['wide'],
                    'long' => $rs['long'],
                    'meter' => $rs['meter'],
                    'amount' => $rs['amount'],
                    'text' => $rs['text'],
                    'place' => $rs['place'],
                    'date' => $rs['date'],
                    'remark' => $rs['remark']
                ]);
            }
        }
        foreach ($request->no_lang as $rs) {
            if ($rs['wide'] != '' || $rs['long'] != '' || $rs['meter'] != '' || $rs['amount'] != '' || $rs['text'] != '' || $rs['place'] != '' || $rs['date'] != '' || $rs['remark'] != '') {
                $LicenseTaxOption = LicenseTaxOption::create([
                    'license_tax_id' => $LicenseTax->id,
                    'type' => 3,
                    'wide' => $rs['wide'],
                    'long' => $rs['long'],
                    'meter' => $rs['meter'],
                    'amount' => $rs['amount'],
                    'text' => $rs['text'],
                    'place' => $rs['place'],
                    'date' => $rs['date'],
                    'remark' => $rs['remark']
                ]);
            }
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('attachments', $filename, 'public');

                LicenseTaxFormFiles::create([
                    'license_tax_id' => $LicenseTax->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    public function LicenseTaxShowDetails()
    {
        $forms = LicenseTaxInformations::with(['user', 'files', 'replies'])
            ->where('users_id', Auth::id())
            ->get();

        return view('users.license_tax.account.show-detail', compact('forms'));
    }

    public function LicenseTaxUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        LicenseTaxReplies::create([
            'license_tax_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function LicenseTaxUserExportPDF($id)
    {
        $form = LicenseTaxInformations::with('details')->find($id);

        $type1 = LicenseTaxOption::where('license_tax_id', $id)->where('type', 1)->orderBy('created_at', 'asc')->get();
        $type2 = LicenseTaxOption::where('license_tax_id', $id)->where('type', 2)->orderBy('created_at', 'asc')->get();
        $type3 = LicenseTaxOption::where('license_tax_id', $id)->where('type', 3)->orderBy('created_at', 'asc')->get();

        $pdf = Pdf::loadView('users.license_tax.pdf-form', compact('form', 'type1', 'type2', 'type3'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('(ภ.ป.๑) แนบแสดงรายการ ภาษีป้าย' . $form->id . '.pdf');
    }
}

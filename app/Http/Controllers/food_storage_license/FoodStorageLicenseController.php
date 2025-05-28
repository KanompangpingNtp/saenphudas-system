<?php

namespace App\Http\Controllers\food_storage_license;

use App\Http\Controllers\Controller;
use App\Models\FoodStorageAppointmentLogs;
use App\Models\FoodStorageExploreLogs;
use Illuminate\Http\Request;
use App\Models\FoodStorageType;
use App\Models\FoodStorageInformations;
use App\Models\FoodStorageFormDetails;
use App\Models\FoodStorageFormFiles;
use App\Models\FoodStorageFormReplies;
use App\Models\FoodStorageNumberLogs;
use App\Models\FoodStoragePaymentLogs;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class FoodStorageLicenseController extends Controller
{
    public function FoodStorageLicenseFormPage()
    {
        $types = FoodStorageType::all();

        return view('users.food_storage_license.page-form', compact('types'));
    }

    public function FoodStorageLicenseFormCreate(Request $request)
    {
        // dd($request);

        $FoodStorageInformations = FoodStorageInformations::create([
            'users_id' => auth()->id(),
            'form_status' => 1,
            'title_name' => $request->title_name,
            'salutation' => $request->salutation,
            'full_name' => $request->full_name,
            'age' => $request->age,
            'nationality' => $request->nationality,
            'id_card_number' => $request->id_card_number,
            'address' => $request->address,
            'village' => $request->village,
            'alley' => $request->alley,
            'road' => $request->road,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
            'telephone' => $request->telephone,
            'fax' => $request->fax,
        ]);

        $FoodStorageFormDetails = FoodStorageFormDetails::create([
            'informations_id' => $FoodStorageInformations->id,
            'confirm_option' => $request->confirm_option,
            'confirm_volume' => $request->confirm_volume,
            'confirm_number' => $request->confirm_number,
            'confirm_year' => $request->confirm_year,
            'confirm_expiration_date' => $request->confirm_expiration_date,
            'place_name' => $request->place_name,
            'shop_type' => $request->shop_type,
            'location' => $request->location,
            'details_village' => $request->details_village,
            'details_alley' => $request->details_alley,
            'details_road' => $request->details_road,
            'details_subdistrict' => $request->details_subdistrict,
            'details_district' => $request->details_district,
            'details_province' => $request->details_province,
            'details_telephone' => $request->details_telephone,
            'details_fax' => $request->details_fax,
            'business_area' => $request->business_area,
            'number_of_cooks' => $request->number_of_cooks,
            'number_of_food' => $request->number_of_food,
            'including_food_handlers' => $request->including_food_handlers,
            'number_of_trainees' => $request->number_of_trainees,
            'opening_hours' => $request->opening_hours,
            'opening_for_business_until' => $request->opening_for_business_until,
            'total_hours' => $request->total_hours,
            'document_option' => json_encode($request->document_option),
            'document_option_detail' => $request->document_option_detail,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $optionKey => $file) {
                $documentType = str_replace('option', '', $optionKey);

                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                FoodStorageFormFiles::create([
                    'informations_id' => $FoodStorageInformations->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'document_type' => $documentType,
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    // public function FoodStorageLicenseShowDetails()
    // {
    //     $forms = FoodStorageInformations::with(['user', 'files', 'replies', 'details'])
    //         ->where('users_id', Auth::id())
    //         ->get();
    //     if (!empty($forms)) {
    //         foreach ($forms as $rs) {
    //             $rs->appointmentte = FoodStorageAppointmentLogs::orderBy('id', 'desc')->first();
    //             $rs->payment = FoodStoragePaymentLogs::orderBy('id', 'desc')->first();
    //         }
    //     }

    //     return view('users.food_storage_license.account.show-detail', compact('forms'));
    // }
    public function FoodStorageLicenseShowDetails()
    {
        $originalForms = FoodStorageInformations::with(['user', 'files', 'replies', 'details'])
            ->where('users_id', Auth::id())
            ->whereNull('refer_information_id')
            ->get();

        $forms = collect();

        foreach ($originalForms as $form) {
            $latest = FoodStorageInformations::with(['user', 'files', 'replies', 'details'])
                ->where('refer_information_id', $form->id)
                ->orderByDesc('created_at')
                ->first();

            $finalForm = $latest ?? $form;

            $finalForm->appointmentte = FoodStorageAppointmentLogs::where('informations_id', $finalForm->id)
                ->orderBy('id', 'desc')
                ->first();

            $finalForm->payment = FoodStoragePaymentLogs::where('informations_id', $finalForm->id)
                ->orderBy('id', 'desc')
                ->first();

            $forms->push($finalForm);
        }

        return view('users.food_storage_license.account.show-detail', compact('forms'));
    }


    public function FoodStorageLicenseUserExportPDF($id)
    {
        $form = FoodStorageInformations::with(['details' => function ($query) {
            $query->where('confirm_option', 1);
        }])->find($id);

        $details = $form->details->first();
        $document_option = $details->document_option ?? [];

        if (is_string($document_option)) {
            $document_option = json_decode($document_option, true);
        }

        $document_option = is_array($document_option) ? $document_option : [];


        $pdf = Pdf::loadView(
            'users.food_storage_license.pdf-form',
            compact('form', 'document_option')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function FoodStorageLicenseUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // dd($request);

        FoodStorageFormReplies::create([
            'informations_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function FoodStorageLicenseUserShowFormEdit($id)
    {
        $form = FoodStorageInformations::with('files', 'details')->findOrFail($id);

        if ($form['details'] && $form['details']->document_option) {
            $document_option = $form['details']->document_option;
            if (is_string($document_option)) {
                $form['details']->document_option = json_decode($document_option, true);
            }
        }

        return view('users.food_storage_license.account.edit-data', compact('form'));
    }

    public function CertificateFoodStorageLicensePDF($id)
    {
        $form = FoodStorageInformations::find($id);

        $explore = FoodStorageExploreLogs::where('informations_id', $form->id)->first();

        $file = FoodStoragePaymentLogs::where('informations_id', $form->id)->first();

        $info_number = FoodStorageNumberLogs::where('informations_id', $form->id)->first();

        if ($form['details']->confirm_option == 2) {
            $views = "users.food_storage_license.account.pdf.food_storage_license";
        } else {
            $views = "users.food_storage_license.account.pdf.food_sales";
        }
        $pdf = Pdf::loadView(
            $views,
            compact('form', 'file', 'info_number', 'explore')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function CertificateFoodSalesPDF($id)
    {
        $form = FoodStorageInformations::with(['details' => function ($query) {
            $query->where('confirm_option', 2);
        }])->find($id);

        $document_option = $form->details->first()->document_option ?? [];
        if (is_string($document_option)) {
            $document_option = json_decode($document_option, true);
        }

        $pdf = Pdf::loadView(
            'certificate.food_sales',
            compact('form', 'document_option')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function FoodStorageLicenseDetail($id)
    {
        $form = FoodStorageInformations::with(['user', 'details', 'files', 'replies'])
            ->find($id);

        if ($form['details']->document_option != 'null') {
            $document_option = $form['details']->document_option;
            if (is_string($document_option)) {
                $form['details']->document_option = json_decode($document_option, true);
            }
        } else {
            $form['details']->document_option = [];
        }
        $types = FoodStorageType::all();

        return view('users.food_storage_license.account.detail', compact('form', 'types'));
    }

    public function FoodStorageLicenseCalendar($id)
    {
        $form = FoodStorageInformations::with(['user', 'details', 'files', 'replies'])->find($id);
        $calendar = FoodStorageAppointmentLogs::orderBy('id', 'desc')->where('informations_id', $id)->first();

        return view('users.food_storage_license.account.calendar', compact('form', 'calendar'));
    }

    public function FoodStorageLicenseCalendarSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = FoodStorageFormDetails::where('informations_id', $input['id'])->first();
            if ($input['result'] != 2) {
                $detail->status = 6;
            } else {
                $detail->status = 5;
            }
            $detail->updated_at = date('Y-m-d H:i:s');
            if ($detail->save()) {
                $calendar = FoodStorageAppointmentLogs::orderBy('id', 'desc')->where('informations_id', $input['id'])->first();
                $calendar->date_user = $input['date_user'];
                $calendar->status = 2;
                $calendar->updated_at = date('Y-m-d H:i:s');
                if ($calendar->save()) {
                    return redirect()->route('FoodStorageLicenseShowDetails')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('FoodStorageLicenseShowDetails')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function FoodStorageLicensePayment($id)
    {
        $form = FoodStorageInformations::with(['user', 'details', 'files', 'replies'])->find($id);
        $info = FoodStorageExploreLogs::where('informations_id', $id)->orderBy('id', 'desc')->first();

        return view('users.food_storage_license.account.payment-check', compact('form', 'info'));
    }

    public function FoodStorageLicensePaymentSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $path = '';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payment', $filename, 'public');
            }
            $detail = FoodStorageFormDetails::where('informations_id', $input['id'])->first();
            $detail->status = 9;
            if ($detail->save()) {
                $insert = new FoodStoragePaymentLogs();
                $insert->informations_id = $input['id'];
                $insert->file = $path;
                $insert->status = 1;
                $insert->created_at = date('Y-m-d H:i:s');
                $insert->updated_at = date('Y-m-d H:i:s');
                if ($insert->save()) {
                    return redirect()->route('FoodStorageLicenseShowDetails')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('FoodStorageLicenseShowDetails')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function FoodStorageLicenseUserChecklistPDF($id)
    {
        $form = FoodStorageInformations::find($id);

        $document_option = FoodStorageExploreLogs::where('informations_id', $id)->first();

        $pdf = Pdf::loadView(
            'users.food_storage_license.account.pdf.food_checklist',
            compact('form', 'document_option')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }
}

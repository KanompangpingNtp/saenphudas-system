<?php

namespace App\Http\Controllers\health_hazard_applications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthLicenseApp;
use App\Models\HealthLicenseAppointmentLogs;
use App\Models\HealthLicenseDetail;
use App\Models\HealthLicenseExploreLogs;
use App\Models\HealthLicenseFiles;
use App\Models\HealthLicenseNumberLogs;
use App\Models\HealthLicensePaymentLogs;
use App\Models\HealthLicenseReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class HealthHazardApplicationController extends Controller
{
    public function HealthHazardApplicationFormPage()
    {
        return view('users.health_hazard_applications.page-form');
    }

    public function HealthHazardApplicationFormCreate(Request $request)
    {
        // dd($request);

        $HealthLicenseApp = HealthLicenseApp::create([
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

        $HealthLicenseDetail = HealthLicenseDetail::create([
            'health_license_id' => $HealthLicenseApp->id,
            'type_request' => $request->type_request,
            'petition' => $request->petition,
            'name_establishment' => $request->name_establishment,
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
            'machine_power' => $request->machine_power,
            'number_male_workers' => $request->number_male_workers,
            'number_female_workers' => $request->number_female_workers,
            'opening_hours' => $request->opening_hours,
            'opening_for_business_until' => $request->opening_for_business_until,
            'document_option' => json_encode($request->document_option),
            'document_option_detail' => $request->document_option_detail,
            'status' => 1,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $optionKey => $file) {
                $documentType = str_replace('option', '', $optionKey);

                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                HealthLicenseFiles::create([
                    'health_license_id' => $HealthLicenseApp->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'document_type' => $documentType,
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว');
    }

    // public function HealthHazardApplicationShowDetails()
    // {
    //     $forms = HealthLicenseApp::with(['user', 'files', 'replies', 'details'])
    //         ->where('users_id', Auth::id())
    //         ->get();
    //     if (!empty($forms)) {
    //         foreach ($forms as $rs) {
    //             $rs->appointmentte = HealthLicenseAppointmentLogs::orderBy('id', 'desc')->first();
    //             $rs->payment = HealthLicensePaymentLogs::orderBy('id', 'desc')->first();
    //         }
    //     }

    //     return view('users.health_hazard_applications.account.show-detail', compact('forms'));
    // }

    public function HealthHazardApplicationShowDetails()
    {
        $originalForms = HealthLicenseApp::with(['user', 'files', 'replies', 'details'])
            ->where('users_id', Auth::id())
            ->whereNull('refer_app_id')
            ->get();

        $forms = collect();

        foreach ($originalForms as $form) {
            $latest = HealthLicenseApp::with(['user', 'files', 'replies', 'details'])
                ->where('refer_app_id', $form->id)
                ->orderByDesc('created_at')
                ->first();

            $finalForm = $latest ?? $form;

            $finalForm->appointmentte = HealthLicenseAppointmentLogs::where('health_license_id', $finalForm->id)
                ->orderBy('id', 'desc')
                ->first();

            $finalForm->payment = HealthLicensePaymentLogs::where('health_license_id', $finalForm->id)
                ->orderBy('id', 'desc')
                ->first();

            $forms->push($finalForm);
        }

        return view('users.health_hazard_applications.account.show-detail', compact('forms'));
    }


    public function HealthHazardApplicationUserExportPDF($id)
    {
        $form = HealthLicenseApp::with('details')->find($id);

        $pdf = Pdf::loadView(
            'users.health_hazard_applications.pdf-form',
            compact('form')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function HealthHazardApplicationUserReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // dd($request);

        HealthLicenseReplies::create([
            'health_license_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function HealthHazardApplicationUserShowFormEdit($id)
    {
        $form = HealthLicenseApp::with('files', 'details')->findOrFail($id);

        if ($form->details->first() && $form->details->first()->document_option) {
            $document_option = $form->details->first()->document_option;
            if (is_string($document_option)) {
                $form->details->first()->document_option = json_decode($document_option, true);
            }
        }

        return view('users.health_hazard_applications.account.edit-data', compact('form'));
    }

    public function CertificateHealthHazardPDF($id)
    {
        $form = HealthLicenseApp::with('details')->find($id);

        $file = HealthLicensePaymentLogs::where('health_license_id', $form->id)->first();

        $explore = HealthLicenseExploreLogs::where('health_license_id', $form->id)->first();

        $info_number = HealthLicenseNumberLogs::where('health_license_id', $form->id)->first();

        $pdf = Pdf::loadView(
            'users.health_hazard_applications.account.pdf.health_hazard_applications',
            compact('form', 'file', 'explore', 'info_number')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function HealthHazardApplicationDetail($id)
    {
        $form = HealthLicenseApp::with(['user', 'details', 'files', 'replies'])
            ->find($id);

        if ($form['details']->document_option != 'null') {
            $document_option = $form['details']->document_option;
            if (is_string($document_option)) {
                $form['details']->document_option = json_decode($document_option, true);
            }
        } else {
            $form['details']->document_option = [];
        }

        return view('admin.health_hazard_applications.detail', compact('form'));
    }

    public function HealthHazardApplicationCalendar($id)
    {
        $form = HealthLicenseApp::with(['user', 'details', 'files', 'replies'])->find($id);
        $calendar = HealthLicenseAppointmentLogs::orderBy('id', 'desc')->where('health_license_id', $id)->first();

        return view('users.health_hazard_applications.account.calendar', compact('form', 'calendar'));
    }

    public function HealthHazardApplicationCalendarSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = HealthLicenseDetail::where('health_license_id', $input['id'])->first();
            if ($input['result'] != 2) {
                $detail->status = 6;
            } else {
                $detail->status = 5;
            }
            $detail->updated_at = date('Y-m-d H:i:s');
            if ($detail->save()) {
                $calendar = HealthLicenseAppointmentLogs::orderBy('id', 'desc')->where('health_license_id', $input['id'])->first();
                $calendar->date_user = $input['date_user'];
                $calendar->status = 2;
                $calendar->updated_at = date('Y-m-d H:i:s');
                if ($calendar->save()) {
                    return redirect()->route('HealthHazardApplicationShowDetails')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('HealthHazardApplicationShowDetails')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function HealthHazardApplicationPayment($id)
    {
        $form = HealthLicenseApp::with(['user', 'details', 'files', 'replies'])->find($id);
        $info = HealthLicenseExploreLogs::where('health_license_id', $id)->orderBy('id', 'desc')->first();

        return view('users.health_hazard_applications.account.payment-check', compact('form', 'info'));
    }

    public function HealthHazardApplicationPaymentSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $path = '';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payment', $filename, 'public');
            }
            $detail = HealthLicenseDetail::where('health_license_id', $input['id'])->first();
            $detail->status = 9;
            if ($detail->save()) {
                $insert = new HealthLicensePaymentLogs();
                $insert->health_license_id = $input['id'];
                $insert->file = $path;
                $insert->status = 1;
                $insert->created_at = date('Y-m-d H:i:s');
                $insert->updated_at = date('Y-m-d H:i:s');
                if ($insert->save()) {
                    return redirect()->route('HealthHazardApplicationShowDetails')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('HealthHazardApplicationShowDetails')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }
}

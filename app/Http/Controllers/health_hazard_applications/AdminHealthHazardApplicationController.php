<?php

namespace App\Http\Controllers\health_hazard_applications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthLicenseApp;
use App\Models\HealthLicenseAppointmentLogs;
use App\Models\HealthLicenseDetail;
use App\Models\HealthLicenseExploreLogs;
use App\Models\HealthLicenseLogs;
use App\Models\HealthLicenseNumberLogs;
use App\Models\HealthLicensePaymentLogs;
use App\Models\HealthLicenseReplies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminHealthHazardApplicationController extends Controller
{
    public function HealthHazardApplicationAdminShowData()
    {
        $forms = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [1, 2]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.health_hazard_applications.show-data', compact('forms'));
    }

    public function HealthHazardApplicationAdminExportPDF($id)
    {
        $form = HealthLicenseApp::with('details')->find($id);

        $document_option = $form->details->first()->document_option ?? [];
        if (is_string($document_option)) {
            $document_option = json_decode($document_option, true);
        }

        $pdf = Pdf::loadView(
            'users.health_hazard_applications.pdf-form',
            compact('form', 'document_option')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function HealthHazardApplicationAdminReply(Request $request, $formId)
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

    public function HealthHazardApplicationUpdateStatus($id)
    {
        $form = HealthLicenseApp::findOrFail($id);

        $form->form_status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }

    public function HealthHazardApplicationAdminConfirm($id)
    {
        $form = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [1, 2]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->find($id);

        if ($form['details']->document_option != 'null') {
            $document_option = $form['details']->document_option;
            if (is_string($document_option)) {
                $form['details']->document_option = json_decode($document_option, true);
            }
        } else {
            $form['details']->document_option = [];
        }

        return view('admin.health_hazard_applications.confirm', compact('form'));
    }

    public function HealthHazardApplicationAdminConfirmSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = HealthLicenseDetail::where('health_license_id', $input['id'])->first();
            $detail->type_request = $input['type_request'];
            $detail->petition = $input['petition'];
            if ($input['result'] != 2) {
                $detail->status = 3;
                if ($detail->save()) {
                    return redirect()->route('HealthHazardApplicationAdminShowData')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            } else {
                $detail->status = 2;
                if ($detail->save()) {
                    $insert = new HealthLicenseLogs();
                    $insert->health_license_id = $input['id'];
                    $insert->detail = $input['detail'];
                    $insert->created_at = date('Y-m-d H:i:s');
                    $insert->updated_at = date('Y-m-d H:i:s');
                    if ($insert->save()) {
                        return redirect()->route('HealthHazardApplicationAdminShowData')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }
        return redirect()->route('HealthHazardApplicationAdminShowData')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function HealthHazardApplicationAdminDetail($id)
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

    public function HealthHazardApplicationAdminAppointment()
    {
        $forms = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [3, 4, 5, 8]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->appointmentte = HealthLicenseAppointmentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.health_hazard_applications.appointment', compact('forms'));
    }

    public function HealthHazardApplicationAdminCalendar($id)
    {
        $form = HealthLicenseApp::with(['user', 'details', 'files', 'replies'])->find($id);

        return view('admin.health_hazard_applications.calendar', compact('form'));
    }

    public function HealthHazardApplicationAdminCalendarSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = HealthLicenseDetail::where('health_license_id', $input['id'])->first();
            $detail->status = 4;
            if ($detail->save()) {
                $insert = new HealthLicenseAppointmentLogs();
                $insert->health_license_id = $input['id'];
                $insert->title = $input['title'];
                $insert->detail = $input['detail'];
                $insert->date_admin = $input['date_admin'];
                $insert->status = 1;
                $insert->created_at = date('Y-m-d H:i:s');
                $insert->updated_at = date('Y-m-d H:i:s');
                if ($insert->save()) {
                    return redirect()->route('HealthHazardApplicationAdminAppointment')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('HealthHazardApplicationAdminAppointment')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function HealthHazardApplicationAdminExplore()
    {
        $forms = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [6]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->appointmentte = HealthLicenseAppointmentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.health_hazard_applications.explore', compact('forms'));
    }

    public function HealthHazardApplicationAdminChecklist($id)
    {
        $form = HealthLicenseApp::with(['user', 'details', 'files', 'replies'])->find($id);

        return view('admin.health_hazard_applications.checklist', compact('form'));
    }

    public function HealthHazardApplicationAdminChecklistSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $path = '';
            if ($request->hasFile('formFile')) {
                $file = $request->file('formFile');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('checklist', $filename, 'public');
            }
            $detail = HealthLicenseDetail::where('health_license_id', $input['id'])->first();
            if ($input['result'] != 2) {
                $detail->status = 7;
                if ($detail->save()) {
                    $insert = new HealthLicenseExploreLogs();
                    $insert->health_license_id = $input['id'];
                    $insert->detail = $input['detail'];
                    $insert->price = $input['price'];
                    $insert->file = $path;
                    $insert->status = 1;
                    $insert->created_at = date('Y-m-d H:i:s');
                    $insert->updated_at = date('Y-m-d H:i:s');
                    if ($insert->save()) {
                        return redirect()->route('HealthHazardApplicationAdminExplore')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            } else {
                $detail->status = 8;
                if ($detail->save()) {
                    $insert = new HealthLicenseExploreLogs();
                    $insert->health_license_id = $input['id'];
                    $insert->detail = $input['detail'];
                    $insert->price = $input['price'];
                    $insert->file = $path;
                    $insert->status = 2;
                    $insert->created_at = date('Y-m-d H:i:s');
                    $insert->updated_at = date('Y-m-d H:i:s');
                    if ($insert->save()) {
                        return redirect()->route('HealthHazardApplicationAdminExplore')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }
        return redirect()->route('HealthHazardApplicationAdminExplore')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function HealthHazardApplicationAdminPayment()
    {
        $forms = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [7, 9]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->payment = HealthLicensePaymentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.health_hazard_applications.payment', compact('forms'));
    }

    public function HealthHazardApplicationAdminPaymentCheck($id)
    {
        $form = HealthLicenseApp::with(['user', 'details', 'files', 'replies'])->find($id);

        $file = HealthLicensePaymentLogs::where('health_license_id', $id)->first();
        return view('admin.health_hazard_applications.payment-check', compact('form', 'file'));
    }

    public function HealthHazardApplicationAdminPaymentSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = HealthLicenseDetail::where('health_license_id', $input['id'])->first();
            $detail->status = 10;
            if ($detail->save()) {
                $path = '';
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('payment', $filename, 'public');
                }

                $createdAt = Carbon::now();

                $update = HealthLicensePaymentLogs::find($input['file-id']);
                $update->receipt_book = $input['receipt_book'];
                $update->receipt_number = $input['receipt_number'];
                $update->file_treasury = $path;
                $update->status = 2;
                $update->updated_at = now();
                $update->expiration_date = $createdAt->copy()->addYear()->subDay();
                if ($update->save()) {
                    $number = HealthLicenseNumberLogs::orderBy('id', 'desc')->first();
                    if ($number) {
                        $run_book = $number->book + 1;
                        $run_number = $number->number + 1;
                    } else {
                        $run_number = 1;
                        $run_book = 91;
                    }

                    $insert = new HealthLicenseNumberLogs();
                    $insert->health_license_id = $input['id'];
                    $insert->number = $run_number;
                    $insert->book = $run_book;
                    $insert->year = date('Y') + 543;
                    $insert->created_at = date('Y-m-d');
                    $insert->updated_at = date('Y-m-d');
                    if ($insert->save()) {
                        return redirect()->route('HealthHazardApplicationAdminPayment')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }
        return redirect()->route('HealthHazardApplicationAdminPayment')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function HealthHazardApplicationAdminApprove()
    {
        $forms = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [10, 11]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->payment = HealthLicensePaymentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.health_hazard_applications.approve', compact('forms'));
    }

    public function AdminCertificateHealthHazardApplicationPDF($id)
    {
        $form = HealthLicenseApp::find($id);

        $file = HealthLicensePaymentLogs::where('health_license_id', $form->id)->first();

        $explore = HealthLicenseExploreLogs::where('health_license_id', $form->id)->first();

        $info_number = HealthLicenseNumberLogs::where('health_license_id', $form->id)->first();

        $pdf = Pdf::loadView(
            "admin.health_hazard_applications.pdf.health_hazard_applications",
            compact('form', 'file', 'explore', 'info_number')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function CertificateHealthHazardApplicationCoppy(Request $request)
    {
        $id = $request->input('id');
        $original = HealthLicenseApp::with('details')->findOrFail($id);

        if ($original->details) {
            $original->details->status = 11;
            $original->details->save();
        }

        $newInfo = $original->replicate();
        $newInfo->form_status = 1;
        $newInfo->refer_app_id = $original->id;
        $newInfo->created_at = now();
        $newInfo->updated_at = now();
        $newInfo->save();

        if ($original->details) {
            $newDetails = $original->details->replicate();
            $newDetails->health_license_id = $newInfo->id;
            $newDetails->status = 7;
            $newDetails->created_at = now();
            $newDetails->updated_at = now();
            $newDetails->save();
        }

        $appointments = HealthLicenseAppointmentLogs::where('health_license_id', $original->id)->get();
        foreach ($appointments as $appointment) {
            $newAppointment = $appointment->replicate();
            $newAppointment->health_license_id = $newInfo->id;
            $newAppointment->created_at = now();
            $newAppointment->updated_at = now();
            $newAppointment->save();
        }

        $explores = HealthLicenseExploreLogs::where('health_license_id', $original->id)->get();
        foreach ($explores as $explore) {
            $newExplore = $explore->replicate();
            $newExplore->health_license_id = $newInfo->id;
            $newExplore->created_at = now();
            $newExplore->updated_at = now();
            $newExplore->save();
        }

        return response()->json(['success' => true, 'message' => 'คัดลอกข้อมูลเรียบร้อยแล้ว']);
    }

    public function CertificateHealthHazardApplicationExpire(Request $request)
    {
        $ninetyDaysFromNow = Carbon::now()->addDays(90);

        // รับค่าเดือนและปีจากฟอร์ม
        $month = $request->input('month');
        $year = $request->input('year');

        $startDate = null;
        $endDate = null;

        if ($month && $year) {
            // กำหนดช่วงเวลาตามเดือนและปีที่เลือก
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        }

        // ตรวจสอบว่ามีข้อมูลในเดือนและปีที่เลือกหรือไม่
        $availableMonths = range(1, 12); // เดือนทั้งหมด
        $availableYears = range(now()->year - 5, now()->year + 1); // ปีทั้งหมด

        // กรองข้อมูลที่ตรงกับเดือนและปีที่เลือก
        $forms = HealthLicenseApp::whereHas('details', function ($query) {
            $query->whereIn('status', [10, 11]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->get()
            ->filter(function ($form) use ($ninetyDaysFromNow, $startDate, $endDate) {
                $latestPayment = HealthLicensePaymentLogs::where('health_license_id', $form->id)
                    ->orderBy('id', 'desc')
                    ->first();

                if ($latestPayment && $latestPayment->expiration_date) {
                    $form->payment = $latestPayment;

                    $isWithin90Days = Carbon::parse($latestPayment->expiration_date)->lessThanOrEqualTo($ninetyDaysFromNow);

                    if ($startDate && $endDate) {
                        return Carbon::parse($latestPayment->created_at)->between($startDate, $endDate) && $isWithin90Days;
                    }

                    return $isWithin90Days;
                }

                return false;
            });

        // ตรวจสอบว่าในแต่ละเดือนและปีมีข้อมูลหรือไม่
        $availableMonths = collect($availableMonths)->filter(function ($m) use ($forms) {
            return $forms->filter(function ($form) use ($m) {
                return Carbon::parse($form->payment->created_at)->month == $m;
            })->isNotEmpty();
        });

        $availableYears = collect($availableYears)->filter(function ($y) use ($forms) {
            return $forms->filter(function ($form) use ($y) {
                return Carbon::parse($form->payment->created_at)->year == $y;
            })->isNotEmpty();
        });

        return view('admin.health_hazard_applications.expire-details', compact('forms', 'availableMonths', 'availableYears'));
    }
}

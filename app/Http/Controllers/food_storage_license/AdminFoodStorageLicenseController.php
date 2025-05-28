<?php

namespace App\Http\Controllers\food_storage_license;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodStorageAppointmentLogs;
use App\Models\FoodStorageExploreLogs;
use App\Models\FoodStorageFormDetails;
use App\Models\FoodStorageInformations;
use App\Models\FoodStorageFormReplies;
use App\Models\FoodStorageLogs;
use App\Models\FoodStorageNumberLogs;
use App\Models\FoodStoragePaymentLogs;
use App\Models\FoodStorageType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminFoodStorageLicenseController extends Controller
{
    public function FoodStorageLicenseAdminShowData()
    {
        $forms = FoodStorageInformations::whereHas('details', function ($query) {
            $query->whereIn('status', [1, 2]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.food_storage_license.show-data', compact('forms'));
    }

    public function FoodStorageLicenseAdminExportPDF($id)
    {
        $form = FoodStorageInformations::with('details')->find($id);

        $document_option = $form->details->first()->document_option ?? [];
        if (is_string($document_option)) {
            $document_option = json_decode($document_option, true);
        }

        $pdf = Pdf::loadView(
            'users.food_storage_license.pdf-form',
            compact('form', 'document_option')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function FoodStorageLicenseAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        FoodStorageFormReplies::create([
            'informations_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function FoodStorageLicenseUpdateStatus($id)
    {
        $form = FoodStorageInformations::findOrFail($id);

        $form->form_status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }

    public function FoodStorageLicenseAdminDetail($id)
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

        return view('admin.food_storage_license.detail', compact('form', 'types'));
    }

    public function FoodStorageLicenseAdminConfirm($id)
    {
        $form = FoodStorageInformations::whereHas('details', function ($query) {
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
        $types = FoodStorageType::all();

        return view('admin.food_storage_license.confirm', compact('form', 'types'));
    }

    public function FoodStorageLicenseAdminConfirmSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = FoodStorageFormDetails::where('informations_id', $input['id'])->first();
            if ($input['result'] != 2) {
                $detail->status = 3;
                if ($detail->save()) {
                    return redirect()->route('FoodStorageLicenseAdminShowData')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            } else {
                $detail->status = 2;
                if ($detail->save()) {
                    $insert = new FoodStorageLogs();
                    $insert->informations_id = $input['id'];
                    $insert->detail = $input['detail'];
                    $insert->created_at = date('Y-m-d H:i:s');
                    $insert->updated_at = date('Y-m-d H:i:s');
                    if ($insert->save()) {
                        return redirect()->route('FoodStorageLicenseAdminShowData')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }
        return redirect()->route('FoodStorageLicenseAdminShowData')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function FoodStorageLicenseAdminAppointment()
    {
        $forms = FoodStorageInformations::whereHas('details', function ($query) {
            $query->whereIn('status', [3, 4, 5, 8]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->appointmentte = FoodStorageAppointmentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.food_storage_license.appointment', compact('forms'));
    }

    public function FoodStorageLicenseAdminCalendar($id)
    {
        $form = FoodStorageInformations::with(['user', 'details', 'files', 'replies'])->find($id);

        return view('admin.food_storage_license.calendar', compact('form'));
    }

    public function FoodStorageLicenseAdminCalendarSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = FoodStorageFormDetails::where('informations_id', $input['id'])->first();
            $detail->status = 4;
            if ($detail->save()) {
                $insert = new FoodStorageAppointmentLogs();
                $insert->informations_id = $input['id'];
                $insert->title = $input['title'];
                $insert->detail = $input['detail'];
                $insert->date_admin = $input['date_admin'];
                $insert->status = 1;
                $insert->created_at = date('Y-m-d H:i:s');
                $insert->updated_at = date('Y-m-d H:i:s');
                if ($insert->save()) {
                    return redirect()->route('FoodStorageLicenseAdminAppointment')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('FoodStorageLicenseAdminAppointment')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function FoodStorageLicenseAdminExplore()
    {
        $forms = FoodStorageInformations::whereHas('details', function ($query) {
            $query->whereIn('status', [6]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->appointmentte = FoodStorageAppointmentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.food_storage_license.explore', compact('forms'));
    }

    public function FoodStorageLicenseAdminChecklist($id)
    {
        $form = FoodStorageInformations::with(['user', 'details', 'files', 'replies'])->find($id);

        return view('admin.food_storage_license.checklist', compact('form'));
    }

    public function FoodStorageLicenseAdminChecklistSave(Request $request)
    {
        $input = $request->input();

        if ($input['id']) {
            $detail = FoodStorageFormDetails::where('informations_id', $input['id'])->first();

            if ($input['result'] != 2) {
                $detail->status = 7;
                if ($detail->save()) {
                    $insert = new FoodStorageExploreLogs();
                    $insert->informations_id = $input['id'];
                    $insert->detail = $input['detail'];
                    $insert->price = $input['price'];
                    $insert->status = 1;
                    $insert->business_type = $input['business_type'] ?? null;
                    $insert->inspection_type = $input['inspection_type'] ?? null;
                    $insert->name_establishment = $input['name_establishment'] ?? null;
                    $insert->owner_name = $input['owner_name'] ?? null;
                    $insert->manager_name = $input['manager_name'] ?? null;
                    $insert->location = $input['location'] ?? null;
                    $insert->village = $input['village'] ?? null;
                    $insert->alley = $input['alley'] ?? null;
                    $insert->road = $input['road'] ?? null;
                    $insert->subdistrict = $input['subdistrict'] ?? null;
                    $insert->district = $input['district'] ?? null;
                    $insert->province = $input['province'] ?? null;
                    $insert->phone = $input['phone'] ?? null;
                    $insert->fax = $input['fax'] ?? null;
                    $characteristics = $input['characteristics_options'] ?? [];
                    $insert->characteristics_options = json_encode($characteristics);
                    $insert->characteristics_floor = $input['characteristics_floor'] ?? null;
                    $insert->characteristics_floor_no = $input['characteristics_floor_no'] ?? null;
                    $insert->characteristics_area = $input['characteristics_area'] ?? null;
                    $insert->sanitary_option1 = $input['sanitary_option1'];
                    $insert->sanitary_option2 = $input['sanitary_option2'];
                    $insert->sanitary_option2_detail = $input['sanitary_option2_detail'];
                    $insert->sanitary_option3 = $input['sanitary_option3'];
                    $insert->sanitary_option4 = $input['sanitary_option4'];
                    $insert->sanitary_option5 = $input['sanitary_option5'];
                    $insert->sanitary_option6 = $input['sanitary_option6'];
                    $insert->sanitary_option7 = $input['sanitary_option7'];
                    $insert->sanitary_option8 = $input['sanitary_option8'];
                    $insert->sanitary_option9 = $input['sanitary_option9'];
                    $insert->sanitary_option10 = $input['sanitary_option10'];
                    $insert->sanitary_option11 = $input['sanitary_option11'];
                    $insert->food_handlers = $input['food_handlers'] ?? null;
                    $insert->cook = $input['cook'] ?? null;
                    $insert->server = $input['server'] ?? null;
                    $insert->health_check_option = $input['health_check_option'] ?? null;
                    $insert->dressing_option = $input['dressing_option'] ?? null;
                    $insert->training_option = $input['training_option'] ?? null;
                    $insert->extinguisher_option = $input['extinguisher_option'] ?? null;

                    if ($insert->save()) {
                        return redirect()->route('FoodStorageLicenseAdminExplore')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            } else {
                $detail->status = 8;
                if ($detail->save()) {
                    $insert = new FoodStorageExploreLogs();
                    $insert->informations_id = $input['id'];
                    $insert->detail = $input['detail'];
                    $insert->price = $input['price'];
                    $insert->status = 2;
                    $insert->business_type = $input['business_type'] ?? null;
                    $insert->inspection_type = $input['inspection_type'] ?? null;
                    $insert->name_establishment = $input['name_establishment'] ?? null;
                    $insert->owner_name = $input['owner_name'] ?? null;
                    $insert->manager_name = $input['manager_name'] ?? null;
                    $insert->location = $input['location'] ?? null;
                    $insert->village = $input['village'] ?? null;
                    $insert->alley = $input['alley'] ?? null;
                    $insert->road = $input['road'] ?? null;
                    $insert->subdistrict = $input['subdistrict'] ?? null;
                    $insert->district = $input['district'] ?? null;
                    $insert->province = $input['province'] ?? null;
                    $insert->phone = $input['phone'] ?? null;
                    $insert->fax = $input['fax'] ?? null;
                    $characteristics = $input['characteristics_options'] ?? [];
                    $insert->characteristics_options = json_encode($characteristics);
                    $insert->characteristics_floor = $input['characteristics_floor'] ?? null;
                    $insert->characteristics_floor_no = $input['characteristics_floor_no'] ?? null;
                    $insert->characteristics_area = $input['characteristics_area'] ?? null;
                    $insert->sanitary_option1 = $input['sanitary_option1'];
                    $insert->sanitary_option2 = $input['sanitary_option2'];
                    $insert->sanitary_option2_detail = $input['sanitary_option2_detail'];
                    $insert->sanitary_option3 = $input['sanitary_option3'];
                    $insert->sanitary_option4 = $input['sanitary_option4'];
                    $insert->sanitary_option5 = $input['sanitary_option5'];
                    $insert->sanitary_option6 = $input['sanitary_option6'];
                    $insert->sanitary_option7 = $input['sanitary_option7'];
                    $insert->sanitary_option8 = $input['sanitary_option8'];
                    $insert->sanitary_option9 = $input['sanitary_option9'];
                    $insert->sanitary_option10 = $input['sanitary_option10'];
                    $insert->sanitary_option11 = $input['sanitary_option11'];
                    $insert->food_handlers = $input['food_handlers'] ?? null;
                    $insert->cook = $input['cook'] ?? null;
                    $insert->server = $input['server'] ?? null;
                    $insert->health_check_option = $input['health_check_option'] ?? null;
                    $insert->dressing_option = $input['dressing_option'] ?? null;
                    $insert->training_option = $input['training_option'] ?? null;
                    $insert->extinguisher_option = $input['extinguisher_option'] ?? null;

                    if ($insert->save()) {
                        return redirect()->route('FoodStorageLicenseAdminExplore')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }

        return redirect()->route('FoodStorageLicenseAdminExplore')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function FoodStorageLicenseAdminPayment()
    {
        $forms = FoodStorageInformations::whereHas('details', function ($query) {
            $query->whereIn('status', [7, 9]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->payment = FoodStoragePaymentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.food_storage_license.payment', compact('forms'));
    }

    public function FoodStorageLicenseAdminPaymentCheck($id)
    {
        $form = FoodStorageInformations::with(['user', 'details', 'files', 'replies'])->find($id);

        $file = FoodStoragePaymentLogs::where('informations_id', $id)->first();
        return view('admin.food_storage_license.payment-check', compact('form', 'file'));
    }

    public function FoodStorageLicenseAdminPaymentSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $detail = FoodStorageFormDetails::where('informations_id', $input['id'])->first();
            $detail->status = 10;
            if ($detail->save()) {
                $path = '';
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('payment', $filename, 'public');
                }
                $createdAt = Carbon::now();

                $update = FoodStoragePaymentLogs::find($input['file-id']);
                $update->receipt_book = $input['receipt_book'];
                $update->receipt_number = $input['receipt_number'];
                $update->file_treasury = $path;
                $update->status = 2;
                $update->expiration_date = $createdAt->copy()->addYear()->subDay();
                $update->updated_at = date('Y-m-d H:i:s');
                if ($update->save()) {
                    $number = FoodStorageNumberLogs::where('type', $detail['confirm_option'])->orderBy('id', 'desc')->first();
                    if ($number) {
                        $run_book = $number->book + 1;
                        $run_number = $number->number + 1;
                    } else {
                        if ($detail['confirm_option'] == 1) {
                            $run_number = 1;
                            $run_book = 7;
                        } else {
                            $run_number = 1;
                            $run_book = 8;
                        }
                    }

                    $insert = new FoodStorageNumberLogs();
                    $insert->informations_id = $input['id'];
                    $insert->number = $run_number;
                    $insert->book = $run_book;
                    $insert->year = date('Y') + 543;
                    $insert->type = $detail['confirm_option'];
                    $insert->created_at = date('Y-m-d');
                    $insert->updated_at = date('Y-m-d');
                    if ($insert->save()) {
                        return redirect()->route('FoodStorageLicenseAdminPayment')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }
        return redirect()->route('FoodStorageLicenseAdminPayment')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function FoodStorageLicenseAdminApprove()
    {
        $forms = FoodStorageInformations::whereHas('details', function ($query) {
            $query->whereIn('status', [10, 11]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($forms as $key => $rs) {
            $rs->payment = FoodStoragePaymentLogs::orderBy('id', 'desc')->first();
        }

        return view('admin.food_storage_license.approve', compact('forms'));
    }

    public function AdminCertificateFoodStorageLicensePDF($id)
    {
        $form = FoodStorageInformations::find($id);

        $explore = FoodStorageExploreLogs::where('informations_id', $form->id)->first();

        $file = FoodStoragePaymentLogs::where('informations_id', $form->id)->first();

        $info_number = FoodStorageNumberLogs::where('informations_id', $form->id)->first();

        if ($form['details']->confirm_option == 2) {
            $views = "admin.food_storage_license.pdf.food_storage_license";
        } else {
            $views = "admin.food_storage_license.pdf.food_sales";
        }
        $pdf = Pdf::loadView(
            $views,
            compact('form', 'file', 'info_number', 'explore')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf' . $form->id . '.pdf');
    }

    public function CertificateFoodStorageLicenseCoppy(Request $request)
    {
        $id = $request->input('id');
        $original = FoodStorageInformations::with('details')->findOrFail($id);

        // อัปเดตสถานะของข้อมูลเดิม
        if ($original->details) {
            $original->details->status = 11;
            $original->details->save();
        }

        // คัดลอกข้อมูล FoodStorageInformations
        $newInfo = $original->replicate();
        $newInfo->form_status = 1;
        $newInfo->refer_information_id  = $original->id;
        $newInfo->created_at = now();
        $newInfo->updated_at = now();
        $newInfo->save();

        // คัดลอกข้อมูล details
        if ($original->details) {
            $newDetails = $original->details->replicate();
            $newDetails->informations_id = $newInfo->id;
            $newDetails->status = 7;
            $newDetails->created_at = now();
            $newDetails->updated_at = now();
            $newDetails->save();
        }

        // คัดลอก Appointment Logs
        $appointments = FoodStorageAppointmentLogs::where('informations_id', $original->id)->get();
        foreach ($appointments as $appointment) {
            $newAppointment = $appointment->replicate();
            $newAppointment->informations_id = $newInfo->id;
            $newAppointment->created_at = now();
            $newAppointment->updated_at = now();
            $newAppointment->save();
        }

        // คัดลอก Explore Logs
        $explores = FoodStorageExploreLogs::where('informations_id', $original->id)->get();
        foreach ($explores as $explore) {
            $newExplore = $explore->replicate();
            $newExplore->informations_id = $newInfo->id;
            $newExplore->created_at = now();
            $newExplore->updated_at = now();
            $newExplore->save();
        }

        return response()->json(['success' => true, 'message' => 'คัดลอกข้อมูลเรียบร้อยแล้ว']);
    }

    public function CertificateFoodStorageLicenseExpire(Request $request)
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

        // กรองข้อมูลที่มีสถานะ 10 หรือ 11 และวันหมดอายุภายใน 90 วัน
        $forms = FoodStorageInformations::whereHas('details', function ($query) {
            $query->whereIn('status', [10, 11]);
        })
            ->with(['user', 'details', 'files', 'replies'])
            ->get()
            ->filter(function ($form) use ($ninetyDaysFromNow, $startDate, $endDate) {
                $latestPayment = FoodStoragePaymentLogs::where('informations_id', $form->id)
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

        return view('admin.food_storage_license.expire-details', compact('forms', 'availableMonths', 'availableYears'));
    }
}

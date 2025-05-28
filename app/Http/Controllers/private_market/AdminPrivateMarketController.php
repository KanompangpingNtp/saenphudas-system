<?php

namespace App\Http\Controllers\private_market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivateMarket;
use App\Models\PrivateMarketLogs;
use App\Models\PrivateMarketointmentLogs;
use App\Models\PrivateMarketPaymentLogs;
use App\Models\PrivateMarketExploreLogs;
use App\Models\PrivateMarketNumberLogs;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminPrivateMarketController extends Controller
{
    public function PrivateMarketAdminShowData()
    {
        $forms = PrivateMarket::with(['user', 'files', 'replies'])
            ->whereIn('status', [1, 2])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.private_market.show-data', compact('forms'));
    }

    public function PrivateMarketAdminExportPDF($id)
    {
        $form = PrivateMarket::find($id);

        $pdf = Pdf::loadView(
            'users.private_market.pdf-form',
            compact('form')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('private_market_' . $form->id . '.pdf');
    }

    public function PrivateMarketAdminConfirm($id)
    {
        $form = PrivateMarket::whereIn('status', [1, 2])
            ->with(['user', 'files', 'replies'])
            ->findOrFail($id);

        return view('admin.private_market.confirm', compact('form'));
    }

    public function PrivateMarketAdminConfirmSave(Request $request)
    {
        $input = $request->input();

        if ($input['id']) {
            $form = PrivateMarket::find($input['id']);
            if (!$form) {
                return redirect()->route('PrivateMarketAdminShowData')->with('error', 'ไม่พบข้อมูล');
            }

            // $form->form_status = $input['type_request'] ?? null;
            $form->status = ($input['result'] != 2) ? 3 : 2;

            if ($form->save()) {
                if ($form->status == 2 && !empty($input['detail'])) {
                    $log = new PrivateMarketLogs();
                    $log->market_id = $form->id;
                    $log->detail = $input['detail'];
                    $log->created_at = now();
                    $log->updated_at = now();
                    $log->save();
                }

                return redirect()->route('PrivateMarketAdminShowData')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
            }
        }

        return redirect()->route('PrivateMarketAdminShowData')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function PrivateMarketAdminDetail($id)
    {
        $form = PrivateMarket::with(['user', 'files'])
            ->find($id);

        return view('admin.private_market.detail', compact('form'));
    }

    public function PrivateMarketAdminAppointment()
    {
        $forms = PrivateMarket::whereIn('status', [3, 4, 5, 8])
            ->with(['user', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($forms as $key => $form) {
            $form->appointmentte = PrivateMarketointmentLogs::where('market_id', $form->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        return view('admin.private_market.appointment', compact('forms'));
    }

    public function PrivateMarketAdminCalendar($id)
    {
        $form = PrivateMarket::with(['user', 'files', 'replies'])->find($id);

        return view('admin.private_market.calendar', compact('form'));
    }

    public function PrivateMarketAdminCalendarSave(Request $request)
    {
        $input = $request->input();

        if ($input['id']) {
            $detail = PrivateMarket::find($input['id']);
            $detail->status = 4;

            if ($detail->save()) {
                $insert = new PrivateMarketointmentLogs();
                $insert->market_id = $input['id'];
                $insert->title = $input['title'];
                $insert->detail = $input['detail'];
                $insert->date_admin = $input['date_admin'];
                $insert->status = 1;
                $insert->created_at = now();
                $insert->updated_at = now();

                if ($insert->save()) {
                    return redirect()->route('PrivateMarketAdminAppointment')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }

        return redirect()->route('PrivateMarketAdminAppointment')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function PrivateMarketAdminExplore()
    {
        $forms = PrivateMarket::where('status', 6)
            ->with(['user', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($forms as $key => $rs) {
            $rs->appointmentte = PrivateMarketointmentLogs::where('market_id', $rs->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        return view('admin.private_market.explore', compact('forms'));
    }

    public function PrivateMarketAdminChecklist($id)
    {
        $form = PrivateMarket::with(['user', 'files', 'replies'])->find($id);

        return view('admin.private_market.checklist', compact('form'));
    }

    public function PrivateMarketAdminChecklistSave(Request $request)
    {
        $input = $request->input();

        if ($input['id']) {
            $path = '';

            if ($request->hasFile('formFile')) {
                $file = $request->file('formFile');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('checklist', $filename, 'public');
            }

            $market = PrivateMarket::find($input['id']);
            if (!$market) {
                return redirect()->route('PrivateMarketAdminExplore')->with('error', 'ไม่พบข้อมูล');
            }

            if ($input['result'] != 2) {
                $market->status = 7;
                if ($market->save()) {
                    $log = new PrivateMarketExploreLogs();
                    $log->market_id = $input['id'];
                    $log->detail = $input['detail'];
                    $log->price = $input['price'];
                    $log->file = $path;
                    $log->status = 1;
                    $log->created_at = now();
                    $log->updated_at = now();

                    if ($log->save()) {
                        return redirect()->route('PrivateMarketAdminExplore')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            } else {
                $market->status = 8;
                if ($market->save()) {
                    $log = new PrivateMarketExploreLogs();
                    $log->market_id = $input['id'];
                    $log->detail = $input['detail'];
                    $log->price = $input['price'];
                    $log->file = $path;
                    $log->status = 2;
                    $log->created_at = now();
                    $log->updated_at = now();

                    if ($log->save()) {
                        return redirect()->route('PrivateMarketAdminExplore')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }

        return redirect()->route('PrivateMarketAdminExplore')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function PrivateMarketAdminPayment()
    {
        $forms = PrivateMarket::whereIn('status', [7, 9])
            ->with(['user', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($forms as $key => $rs) {
            $rs->payment = PrivateMarketPaymentLogs::where('market_id', $rs->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        return view('admin.private_market.payment', compact('forms'));
    }

    public function PrivateMarketAdminPaymentCheck($id)
    {
        $form = PrivateMarket::with(['user', 'files', 'replies'])->find($id);

        $file = PrivateMarketPaymentLogs::where('market_id', $id)->first();

        return view('admin.private_market.payment-check', compact('form', 'file'));
    }

    public function PrivateMarketAdminPaymentSave(Request $request)
    {
        $input = $request->input();

        if ($input['id']) {
            $detail = PrivateMarket::find($input['id']);
            $detail->status = 10;

            if ($detail->save()) {
                $path = '';
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('payment', $filename, 'public');
                }

                $createdAt = \Carbon\Carbon::now();

                $update = PrivateMarketPaymentLogs::find($input['file-id']);
                $update->receipt_book = $input['receipt_book'];
                $update->receipt_number = $input['receipt_number'];
                $update->file_treasury = $path;
                $update->status = 2;
                $update->updated_at = now();
                $update->expiration_date = $createdAt->copy()->addYear()->subDay();

                if ($update->save()) {
                    $number = PrivateMarketNumberLogs::orderBy('id', 'desc')->first();
                    if ($number) {
                        $run_book = $number->book + 1;
                        $run_number = $number->number + 1;
                    } else {
                        $run_number = 1;
                        $run_book = 91;
                    }

                    $insert = new PrivateMarketNumberLogs();
                    $insert->market_id = $input['id'];
                    $insert->number = $run_number;
                    $insert->book = $run_book;
                    $insert->year = date('Y') + 543;
                    $insert->created_at = date('Y-m-d');
                    $insert->updated_at = date('Y-m-d');

                    if ($insert->save()) {
                        return redirect()->route('PrivateMarketAdminPayment')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }

        return redirect()->route('PrivateMarketAdminPayment')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function PrivateMarketAdminApprove()
    {
        $forms = PrivateMarket::whereIn('status', [10, 11])
            ->with(['user', 'files', 'replies'])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($forms as $key => $rs) {
            $rs->payment = PrivateMarketPaymentLogs::where('market_id', $rs->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        return view('admin.private_market.approve', compact('forms'));
    }

    public function AdminCertificatePrivateMarketPDF($id)
    {
        $form = PrivateMarket::find($id);

        $file = PrivateMarketPaymentLogs::where('market_id', $form->id)->first();

        $explore = PrivateMarketExploreLogs::where('market_id', $form->id)->first();

        $info_number = PrivateMarketNumberLogs::where('market_id', $form->id)->first();

        $pdf = PDF::loadView(
            "admin.private_market.pdf.private_market_certificate",
            compact('form', 'file', 'explore', 'info_number')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('pdf_' . $form->id . '.pdf');
    }

    public function CertificatePrivateMarketCopy(Request $request)
    {
        $id = $request->input('id');
        $original = PrivateMarket::findOrFail($id);

        if ($original->details) {
            $original->details->status = 11;
            $original->details->save();
        }

        $newInfo = $original->replicate();
        $newInfo->form_status = 1;
        $newInfo->status = 7;
        $newInfo->refer_app_id = $original->id;
        $newInfo->created_at = now();
        $newInfo->updated_at = now();
        $newInfo->save();

        $appointments = PrivateMarketointmentLogs::where('market_id', $original->id)->get();
        foreach ($appointments as $appointment) {
            $newAppointment = $appointment->replicate();
            $newAppointment->market_id = $newInfo->id;
            $newAppointment->created_at = now();
            $newAppointment->updated_at = now();
            $newAppointment->save();
        }

        $explores = PrivateMarketExploreLogs::where('market_id', $original->id)->get();
        foreach ($explores as $explore) {
            $newExplore = $explore->replicate();
            $newExplore->market_id = $newInfo->id;
            $newExplore->created_at = now();
            $newExplore->updated_at = now();
            $newExplore->save();
        }

        return response()->json(['success' => true, 'message' => 'คัดลอกข้อมูลเรียบร้อยแล้ว']);
    }

    public function CertificatePrivateMarketExpire(Request $request)
    {
        $ninetyDaysFromNow = Carbon::now()->addDays(90);

        $month = $request->input('month');
        $year = $request->input('year');

        $startDate = null;
        $endDate = null;

        if ($month && $year) {
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        }

        $availableMonths = range(1, 12);
        $availableYears = range(now()->year - 5, now()->year + 1);

        $forms = PrivateMarket::whereIn('status', [10, 11])
            ->with(['user', 'files', 'replies'])
            ->get()
            ->filter(function ($form) use ($ninetyDaysFromNow, $startDate, $endDate) {
                $latestPayment = PrivateMarketPaymentLogs::where('market_id', $form->id)
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

        return view('admin.private_market.expire-details', compact('forms', 'availableMonths', 'availableYears'));
    }
}

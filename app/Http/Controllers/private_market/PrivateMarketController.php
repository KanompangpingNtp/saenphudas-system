<?php

namespace App\Http\Controllers\private_market;

use App\Http\Controllers\Controller;
use App\Models\PrivateMarket;
use App\Models\PrivateMarketFile;
use App\Models\PrivateMarketointmentLogs;
use App\Models\PrivateMarketPaymentLogs;
use App\Models\PrivateMarketExploreLogs;
use App\Models\PrivateMarketNumberLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PrivateMarketController extends Controller
{
    //
    public function PrivateMarketFormPage()
    {
        return view("users.private_market.page-form");
    }

    public function PrivateMarketFormCreate(Request $request)
    {
        // dd($request);
        $market = PrivateMarket::create([
            'users_id' => auth()->id(),
            'form_status' => 1,
            'status' => 1,
            'written_at' => $request->written_at,
            'salutation' => $request->salutation,
            'full_name' => $request->full_name,
            'age' => $request->age,
            'force' => $request->force,
            'house_number' => $request->house_number,
            'road' => $request->road,
            'village' => $request->village,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'submit_request' => $request->submit_request,
            'submit_road' => $request->submit_road,
            'submit_number' => $request->submit_number,
            'submit_sub_district' => $request->submit_sub_district,
            'submit_district' => $request->submit_district,
            'submit_province' => $request->submit_province,
            'annual_market' => $request->annual_market,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('private_market_files', 'public');
                PrivateMarketFile::create([
                    'market_id' => $market->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ส่งคำขอเรียบร้อยแล้ว');
    }

    // public function PrivateMarketShowDetails()
    // {
    //     $forms = PrivateMarket::with(['user', 'files', 'replies'])
    //         ->where('users_id', Auth::id())
    //         ->get();
    //     if (!empty($forms)) {
    //         foreach ($forms as $rs) {
    //             $rs->appointmentte = PrivateMarketointmentLogs::orderBy('id', 'desc')->first();
    //             $rs->payment = PrivateMarketPaymentLogs::orderBy('id', 'desc')->first();
    //         }
    //     }

    //     return view('users.private_market.account.show-detail', compact('forms'));
    // }

    public function PrivateMarketShowDetails()
    {
        // ดึงเฉพาะรายการต้นฉบับ
        $originalForms = PrivateMarket::with(['user', 'files', 'replies'])
            ->where('users_id', Auth::id())
            ->whereNull('refer_app_id')
            ->get();

        $forms = collect();

        foreach ($originalForms as $form) {
            // ค้นหารายการล่าสุดที่อ้างอิงถึงต้นฉบับ
            $latest = PrivateMarket::with(['user', 'files', 'replies'])
                ->where('refer_app_id', $form->id)
                ->orderByDesc('created_at')
                ->first();

            $finalForm = $latest ?? $form;

            // เพิ่มข้อมูลการนัดหมายและการชำระเงิน
            $finalForm->appointmentte = PrivateMarketointmentLogs::where('market_id', $finalForm->id)
                ->orderBy('id', 'desc')
                ->first();

            $finalForm->payment = PrivateMarketPaymentLogs::where('market_id', $finalForm->id)
                ->orderBy('id', 'desc')
                ->first();

            $forms->push($finalForm);
        }

        return view('users.private_market.account.show-detail', compact('forms'));
    }


    public function privateMarketUserExportPDF($id)
    {
        $form = PrivateMarket::find($id);

        $pdf = Pdf::loadView(
            'users.private_market.pdf-form',
            compact('form')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('private_market_' . $form->id . '.pdf');
    }

    public function privateMarketDetail($id)
    {
        $form = PrivateMarket::with(['user', 'files'])->find($id);

        return view('users.private_market.account.form_detail', compact('form'));
    }

    public function PrivateMarketCalendar($id)
    {
        $form = PrivateMarket::with(['user', 'files', 'replies'])->find($id);
        $calendar = PrivateMarketointmentLogs::orderBy('id', 'desc')->where('market_id', $id)->first();

        return view('users.private_market.account.calendar', compact('form', 'calendar'));
    }

    public function PrivateMarketCalendarSave(Request $request)
    {
        $input = $request->input();

        if ($input['id']) {
            $detail = PrivateMarket::find($input['id']);

            if (!$detail) {
                return redirect()->route('PrivateMarketShowDetails')->with('error', 'ไม่พบข้อมูล');
            }

            $detail->status = ($input['result'] != 2) ? 6 : 5;
            $detail->updated_at = now();

            if ($detail->save()) {
                $calendar = PrivateMarketointmentLogs::where('market_id', $input['id'])
                    ->orderBy('id', 'desc')
                    ->first();

                if ($calendar) {
                    $calendar->date_user = $input['date_user'];
                    $calendar->status = 2;
                    $calendar->updated_at = now();

                    if ($calendar->save()) {
                        return redirect()->route('PrivateMarketShowDetails')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                    }
                }
            }
        }

        return redirect()->route('PrivateMarketShowDetails')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function PrivateMarketPayment($id)
    {
        $form = PrivateMarket::with(relations: ['user', 'files', 'replies'])->find($id);
        $info = PrivateMarketExploreLogs::where('market_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        return view('users.private_market.account.payment-check', compact('form', 'info'));
    }

    public function PrivateMarketPaymentSave(Request $request)
    {
        $input = $request->input();
        if ($input['id']) {
            $path = '';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payment', $filename, 'public');
            }

            $detail = PrivateMarket::find($input['id']);
            $detail->status = 9;
            if ($detail->save()) {
                $insert = new PrivateMarketPaymentLogs();
                $insert->market_id = $input['id'];
                $insert->file = $path;
                $insert->status = 1;
                $insert->created_at = now();
                $insert->updated_at = now();
                if ($insert->save()) {
                    return redirect()->route('PrivateMarketShowDetails')->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
                }
            }
        }
        return redirect()->route('PrivateMarketShowDetails')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function CertificatePrivateMarketPDF($id)
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
}

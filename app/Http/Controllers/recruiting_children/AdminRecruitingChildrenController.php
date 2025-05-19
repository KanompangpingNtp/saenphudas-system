<?php

namespace App\Http\Controllers\recruiting_children;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildInformation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ChildReply;
use Illuminate\Support\Facades\Auth;

class AdminRecruitingChildrenController extends Controller
{
    public function TableChildApplyAdminPages()
    {
        $forms = ChildInformation::with(['user', 'attachments', 'replies'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.department_education.recruiting_children.show-data', compact('forms'));
    }

    public function ChildApplyAdminExportPDF($id)
    {
        $form = ChildInformation::with('caregiverInformation', 'surrenderTheChild', 'childRegistration')->find($id);

        if ($form->childRegistration->first() && $form->childRegistration->first()->ge_immunity) {
            $geImmunity = $form->childRegistration->first()->ge_immunity;
            $form->childRegistration->first()->ge_immunity = json_decode($geImmunity, true); // Decode JSON to array
        }

        $selectedOptions = $form->childRegistration->first()->ge_immunity ?? [];

        $pdf = Pdf::loadView('users.department_education.recruiting_children.pdf-form', compact('form', 'selectedOptions'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก' . $form->id . '.pdf');
    }

    public function ChildApplyAdminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ChildReply::create([
            'child_information_id' => $formId,
            'users_id' => auth()->id(),
            'reply_text' => $request->message,
            'reply_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function ChildApplyUpdateStatus($id)
    {
        $form = ChildInformation::findOrFail($id);

        $form->status = 2;
        $form->admin_name_verifier = Auth::user()->name;
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}

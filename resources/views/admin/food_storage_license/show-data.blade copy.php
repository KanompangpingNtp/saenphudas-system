@extends('admin.layout.layout')
@section('admin_content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<div class="container">
    <h2 class="text-center">แบบคำร้องใบอนุญาตสะสมอาหาร <br>
        <h3 class="text-center">ตารางแสดงข้อมูลฟอร์มที่ส่งเข้ามา</h3>
    </h2> <br>

    <table class="table table-bordered table-striped" id="data_table">
        <thead class="text-center">
            <tr>
                <th>วันที่ขอใบอนุญาต</th>
                <th>ผู้ขอใบอนุญาต</th>
                <th>ประเภทขอใบอนุญาต</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($forms as $form)
            <tr>
                <td class="date-column">{{ $form->created_at->format('Y-m-d') }}</td>
                <td>{{ $form->salutation }} {{ $form->full_name }}</td>
                <td>{{ $form['details']['type']->type_name }}</td>
                <td>
                    @if ($form['details']->status == 1)
                    <span class="badge rounded-pill text-bg-primary">รอรับเรื่อง</span>
                    @elseif($form['details']->status == 2)
                    <span class="badge rounded-pill text-bg-warning">รอการแก้ไข</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('FoodStorageLicenseAdminExportPDF', $form->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                    <a href="{{ route('FoodStorageLicenseAdminComfirm', $form->id) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-reply"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($forms as $form)
    <div class="modal fade" id="submitModal-{{ $form->id }}" tabindex="-1" aria-labelledby="submitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <!-- เพิ่มคลาส modal-dialog-centered -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="submitModalLabel">แสดงข้อมูล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span style="color: black;">preview</span>
                    <a href="{{ route('FoodStorageLicenseAdminExportPDF', $form->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                    <br>
                    <br>
                    <span style="color: black;">ไฟล์แนบ </span>
                    @foreach ($form->files as $attachment)
                    <span class="d-inline me-2">
                        <a href="{{ asset('storage/' . $attachment->file_path) }}"
                            target="_blank">{{ basename($attachment->file_path) }}</a>
                    </span>
                    @endforeach
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <span class="text-start" style="color: black;">รับฟอร์ม</span>
                    <form action="{{ route('FoodStorageLicenseUpdateStatus', $form->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm" @if($form->form_status == 2) disabled @endif>
                            กดรับแบบฟอร์ม
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="replyModal-{{ $form->id }}" tabindex="-1" aria-labelledby="replyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">ตอบกลับฟอร์ม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><span style="color: black;">ชื่อผู้ส่งฟอร์ม :
                        </span>{{ $form->user ? $form->user->name : 'ผู้ใช้งานทั่วไป' }}</p>
                    <p>ข้อความตอบกลับก่อนหน้า</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>ผู้ตอบกลับ</th>
                                <th>วันที่ตอบกลับ</th>
                                <th>ข้อความที่ตอบกลับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($form->replies as $reply)
                            <tr class="text-center">
                                <td>{{ $reply->user->name ?? 'Unknown User' }}</td>
                                <td>
                                    {{ $reply->created_at->timezone('Asia/Bangkok')->translatedFormat('d F') }}
                                    {{ $reply->created_at->year + 543 }}
                                    {{ $reply->created_at->format('H:i') }} น.
                                </td>
                                <td>{{ $reply->reply_text }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">ยังไม่มีการตอบกลับ</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('FoodStorageLicenseAdminReply', $form->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">ข้อความตอบกลับ</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">ส่งตอบกลับ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
<script src="{{ asset('js/datatable.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
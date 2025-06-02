@extends('home.layouts.app')
@section('title', 'Trash Toxic Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 68vh;
    }

    .big-text {
        font-weight: bold;
        font-size: 60px;
        white-space: nowrap;
    }

    @media (max-width: 476px) {
        .big-text {
            font-size: 40px;
            /* ลดขนาดลงตามต้องการ */
        }
    }

    .btn-back-effect img {
        transition: all 0.3s ease;
    }

    .btn-back-effect:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }

    .bg-white-cs {
        background: rgba(255, 255, 255, 0.6);
        padding: 10px;
        border-radius: 20px;
        border-left: 10px solid #24ad22;
        border-right: none;
        border-top: none;
        border-bottom: none;
    }

    .bg-green {
        background: #b9ffb8;
        padding: 0px 10px;
        border-radius: 10px;
        font-size: 30px;
        font-weight: bold;
    }

    .no-click {
        pointer-events: none;
        user-select: none;
    }

    .bg-green-x {
        background: #19aa60;
        border-radius: 10px;
        padding: 0px 25px;
        font-size: 40px;
        font-weight: bold;
        color: #ffff;
        display: inline-block;
    }

    .custom-table {
        font-size: 25px;
        border-radius: 15px;
        border-collapse: collapse;
        overflow: hidden;
    }

    .custom-table thead th {
        background-color: #19aa60;
        color: white;
        font-weight: bold;
        text-align: center;
        white-space: nowrap;
    }

    .custom-table tbody tr:nth-child(odd) {
        background-color: white !important;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #e3ffd2 !important;
    }

    .rounded-table {
        border-radius: 15px;
    }

    /* ขอบมนแถวแรกและสุดท้าย */
    .custom-table thead tr:first-child th:first-child {
        border-top-left-radius: 15px;
    }

    .custom-table thead tr:first-child th:last-child {
        border-top-right-radius: 15px;
    }

    .custom-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 15px;
    }

    .custom-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 15px;
    }

    .custom-table td,
    .custom-table th {
        border: 1px solid #ccc;
        /* สีเส้นขอบ */
        padding: 10px;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .table-wrapper {
        overflow-x: auto;
        width: 100%;
    }
</style>
@section('content')
    <div class="body-bg py-4">
        <div class="container">
            <div class="d-flex justify-content-center justify-content-lg-start align-items-center">
                <div class="big-text">
                    ตรวจสอบค่าชำระ
                </div>
                <a href="{{ route('UserWastePayment') }}" class="btn-back-effect">
                    <img src="{{ asset('trash-page/btn-back.png') }}" alt="btn-back" class="img-fluid">
                </a>
            </div>
            <div class="row bg-white-cs mb-3">
                <!-- แถวที่ 1: input 3 ช่อง -->
                <div class="col-lg-4 mb-2">
                    <div class="bg-green p-2 rounded-3">
                        <input type="text" class="bg-green border-0 w-100 no-click"
                            value="{{ $user->userDetail->salutation }}{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="col-lg-2 mb-2">
                    <div class="bg-white p-2 rounded-3">
                        <input type="text" class="bg-white border-0 fs-3 fw-bold w-100 no-click" value="สถานะ: ปกติ"
                            readonly>
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="bg-white p-2 rounded-3">
                        <input type="text" class="bg-white border-0 fs-3 fw-bold w-100 no-click" value="ประเภท: ปกติ"
                            readonly>
                    </div>
                </div>

                <!-- แถวที่ 2: textarea -->
                <div class="col-12">
                    <div class="bg-white p-3 rounded-3">
                        <textarea name="address" id="address" class="border-0 w-100 fs-3 fw-bold no-click" rows="4" readonly>ที่อยู่: {{ $user->userDetail->house_number }} ม.{{ $user->userDetail->village }} ต.{{ $user->userDetail->subdistrict }} อ.{{ $user->userDetail->district }} จ.{{ $user->userDetail->province }}</textarea>
                    </div>
                </div>
            </div>
            <div class="bg-green-x mb-3">
                ประวัติการชำระ
            </div>
            <div class="table-wrapper">
                <table class="custom-table rounded-table w-100">
                    <thead>
                        <tr>
                            <th>เดือน</th>
                            <th>รายการ</th>
                            <th>สถานะ</th>
                            <th>ใบเสร็จ</th>
                            <th>ชำระ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($payment->due_date)->locale('th')->translatedFormat('F Y') }}</td>
                                <td>ค่าชำระขยะประจำเดือน</td>
                                <td>
                                    @if ($payment->payment_status == 3)
                                        <span class="text-success">ชำระเงินแล้ว</span>
                                    @elseif ($payment->payment_status == 2)
                                        <span class="text-warning">รอตรวจสอบ</span>
                                    @elseif ($payment->payment_status == 1)
                                        <span class="text-danger">ยังไม่ชำระเงิน</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($payment->bill))
                                        <a href="{{ asset('storage/bills/' . $payment->bill) }}" target="_blank">
                                            <img src="{{ asset('check-valuetrash/search.png') }}" alt="ดูบิล"
                                                style="width: 24px; height: 24px;">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal{{ $payment->id }}">
                                        <img src="{{ asset('check-valuetrash/tips.png') }}" alt="tips">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @foreach ($payments as $payment)
                    <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1"
                        aria-labelledby="paymentModalLabel{{ $payment->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('CheckValuetrashUpdateSlip', $payment->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel{{ $payment->id }}">รายละเอียดการชำระ
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="ปิด"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p><strong>ยอดที่ต้องชำระ:</strong> {{ number_format($payment->amount, 2) }} บาท
                                        </p>
                                        <p><strong>กำหนดชำระ:</strong>
                                            {{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}</p>

                                        @if ($payment->payment_slip)
                                            <p><strong>สลิป:</strong></p>
                                            <img src="{{ asset('storage/payment_slips/' . $payment->payment_slip) }}"
                                                alt="slip" class="img-fluid rounded mb-2">
                                        @endif

                                        @if ($payment->payment_status == 1)
                                            <div class="mb-3">
                                                <label
                                                    for="payment_slip_{{ $payment->id }}"><strong>แนบสลิป:</strong></label>
                                                <input type="file" name="payment_slip"
                                                    id="payment_slip_{{ $payment->id }}" class="form-control" required>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">ปิด</button>
                                        @if ($payment->payment_status == 1)
                                            <button type="submit" class="btn btn-success">อัปโหลดสลิป</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection

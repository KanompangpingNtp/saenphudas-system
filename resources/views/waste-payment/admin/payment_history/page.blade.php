@extends('waste-payment.layouts.master')
@section('content')
    <style>
        select option:disabled {
            color: #999;
            /* สีเทาอ่อน */
            background-color: #f9f9f9;
        }
    </style>

    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mb-5">ประวัติการชำระเงิน</h3>

                    <form method="GET" action="{{ route('PaymentHistoryPage') }}" class="row g-2 mb-3">
                        <div class="col-md-2">
                            <select name="month" class="form-select">
                                <option value="">-- เลือกเดือน --</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}
                                        {{ in_array($m, $availableMonths) ? '' : 'disabled' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->locale('th')->isoFormat('MMMM') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="year" class="form-select">
                                <option value="">-- เลือกปี --</option>
                                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}
                                        {{ in_array($y, $availableYears) ? '' : 'disabled' }}>
                                        {{ $y + 543 }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary"><i class='bx bx-search-alt'></i></button>
                        </div>
                    </form>

                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">วันที่ชำระ</th>
                                <th class="text-center">ชื่อผู้จ่าย</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">ยอดชำระ (บาท)</th>
                                <th class="text-center">สลิปชำระเงิน</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $index => $payment)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $payment->wasteManagement->name ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $payment->wasteManagement->address ?? '-' }},
                                        หมู่ที่ {{ $payment->wasteManagement->village ?? '-' }},
                                        ต.{{ $payment->wasteManagement->sub_district ?? '-' }},
                                        อ.{{ $payment->wasteManagement->district ?? '-' }},
                                        จ.{{ $payment->wasteManagement->province ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($payment->amount, 2) }}
                                    </td>
                                    <td class="text-center">
                                        @if ($payment->payment_slip)
                                            <a href="{{ asset('storage/payment_slips/' . $payment->payment_slip) }}"
                                                target="_blank">ดูสลิป</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">ชำระแล้ว</span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $payment->id }}">
                                            <i class="bi bi-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($payments as $payment)
                        <div class="modal fade" id="modal-{{ $payment->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $payment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-{{ $payment->id }}">
                                            รายละเอียดบิลการชำระเงิน
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="ปิด"></button>
                                    </div>
                                    <form method="POST" action="{{ route('uploadBill', $payment->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')

                                        <div class="modal-body">
                                            <div>
                                                @if ($payment->bill)
                                                    @php
                                                        $extension = pathinfo($payment->bill, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                                                        <img src="{{ asset('storage/bills/' . $payment->bill) }}"
                                                            alt="บิล" class="img-fluid rounded border">
                                                    @elseif ($extension === 'pdf')
                                                        <iframe src="{{ asset('storage/bills/' . $payment->bill) }}"
                                                            width="100%" height="500px" class="border rounded"></iframe>
                                                    @else
                                                        <p>ไม่สามารถแสดงไฟล์บิลนี้ได้</p>
                                                    @endif
                                                @else
                                                    <p><strong>ไม่มีข้อมูล</strong></p>
                                                @endif

                                                @if (is_null($payment->bill))
                                                    <div class="mb-3 mt-3">
                                                        <label for="bill" class="form-label"><strong>แนบบิล (PDF, JPG,
                                                                PNG):</strong></label>
                                                        <input type="file" class="form-control" name="bill"
                                                            accept=".pdf,.jpg,.jpeg,.png" required>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">ปิด</button>
                                            @if (is_null($payment->bill))
                                                <button type="submit" class="btn btn-success">บันทึกบิล</button>
                                            @endif
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection

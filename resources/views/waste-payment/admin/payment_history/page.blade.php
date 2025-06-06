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
                                <th class="text-center">วันที่ชำระ (ล่าสุด)</th>
                                <th class="text-center">ชื่อผู้จ่าย</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">ยอดชำระทั้งหมด (บาท)</th>
                                <th class="text-center">จำนวนรายการ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">รายละเอียด</th>
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
                                        หมู่ {{ $payment->wasteManagement->village ?? '-' }},
                                        ต.{{ $payment->wasteManagement->sub_district ?? '-' }},
                                        อ.{{ $payment->wasteManagement->district ?? '-' }},
                                        จ.{{ $payment->wasteManagement->province ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($payment->total_amount, 2) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $payment->payment_count }} รายการ
                                    </td>
                                    <td class="text-center">
                                        @if ($payment->has_missing_bill)
                                            <span class="text-warning">มีบางรายการยังไม่แนบบิล</span>
                                        @else
                                            <span class="text-success">แนบบิลครบแล้ว</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('PaymentHistoryDetail', ['user_id' => $payment->wasteManagement->users_id]) }}"
                                            class="btn btn-primary btn-sm">
                                            ดูบิล
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection

@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">
                        บิลที่รอการชำระเงิน : {{ $user->name ?? '-' }}
                    </h3>

                    <form method="GET" action="{{ route('NonPaymentDetail') }}" class="row g-2 mb-3">
                        <input type="hidden" name="user_id" value="{{ $userId }}">

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
                                @for ($y = now()->year; $y >= now()->year - 9; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}
                                        {{ in_array($y, $availableYears) ? '' : 'disabled' }}>
                                        {{ $y + 543 }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-search-alt'></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('NonPaymentExportPDF', [
                        'user_id' => $userId,
                        'month' => request('month'),
                        'year' => request('year'),
                    ]) }}"
                        class="btn btn-danger btn-sm mb-3" target="_blank">
                        <i class="bi bi-filetype-pdf"></i> Export PDF
                    </a>


                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ชื่อผู้ใช้</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">เบอร์โทร</th>
                                <th class="text-center">จำนวนเงิน</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">วันครบกำหนด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $index => $payment)
                                @php
                                    $waste = $payment->wasteManagement;
                                    $user = $waste->user ?? null;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $waste->name ?? ($user->name ?? '-') }}</td>
                                    <td>
                                        {{ $waste->address }},
                                        หมู่ {{ $waste->village }},
                                        ต.{{ $waste->sub_district }},
                                        อ.{{ $waste->district }},
                                        จ.{{ $waste->province }}
                                    </td>
                                    <td class="text-center">{{ $waste->phone }}</td>
                                    <td class="text-center">{{ number_format($payment->amount, 2) }} บาท</td>
                                    <td class="text-center">
                                        @if ($payment->payment_status == 1)
                                            <span class="text-danger">ยังไม่ชำระ</span>
                                        @elseif($payment->payment_status == 3)
                                            <span class="text-success">ชำระแล้ว</span>
                                        @else
                                            <span class="text-secondary">สถานะอื่นๆ</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tr>
                            <td colspan="4" class="text-center fw-bold">ยอดรวมค้างชำระทั้งหมด</td>
                            <td class="text-center fw-bold">{{ number_format($totalAmount, 2) }} บาท</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection

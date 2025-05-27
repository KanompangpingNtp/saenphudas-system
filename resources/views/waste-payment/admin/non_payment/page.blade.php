@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">ผู้ขาดการชำระเงิน</h3>

                    <form method="GET" action="{{ route('NonPaymentPage') }}" class="row g-2 mb-3">
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
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-search-alt'></i>
                            </button>
                        </div>
                    </form>

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
                            @foreach ($nonPayments as $index => $payment)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $payment->wasteManagement->name ?? '-' }}</td>
                                    <td>
                                        {{ $payment->wasteManagement->address }},
                                        หมู่ {{ $payment->wasteManagement->village }},
                                        ต.{{ $payment->wasteManagement->sub_district }},
                                        อ.{{ $payment->wasteManagement->district }},
                                        จ.{{ $payment->wasteManagement->province }}
                                    </td>
                                    <td class="text-center">{{ $payment->wasteManagement->phone }}</td>
                                    <td class="text-center">{{ number_format($payment->amount, 2) }} บาท</td>
                                    <td class="text-center">
                                        @if ($payment->payment_status == 1)
                                            <span class="badge bg-danger">ยังไม่ชำระ</span>
                                        @elseif($payment->payment_status == 3)
                                            <span class="badge bg-success">ชำระแล้ว</span>
                                        @else
                                            <span class="badge bg-secondary">สถานะอื่นๆ</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}</td>
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

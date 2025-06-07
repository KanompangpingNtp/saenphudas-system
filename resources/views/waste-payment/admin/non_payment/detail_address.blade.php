@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">
                        บิลที่รอการชำระเงิน : {{ $wasteAddress->name ?? '-' }}
                    </h3>

                    <form method="GET" action="{{ route('NonPaymentDetailAd') }}" class="row g-2 mb-3">
                        <input type="hidden" name="waste_address_id" value="{{ $wasteAddressId }}">

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

                    <a href="{{ route('NonPaymentExportPDFAd', [
                        'waste_address_id' => $wasteAddressId,
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
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">เบอร์โทร</th>
                                <th class="text-center">จำนวนเงิน</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">วันครบกำหนด</th>
                                <th class="text-center">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $index => $payment)
                                @php
                                    $waste = $payment->wasteManagement;
                                    $wasteAddress = $payment->wasteAddress;
                                    $user = $waste->user ?? null;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        {{ $wasteAddress->name ?? '-' }}
                                    </td>
                                    <td class="text-center">{{ $waste->phone ?? '-' }}</td>
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
                                        {{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#payModal-{{ $payment->id }}">
                                            จ่ายบิล
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tr>
                            <td colspan="4" class="text-center fw-bold">ยอดรวมค้างชำระทั้งหมด</td>
                            <td class="text-center fw-bold">{{ number_format($totalAmount, 2) }} บาท</td>
                        </tr>
                    </table>

                    @foreach ($payments as $payment)
                        <div class="modal fade" id="payModal-{{ $payment->id }}" tabindex="-1"
                            aria-labelledby="payModalLabel-{{ $payment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('NonPaymentUploadSlip', $payment->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="payModalLabel-{{ $payment->id }}">ชำระเงิน</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="ปิด"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>ยอดที่ต้องชำระ: <strong>{{ number_format($payment->amount, 2) }}
                                                    บาท</strong></p>
                                            <div class="mb-3">
                                                <label for="payment_slip_{{ $payment->id }}"
                                                    class="form-label">อัปโหลดสลิปการชำระเงิน</label>
                                                <input type="file" class="form-control" name="payment_slip"
                                                    id="payment_slip_{{ $payment->id }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">ยืนยันการชำระ</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">ยกเลิก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection

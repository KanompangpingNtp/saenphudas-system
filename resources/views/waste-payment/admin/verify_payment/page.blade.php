@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mb-4">ตรวจสอบการชำระเงิน</h3>

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
                            @foreach ($payments as $payment)
                                <tr>
                                    <td class="text-center">{{ $payment->id }}</td>
                                    <td class="text-center">
                                        {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td>{{ $payment->wasteManagement->name ?? '-' }}</td>
                                    <td>
                                        {{ $payment->wasteManagement->address ?? '-' }},
                                        หมู่ที่ {{ $payment->wasteManagement->village ?? '-' }},
                                        ต.{{ $payment->wasteManagement->sub_district ?? '-' }},
                                        อ.{{ $payment->wasteManagement->district ?? '-' }},
                                        จ.{{ $payment->wasteManagement->province ?? '-' }}
                                    </td>
                                    <td class="text-center">{{ number_format($payment->amount, 2) }}</td>
                                    <td class="text-center">
                                        @if ($payment->payment_slip)
                                            <a href="{{ asset('storage/payment_slips/' . $payment->payment_slip) }}"
                                                target="_blank">ดูสลิป</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($payment->payment_status == '3')
                                            <span class="badge bg-success">ชำระแล้ว</span>
                                        @elseif ($payment->payment_status == '2')
                                            <span class="badge bg-warning">รอตรวจสอบ</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('approvePayment', $payment->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            <button class="btn btn-success btn-sm"
                                                onclick="return confirm('ยืนยันการอัปเดตสถานะเป็นสำเร็จ?')">
                                                <i class='bx bx-check-circle'></i>
                                            </button>
                                        </form>

                                        <form action="" class="d-inline-block">
                                            <button class="btn btn-warning btn-sm">
                                                <i class='bx bx-undo'></i>
                                            </button>
                                        </form>
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

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
                                @for ($y = now()->year; $y >= now()->year - 9; $y--)
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
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">ยอดชำระทั้งหมด (บาท)</th>
                                <th class="text-center">จำนวนรายการ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp

                            @foreach ($paymentsByUser as $group)
                                @php
                                    $first = $group->sortByDesc('issued_at')->first();
                                    $user = optional($first->wasteManagement)->user;
                                    $waste = $first->wasteManagement;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($first->issued_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $waste->address ?? '-' }}
                                    </td>
                                    <td class="text-center">{{ number_format($group->sum('amount'), 2) }}</td>
                                    <td class="text-center">{{ $group->count() }} รายการ</td>
                                    <td class="text-center">
                                        @if ($group->contains(fn($p) => is_null($p->bill)))
                                            <span class="text-warning">มีบางรายการยังไม่แนบบิล</span>
                                        @else
                                            <span class="text-success">แนบบิลครบแล้ว</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('PaymentHistoryDetail', [
                                            'user_id' => $user->id,
                                            'month' => $month,
                                            'year' => $year,
                                        ]) }}"
                                            class="btn btn-sm btn-primary">
                                            ดูบิล
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($paymentsByAddress as $wasteAddressId => $group)
                                @php
                                    $first = $group->sortByDesc('issued_at')->first();
                                    $wasteAddress = $first->wasteAddress;
                                    $waste = $first->wasteManagement;
                                    if (!$wasteAddress) {
                                        continue;
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">
                                        @if (!is_null($first->issued_at))
                                            {{ \Carbon\Carbon::parse($first->issued_at)->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $wasteAddress->name ?? '-' }}</td>
                                    <td class="text-center">{{ number_format($group->sum('amount'), 2) }}</td>
                                    <td class="text-center">{{ $group->count() }} รายการ</td>
                                    <td class="text-center">
                                        @if ($group->contains(fn($p) => is_null($p->bill)))
                                            <span class="text-warning">มีบางรายการยังไม่แนบบิล</span>
                                        @else
                                            <span class="text-success">แนบบิลครบแล้ว</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('PaymentHistoryDetailAd', [
                                            'waste_address_id' => $wasteAddressId,
                                            'month' => $month,
                                            'year' => $year,
                                        ]) }}"
                                            class="btn btn-sm btn-primary">
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

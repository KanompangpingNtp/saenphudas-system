@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">บิลที่รอการชำระเงิน</h3>

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

                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">เบอร์โทร</th>
                                <th class="text-center">จำนวนเงิน</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nonPaymentsByUser as $group)
                                @php
                                    $firstPayment = $group->first();
                                    $user = $firstPayment->wasteManagement->user;
                                    $waste = $firstPayment->wasteManagement;
                                @endphp
                                <tr>
                                    <td>
                                        {{ $waste->address }}
                                    </td>
                                    <td class="text-center">{{ $waste->phone }}</td>
                                    <td class="text-center">{{ number_format($group->sum('amount'), 2) }} บาท</td>
                                    <td class="text-center">
                                        <span class="text-danger">ยังไม่ชำระ {{ $group->count() }} รายการ</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('NonPaymentDetail', ['user_id' => $user->id, 'month' => $month, 'year' => $year]) }}"
                                            class="btn btn-sm btn-primary">
                                            ดูบิล
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($nonPaymentsByAddress as $wasteAddressId => $group)
                                @php
                                    $firstPayment = $group->first();
                                    $wasteAddress = $firstPayment->wasteAddress;
                                    if (!$wasteAddress) {
                                        continue;
                                    }
                                    $wasteManagement = $firstPayment->wasteManagement;
                                    $user = $wasteManagement->user ?? null;
                                @endphp
                                <tr>
                                    <td>{{ $wasteAddress->name ?? '-' }}</td>
                                    <td class="text-center">{{ $wasteManagement->phone ?? '-' }}</td>
                                    <td class="text-center">{{ number_format($group->sum('amount'), 2) }} บาท</td>
                                    <td class="text-center">
                                        <span class="text-danger">ยังไม่ชำระ {{ $group->count() }} รายการ</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('NonPaymentDetailAd', ['waste_address_id' => $wasteAddressId, 'month' => $month, 'year' => $year]) }}"
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

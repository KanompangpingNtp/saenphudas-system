@extends('admin.layout.layout')
@section('admin_content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        select option:disabled {
            color: #aaa !important;
            /* สีเทาอ่อน */
        }

        select option {
            color: #000;
            /* สีดำเป็นค่าเริ่มต้น */
        }
    </style>

    <div class="container">
        <h2 class="text-center">ใบอนุญาตใกล้หมดอายุ</h2> <br>

        <form method="GET" action="{{ route('CertificatePrivateMarketExpire') }}" class="row g-2 mb-4">
            <div class="col-md-2">
                <select name="month" class="form-select">
                    <option value="">-- เลือกเดือน --</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}
                            {{ !in_array($m, $availableMonths->toArray()) ? 'disabled' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('th')->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="year" class="form-select">
                    <option value="">-- เลือกปี --</option>
                    @foreach (range(now()->year, now()->year - 5) as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}
                            {{ !in_array($y, $availableYears->toArray()) ? 'disabled' : '' }}>
                            {{ $y + 543 }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
            </div>
        </form>

        <br>

        <table class="table table-bordered table-striped" id="data_table">
            <thead class="text-center">
                <tr>
                    <th>วันที่ขอใบอนุญาต</th>
                    <th>ผู้ขอใบอนุญาต</th>
                    <th>วันที่ชำระเงิน</th>
                    <th>วันหมดอายุ</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($forms as $form)
                    @if ($form->details && $form->details->status != 11)
                        <tr>
                            <td class="date-column">{{ $form->created_at->format('Y-m-d') }}</td>
                            <td>{{ $form->salutation }} {{ $form->full_name }}</td>
                            <td>
                                @if ($form->payment)
                                    {{ $form->payment->created_at }}
                                @endif
                            </td>
                            <td>
                                @if ($form->payment && $form->payment->expiration_date)
                                    <span class="text-warning">
                                        {{ \Carbon\Carbon::parse($form->payment->expiration_date)->format('Y-m-d') }}</span>
                                @else
                                    <span class="text-danger">หมดอายุแล้ว</span>
                                @endif
                            </td>

                            <td>
                                @if ($form['details']->status == 10)
                                    <a href="{{ route('AdminCertificateHealthHazardApplicationPDF', $form->id) }}"
                                        class="badge rounded-pill text-bg-success" target="_blank" style="color: blue;">
                                        ออกใบอนุญาต
                                    </a>
                                    <a href="{{ url('storage/' . $form->payment->file_treasury) }}"
                                        class="badge rounded-pill text-bg-primary" target="_blank" style="color: blue;">
                                        ใบเสร็จกองคลัง
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('HealthHazardApplicationAdminExportPDF', $form->id) }}"
                                    class="btn btn-danger btn-sm" target="_blank">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                                {{-- <a href="{{ route('FoodStorageLicenseAdminDetail', $form->id) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-search"></i>
                                </a> --}}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>

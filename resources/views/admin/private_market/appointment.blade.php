@extends('admin.layout.layout')
@section('admin_content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<div class="container">
    <h2 class="text-center">แบบคำร้องขอจัดตั้งตลาดเอกชน <br>
        <h3 class="text-center">ตารางแสดงข้อมูลฟอร์มที่ส่งเข้ามา</h3>
    </h2> <br>

    <table class="table table-bordered table-striped" id="data_table">
        <thead class="text-center">
            <tr>
                <th>วันที่ขอใบอนุญาต</th>
                <th>ผู้ขอใบอนุญาต</th>
                <th>วันที่นัดหมาย</th>
                <th>วันที่สะดวก</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($forms as $form)
            <tr>
                <td class="date-column">{{ $form->created_at->format('Y-m-d') }}</td>
                <td>{{ $form->salutation }} {{ $form->full_name }}</td>
                <td>
                    @if($form->appointmentte)
                    {{ $form->appointmentte->date_admin }}
                    @endif
                </td>
                <td>
                    @if($form->appointmentte)
                    {{ $form->appointmentte->date_user }}
                    @endif
                </td>
                <td>
                    @if ($form->status == 3)
                    <span class="badge rounded-pill text-bg-primary">รอการนัดหมาย</span>
                    @elseif($form->status == 4)
                    <span class="badge rounded-pill text-bg-primary">รอยืนยันนัดหมาย</span>
                    @elseif($form->status == 5)
                    <span class="badge rounded-pill text-bg-warning">นัดหมายใหม่</span>
                    @elseif($form->status == 8)
                    <span class="badge rounded-pill text-bg-warning">ผลสำรวจไม่ผ่านรอการนัดหมายใหม่</span>
                    @endif
                </td>
                <td>
                    @if ($form->status != 4)
                    <a href="{{ route('PrivateMarketAdminCalendar', $form->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-calendar-check"></i>
                    </a>
                    @endif
                    {{-- <a href="{{ route('PrivateMarketAdminExportPDF', $form->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a> --}}
                    <a href="{{ route('PrivateMarketAdminDetail', $form->id) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-search"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<script src="{{ asset('js/datatable.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>

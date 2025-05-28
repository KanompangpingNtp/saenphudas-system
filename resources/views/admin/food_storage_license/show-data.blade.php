@extends('admin.layout.layout')
@section('admin_content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<div class="container">
    <h2 class="text-center">แบบคำร้องใบอนุญาต <br>
    </h2> <br>

    <table class="table table-bordered table-striped" id="data_table">
        <thead class="text-center">
            <tr>
                <th>วันที่ขอใบอนุญาต</th>
                <th>ผู้ขอใบอนุญาต</th>
                <th>ประเภทขอใบอนุญาต</th>
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
                    @if ($form['details']->confirm_option == 1)
                    จัดตั้งสถานที่จำหน่ายอาหาร
                    @elseif($form['details']->confirm_option == 2)
                    จัดตั้งสถานที่สะสมอาหาร
                    @endif
                </td>
                <td>
                    @if ($form['details']->status == 1)
                    <span class="badge rounded-pill text-bg-primary">รอรับเรื่อง</span>
                    @elseif($form['details']->status == 2)
                    <span class="badge rounded-pill text-bg-warning">รอการแก้ไข</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('FoodStorageLicenseAdminExportPDF', $form->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                    <a href="{{ route('FoodStorageLicenseAdminConfirm', $form->id) }}" class="btn btn-success btn-sm">
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
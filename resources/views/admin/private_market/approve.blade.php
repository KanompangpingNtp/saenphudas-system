@extends('admin.layout.layout')
@section('admin_content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <div class="container">
        <h2 class="text-center">แบบคำร้องขอจัดตั้งตลาดเอกชน <br>
        </h2> <br>

        <table class="table table-bordered table-striped" id="data_table">
            <thead class="text-center">
                <tr>
                    <th>วันที่ขอใบอนุญาต</th>
                    <th>ผู้ขอใบอนุญาต</th>
                    <th>วันที่ชำระเงิน</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($forms as $form)
                    @if ($form->status != 11)
                        <tr>
                            <td class="date-column">{{ $form->created_at->format('Y-m-d') }}</td>
                            <td>{{ $form->salutation }} {{ $form->full_name }}</td>
                            <td>
                                @if ($form->payment)
                                    {{ $form->payment->created_at }}
                                @endif
                            </td>
                            <td>
                                @if ($form->status == 10)
                                    {{-- <a href="{{ route('HealthHazardApplicationAdminExportPDF', $form->id) }}"
                                        class="badge rounded-pill text-bg-success" target="_blank">
                                        ออกใบอนุญาต
                                    </a> --}}
                                    <a href="{{ route('AdminCertificatePrivateMarketPDF', $form->id) }}"
                                        class="badge rounded-pill text-bg-success" target="_blank">
                                        ออกใบอนุญาต
                                    </a>
                                    <a href="{{ url('storage/' . $form->payment->file_treasury) }}"
                                        class="badge rounded-pill text-bg-primary" target="_blank">
                                        ใบเสร็จกองคลัง
                                    </a>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="confirmExtendLeave({{ $form->id }})">
                                    <i class="bi bi-calendar-plus"></i>
                                </button>
                                {{-- <a href="{{ route('HealthHazardApplicationAdminExportPDF', $form->id) }}"
                                    class="btn btn-danger btn-sm" target="_blank">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a> --}}
                                <a href="{{ route('HealthHazardApplicationAdminDetail', $form->id) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-search"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>

        <script>
            function confirmExtendLeave(formId) {
                Swal.fire({
                    title: 'ขยายเวลาใบอนุญาต',
                    text: 'คุณต้องการขยายเวลาใบอนุญาตหรือไม่?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/certificate/private_market/extend',
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: formId
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('เรียบร้อย!', response.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('เกิดข้อผิดพลาด', response.message || 'ไม่สามารถดำเนินการได้',
                                        'error');
                                }
                            },
                            error: function() {
                                Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้', 'error');
                            }
                        });
                    }
                });
            }
        </script>

    </div>
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>

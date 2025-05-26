@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <!-- ตัวอย่าง Card -->
        <div class="">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mb-4">ผู้ใช้บริการติดตั้งถังขยะ</h3>

                    <table class="table table-bordered table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ชื่อ</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">จำนวนค้างชำระ</th>
                                <th class="text-center">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forms as $index => $form)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $form->salutation }}{{ $form->name }}</td>
                                    <td>
                                        {{ $form->address }},
                                        หมู่ {{ $form->village }},
                                        ต.{{ $form->sub_district }},
                                        อ.{{ $form->district }},
                                        จ.{{ $form->province }}
                                    </td>
                                    <td class="text-center">
                                        @if ($form->status == 2)
                                            <span class="badge bg-success">ติดตั้งแล้ว</span>
                                        @else
                                            <span class="badge bg-secondary">ยังไม่ติดตั้ง</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $form->unpaid_count }} บิล
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('TrashInstallerDetail', $form->id) }}"
                                            class="btn btn-primary btn-sm"><i class='bx bx-search-alt'></i></a>
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

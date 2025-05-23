@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mb-4">ตำแหน่งที่ติดตั้งถังขยะ</h3>

                    <table class="table table-bordered" id="data_table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ชื่อ</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forms as $form)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $form->name }}</td>
                                    <td>ที่อยู่ {{ $form->address }} หมู่ที่ {{ $form->village }}
                                        ต.{{ $form->sub_district }} อ.{{ $form->district }} จ.{{ $form->province }}
                                    </td>
                                    <td class="text-center">
                                        @if ($form->trash_can_status == 1)
                                            <span class="text-warning">กำลังดำเนินการ</span>
                                        @elseif ($form->trash_can_status == 2)
                                            <span class="text-danger">รออนุมัติเรียกชำระเงิน</span>
                                        @elseif ($form->trash_can_status == 3)
                                            <span class="text-success">เสร็จสิ้น</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('TrashCanInstallationDetail', $form->id) }}"
                                            class="btn btn-primary btn-sm"><i class='bx  bx-search-alt'></i></a>

                                        @if ($form->trash_can_status == 2)
                                            <button class="btn btn-warning btn-sm">
                                                <i class='bx bx-wallet-alt'></i>
                                            </button>
                                        @endif
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

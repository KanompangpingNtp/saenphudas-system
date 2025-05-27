@extends('admin.layout.layout')
@section('admin_content')
<div class="container">
    <h2 class="text-center mb-4">แบบคำร้องใบอนุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</h2><br>

    <form action="{{route('HealthHazardApplicationAdminPaymentSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label for="formFile" class="form-label">เล่มที่ :</label>
                <input class="form-control" type="text" id="receipt_book" name="receipt_book">
            </div>
            <div class="col-md-7">
                <label for="formFile" class="form-label">เลขที่ :</label>
                <input class="form-control" type="text" id="receipt_number" name="receipt_number">
            </div>
            <div class="col-md-7">
                <label for="formFile" class="form-label">หลักฐานการชำระเงิน : </label>
                <a href="{{url('storage/'.$file->file)}}" class="btn btn-success btn-sm" target="_blank">
                    <i class="fa fa-search"></i>
                </a>
            </div>
            <div class="col-7">
                <label for="file" class="form-label">ใบเสร็จสำหรับกองคลัง : </label>
                <input type="file" id="file" class="form-control" name="file" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary py-1"><i class="fa fa-save"></i></i> ยืนยันการชำระเงิน</button>
        <input type="hidden" name="id" value="{{ old('id', $form->id) }}">
        <input type="hidden" name="file-id" value="{{ old('id', $file->id) }}">
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
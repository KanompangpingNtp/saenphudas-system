@extends('admin.layout.layout')
@section('admin_content')
<div class="container">
    <h2 class="text-center mb-4">แบบฟอร์มชำระเงินคำร้องขอใบอนุญาต</h2><br>

    <form action="{{route('FoodStorageLicensePaymentSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-3">
            <div class="col-md-12 d-flex justify-content-center">
                <h5>ยอดเงินที่ต้องชำระ {{$info->price}} บาท</h5>
            </div>
            <div class="col-md-12 mt-1 d-flex justify-content-center">
                <h5>ธนาคารกรุงไทย เลขที่บัญชี 775-0-27329-8</h5>
            </div>
            <div class="col-md-12 mt-1 d-flex justify-content-center">
                <h5>ชื่อบัญชี องค์การบริหารส่วนตำบลคลองอุดมชลจร</h5>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <img src="{{asset('/images/payment/QR.jpg')}}" width="40%">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="col-4 mb-3">
                    <label for="file" class="form-label">หลักฐานการชำระเงิน : </label>
                    <input type="file" id="file" class="form-control" name="file" required>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary py-1"><i class="fa fa-save"></i></i> ยืนยันการชำระเงิน</button>
            </div>
            <input type="hidden" name="id" value="{{ old('id', $form->id) }}">
        </div>
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
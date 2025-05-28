@extends('admin.layout.layout')
@section('admin_content')
<div class="container">
    <h2 class="text-center mb-4">แบบคำร้องขอจัดตั้งตลาดเอกชน</h2><br>

    <form action="{{route('PrivateMarketAdminChecklistSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label for="formFile" class="form-label">ไฟล์ออกสำรวจ :</label>
                <input class="form-control" type="file" id="formFile" name="formFile">
            </div>
            <div class="col-md-7">
                <label for="formFile" class="form-label">อัตราค่าธรรมเนียม :</label>
                <input class="form-control" type="text" id="price" name="price">
            </div>
            <h5>ผลออกสำรวจ</h5><br>
            <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="result" value="1">
                    <label class="form-check-label">
                        ผ่าน
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="result" value="2">
                    <label class="form-check-label">
                        ไม่ผ่าน
                    </label>
                </div>
            </div>
            <div class="col-md-7">
                <label for="number_of_food" class="form-label">หมายเหตุ : </label>
                <textarea rows="6" class="form-control" name="detail" id="detail"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary py-1"><i class="fa fa-save"></i></i> บันทึกข้อมูล</button>
        <input type="hidden" name="id" value="{{ old('id', $form->id) }}">
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>

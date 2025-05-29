@extends('users.layout.layout')
@section('pages_content')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">
    <a href="{{route('GeneralRequestsShowDetails')}}">กลับ</a><br>
    <h2 class="text-center">แก้ไขฟอร์ม</h2><br>

    <form action="{{ route('GeneralRequestsUserUpdateForm', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

         <!-- Row 1: วันที่ และ เรื่อง -->
         <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="date" class="form-label">วันที่</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $form->date) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="included" class="form-label">สิ่งที่ส่งมาด้วย<span class="text-danger">*</span></label>
            <textarea class="form-control" id="included" name="included" rows="2" required>{{ old('included', $form->included) }}</textarea>
        </div>

        <!-- Row 2: คำนำหน้า และ ชื่อ -->
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <input type="text" class="form-control" id="salutation" name="salutation" value="{{ old('salutation', $form->salutation) }}" maxlength="50">
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $form->name) }}" maxlength="255">
            </div>
            <div class="col-md-3">
                <label for="age" class="form-label">อายุ</label>
                <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $form->age) }}">
            </div>
        </div>

        <!-- Row 4: หมู่บ้าน, ตำบล, อำเภอ -->
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="house_number" class="form-label">บ้านเลขที่</label>
                <input type="text" class="form-control" id="house_number" name="house_number" value="{{ old('house_number', $form->house_number) }}" maxlength="50">
            </div>
            <div class="col-md-4">
                <label for="village" class="form-label">หมู่บ้าน</label>
                <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $form->village) }}" maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $form->subdistrict) }}" maxlength="100">
            </div>
        </div>

        <!-- Row 5: อำเภอ, จังหวัด และ เบอร์ติดต่อ -->
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $form->district) }}" maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $form->province) }}" maxlength="100">
            </div>
            <div class="col-md-4">
                <label for="phone" class="form-label">เบอร์ติดต่อ</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $form->phone) }}" maxlength="100">
            </div>
        </div>

        <!-- Row 6: รายละเอียดคำขอ -->
        <div class="mb-3">
            <label for="request_details" class="form-label">เรื่องร้องเรียนต่อองค์การบริหารส่วนตำบลคลองอุดมชลจร กรณี<span class="text-danger">*</span></label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required>{{ old('request_details', $form->request_details) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="proceedings" class="form-label">ข้าพเจ้าขอความอนุเคราะห์ให้องค์การบริหารส่วนตำบลคลองอุดมชลจร ดำเนินการ<span class="text-danger">*</span></label>
            <textarea class="form-control" id="proceedings" name="proceedings" rows="3" required>{{ old('proceedings', $form->proceedings) }}</textarea>
        </div>

        <!-- Row 7: แนบไฟล์ -->
        <div class="mb-3">
            <label class="form-label">ไฟล์แนบปัจจุบัน</label>
            <ul>
                @foreach ($form->gerFiles as $attachment)
                <li>
                    <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ basename($attachment->file_path) }}</a>
                    <input type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}"> ลบไฟล์นี้
                </li>
                @endforeach
            </ul>
        </div>

        <div class="mb-3">
            <label for="attachments" class="form-label">เพิ่มไฟล์แนบใหม่</label>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
            <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 10MB)</small>
            <div id="file-list" class="mt-1">
                <div class="d-flex flex-wrap gap-3"></div>
            </div>
        </div>

        <div class="text-center w-full border">
            <button type="submit" class="btn btn-primary w-100 py-1">
                <i class="fa-solid fa-file-arrow-up me-2"></i>
                บันทึกการเปลี่ยนแปลง
            </button>
        </div>
    </form>
</div>

@endsection

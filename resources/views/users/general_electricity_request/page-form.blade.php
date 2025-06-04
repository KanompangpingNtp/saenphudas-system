@extends('users.layout.layout')
@section('pages_content')
    <div class="container">
        <div class="mt-2 mb-3">
            <img src="{{ asset('eservice/5.png') }}" alt="" style="width: 100%; height: 600px;">
        </div>

        <h2 class="text-center mb-4">ฟอร์มส่งคำร้องทั่วไป (แจ้งเรื่องไฟฟ้า)</h2>

        <form action="{{ route('GeneralElectricityRequestFormCreate') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row 1: วันที่ และ เรื่อง -->
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label for="date" class="form-label">วันที่ <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                {{-- <div class="col-md-6">
                <label for="subject" class="form-label">เรื่อง <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subject" name="subject"  required>
            </div> --}}
            </div>

            <div class="mb-3">
                <label for="included" class="form-label">สิ่งที่ส่งมาด้วย<span class="text-danger">*</span></label>
                <textarea class="form-control" id="included" name="included" rows="2" required></textarea>
            </div>

            <!-- Row 2: คำนำหน้า และ ชื่อ -->
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label for="salutation" class="form-label">คำนำหน้า</label>
                    <select class="form-select" id="salutation" name="salutation">
                        <option value="" selected disabled>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-3">
                    <label for="age" class="form-label">อายุ (ปี) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>
            </div>

            <!-- Row 4: หมู่บ้าน, ตำบล, อำเภอ -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label for="house_number" class="form-label">บ้านเลขที่<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="house_number" name="house_number" maxlength="50"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="village" class="form-label">หมู่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="village" name="village" required>
                </div>
                <div class="col-md-4">
                    <label for="subdistrict" class="form-label">ตำบล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="subdistrict" name="subdistrict" required>
                </div>
                <div class="col-md-4">
                    <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="district" name="district" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="province" name="province" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="phone" class="form-label">เบอร์ติดต่อ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
            </div>

            <!-- Row 6: รายละเอียดคำขอ -->
            <div class="mb-3">
                <label for="request_details" class="form-label">เรื่องร้องเรียนต่อเทศบาลตำบลแสนภูดาษ กรณี<span
                        class="text-danger">*</span></label>
                <textarea class="form-control" id="request_details" name="request_details" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="proceedings" class="form-label">ข้าพเจ้าขอความอนุเคราะห์ให้เทศบาลตำบลแสนภูดาษ ดำเนินการ<span
                        class="text-danger">*</span></label>
                <textarea class="form-control" id="proceedings" name="proceedings" rows="3" required></textarea>
            </div>

            <p>จึงเรียนมาเพื่อโปรดพิจารณาให้ความอนุเคราะห์ในเรื่องฯ ดังกล่าว จะขอบคุณยิ่ง </p>

            <div class="mb-3">
                <label for="attachments" class="form-label">แนบไฟล์บัตรประชาชน <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple required>
            </div>

            <!-- Row 7: แนบไฟล์ -->
            <div class="mb-3">
                <label for="attachments" class="form-label">แนบไฟล์เพิ่มเติม</label>
                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
                <div id="file-list" class="mt-1">
                    <div class="d-flex flex-wrap gap-3"></div>
                </div>
            </div>

            <!-- ปุ่มบันทึก -->
            <div class="text-center w-full border">
                <button type="submit" class="btn btn-primary w-100 py-1"><i
                        class="fa-solid fa-file-arrow-up me-2"></i></i>
                    ส่งฟอร์มข้อมูล</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/multipart_files.js') }}"></script>
@endsection

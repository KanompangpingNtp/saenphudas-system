@extends('users.layout.layout')
@section('pages_content')
    <div class="container">
        <h2 class="text-center mb-4">แบบคำร้องขอจัดตั้งตลาดเอกชน</h2><br>

        <form action="{{ route('PrivateMarketFormCreate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="col-md-3">
                    <label for="written_at" class="form-label">เขียนที่</label>
                    <input type="text" class="form-control require" id="written_at" name="written_at" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="salutation" class="form-label">คำนำหน้า <span class="text-danger">*</span></label>
                    <select class="form-select require" id="salutation" name="salutation" required>
                        <option value="" selected disabled>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="full_name" name="full_name" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="age" name="age" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="" name="" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="force" class="form-label">บังคับ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="force" name="force" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="house_number" class="form-label">อยู่บ้านเลขที่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="house_number" name="house_number" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="road" class="form-label">ถนน</label>
                    <input type="text" class="form-control require" id="road" name="road">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="village" class="form-label">หมู่ที่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="village" name="village" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="sub_district" class="form-label">ตำบล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="sub_district" name="sub_district" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="district" name="district" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="province" name="province" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="submit_request" class="form-label">ขอยื่นเรื่องราวต่อ <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="submit_request" name="submit_request"
                        required>
                </div>

                <p>เพื่อขออนุญาตใช้สถานที่ซึ่งตั้งอยู่ </p>

                <div class="col-md-3 mb-3">
                    <label for="submit_road" class="form-label">ถนน</label>
                    <input type="text" class="form-control require" id="submit_road" name="submit_road">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_number" class="form-label">เลขที่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="submit_number" name="submit_number" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_sub_district" class="form-label">ตำบล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="submit_sub_district"
                        name="submit_sub_district" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="submit_district" name="submit_district"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="submit_province" name="submit_province"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="annual_market" class="form-label">เพื่อใช้เป็นตลาดเอกชนประจำปี <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="annual_market" name="annual_market" required>
                </div>
            </div>

            <div class="mb-3 mt-2">
                <label for="attachments" class="form-label">แนบไฟล์ (รูปหรือเอกสารประกอบ)</label>
                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 10MB)</small>
                <div id="file-list" class="mt-1">
                    <div class="d-flex flex-wrap gap-3"></div>
                </div>
            </div>

            <div class="text-center w-full border mt-3">
                <button type="submit" class="btn btn-primary w-100 py-1"><i
                        class="fa-solid fa-file-arrow-up me-2"></i></i>ส่งฟอร์มข้อมูล</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/multipart_files.js') }}"></script>
@endsection

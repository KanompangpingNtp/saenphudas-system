@extends('users.layout.layout')
@section('pages_content')

<div class="container">
    <h2 class="text-center mb-4">คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน <br>
        ตามมาตรา ๕๔ วรรคสอง แห่งพระราชบัญญัติภาษีที่ดินและสิ่งปลูกสร้าง พ.ศ. ๒๕๖๒
    </h2> <br>

    <form action="{{route('LandTaxRefundRequestFormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-2">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="full_name" name="full_name" maxlength="255" required>
            </div>

            <div class="col-md-3">
                <label for="house_number" class="form-label">บ้านเลขที่<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="house_number" name="house_number" maxlength="50" required>
            </div>

            <div class="col-md-3">
                <label for="village" class="form-label">หมู่บ้าน </label>
                <input type="text" class="form-control" id="village" name="village" maxlength="100" required>
            </div>

            <div class="col-md-3">
                <label for="alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="alley" name="alley" required>
            </div>

            <div class="col-md-3">
                <label for="road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="road" name="road" required>
            </div>

            <div class="col-md-3">
                <label for="subdistrict" class="form-label">ตำบล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" maxlength="100" required>
            </div>

            <div class="col-md-3">
                <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" maxlength="100" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="province" name="province" maxlength="100" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="phone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone" maxlength="100" required>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="mb-3 col-md-4">
                <label for="tax_year" class="form-label">
                    ได้รับชำระเงินค่าภาษีที่ดินและสิ่งปลูกสร้าง ประจำปี พ.ศ. <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="tax_year" name="tax_year" required>
                </div>
            </div>

            <div class="mb-3 col-md-2">
                <label for="amount" class="form-label">จำนวน (บาท) </label>
                <input type="text" class="form-control" id="amount" name="amount">
            </div>

            <div class="mb-3 col-md-3">
                <label for="receipt_number" class="form-label">ตามใบเสร็จรับเงินเลขที่ </label>
                <input type="text" class="form-control" id="receipt_number" name="receipt_number">
            </div>

            <div class="mb-3 col-md-3">
                <label for="dated" class="form-label">ลงวันที่ </label>
                <input type="date" class="form-control" id="dated" name="dated">
            </div>

            <div class="mb-3 col-md-5">
                <label for="tax_money" class="form-label">
                    มีความประสงค์ขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างที่จ่ายเกินคืน จำนวน (บาท)
                </label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="tax_money" name="tax_money" required>
                </div>
            </div>

            <div class="mb-3 col-md-7">
                <label class="form-label">เนื่องจาก</label><br>

                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="option1" name="due_to_options[]" value="option1">
                        <label class="form-check-label" for="option1">ไม่มีหน้าที่ต้องเสีย</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="option2" name="due_to_options[]" value="option2">
                        <label class="form-check-label" for="option2">เสียเกินกว่าที่ควรจะเสีย</label>
                    </div>
                </div>
            </div>

            <div>
                <p>โดยได้ยื่นเอกสารเพื่อเป็นหลักฐานประกอบการพิจารณา ดังนี้</p>
                <p>๑. ใบเสร็จรับเงินปีที่ผ่านมา หรือหลักฐานการชำระเงิน</p>
                <p>๒. หนังสือมอบอำนาจกรณียิ้นคำร้องแทน</p>
                <p>๓. บัตรประจำตัวประชาชน</p>

                <label for="other_documents" class="form-label">๔. อื่นๆ</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="other_documents" name="other_documents">
                </div>

                <br>

                <p><strong>ขอรับรองว่า ข้อความข้างต้นเป็นตจริงทุกประการ</strong></p>
            </div>
        </div>

        <div class="mb-3">
            <label for="attachments" class="form-label">แนบไฟล์ (รูปหรือเอกสารประกอบคำร้อง)</label>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
            <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
            <div id="file-list" class="mt-1">
                <div class="d-flex flex-wrap gap-3"></div>
            </div>
        </div>

        <div class="text-center w-full border">
            <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>
                ส่งฟอร์มข้อมูล</button>
        </div>

    </form>
</div>

@endsection

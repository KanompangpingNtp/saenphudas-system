@extends('users.layout.layout')
@section('pages_content')

<div class="container">
    <h2 class="text-center mb-4">คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง <br>
        ตามมาตรา ๗๓ วรรคสอง แห่งพระราชบัญญัติภาษีที่ดินและสิ่งปลูกสร้าง พ.ศ. ๒๕๖๒
    </h2> <br>

    <form action="{{route('LandBuildingTaxAppealFormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <div class="col-md-12">
                <label for="delivered_to" class="form-label">เรียน</label>
                <input type="text" class="form-control" id="delivered_to" name="delivered_to" required>
            </div>
        </div>

        <div class="mb-3 mt-4">
            <p><strong>ตามที่พนักงานประเมินได้แจ้งการประเมินหรือเรียกเก็บภาษีที่กินและสิ่งปลูกสร้าง ประจำปี</strong></p>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="year" class="form-label">พ.ศ</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>

            <div class="col-md-3">
                <label for="number" class="form-label">เลขที่ ..../.... </label>
                <input type="text" class="form-control" id="number" name="number" required>
            </div>

            <div class="col-md-3">
                <label for="dated" class="form-label">ลงวันที่</label>
                <input type="date" class="form-control" id="dated" name="dated" required>
            </div>

            <div class="col-md-3">
                <label for="received_date" class="form-label">ซึ่งข้าพเจ้าได้รับเมื่อวันที่</label>
                <input type="date" class="form-control" id="received_date" name="received_date" required>
            </div>
        </div>

        <div class="mb-3 mt-4">
            <p><strong>ข้าพเจ้า</strong></p>
        </div>

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

            <div class="col-md-9">
                <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
        </div>

        <div class="mb-3">
            <p><strong>ขอยื่นคำร้องคัดค้านการประเมินภาษี หรือการเรียกเก็บภาษีไม่ถูกต้อง</strong></p>
        </div>

        <div class="mb-3 col-md-12">
            <label for="due_to" class="form-label">เนื่องจาก</label>
            <textarea class="form-control" id="due_to" name="due_to" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <p>โดยข้าพเจ้าได้แนบเอกสารหลักฐาน จำนวน
                <input type="text" class="form-control d-inline" style="width: 80px;" name="documents">
                ฉบับ มาเพื่อประกอบการพิจารณาทบทวนการประเมินหรือเรียกเก็บภาษีใหม่
            </p>
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

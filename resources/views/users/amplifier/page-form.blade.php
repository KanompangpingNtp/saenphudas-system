@extends('users.layout.layout')
@section('pages_content')
    <div class="container">
        <h2 class="text-center mb-4">คำร้องขออนุญาตทำการโฆษณาโดยใช้เครื่องขยายเสียง</h2><br>

        <form action="{{ route('AmplifierFormCreate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="col-md-4 mb-3">
                    <label for="written_at" class="form-label">เขียนที่</label>
                    <input type="text" class="form-control require" id="written_at" name="written_at" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="salutation" class="form-label">คำนำหน้า</label>
                    <select class="form-select" id="salutation" name="salutation">
                        <option value="" selected disabled>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="age" name="age" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="ethnicity" class="form-label">เชื้อชาติ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ethnicity" name="ethnicity" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="nationality" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required>
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
                <div class="col-md-4 mb-3">
                    <label for="registration_number1" class="form-label">ชื่อผู้ปกครองเครื่องขยายเสียงเลขหมายทะเบียนที่
                        <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="registration_number1"
                        name="registration_number1" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="registration_number2" class="form-label">ไมโครโฟนเลขหมายทะเบียนที่ <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="registration_number2"
                        name="registration_number2" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="registration_number3" class="form-label">และเครื่องบันทึกเสียงเลขหมายทะเบียนที่ <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="registration_number3"
                        name="registration_number3" required>
                </div>
            </div>

            <br>

            <div>
                <p><strong>ขอทำคำร้องยื่นต่อเจ้าพนักงานผู้ออกใบอนุญาติมีข้อความดังต่อไปนี้</strong></p>

                <div class="col-md-12 mb-3">
                    <label for="have_intention" class="form-label">
                        ข้อ 1 ข้าพเจ้ามีความประสงค์จะใช้เครื่องดังกล่าวมานั้นเพื่อทำการโฆษณากิจการ
                        <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control require" id="have_intention" name="have_intention" rows="3" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="location_at" class="form-label">ณ ที่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_at" name="location_at" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_number" class="form-label">เลขที่<span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_number" name="location_number"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_village" class="form-label">หมู่ที่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_village" name="location_village"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_road" class="form-label">ถนน</label>
                    <input type="text" class="form-control require" id="location_road" name="location_road">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_sub_district" class="form-label">ตำบล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_sub_district"
                        name="location_sub_district" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_district" name="location_district"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_province" name="location_province"
                        required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="location_set" class="form-label">มีกำหนด (วัน) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control require" id="location_set" name="location_set" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_start" class="form-label">ตั้งแต่วันที่ <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control require" id="location_start" name="location_start"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="location_end" class="form-label">ถึงวันที่ <span class="text-danger">*</span></label>
                    <input type="date" class="form-control require" id="location_end" name="location_end" required>
                </div>
            </div>

            <div>
                <p>ข้อ 2 ข้าพเจ้ารับรองว่าจะปฏิบัติให้ถูกต้องตามกฏหมาย
                    กฏข้อบังคับและเงื่อนไขว่าด้วยการควบคุมการโฆษณาโดยเครื่องหมายเสียงทุกประการ</p>
            </div>

            <div class="row">
                <div class="col-md-auto">
                    <p class="mb-0 d-inline">
                        ข้อ 3 ข้าพเจ้าได้แนบใบอนุญาตให้มีเพื่อใช้ ซึ่งมีเลขหมายทะเบียนตามที่แจ้งในคำร้องนี้รวม
                    </p>
                </div>
                <div class="col-md-1 mb-3">
                    <input type="text" class="form-control require" name="license_number" id="license_number"
                        required>
                </div>
                <div class="col-md-auto">
                    <p class="mb-0 d-inline">
                        ฉบับ มาเพื่อประกอบการพิจารณาด้วยแล้ว
                    </p>
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
@endsection

@extends('users.layout.layout')
@section('pages_content')
<div class="container">
    <h2 class="text-center mb-4">แบบฟอร์ม(ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง</h2><br>

    <form action="{{route('ChangeInUseFormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">

            <h5>ข้อมูลผู้ขอยื่นแบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ในที่ดินหรือสิ่งปลูกสร้าง</h5><br>
            <div class="col-md-3">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>

            <div class="col-md-3">
                <label for="address" class="form-label">อยู่บ้านเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="col-md-3">
                <label for="village" class="form-label">หมู่ที่ </label>
                <input type="text" class="form-control" id="village" name="village" required>
            </div>

            <div class="col-md-3">
                <label for="road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="road" name="road">
            </div>

            <div class="col-md-3">
                <label for="subdistrict" class="form-label">ตำบล/แขวง <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" required>
            </div>

            <div class="col-md-3">
                <label for="district" class="form-label">อำเภอ/เขต <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" required>
            </div>

            <div class="col-md-3">
                <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="province" name="province" required>
            </div>
        </div>
        <hr>
        <h5>ข้าพเจ้ามีทรัพย์สินประเภท</h5><br>
        <h5>1.ที่ดิน</h5><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="land_total" class="form-label">ที่ดินจำนวน (แปลง)</label>
                <input type="text" class="form-control" id="land_total" name="land_total">
            </div>
        </div>
        <h6>1.1 ข้อมูลที่ดิน</h6><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="land_on" class="form-label">แปลงที่</label>
                <input type="text" class="form-control" id="land_on" name="land_on">
            </div>
            <div class="col-md-3">
                <label for="land_village" class="form-label">ตั้งอยู่หมู่ที่</label>
                <input type="text" class="form-control" id="land_village" name="land_village">
            </div>
            <div class="col-md-3">
                <label for="land_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="land_road" name="land_road">
            </div>
            <div class="col-md-3">
                <label for="land_subdistrict" class="form-label">ตำบล/แขวง </label>
                <input type="text" class="form-control" id="land_subdistrict" name="land_subdistrict">
            </div>
            <div class="col-md-3">
                <label for="land_district" class="form-label">อำเภอ/เขต </label>
                <input type="text" class="form-control" id="land_district" name="land_district">
            </div>
            <div class="col-md-3">
                <label for="land_province" class="form-label">จังหวัด </label>
                <input type="text" class="form-control" id="land_province" name="land_province">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="land_deed" class="form-label">เลขที่โฉนดหรือหนังสือสำคัญ </label>
                <input type="text" class="form-control" id="land_deed" name="land_deed">
            </div>
            <div class="col-md-3">
                <label for="land_rai" class="form-label">เนื้อที่ดิน (ไร่) </label>
                <input type="text" class="form-control" id="land_rai" name="land_rai">
            </div>
            <div class="col-md-3">
                <label for="land_unit" class="form-label">เนื้อที่ดิน (งาน) </label>
                <input type="text" class="form-control" id="land_unit" name="land_unit">
            </div>
            <div class="col-md-3">
                <label for="land_wa" class="form-label">เนื้อที่ดิน (ตารางวา) </label>
                <input type="text" class="form-control" id="land_wa" name="land_wa">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="land_default_use" class="form-label">เดิมที่ดินแปลงนี้ใช้ทำประโยชน์ </label>
                <input type="text" class="form-control" id="land_default_use" name="land_default_use">
            </div>
            <div class="col-md-3">
                <label for="land_current_use" class="form-label">ปัจจุบันที่ดินนี้ใช้ประโยชน์ </label>
                <input type="text" class="form-control" id="land_current_use" name="land_current_use">
            </div>
            <div class="col-md-3">
                <label for="land_current_date" class="form-label">ตั้งแต่วันที่ </label>
                <input type="date" class="form-control" id="land_current_date" name="land_current_date">
            </div>
        </div>
        <hr>
        <h5>2.สิ่งปลูกสร้าง</h5><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="build_total" class="form-label">สิ่งปลูกสร้างจำนวน (หลัง)</label>
                <input type="text" class="form-control" id="build_total" name="build_total">
            </div>
        </div>
        <br>
        <h6>2.1 ข้อมูลสิ่งปลูกสร้าง</h6><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="build_on" class="form-label">หลังที่</label>
                <input type="text" class="form-control" id="build_on" name="build_on">
            </div>
            <div class="col-md-3">
                <label for="build_village" class="form-label">ตั้งอยู่หมู่ที่</label>
                <input type="text" class="form-control" id="build_village" name="build_village">
            </div>
            <div class="col-md-3">
                <label for="build_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="build_road" name="build_road">
            </div>
            <div class="col-md-3">
                <label for="build_subdistrict" class="form-label">ตำบล/แขวง </label>
                <input type="text" class="form-control" id="build_subdistrict" name="build_subdistrict">
            </div>
            <div class="col-md-3">
                <label for="build_district" class="form-label">อำเภอ/เขต </label>
                <input type="text" class="form-control" id="build_district" name="build_district">
            </div>
            <div class="col-md-3">
                <label for="build_province" class="form-label">จังหวัด </label>
                <input type="text" class="form-control" id="build_province" name="build_province">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="build_deed" class="form-label">บนที่ดินเลขที่โฉนดหรือหนังสือสำคัญ </label>
                <input type="text" class="form-control" id="build_deed" name="build_deed">
            </div>
            <div class="col-md-3">
                <label for="build_meter" class="form-label">ขนาดพื้นที่สิ่งปลูกสร้าง (ตารางเมตร) </label>
                <input type="text" class="form-control" id="build_meter" name="build_meter">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="build_default_use" class="form-label">เดิมสิ่งปลูกสร้างนี้ใช้ทำประโยชน์ </label>
                <input type="text" class="form-control" id="build_default_use" name="build_default_use">
            </div>
            <div class="col-md-3">
                <label for="build_current_use" class="form-label">ปัจจุบันสิ่งปลูกสร้างนี้ใช้ประโยชน์ </label>
                <input type="text" class="form-control" id="build_current_use" name="build_current_use">
            </div>
            <div class="col-md-3">
                <label for="build_current_date" class="form-label">ตั้งแต่วันที่ </label>
                <input type="date" class="form-control" id="build_current_date" name="build_current_date">
            </div>
        </div>
        <hr>
        <h5>3.อาคารชุด/ห้องชุด</h5><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="room_total" class="form-label">อาคารชุด/ห้องชุด (ห้อง)</label>
                <input type="text" class="form-control" id="room_total" name="room_total">
            </div>
        </div>
        <br>
        <h6>3.1 ข้อมูลอาคารชุด/ห้องชุด</h6><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="room_name" class="form-label">ชื่ออาคารชุด/ห้องชุด</label>
                <input type="text" class="form-control" id="room_name" name="room_name">
            </div>
            <div class="col-md-3">
                <label for="room_on" class="form-label">เลขที่/ห้องที่</label>
                <input type="text" class="form-control" id="room_on" name="room_on">
            </div>
            <div class="col-md-3">
                <label for="room_village" class="form-label">ตั้งอยู่หมู่ที่</label>
                <input type="text" class="form-control" id="room_village" name="room_village">
            </div>
            <div class="col-md-3">
                <label for="room_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="room_road" name="room_road">
            </div>
            <div class="col-md-3">
                <label for="room_subdistrict" class="form-label">ตำบล/แขวง </label>
                <input type="text" class="form-control" id="room_subdistrict" name="room_subdistrict">
            </div>
            <div class="col-md-3">
                <label for="room_district" class="form-label">อำเภอ/เขต </label>
                <input type="text" class="form-control" id="room_district" name="room_district">
            </div>
            <div class="col-md-3">
                <label for="room_province" class="form-label">จังหวัด </label>
                <input type="text" class="form-control" id="room_province" name="room_province">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="room_deed" class="form-label">บนที่ดินเลขที่โฉนดหรือหนังสือสำคัญ </label>
                <input type="text" class="form-control" id="room_deed" name="room_deed" required>
            </div>
            <div class="col-md-3">
                <label for="room_meter" class="form-label">ขนาดพื้นที่อาคารชุด/ห้องชุด (ตารางเมตร) </label>
                <input type="text" class="form-control" id="room_meter" name="room_meter">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="room_default_use" class="form-label">เดิมอาคารชุด/ห้องชุดนี้ใช้ทำประโยชน์ </label>
                <input type="text" class="form-control" id="room_default_use" name="room_default_use">
            </div>
            <div class="col-md-3">
                <label for="room_current_use" class="form-label">ปัจจุบันอาคารชุด/ห้องชุดนี้ใช้ทำประโยชน์ </label>
                <input type="text" class="form-control" id="room_current_use" name="room_current_use">
            </div>
            <div class="col-md-3">
                <label for="room_current_date" class="form-label">ตั้งแต่วันที่ </label>
                <input type="date" class="form-control" id="room_current_date" name="room_current_date">
            </div>
        </div>

        <div class="text-center w-full border mt-5">
            <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>
                ส่งฟอร์มข้อมูล</button>
        </div>
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>

@endsection
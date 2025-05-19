@extends('users.layout.layout')
@section('pages_content')
<div class="container">
    <h2 class="text-center mb-4">แบบฟอร์มหนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด</h2><br>

    <form action="{{route('PayTaxBuildAndRoomFormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-3">
            <h5>1. ข้อมูลรายละเอียด</h5>
            <div class="col-md-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_individual" value="บุคคลธรรมดา" required checked>
                    <label class="form-check-label" for="person_individual">
                        บุคคลธรรมดา
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_legal" value="นิติบุคคล">
                    <label class="form-check-label" for="person_legal">
                        นิติบุคคล
                    </label>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3" id="personal_div">

            <h5>ก. กรณีเป็นบุคคลธรรมดา</h5><br>
            <div class="col-md-3">
                <label for="personal_salutation" class="form-label">คำนำหน้า <span class="text-danger">*</span></label>
                <select class="form-select require" id="personal_salutation" name="personal_salutation" required>
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="personal_full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_full_name" name="personal_full_name" required>
            </div>

            <div class="col-md-3">
                <label for="personal_age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_age" name="personal_age" required>
            </div>

            <div class="col-md-3">
                <label for="personal_id_card_number" class="form-label">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_id_card_number" name="personal_id_card_number" required maxlength="13">
            </div>

            <div class="col-md-3">
                <label for="personal_id_card_by" class="form-label">ออกให้โดย <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_id_card_by" name="personal_id_card_by" required>
            </div>

            <div class="col-md-3">
                <label for="personal_id_card_date" class="form-label">หมดอายุวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control require" id="personal_id_card_date" name="personal_id_card_date" required>
            </div>

            <div class="col-md-3"></div>

            <div class="col-md-3">
                <label for="personal_address" class="form-label">อยู่บ้านเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_address" name="personal_address" required>
            </div>

            <div class="col-md-3">
                <label for="personal_village" class="form-label">หมู่ที่ </label>
                <input type="text" class="form-control require" id="personal_village" name="personal_village" required>
            </div>

            <div class="col-md-3">
                <label for="personal_alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="personal_alley" name="personal_alley">
            </div>

            <div class="col-md-3">
                <label for="personal_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="personal_road" name="personal_road">
            </div>

            <div class="col-md-3">
                <label for="personal_subdistrict" class="form-label">แขวง/ตำบล <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_subdistrict" name="personal_subdistrict" required>
            </div>

            <div class="col-md-3">
                <label for="personal_district" class="form-label">เขต/อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_district" name="personal_district" required>
            </div>

            <div class="col-md-3">
                <label for="personal_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_province" name="personal_province" required>
            </div>

            <div class="col-md-3">
                <label for="personal_telephone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="personal_telephone" name="personal_telephone" required maxlength="10">
            </div>

            <div class="col-md-3">
                <label for="personal_line" class="form-label">Line ID (ถ้ามี) </label>
                <input type="text" class="form-control" id="personal_line" name="personal_line">
            </div>

            <div class="col-md-3">
                <label for="personal_email" class="form-label">อีเมล (ถ้ามี)</label>
                <input type="text" class="form-control" id="personal_email" name="personal_email">
            </div>

        </div>

        <div class="row g-3 mb-3" id="org_div" style="display:none;">

            <h5>ข. กรณีเป็นนิติบุคคล</h5><br>
            <div class="col-md-3">
                <label for="org_salutation" class="form-label">คำนำหน้า <span class="text-danger">*</span></label>
                <select class="form-select require" id="org_salutation" name="org_salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="บริษัท">บริษัท</option>
                    <option value="ร้าน">ร้าน</option>
                    <option value="หจก.">หจก.</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="org_full_name" class="form-label">ชื่อสถานประกอบการ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_full_name" name="org_full_name">
            </div>

            <div class="col-md-3">
                <label for="org_address" class="form-label">สำนักงานใหญ่เลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_address" name="org_address">
            </div>

            <div class="col-md-3">
                <label for="org_village" class="form-label">หมู่ที่ </label>
                <input type="text" class="form-control" id="org_village" name="org_village">
            </div>

            <div class="col-md-3">
                <label for="org_alley" class="form-label">ตรอก/ซอย </label>
                <input type="text" class="form-control" id="org_alley" name="org_alley">
            </div>

            <div class="col-md-3">
                <label for="org_road" class="form-label">ถนน <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_road" name="org_road">
            </div>

            <div class="col-md-3">
                <label for="org_subdistrict" class="form-label">แขวง/ตำบล <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_subdistrict" name="org_subdistrict">
            </div>

            <div class="col-md-3">
                <label for="org_district" class="form-label">เขต/อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_district" name="org_district">
            </div>

            <div class="col-md-3">
                <label for="org_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_province" name="org_province">
            </div>

            <div class="col-md-3">
                <label for="org_telephone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_telephone" name="org_telephone" maxlength="10">
            </div>

            <div class="col-md-3"></div>

            <h5>ผู้มีอำนาจลงนามผูกพันนิติบุคคล</h5>
            <div class="col-md-3">
                <label for="org_salutation_2" class="form-label">คำนำหน้า <span class="text-danger">*</span></label>
                <select class="form-select require" id="org_salutation_2" name="org_salutation_2">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="org_full_name_2" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_full_name_2" name="org_full_name_2">
            </div>

            <div class="col-md-3">
                <label for="org_age_2" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_age_2" name="org_age_2">
            </div>

            <div class="col-md-3">
                <label for="org_id_card_2" class="form-label">บัตรประจำตัวประชาชนเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_id_card_2" name="org_id_card_2">
            </div>

            <div class="col-md-3">
                <label for="org_id_card_by_2" class="form-label">ออกให้โดย <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_id_card_by_2" name="org_id_card_by_2">
            </div>

            <div class="col-md-3">
                <label for="org_id_card_date_2" class="form-label">หมดอายุวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control require" id="org_id_card_date_2" name="org_id_card_date_2">
            </div>

            <div class="col-md-3">
            </div>

            <div class="col-md-9">
                <label for="org_certificate" class="form-label">มีอำนาจลงนามผูกพันนิติบุคคล ตามหนังสือรับรองของสำนักงานทะเบียนหุ้นส่วนบริษัท <span class="text-danger">*</span></label>
                <input type="text" class="form-control require" id="org_certificate" name="org_certificate">
            </div>

            <div class="col-md-3">
                <label for="org_certificate_date" class="form-label">ลงวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control require" id="org_certificate_date" name="org_certificate_date">
            </div>

            <div class="col-md-3">
                <label for="org_line" class="form-label">Line ID (ถ้ามี) </label>
                <input type="text" class="form-control" id="org_line" name="org_line">
            </div>

            <div class="col-md-3">
                <label for="org_email" class="form-label">อีเมล (ถ้ามี) </label>
                <input type="text" class="form-control" id="org_email" name="org_email">
            </div>

        </div>

        <hr>
        <h5>2. ข้าพเจ้ายอมรับว่าได้รับแจ้งการประเมินภาษีที่ดินและสิ่งปลูกสร้าง/ห้องชุด ประจำปีภาษี</h5><br>
        <div class="row g-3 mb-3">

            <div class="col-md-3">
                <label for="year" class="form-label">ประจำปีภาษี (ภ.ด.ส.๖) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>

            <div class="col-md-3">
                <label for="date" class="form-label">เมื่อวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date" name="date">
            </div>

            <div class="col-md-3">
                <label for="total" class="form-label">เป็นเงินทั้งสิ้น <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="total" name="total" required>
            </div>

        </div>
        <hr>
        <h5>3. ค่าภาษีที่ดินและสิ่งปลูกสร้าง/ห้องชุด ตามข้อ 2. ข้าพเจ้าไม่สามารถชำระให้เสร็จสิ้นในคราวเดียวกันได้จึงขอผ่อนชำระเป็นจำนวน 3 งวด ๆ ละเท่า ๆ กัน ภายในกำหนดเวลา หากมีเศษเหลือเท่าใดใช้ชำระในงวดที่ 1 ดังนี้</h5><br>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="round_date_1" class="form-label">งวดที่ 1 ชำระภายในวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="round_date_1" name="round_date_1" required>
            </div>

            <div class="col-md-6">
                <label for="round_total_1" class="form-label">จำนวน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="round_total_1" name="round_total_1" required>
            </div>
            <div class="col-md-6">
                <label for="round_date_2" class="form-label">งวดที่ 2 ชำระภายในวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="round_date_2" name="round_date_2" required>
            </div>

            <div class="col-md-6">
                <label for="round_total_2" class="form-label">จำนวน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="round_total_2" name="round_total_2" required>
            </div>
            <div class="col-md-6">
                <label for="round_date_3" class="form-label">งวดที่ 3 ชำระภายในวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="round_date_3" name="round_date_3" required>
            </div>

            <div class="col-md-6">
                <label for="round_total_3" class="form-label">จำนวน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="round_total_1" name="round_total_3" required>
            </div>
        </div>
        <hr>
        <h5>4. ข้าพเจ้ายอมรับและตกลงว่า ถ้าข้าพเจ้าผิดนัดชำระงวดหนึ่งงวดใด ถือว่าหมดสิทธิที่จะผ่อนชำระ และต้องเสียเงินเพิ่มอีกร้อยละหนึ่งต่อเดือนของจำนวนภาษีที่ค้างชำระ เศษของเดือนให้นับเป็นหนึ่งเดือน ตามมาตรา ๕๒ แห่งพระราชบัญญัติภาษีที่ดินและสิ่งปลูกสร้าง พ.ศ.๒๕๖๒</h5><br>
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="confirm" id="confirm" value="1" required>
                    <label class="form-check-label" for="confirm">
                        ยอมรับ
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-12">
            <label class="form-label"><strong>เอกสารแนบมาพร้อมกับคำขอนี้ </strong></label><br>
            <div class="form-check">
                <label class="form-check-label">- แนบสำเนาบัตรประจำตัวประชาชน (กรณีเป็นบุคคลธรรมดา)</label>
            </div>
            <div class="form-check">
                <label class="form-check-label">- แนบสำเนาหนังสือรับรอง สำเนาบัตรประจำตัวประชาชน และหนังสือมอบอำนาจ ถ้ามี(กรณีเป็นนิติบุคคล)</label>
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
        <br>
        <div class="text-center w-full border">
            <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>ส่งฟอร์มข้อมูล</button>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/multipart_files.js')}}"></script>
<script>
    $('#person_individual').change(function(e) {
        e.preventDefault();
        if ($('#person_individual').is(":checked")) {
            $('#personal_div').find('.require').attr('required', true);
            $('#org_div').find('.require').attr('required', false);
            $('#org_div').find('input').val('');
            $('#org_div').find('select').val('');
            $('#personal_div').find('input').val('');
            $('#personal_div').find('select').val('');
            $('#org_div').hide();
            $('#personal_div').show();
        }
    });
    $('#person_legal').change(function(e) {
        e.preventDefault();
        if ($('#person_legal').is(":checked")) {
            $('#org_div').find('.require').attr('required', true);
            $('#personal_div').find('.require').attr('required', false);
            $('#org_div').find('input').val('');
            $('#org_div').find('select').val('');
            $('#personal_div').find('input').val('');
            $('#personal_div').find('select').val('');
            $('#personal_div').hide();
            $('#org_div').show();
        }
    });
</script>

@endsection
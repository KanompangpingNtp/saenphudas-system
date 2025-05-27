@extends('users.layout.layout')
@section('pages_content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="container">
    <h2 class="text-center mb-4">แบบคำร้องใบอนุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</h2><br>

    <form action="{{route('HealthHazardApplicationFormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label class="form-label d-block">ข้าพเจ้า <span class="text-danger">*</span></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_individual" value="บุคคลธรรมดา" required>
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

            <div class="col-md-2">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="full_name" class="form-label" id="full_name_input">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>

            <div class="col-md-2 div-empty" style="display:none;">
            </div>
            <div class="col-md-2 div-empty" style="display:none;">
            </div>

            <div class="col-md-2 div-hide">
                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="age" name="age" required>
            </div>

            <div class="col-md-2 div-hide">
                <label for="nationality" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nationality" name="nationality" required>
            </div>

            <div class="col-md-3">
                <label for="id_card_number" class="form-label" id="id_card_input">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="id_card_number" name="id_card_number" required maxlength="13">
            </div>

            <div class="col-md-3">
                <label for="address" class="form-label">อยู่บ้าน/สำนักงานเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="col-md-3">
                <label for="village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="village" name="village">
            </div>

            <div class="col-md-3">
                <label for="alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="alley" name="alley">
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
                <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" required>
            </div>

            <div class="col-md-3">
                <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="province" name="province" required>
            </div>

            <div class="col-md-3">
                <label for="telephone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telephone" name="telephone" required maxlength="10">
            </div>

            <div class="col-md-3">
                <label for="fax" class="form-label">โทรสาร</label>
                <input type="text" class="form-control" id="fax" name="fax">
            </div>
        </div>

        <br>
        <h5>ขอยื่นเรื่องต่อเจ้าพนักงานท้องถิ่น เพื่อขอรับ/ ขอต่อใบอนุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</h5><br>

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label for="type_request" class="form-label">ประเภท</label>
                <input type="text" class="form-control" id="type_request" name="type_request">
            </div>

            <div class="col-md-4">
                <label for="petition" class="form-label">ข้อ</label>
                <input type="text" class="form-control" id="petition" name="petition">
            </div>

            <div class="col-md-12">
                <label for="name_establishment" class="form-label">ชื่อสถานประกอบการ</label>
                <input type="text" class="form-control" id="name_establishment" name="name_establishment">
            </div>

            <div class="col-md-3">
                <label for="location" class="form-label">ตั้งอยู่ที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>

            <div class="col-md-3">
                <label for="details_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="details_village" name="details_village">
            </div>

            <div class="col-md-3">
                <label for="details_alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="details_alley" name="details_alley">
            </div>

            <div class="col-md-3">
                <label for="details_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="details_road" name="details_road">
            </div>

            <div class="col-md-3">
                <label for="details_subdistrict" class="form-label">ตำบล/แขวง</label>
                <input type="text" class="form-control" id="details_subdistrict" name="details_subdistrict" value="คลองอุดมชลจร">
            </div>

            <div class="col-md-3">
                <label for="details_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="details_district" name="details_district" value="เมืองฉะเชิงเทรา">
            </div>

            <div class="col-md-3">
                <label for="details_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="details_province" name="details_province" value="ฉะเชิงเทรา">
            </div>

            <div class="col-md-3">
                <label for="details_telephone" class="form-label">โทรศัพท์</label>
                <input type="text" class="form-control" id="details_telephone" name="details_telephone" maxlength="10">
            </div>

            <div class="col-md-3">
                <label for="details_fax" class="form-label">โทรสาร</label>
                <input type="text" class="form-control" id="details_fax" name="details_fax">
            </div>

            <div class="col-md-3">
                <label for="business_area" class="form-label">พื้นที่ประกอบการ (ตารางเมตร)</label>
                <input type="text" class="form-control" id="business_area" name="business_area">
            </div>

            <div class="col-md-3">
                <label for="machine_power" class="form-label">กำลังเครื่องจักร (แรงม้า)</label>
                <input type="text" class="form-control" id="machine_power" name="machine_power">
            </div>

            <div class="col-md-3">
                <label for="number_male_workers" class="form-label">จำนวนคนงานชาย (คน)</label>
                <input type="text" class="form-control" id="number_male_workers" name="number_male_workers">
            </div>

            <div class="col-md-3">
                <label for="number_female_workers" class="form-label">จำนวนคนงานหญิง (คน)</label>
                <input type="text" class="form-control" id="number_female_workers" name="number_female_workers">
            </div>

            <div class="col-md-3">
                <label for="opening_hours" class="form-label">เปิดประกอบการตั้งแต่เวลา (น.)</label>
                <input type="text" class="form-control" id="opening_hours" name="opening_hours">
            </div>

            <div class="col-md-3">
                <label for="opening_for_business_until" class="form-label">ถึงเวลา (น.)</label>
                <input type="text" class="form-control" id="opening_for_business_until" name="opening_for_business_until">
            </div>

            <br>
            <p><strong>โดยแนบใบอนุญาตเดิมพร้อมกัยหลักฐานดังต่อไปนี้</strong> <br> <span class="text-danger">ประเภทไฟล์ที่รับรอง : jpg,jpeg,png,pdf (ขนาดไม่เกิน 2 MB)</span></p>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option1" id="option1" data-status="1">
                        <label class="form-check-label" for="option1">
                            สำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านเจ้าของกิจการ(ผู้ประกอบการ/ผู้ถือใบอนุญาต)
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option1" class="form-control-file" name="attachments[option1]" style="display:none;">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option2" id="option2" data-status="2">
                        <label class="form-check-label" for="option2">
                            สำเนาหนังสือรับรองการจดทะเบียนนิติบุคคลพร้อมสำเนาบัตรประชาชนของผู้แทนนิติบุคคล
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option2" class="form-control-file" name="attachments[option2]" style="display:none;">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option3" id="option3" data-status="3">
                        <label class="form-check-label" for="option3">
                            หนังสือยินยอมให้ใช้อาคาร สถานที่ หรือสัญญาเช่า(กรณีผู้รับใบอนุญาตไม่มีกรรมสิทธิ์ในอาคารสถานที่)
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option3" class="form-control-file" name="attachments[option3]" style="display:none;">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option4" id="option4" data-status="4">
                        <label class="form-check-label" for="option4">
                            หนังสือยินมอบอำนาจพร้อมสำเนาบัตรประชาชน/สำเนาทะเบียนบ้านผู้มอบและผู้รับมอบอำนาจ พร้อมติดอากรแสตมป์ (กรณีเจ้าของไม่สามารถมายื่นคำขอด้วยตนเอง)
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option4" class="form-control-file" name="attachments[option4]" style="display:none;">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option5" id="option5" data-status="5">
                        <label class="form-check-label" for="option5">
                            สำเนาใบอนุญาตตามกฏหมายว่าด้วยการควบคุมอาคาร(แบบอ.๑)
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option5" class="form-control-file" name="attachments[option5]" style="display:none;">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option6" id="option6" data-status="6">
                        <label class="form-check-label" for="option6">
                            สำเนาใบอนุญาตประกอบกิจการโรงงานทุกหน้า(ใบร.ง.๔)
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option6" class="form-control-file" name="attachments[option6]" style="display:none;">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option7" id="option7" data-status="7">
                        <label class="form-check-label" for="option7">
                            แผนที่สถานที่ตั้งของสถานประกอบการ (กรณีขอรับ)
                        </label>
                        <div class="mt-2">
                            <input type="file" id="file_option7" class="form-control-file" name="attachments[option7]" style="display:none;">
                        </div>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option8" id="option8">
                        <label class="form-check-label" for="option8">
                            อื่นๆ
                        </label>
                    </div>

                    <!-- Input ที่จะซ่อน/แสดงเมื่อเลือก checkbox -->
                    <div class="col-md-7" id="document_option_detail_div" style="display: none;">
                        <label for="document_option_detail" class="form-label">รายละเอียดอื่นๆ</label>
                        <input type="text" class="form-control" id="document_option_detail" name="document_option_detail">
                    </div>

                    <script>
                        // ใช้ JavaScript vanilla
                        document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
                            checkbox.addEventListener('change', function() {
                                // เช็คว่า checkbox ถูกเลือกหรือไม่
                                var fileInput = document.getElementById('file_' + this.id);

                                // ถ้าตัว checkbox ถูกเลือกให้แสดง input file, ถ้าไม่ให้ซ่อน
                                if (this.checked) {
                                    fileInput.style.display = 'block';
                                } else {
                                    fileInput.style.display = 'none';
                                }
                            });
                        });

                        // ใช้ jQuery
                        $('input[type="checkbox"]').change(function() {
                            var checkboxId = $(this).attr('id'); // ได้ ID ของ checkbox ที่ถูกคลิก
                            var fileInputId = '#file_' + checkboxId; // สร้าง ID ของ input file ที่เชื่อมโยง

                            if ($(this).is(':checked')) {
                                // แสดง input file เมื่อ checkbox ถูกเลือก
                                $(fileInputId).show();
                            } else {
                                // ซ่อน input file เมื่อ checkbox ถูกยกเลิกเลือก
                                $(fileInputId).hide();
                            }
                        });
                    </script>

                    <!-- JavaScript -->
                    <script>
                        document.getElementById('option8').addEventListener('change', function() {
                            var detailDiv = document.getElementById('document_option_detail_div');
                            if (this.checked) {
                                detailDiv.style.display = 'block'; // แสดง input
                            } else {
                                detailDiv.style.display = 'none'; // ซ่อน input
                            }
                        });
                    </script>

                </div>
            </div>
        </div>

        <div class="text-center w-full border">
            <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>
                ส่งฟอร์มข้อมูล</button>
        </div>

    </form>
</div>
<script>
    $('#person_individual').change(function(e) {
        e.preventDefault();
        if ($('#person_individual').is(":checked")) {
            $('#full_name_input').html('ชื่อ - นามสกุล <span class="text-danger">*</span>');
            $('#id_card_input').html('เลขบัตรประชาชน <span class="text-danger">*</span>');
            $('.div-hide').show();
            $('.div-empty').hide();
            $('.div-hide').find('input').attr('required', true);
            $('.div-hide').find('input').val('');
            var html = '<option value="" selected disabled>เลือกคำนำหน้า</option><option value="นาย">นาย</option><option value="นาง">นาง</option><option value="นางสาว">นางสาว</option>';
            $('#salutation').html(html);
        }
    });
    $('#person_legal').change(function(e) {
        e.preventDefault();
        if ($('#person_legal').is(":checked")) {
            $('#full_name_input').html('ชื่อสถานประกอบการ <span class="text-danger">*</span>');
            $('#id_card_input').html('เลขที่ทะเบียนนิติบุคคล <span class="text-danger">*</span>');
            $('.div-hide').hide();
            $('.div-empty').show();
            $('.div-hide').find('input').attr('required', false);
            $('.div-hide').find('input').val('');
            var html = '<option value="" selected disabled>เลือกคำนำหน้า</option><option value="บริษัท">บริษัท</option><option value="ร้าน">ร้าน</option><option value="หจก.">หจก.</option>';
            $('#salutation').html(html);
        }
    });
</script>

@endsection

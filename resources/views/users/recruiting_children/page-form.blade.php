@extends('users.layout.layout')
@section('pages_content')

{{-- @if(session('success'))
<div class="alert alert-success">
    {!! nl2br(session('success')) !!}
</div>
@endif --}}

<form action="{{ route('ChildApplyFormCreate') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container">
        <h3 class="text-center">ใบสมัคร <br></h3>
        <h3 class="text-center">ศูนย์พัฒนาเด็กเล็ก สังกัดองค์การบริหารส่วนตำบลคลองอุดมชลจร</h3>
        <h4 class="text-center"><span class="text-danger">** </span><strong>หากไม่มีการกรอกข้อมูล กรุณาใส่เครื่องหมาย - แทน</strong></h4><br>

        <h3>ข้อมูลเด็กเล็ก</h3>
        <!-- Child Information -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="full_name" class="form-label">เด็กชื่อ-สกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="full_name" id="full_name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ethnicity" class="form-label">เชื้อชาติ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ethnicity" id="ethnicity" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nationality" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nationality" id="nationality" required>
            </div>
            {{-- <div class="col-md-6 mb-3">
                <label for="birthday" class="form-label">เกิดวันที่ <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="birthday" id="birthday" required>
            </div> --}}

            <div class="row mb-3">
                <div class="col-12 col-md-4">
                    <label for="day">วันเกิดที่ (กรอกวันที่เกิด) <span class="text-danger">*</span></label>
                    <input type="number" id="day" name="day" class="form-control" min="1" max="31" required>
                    <small id="dayError" class="form-text text-danger" style="display: none;">กรุณากรอกวันเป็นตัวเลขระหว่าง 1 - 31</small>
                </div>

                <script>
                  document.getElementById("day").addEventListener("input", function() {
                    const dayInput = document.getElementById("day");
                    const dayError = document.getElementById("dayError");

                    const dayValue = parseInt(dayInput.value, 10);

                    // ตรวจสอบว่าเป็นค่าที่อยู่ในช่วง 1 - 31 หรือไม่
                    if (dayValue < 1 || dayValue > 31 || isNaN(dayValue)) {
                      // รีเซ็ตค่าที่กรอกไป
                      dayInput.value = ""; // ลบค่าที่กรอก
                      // แสดงข้อความเตือน
                      dayError.style.display = "block";
                      dayInput.classList.add("is-invalid");  // เพิ่มคลาสที่ทำให้ input แสดงสถานะผิดพลาด
                    } else {
                      // ซ่อนข้อความเตือนและลบคลาสผิดพลาดถ้าค่าถูกต้อง
                      dayError.style.display = "none";
                      dayInput.classList.remove("is-invalid");
                    }
                  });
                </script>

                <div class="col-12 col-md-4">
                    <label for="month">เดือน (เลือกเดือนเกิด) <span class="text-danger">*</span></label>
                    <select id="month" name="month" class="form-control" required>
                        <option value="1">มกราคม</option>
                        <option value="2">กุมภาพันธ์</option>
                        <option value="3">มีนาคม</option>
                        <option value="4">เมษายน</option>
                        <option value="5">พฤษภาคม</option>
                        <option value="6">มิถุนายน</option>
                        <option value="7">กรกฎาคม</option>
                        <option value="8">สิงหาคม</option>
                        <option value="9">กันยายน</option>
                        <option value="10">ตุลาคม</option>
                        <option value="11">พฤศจิกายน</option>
                        <option value="12">ธันวาคม</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label for="year">ปี (กรอกปีที่เกิดเป็น พ.ศ.) <span class="text-danger">*</span></label>
                    <input type="number" id="year" name="year" class="form-control" min="1900" required>
                    <small id="yearError" class="form-text text-danger" style="display: none;">กรุณากรอกปี 4 หลัก</small>
                </div>

                <script>
                    document.getElementById("year").addEventListener("input", function() {
                        const yearInput = document.getElementById("year");
                        const yearError = document.getElementById("yearError");

                        // ตรวจสอบว่าค่าที่กรอกมีความยาวมากกว่า 4 ตัวหรือไม่
                        if (yearInput.value.length > 4) {
                            // หากกรอกเกิน 4 ตัว ให้ลบค่าที่กรอก
                            yearInput.value = yearInput.value.slice(0, 4);
                        }

                        const yearValue = yearInput.value;

                        // ตรวจสอบว่าเป็นเลข 4 หลักหรือไม่
                        if (yearValue.length !== 4 || isNaN(yearValue)) {
                            // แสดงข้อความเตือนถ้าปีไม่ครบ 4 หลักหรือไม่ใช่ตัวเลข
                            yearError.style.display = "block";
                            yearInput.classList.add("is-invalid");  // เพิ่มคลาสที่ทำให้ input แสดงสถานะผิดพลาด
                        } else {
                            // ซ่อนข้อความเตือนและลบคลาสผิดพลาดถ้าค่าถูกต้อง
                            yearError.style.display = "none";
                            yearInput.classList.remove("is-invalid");
                        }
                    });
                </script>

            </div>

            <div class="row mb-1" >
                <div class="col-12 d-flex align-items-center">
                    <label for="birth_day" class="mb-0 me-2 " style="width: 12rem;">วันเกิดตามปฎิทินสากลคือ</label>
                    <input type="text" id="birth_day" name="birthday" class="form-control" readonly>
                </div>
            </div>


            <style>
                #birth_day {
                    border: none;  /* ลบขอบ */
                    background: transparent;  /* ลบพื้นหลัง */
                    box-shadow: none;  /* ลบเงา */
                }
            </style>

            <script>
                // ฟังก์ชันแปลงวันที่จาก พ.ศ. เป็น ค.ศ.
                function convertToAD(year) {
                    return year - 543;
                }

                // เมื่อมีการกรอกข้อมูลในช่องวัน เดือน ปี
                document.querySelectorAll("#day, #month, #year").forEach(input => {
                    input.addEventListener("input", function () {
                        // ดึงค่าจาก input
                        const day = document.getElementById("day").value;
                        const month = document.getElementById("month").value;
                        const year = document.getElementById("year").value;

                        if (day && month && year) {
                            // แปลงปี พ.ศ. เป็น ค.ศ.
                            const yearAD = convertToAD(parseInt(year));

                            // สร้างวันที่ในรูปแบบ dd/mm/yyyy
                            const formattedDate = `${String(day).padStart(2, '0')}/${String(month).padStart(2, '0')}/${yearAD}`;

                            // แสดงวันที่ที่แปลงแล้วใน input birth_day
                            document.getElementById("birth_day").value = formattedDate;
                        }
                    });
                });
            </script>


        <div class="row ">
            <div class="col-md-4 mb-3">
                <label for="age" class="form-label">อายุ (ปี) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="age" id="age" required>
            </div>
            {{-- <div class="col-md-4 mb-3">
                <label for="age_months" class="form-label">อายุ (เดือน) นับถึงวันที่ 16 พฤษภาคม</label>
                <input type="number" class="form-control" name="age_months" id="age_months" required>
            </div> --}}
            <div class="col-md-4 mb-3">
                <label for="age_months" class="form-label">อายุ (เดือน)</label>
                <div class="d-flex align-items-center">
                    <input type="number" class="form-control" name="age_months" id="age_months" required>
                    <span class="col-md-5 ms-3">นับถึงวันที่ 16 พฤษภาคม</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="age_since_date" class="form-label"></label>
                <?php
                $currentDate = date('Y-m-d');
                ?>
                <input type="hidden" class="form-control" name="age_since_date" id="age_since_date" value="<?= $currentDate; ?>" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="citizen_id" class="form-label">เลขประจำตัวประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="citizen_id" id="citizen_id" required>
            </div>
        </div>

        <hr>
        <!-- Address Information -->
        <h3>ที่อยู่ตามทะเบียนบ้าน</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="regis_house_number" class="form-label">บ้านเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="regis_house_number" id="regis_house_number" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="regis_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" name="regis_village" id="regis_village">
            </div>
            <div class="col-md-4 mb-3">
                <label for="regis_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" name="regis_road" id="regis_road">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="regis_subdistrict" class="form-label">ตำบล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="regis_subdistrict" id="regis_subdistrict" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="regis_district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="regis_district" id="regis_district" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="regis_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="regis_province" id="regis_province" required>
            </div>
        </div>

        <hr>

        <!-- Current Address Information -->
        <h3>ที่อยู่อาศัยจริงในปัจจุบัน</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="current_house_number" class="form-label">บ้านเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="current_house_number" id="current_house_number" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="current_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" name="current_village" id="current_village">
            </div>
            <div class="col-md-4 mb-3">
                <label for="current_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" name="current_road" id="current_road">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="current_subdistrict" class="form-label">ตำบล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="current_subdistrict" id="current_subdistrict" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="current_district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="current_district" id="current_district" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="current_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="current_province" id="current_province" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="current_phone_number" class="form-label">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="current_phone_number" id="current_phone_number" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="number_of_siblings" class="form-label">มีพี่น้องร่วมบิดา - มารดาเดียวกันจำนวน (ถ้าไม่มีใส่ - )</label>
                <input type="text" name="number_of_siblings" class="form-control" id="number_of_siblings" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="the_child_number" class="form-label">เป็นบุตรลำดับที่</label>
                <input type="text" name="the_child_number" class="form-control" id="the_child_number" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="congenital_disease" class="form-label">โรคประจำตัว</label>
                <input type="text" class="form-control" name="congenital_disease" id="congenital_disease" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="blood_group" class="form-label">หมู่โลหิต</label>
                <input type="text" class="form-control" name="blood_group" id="blood_group" >
            </div>
        </div>

        <hr>
        <!-- Parents Information -->
        <h3>ข้อมูลบิดา-มารดา หรือ ผู้อุปการะ</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="father_name" class="form-label">บิดาชื่อ - สกุล</label>
                <input type="text" class="form-control" name="father_name" id="father_name" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="father_occupation" class="form-label">อาชีพ</label>
                <input type="text" class="form-control" name="father_occupation" id="father_occupation" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="edu_qual_father" class="form-label">วุฒิการศึกษา</label>
                <input type="text" class="form-control" name="edu_qual_father" id="edu_qual_father" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="mother_name" class="form-label">มารดาชื่อ - สกุล</label>
                <input type="text" class="form-control" name="mother_name" id="mother_name" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="mother_occupation" class="form-label">อาชีพ </label>
                <input type="text" id="mother_occupation" class="form-control" name="mother_occupation" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="edu_qual_mother" class="form-label">วุฒิการศึกษา</label>
                <input type="text" id="edu_qual_mother" class="form-control" name="edu_qual_mother" >
            </div>
        </div>

        <hr>
        <!-- Care Options -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="form-label">ปัจจุบันเด็กอยู่ในความดูแลอุปการะ/รับผิดชอบของ</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="care_option_father" name="care_option" value="father" required>
                    <label class="form-check-label" for="care_option_father">บิดา</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="care_option_mother" name="care_option" value="mother" required>
                    <label class="form-check-label" for="care_option_mother">มารดา</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="care_option_fatherAdmother" name="care_option" value="fatherAdmother" required>
                    <label class="form-check-label" for="care_option_fatherAdmother">ทั้งบิดา - มารดาร่วมกัน</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" id="care_option_relative" name="care_option" value="relative" required>
                    <label class="form-check-label" for="care_option_relative">ญาติ</label>
                </div>

                <div class="col-md-4 mb-3" id="care_option_relativeDiv" style="display: none;">
                    <label for="care_option_relative_text" class="form-label">(โปรดระบุความเกี่ยวข้อง)</label>
                    <input type="text" id="care_option_relative_text" class="form-control" name="care_option_relative_text">
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" id="care_option_other" name="care_option" value="Other" >
                    <label class="form-check-label" for="care_option_other">อื่น ๆ</label>
                </div>

                <div class="col-md-4 mb-3" id="otherCareOptionDiv" style="display: none;">
                    <label for="care_option_other_text" class="form-label">(โปรดระบุรายละเอียด)</label>
                    <input type="text" id="care_option_other_text" class="form-control" name="care_option_other_text">
                </div>
            </div>
        </div>

        <hr>

        <!-- Caretaker Income -->
        <div class="row mb-3">
            <div class="mb-3 col-md-3">
                <label for="caretaker_income" class="form-label">ผู้ดูแลอุปการะเด็ก
                    มีรายได้ในครอบครัวต่อเดือน</label>
                <div style="display: flex; align-items: center;">
                    <input type="text" class="form-control" id="caretaker_income" name="caretaker_income" >
                    <span class="ms-1">บาท</span>
                </div>
            </div>
        </div>

        <!-- Applicant's Information -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="applicants_name" class="form-label">ผู้นำเด็กมาสมัคร ชื่อ-สกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="applicants_name" name="applicants_name" required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="applicants_relevant" class="form-label">เกี่ยวข้องเป็น <span class="text-danger">*</span></label>
                <div style="display: flex; align-items: center;">
                    <input type="text" class="form-control" id="applicants_relevant" name="applicants_relevant" style="flex: 1; margin-right: 5px;" required>
                    <span class="ms-1">ของเด็ก</span>
                </div>
            </div>
        </div>

        <!-- Child Carrier Information -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="child_carrier_name" class="form-label">ผู้ที่จะรับส่งเด็กชื่อ - สกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="child_carrier_name" name="child_carrier_name" required>
            </div>
            <div class="col-md-6">
                <label for="child_carrier_relevant" class="form-label">โดยเกี่ยวข้องเป็น <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="child_carrier_relevant" name="child_carrier_relevant" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="child_carrier_phone" class="form-label">เบอร์โทรศัพท์ติดต่อ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="child_carrier_phone" name="child_carrier_phone" required>
            </div>
        </div>

        <br>

        <div class="col-md-12 mb-4">
            <span><strong>คำรับรอง</strong><br></span>
            <span class="ms-4">1. ข้าพเจ้าขอรับรองว่า ได้อ่านประกาศรับสมัครศูนย์พัฒนาเด็กเล็กสังกัดองค์การบริหารส่วนตำบลคลองอุดมชลจรเข้าใจแล้ว เด็กที่นำมาสมัครมีคุณสมบัติถูกต้องตรงประกาศ และหลักฐานที่ใช้สมัครใน
                 วันนี้เป็นหลักฐานที่ถูกต้องจริง <br>
            </span>
            <span class="ms-4">2. ข้าพเจ้ามีสิทธิถูกต้องในการที่จะให้เด็กสมัครเข้ารับการศึกษาเลี้ยงดูในศูนย์พัฒนาเด็กเล็กสังกัดองค์การบริหารส่วนตำบลคลองอุดมชลจร <br></span>
            <span class="ms-4">3. ข้าพเจ้ายินดีปฏิบัติตามระเบียบ ข้อกำหนดองค์การบริหารส่วนตำบลคลองอุดมชลจร และยินดีปฏิบัติตามคำแนะนำเกี่ยวกับการพัฒนาความพร้อมที่ศูนย์พัฒนาเด็กเล็ก กำหนด</span>
            <br>
            <br>
            {{-- <span><strong>หมายเหตุ</strong> เอาข้อมูลเอกสาร/หลักฐานที่ใช้ในการสมัครเรียน ให้นำมาพร้อมนักเรียน ติดต่อมอบตัว ภายใน 7วัน ทำการที่ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร</span> --}}
        </div>

        <br>
        <hr>
        <br>

        <h3 class="text-center">ใบมอบตัว <br></h3>
        <h3 class="text-center">ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร <br></h3>
        <h4 class="text-center"><span class="text-danger">** </span><strong>หากไม่มีการกรอกข้อมูล กรุณาใส่เครื่องหมาย - แทน</strong></h4><br>

        <div class="row mb-3">
            <div class="col-md-2 mb-3">
                <label for="surrender_salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="surrender_salutation" name="surrender_salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_full_name" class="form-label">ข้าพเจ้า ชื่อ - สกุล <span class="text-danger">*</span></label>
                <input type="text" name="surrender_full_name" id="surrender_full_name" class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label for="surrender_age" class="form-label">อายุ (ปี) <span class="text-danger">*</span></label>
                <input type="number" name="surrender_age" id="surrender_age" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_occupation" class="form-label">อาชีพ <span class="text-danger">*</span></label>
                <input type="text" name="surrender_occupation" id="surrender_occupation" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_income" class="form-label">รายได้ <span class="text-danger">*</span></label>
                <input type="text" name="surrender_income" id="surrender_income" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_hour_number" class="form-label">ที่อยู่ปัจจุบัน เลขที่ <span class="text-danger">*</span></label>
                <input type="text" name="surrender_hour_number" id="surrender_hour_number" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_village" class="form-label">หมู่ <span class="text-danger">*</span></label>
                <input type="text" name="surrender_village" id="surrender_village" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_alley_road" class="form-label">ซอย <span class="text-danger">*</span></label>
                <input type="text" name="surrender_alley_road" id="surrender_alley_road" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_subdistrict" class="form-label">ตำบล <span class="text-danger">*</span></label>
                <input type="text" name="surrender_subdistrict" id="surrender_subdistrict" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" name="surrender_district" id="surrender_district" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" name="surrender_province" id="surrender_province" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="surrender_phone_number" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" name="surrender_phone_number" id="surrender_phone_number" class="form-control" required>
            </div>
        </div>

        <h3 class="form-label">ผู้ปกครองของ</h3>

        <div class="row">
            {{-- <label for="surrender_childs_name" style="display: inline-block; margin-right: 10px;">เด็กชาย/เด็กหญิง</label> --}}
            <div class="col-md-2">
                <label for="child_surrender_salutation1" class="form-label mb-0">คำนำหน้า <span class="text-danger">*</span></label>
                <select class="form-select" id="child_surrender_salutation1" name="child_surrender_salutation1" required>
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="เด็กชาย">เด็กชาย</option>
                    <option value="เด็กหญิง">เด็กหญิง</option>
                </select>
            </div>
            <div class="col-md-4" style="display: inline-block;">
                <label for="surrender_childs_name">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                <input type="text" name="surrender_childs_name" id="surrender_childs_name" class="form-control" required>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <span>เข้าเป็นนักเรียนของศูนย์ พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจรและพร้อมที่จะปฏิบัติตามระเบียบการของศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร ดังนี้</span><br>
            <span class="ms-5"> 1. จะปฏิบัติตามระเบียบ ข้อบังคับของศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร อย่างเคร่งครัด</span><br>
            <span class="ms-5"> 2. จะร่วมมือกับศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร ในการจัดการเรียนการสอนและขจัดปัญหาต่างๆ ที่อาจเกิดขึ้นแก่เด็กอย่างใกล้ชิด
            </span>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3" style="margin-top: 10px;">
                <label for="surrender_contact_location" class="form-label">สถานที่ที่สามารถติดต่อกับผู้ปกครองได้สะดวกรวดเร็วที่สุด</label>
                <input type="text" name="surrender_contact_location" id="surrender_contact_location" class="form-control" >
            </div>

            <div class="col-md-4 mb-3" style="margin-top: 10px;">
                <label for="surrender_contact_phone" class="form-label">โทรศัพท์</label>
                <input type="text" name="surrender_contact_phone" id="surrender_contact_phone" class="form-control" >
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span>อนึ่ง</span>
            <div class="col-md-2">
                <label for="child_recipient_salutation" class="form-label mb-0">คำนำหน้า <span class="text-danger">*</span></label>
                <select class="form-select" id="child_recipient_salutation" name="child_recipient_salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="เด็กชาย">เด็กชาย</option>
                    <option value="เด็กหญิง">เด็กหญิง</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="surrender_child_recipient" class="form-label mb-0">ชื่อ-นามสกุล เด็ก <span class="text-danger">*</span></label>
                <input type="text" name="surrender_child_recipient" id="surrender_child_recipient" class="form-control" required>
            </div>

            <span class="mt-4">เจ็บป่วย จำเป็นต้องรีบส่งโรงพยาบาลหรือพบแพทย์ทันที ข้าพเจ้าอนุญาติให้ศูนย์พัฒนาเด็กเล็ก</span>
        </div>
        <span style="margin-top: 15px;">จัดการไปตามความเห็นชอบก่อน และแจ้งให้ข้าพเจ้าทราบ โดยข้าพเจ้าขอรับผิดชอบค่าใช้จ่ายที่เกิดขึ้น</span>
    </div>

    <br>
    <h3 class="form-label">ผู้รับส่งเด็ก</h3>

    <div class="row">
        <div class="col-md-4 mb-3">
            {{-- ต้องเพิ่ม --}}
            <label for="child_recipient_relevant" class="form-label">ชื่อ-สกุล (ผู้รับส่งเด็ก)</label>
            <input type="text" name="child_recipient_relevant" id="child_recipient_relevant" class="form-control" >
        </div>

        <div class="col-md-4 mb-3">
            <label for="child_recipient_related" class="form-label">โดยเกี่ยวข้องเป็น</label>
            <input type="text" name="child_recipient_related" id="child_recipient_related" class="form-control" >
        </div>

        <div class="col-md-4 mb-3">
            <label for="child_recipient_phone" class="form-label">เบอร์โทรศัพท์ติดต่อ</label>
            <input type="text" name="child_recipient_phone" id="child_recipient_phone" class="form-control" >
        </div>
    </div>

    {{-- <br>
    <hr><br>

    <h3 class="text-center">ทะเบียนประวัติเด็กปฐมวัย <br></h3>
    <h3 class="text-center">ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร <br></h3>
    <h4 class="text-center"><span class="text-danger">** </span><strong>หากไม่มีการกรอกข้อมูล กรุณาใส่เครื่องหมาย - แทน</strong></h4><br>

    <div class="row">
        <div class="col-md-2">
            <label for="child_salutation">คำนำหน้า</label>
            <select class="form-select" id="child_salutation" name="child_salutation">
                <option value="" selected disabled>เลือกคำนำหน้า</option>
                <option value="เด็กชาย">เด็กชาย</option>
                <option value="เด็กหญิง">เด็กหญิง</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="child_name">ชื่อ-นามสกุล เด็ก<span class="text-danger">*</span></label>
            <input type="text" name="child_name" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="child_nickname">ชื่อเล่น <span class="text-danger">*</span></label>
            <input type="text" name="child_nickname" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="registration_citizen_id">เลขประจำตัวประชาชน <span class="text-danger">*</span></label>
            <input type="text" name="registration_citizen_id" class="form-control" required>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <label for="reg_day">วันเกิดที่ (กรอกวันที่เกิด) <span class="text-danger">*</span></label>
                <input type="number" id="reg_day" name="reg_day" class="form-control" min="1" max="31" required>
                <small id="reg_dayError" class="form-text text-danger" style="display: none;">กรุณากรอกวันเป็นตัวเลขระหว่าง 1 - 31</small>
            </div>

            <script>
              document.getElementById("reg_day").addEventListener("input", function() {
                const regDayInput = document.getElementById("reg_day");
                const regDayError = document.getElementById("reg_dayError");

                const regDayValue = parseInt(regDayInput.value, 10);

                if (regDayValue < 1 || regDayValue > 31 || isNaN(regDayValue)) {
                  regDayInput.value = "";
                  regDayError.style.display = "block";
                  regDayInput.classList.add("is-invalid");
                } else {
                  regDayError.style.display = "none";
                  regDayInput.classList.remove("is-invalid");
                }
              });
            </script>

            <div class="col-12 col-md-4">
                <label for="reg_month">เดือน (เลือกเดือนเกิด) <span class="text-danger">*</span></label>
                <select id="reg_month" name="reg_month" class="form-control" required>
                    <option value="1">มกราคม</option>
                    <option value="2">กุมภาพันธ์</option>
                    <option value="3">มีนาคม</option>
                    <option value="4">เมษายน</option>
                    <option value="5">พฤษภาคม</option>
                    <option value="6">มิถุนายน</option>
                    <option value="7">กรกฎาคม</option>
                    <option value="8">สิงหาคม</option>
                    <option value="9">กันยายน</option>
                    <option value="10">ตุลาคม</option>
                    <option value="11">พฤศจิกายน</option>
                    <option value="12">ธันวาคม</option>
                </select>
            </div>

            <div class="col-12 col-md-4">
                <label for="reg_year">ปี (กรอกปีที่เกิดเป็น พ.ศ.) <span class="text-danger">*</span></label>
                <input type="number" id="reg_year" name="reg_year" class="form-control" min="1900" required>
                <small id="reg_yearError" class="form-text text-danger" style="display: none;">กรุณากรอกปี 4 หลัก</small>
            </div>

            <script>
                document.getElementById("reg_year").addEventListener("input", function() {
                    const regYearInput = document.getElementById("reg_year");
                    const regYearError = document.getElementById("reg_yearError");

                    if (regYearInput.value.length > 4) {
                        regYearInput.value = regYearInput.value.slice(0, 4);
                    }

                    const regYearValue = regYearInput.value;

                    if (regYearValue.length !== 4 || isNaN(regYearValue)) {
                        regYearError.style.display = "block";
                        regYearInput.classList.add("is-invalid");
                    } else {
                        regYearError.style.display = "none";
                        regYearInput.classList.remove("is-invalid");
                    }
                });
            </script>
        </div>

        <div class="row mb-1">
            <div class="col-12 d-flex align-items-center">
                <label for="reg_birth_day" class="mb-0 me-2" style="width: 12rem;">วันเกิดตามปฎิทินสากลคือ</label>
                <input type="text" id="reg_birth_day" name="registration_birthday" class="form-control" readonly>
            </div>
        </div>

        <style>
            #reg_birth_day {
                border: none;
                background: transparent;
                box-shadow: none;
            }
        </style>

        <script>
            function convertRegToAD(year) {
                return year - 543;
            }

            document.querySelectorAll("#reg_day, #reg_month, #reg_year").forEach(input => {
                input.addEventListener("input", function () {
                    const regDay = document.getElementById("reg_day").value;
                    const regMonth = document.getElementById("reg_month").value;
                    const regYear = document.getElementById("reg_year").value;

                    if (regDay && regMonth && regYear) {
                        const regYearAD = convertRegToAD(parseInt(regYear));
                        const formattedRegDate = `${String(regDay).padStart(2, '0')}/${String(regMonth).padStart(2, '0')}/${regYearAD}`;

                        document.getElementById("reg_birth_day").value = formattedRegDate;
                    }
                });
            });
        </script>

        <div class="col-md-4 mb-3">
            <label for="birth_province">จังหวัดที่เกิด <span class="text-danger">*</span></label>
            <input type="text" name="birth_province" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="registration_ethnicity">เชื้อชาติ <span class="text-danger">*</span></label>
            <input type="text" name="registration_ethnicity" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="registration_nationality">สัญชาติ <span class="text-danger">*</span></label>
            <input type="text" name="registration_nationality" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="religion">ศาสนา <span class="text-danger">*</span></label>
            <input type="text" name="religion" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="house_number">ที่อยู่ปัจจุบันเลขที่ <span class="text-danger">*</span></label>
            <input type="text" name="house_number" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="village">หมู่ที่ <span class="text-danger">*</span></label>
            <input type="text" name="village" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="alley">ซอย <span class="text-danger">*</span></label>
            <input type="text" name="alley" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="alley_road">ถนน <span class="text-danger">*</span></label>
            <input type="text" name="alley_road" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="subdistrict">ตำบล <span class="text-danger">*</span></label>
            <input type="text" name="subdistrict" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="district">อำเภอ <span class="text-danger">*</span></label>
            <input type="text" name="district" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="province">จังหวัด <span class="text-danger">*</span></label>
            <input type="text" name="province" class="form-control" required>
        </div>
    </div>

    <div>
        <div class="mb-3">
            <label for="health_option">สุขภาพโดยรวมของเด็ก</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="health_option" id="health_option_1" value="option_1">
                    <label class="form-check-label" for="health_option_1">
                        สมบูรณ์
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="health_option" id="health_option_2" value="option_2">
                    <label class="form-check-label" for="health_option_2">
                        ไม่สมบูรณ์
                    </label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="health_option_detail" class="form-control" placeholder="สุขภาพโดยรวมของเด็ก ไม่สมบูรณ์อย่างไร โปรดระบุ">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="registration_blood_group">กลุ่มเลือด</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="registration_blood_group" id="registration_blood_group_1" value="option_1" >
                <label class="form-check-label" for="registration_blood_group_1">
                    เอ
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="registration_blood_group" id="registration_blood_group_2" value="option_2" >
                <label class="form-check-label" for="registration_blood_group_2">
                    บี
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="registration_blood_group" id="registration_blood_group_3" value="option_3" >
                <label class="form-check-label" for="registration_blood_group_3">
                    เอบี
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="registration_blood_group" id="registration_blood_group_4" value="option_4" >
                <label class="form-check-label" for="registration_blood_group_4">
                    โอ
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="registration_blood_group" id="registration_blood_group_5" value="option_5" onclick="toggleOtherInput(this)">
                <label class="form-check-label" for="registration_blood_group_5">
                    อื่นๆ
                </label>
            </div>
            <div class="col-md-3" id="blood_group_detail">
                <input type="text" name="blood_group_detail" class="form-control" placeholder="กลุ่มเลือด อื่นๆโปรดระบุ">
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="registration_congenital_disease">เด็กมีโรคประจำตัว</label>
            <input type="text" name="registration_congenital_disease" class="form-control" >
        </div>

        <div class="col-md-4 mb-3">
            <label for="edited_by">เมื่อมีอาการแก้ไขโดย (ระบุอาการ)</label>
            <input type="text" name="edited_by" class="form-control" >
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="drug_allergy">เด็กมีประวัติการแพ้ยา (โปรดระบุ)</label>
            <input type="text" name="drug_allergy" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="drug_allergy_detail">แพ้อาหาร คือ (โปรดระบุ)</label>
            <input type="text" name="drug_allergy_detail" class="form-control" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="accident_history">ประวัติการได้รับอุบัติเหตุหรือเจ็บป่วย</label>
            <input type="text" name="accident_history" class="form-control">
        </div>

        <div class="col-md-4 mb-3">
            <label for="accident_history_when_age">เมื่ออายุ (ปี)</label>
            <input type="text" name="accident_history_when_age" class="form-control">
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="ge_immunity">การได้รับภูมิคุ้มกัน</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_1" value="option_1">
                <label class="form-check-label" for="ge_immunity_1">
                    คอตีบ
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_2" value="option_2">
                <label class="form-check-label" for="ge_immunity_2">
                    หัดเยอรมัน
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_3" value="option_3">
                <label class="form-check-label" for="ge_immunity_3">
                    ไอกรน
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_4" value="option_4">
                <label class="form-check-label" for="ge_immunity_4">
                    บาดทะยัก
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_5" value="option_5">
                <label class="form-check-label" for="ge_immunity_5">
                    โปลิโอ
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_6" value="option_6">
                <label class="form-check-label" for="ge_immunity_6">
                    ตับอักเสบ
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_7" value="option_7">
                <label class="form-check-label" for="ge_immunity_7">
                    บีซีจี
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ge_immunity[]" id="ge_immunity_8" value="option_8">
                <label class="form-check-label" for="ge_immunity_8">
                    อื่นๆ
                </label>
            </div>
            <input type="text" name="ge_immunity_detail" class="form-control" placeholder="การได้รับภูมิคุ้มกันอื่นๆ คือ">
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="specially_about">เด็กควรได้รับการดูแลเป็นพิเศษเรื่อง</label>
            <input type="text" name="specially_about" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="the_eldest_son">เด็กเป็นบุตรคนที่</label>
            <input type="text" name="the_eldest_son" class="form-control" >
        </div>

        <div class="mb-3 col-md-3">
            <label for="registration_number_of_siblings" class="form-label">จำนวนพี่น้องร่วมสายโลหิต</label>
            <div style="display: flex; align-items: center;">
                <input type="text" name="registration_number_of_siblings" class="form-control" >
                <span class="ms-2">คน</span>
            </div>
        </div>

        <div class="mb-3 col-md-3">
            <label for="elder_brother" class="form-label">พี่ชาย</label>
            <div style="display: flex; align-items: center;">
                <input type="text" name="elder_brother" class="form-control" >
                <span class="ms-2">คน</span>
            </div>
        </div>

        <div class="mb-3 col-md-3">
            <label for="younger_brother" class="form-label">น้องชาย</label>
            <div style="display: flex; align-items: center;">
                <input type="text" name="younger_brother" class="form-control" >
                <span class="ms-2">คน</span>
            </div>
        </div>

        <div class="mb-3 col-md-3">
            <label for="elder_sister" class="form-label">พี่สาว</label>
            <div style="display: flex; align-items: center;">
                <input type="text" name="elder_sister" class="form-control" >
                <span class="ms-2">คน</span>
            </div>
        </div>

        <div class="mb-3 col-md-3">
            <label for="younger_sister" class="form-label">น้องสาว</label>
            <div style="display: flex; align-items: center;">
                <input type="text" name="younger_sister" class="form-control" >
                <span class="ms-2">คน</span>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="fathers_name">บิดาชื่อ - สกุล</label>
            <input type="text" name="fathers_name" class="form-control" >
        </div>

        <div class="col-md-2 mb-3">
            <label for="fathers_age">อายุ (ปี)</label>
            <input type="text" name="fathers_age" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="fathers_occupation">อาชีพ</label>
            <input type="text" name="fathers_occupation" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="fathers_workplace">สถานที่ทำงาน</label>
            <input type="text" name="fathers_workplace" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="fathers_phone">โทรศัพท์</label>
            <input type="text" name="fathers_phone" class="form-control" >
        </div
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="registration_mother_name">มารดาชื่อ - สกุล</label>
            <input type="text" name="registration_mother_name" class="form-control" >
        </div>

        <div class="col-md-2 mb-3">
            <label for="mother_age">อายุ (ปี)</label>
            <input type="text" name="mother_age" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="registration_mother_occupation">อาชีพ</label>
            <input type="text" name="registration_mother_occupation" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="mother_workplace">สถานที่ทำงาน</label>
            <input type="text" name="mother_workplace" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="mother_phone">โทรศัพท์</label>
            <input type="text" name="mother_phone" class="form-control" >
        </div>
    </div>

    <div class="mb-3">
        <label for="marital_status">สถานภาพสมรสของบิดา/มารดา</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="marital_status" id="marital_status_1" value="option_1" required>
                <label class="form-check-label" for="marital_status_1">อยู่ด้วยกัน</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="marital_status" id="marital_status_2" value="option_2" required>
                <label class="form-check-label" for="marital_status_2">แยกกันอยู่</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="marital_status" id="marital_status_3" value="option_3" required>
                <label class="form-check-label" for="marital_status_3">เลิกร้างกัน</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="marital_status" id="marital_status_4" value="option_4" required>
                <label class="form-check-label" for="marital_status_4">บิดาหรือมารดาแต่งงานใหม่</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="marital_status" id="marital_status_5" value="option_5" required>
                <label class="form-check-label" for="marital_status_5">อื่นๆ</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="marital_status_details" class="form-control" placeholder="อื่นๆ โปรดระบุ">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="parent_name">ผู้ปกครองชื่อ - สกุล</label>
            <input type="text" name="parent_name" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="parent_age">อายุ (ปี)</label>
            <input type="number" name="parent_age" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="parent_relevant_as">เกี่ยวข้องเป็น</label>
            <input type="text" name="parent_relevant_as" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="parent_occupation">อาชีพ</label>
            <input type="text" name="parent_occupation" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="parent_workplace">สถานที่ทำงาน</label>
            <input type="text" name="parent_workplace" class="form-control" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="parent_phone">โทรศัพท์</label>
            <input type="text" name="parent_phone" class="form-control" >
        </div>
    </div> --}}
    <br>

    <span><strong>ข้าพเจ้าขอรับรองว่ารายการข้างต้นถูกต้องและเป็นความจริงทุกประการ</strong></span><br>
    <span>เอกสาร/หลักฐานที่ใช้ในการสมัครเรียน</span><br>
    <span class="ms-3">1. ตัวเด็ก</span><br>
    <span class="ms-3">2. สำเนาสูติบัตร</span><br>
    <span class="ms-3">3. สำเนาทะเบียนบ้าน</span><br>
    <span class="ms-3">4. สำเนาบัตรประชาชนบิดา</span><br>
    <span class="ms-3">5. สำเนาบัตรประชาชนมารดา</span><br>
    <span class="ms-3">6. ใบสมัครของศูนย์พัฒนาเด็กเล็กที่กรอกข้อมูลสมบูรณ์แล้ว</span><br>
    <span class="ms-3">7. สำเนาสมุดบันทึกสุขภาพ (สีชมพู)</span><br><br>

    <div class="mb-3">
        <label for="attachments" class="form-label">แนบไฟล์เพิ่มเติม</label>
        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
        <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
        <div id="file-list" class="mt-1">
            <div class="d-flex flex-wrap gap-3"></div>
        </div>
    </div>

    <hr><br>

    <div class="text-center w-full border">
        <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>
            ส่งฟอร์มข้อมูล</button>
    </div>
    </div>

</form>

<script src="{{ asset('js/multipart_files.js') }}"></script>
<script>
    // สำหรับการจัดการตัวเลือก "ญาติ"
    const careOptionRadios = document.getElementsByName('care_option');
    const relativeCareOptionDiv = document.getElementById('care_option_relativeDiv');

    careOptionRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'relative') {
                // แสดง div สำหรับ "ญาติ"
                relativeCareOptionDiv.style.display = 'block';
            } else {
                // ซ่อน div หากไม่ได้เลือก "ญาติ"
                relativeCareOptionDiv.style.display = 'none';
                document.getElementById('care_option_relative_text').value = ''; // ล้างค่า input
            }
        });
    });

</script>

<script>
    // สำหรับการจัดการตัวเลือก "อื่น ๆ"
    const otherCareOptionRadios = document.getElementsByName('care_option');
    const otherCareOptionDiv = document.getElementById('otherCareOptionDiv');

    otherCareOptionRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'Other') {
                // แสดง div สำหรับ "อื่น ๆ"
                otherCareOptionDiv.style.display = 'block';
            } else {
                // ซ่อน div หากไม่ได้เลือก "อื่น ๆ"
                otherCareOptionDiv.style.display = 'none';
                document.getElementById('care_option_other_text').value = ''; // ล้างค่า input
            }
        });
    });

</script>
@endsection

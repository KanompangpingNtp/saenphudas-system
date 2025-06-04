@extends('users.layout.layout')
@section('pages_content')

<div class="container">
    <div class="mt-2 mb-3">
            <img src="{{ asset('eservice/2.png') }}" alt="" style="width: 100%; height: 600px;">
        </div>

    <h2 class="text-center mb-4">แบบยืนยันเบี้ยยังชีพผู้สูงอายุ</h2>

    <form action="{{route('ElderlyAllowanceFormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <h4>ข้อมูลผู้สูงอายุ</h4>
        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <label for="written_at">เขียนที่:</label>
                <input type="text" id="written_at" name="written_at" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-2">
                <label for="salutation">คำนำหน้า :</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
            <div class="col-12 col-md-5">
                <label for="first_name">ชื่อ: <span class="text-danger">*</span></label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="col-12 col-md-5">
                <label for="last_name">นามสกุล: <span class="text-danger">*</span></label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-2">
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
                        dayInput.classList.add("is-invalid"); // เพิ่มคลาสที่ทำให้ input แสดงสถานะผิดพลาด
                    } else {
                        // ซ่อนข้อความเตือนและลบคลาสผิดพลาดถ้าค่าถูกต้อง
                        dayError.style.display = "none";
                        dayInput.classList.remove("is-invalid");
                    }
                });

            </script>

            <div class="col-12 col-md-2">
                <label for="month">เดือน (เลือกเดือนเกิด) <span class="text-danger">*</span></label>
                <select id="month" name="month" class="form-select" required>
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
            <div class="col-12 col-md-2">
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
                        yearInput.classList.add("is-invalid"); // เพิ่มคลาสที่ทำให้ input แสดงสถานะผิดพลาด
                    } else {
                        // ซ่อนข้อความเตือนและลบคลาสผิดพลาดถ้าค่าถูกต้อง
                        yearError.style.display = "none";
                        yearInput.classList.remove("is-invalid");
                    }
                });

            </script>

            <input type="text" id="birth_day" name="birth_day" class="form-control" hidden>

            <div class="col-12 col-md-2">
                <label for="age">อายุ: <span class="text-danger">*</span></label>
                <input type="number" id="age" name="age" class="form-control" required>
            </div>
            <div class="col-12 col-md-4">
                <label for="nationality">สัญชาติ: <span class="text-danger">*</span></label>
                <input type="text" id="nationality" name="nationality" class="form-control" required>
            </div>
        </div>

        {{-- <div class="row mb-1">
            <div class="col-12 d-flex align-items-center">
                <label for="birth_day" class="mb-0 me-2 " style="width: 12rem;">วันเกิดตามปฎิทินสากลคือ</label>
                <input type="text" id="birth_day" name="birth_day" class="form-control" readonly>
            </div>
        </div> --}}


        <style>
            #birth_day {
                border: none;
                /* ลบขอบ */
                background: transparent;
                /* ลบพื้นหลัง */
                box-shadow: none;
                /* ลบเงา */
            }

        </style>

        <script>
            // ฟังก์ชันแปลงวันที่จาก พ.ศ. เป็น ค.ศ.
            function convertToAD(year) {
                return year - 543;
            }

            // เมื่อมีการกรอกข้อมูลในช่องวัน เดือน ปี
            document.querySelectorAll("#day, #month, #year").forEach(input => {
                input.addEventListener("input", function() {
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

        <div class="row mb-3">
            <div class="col-12 col-md-4 mb-3">
                <label for="house_number">ที่อยู่ตามทะเบียนบ้าน: <span class="text-danger">*</span></label>
                <input type="text" id="house_number" name="house_number" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="village">หมู่:</label>
                <input type="text" id="village" name="village" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="community">ชุมชน:</label>
                <input type="text" id="community" name="community" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="alley">ซอย:</label>
                <input type="text" id="alley" name="alley" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="road">ถนน:</label>
                <input type="text" id="road" name="road" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="subdistrict">ตำบล: <span class="text-danger">*</span></label>
                <input type="text" id="subdistrict" name="subdistrict" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="district">อำเภอ: <span class="text-danger">*</span></label>
                <input type="text" id="district" name="district" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="province">จังหวัด: <span class="text-danger">*</span></label>
                <input type="text" id="province" name="province" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="postal_code">รหัสไปรษณีย์: <span class="text-danger">*</span></label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="phone_number">โทรศัพท์: <span class="text-danger">*</span></label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="citizen_id">เลขบัตรประชาชน: <span class="text-danger">*</span></label>
                <input type="text" id="citizen_id" name="citizen_id" class="form-control" required>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="marital_status">สถานภาพการสมรส:</label>
                <select id="marital_status" name="marital_status" class="form-select" required>
                    <option value="single">โสด</option>
                    <option value="married">แต่งงานแล้ว</option>
                    <option value="widowed">เป็นม่าย</option>
                    <option value="divorced">หย่าร้าง</option>
                    <option value="separated">แยกจากกัน</option>
                    <option value="other">อื่นๆ</option>
                </select>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="monthly_income">รายได้ต่อเดือน:</label>
                <input type="text" id="monthly_income" name="monthly_income" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="occupation">อาชีพ:</label>
                <input type="text" id="occupation" name="occupation" class="form-control">
            </div>
        </div>

        <hr>

        <h4> ข้อมูลทั่วไป : สถานภาพการรับสวัสดิการภาครัฐ</h4>
        <div class="form-check">
            <input type="checkbox" name="welfare_type[]" id="welfare_type_aid" value="option1" class="form-check-input">
            <label for="welfare_type_aid" class="form-check-label">ไม่ได้รับเบี้ยยังชีพผู้สูงอายุ</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="welfare_type[]" id="welfare_type_disability" value="option2" class="form-check-input">
            <label for="welfare_type_disability" class="form-check-label">ได้รับเงินสงเคราะห์เพื่อการยังชีพผู้ป่วยเอดส์</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="welfare_type[]" id="welfare_type_disability2" value="option3" class="form-check-input">
            <label for="welfare_type_disability2" class="form-check-label">ได้รับเงินเบี้ยความพิการ</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="welfare_type[]" id="welfare_type_relocation" value="option4" class="form-check-input">
            <label for="welfare_type_relocation"> ย้ายภูมิลำเนาเข้ามาอยู่ใหม่</label>
        </div>

        <div id="welfare_other_types_div" style="display: none;">
            <label for="welfare_other_types" class="form-label">รายละเอียดอื่นๆ</label>
            <input type="text" id="welfare_other_types" name="welfare_other_types" class="form-control" placeholder="กรอกข้อมูลเพิ่มเติม">
        </div>

        <hr>

        <div class="mb-4">
            <h4>มีความประสงค์ขอรับเงินเบี้ยยังชีพผู้สูงอายุ โดยวิธีดังต่อไปนี้ (เลือก 1
                วิธี)</h4>
            <div class="form-check">
                <input type="radio" name="request_for_money_type" id="money_type_option1" value="option1" class="form-check-input" required>
                <label for="money_type_option1" class="form-check-label">รับเงินสดด้วยตนเอง</label>
            </div>
            <div class="form-check">
                <input type="radio" name="request_for_money_type" id="money_type_option2" value="option2" class="form-check-input">
                <label for="money_type_option2" class="form-check-label">รับเงินสดโดยบุคคลที่ได้รับมอบอํานาจจากผู้มีสิทธิ</label>
            </div>
            <div class="form-check">
                <input type="radio" name="request_for_money_type" id="money_type_option3" value="option3" class="form-check-input">
                <label for="money_type_option3" class="form-check-label">โอนเงินเข้าบัญชีเงินฝากธนาคารในนามผู้มีสิทธิ</label>
            </div>
            <div class="form-check">
                <input type="radio" name="request_for_money_type" id="money_type_option4" value="option4" class="form-check-input">
                <label for="money_type_option4" class="form-check-label">โอนเงินเข้าบัญชีเงินฝากธนาคารในนามบุคลที่ได้รับมอบอํานาจจากผู้มีสิทธิ</label>
            </div>
        </div>

        <hr>

        <h4>ประเภทเอกสารที่แนบ</h4>
        <div class="form-check">
            <input type="checkbox" name="document_type[]" id="document_type_id_card" value="option1" class="form-check-input">
            <label for="document_type_id_card" class="form-check-label">บัตรประจำตัวประชาชน</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="document_type[]" id="document_type_house_reg" value="option2" class="form-check-input">
            <label for="document_type_house_reg" class="form-check-label">ทะเบียนบ้าน</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="document_type[]" id="document_type_bank_book" value="option3" class="form-check-input">
            <label for="document_type_bank_book" class="form-check-label">สมุดบัญชีเงินฝากธนาคาร</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="document_type[]" id="document_type_auth_letter" value="option4" class="form-check-input">
            <label for="document_type_auth_letter" class="form-check-label">หนังสือมอบอำนาจ</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="bank_option" id="bank_option" value="1" class="form-check-input" onclick="toggleAccountInputs()">
            <label for="bank_option" class="form-check-label">บัญชีเงินฝากธนาคาร</label>
        </div>

        <div class="form-group" id="bank_name_group" style="display: none;">
            <label for="bank_name" class="form-label">ชื่อธนาคาร</label>
            <input type="text" id="bank_name" name="bank_name" class="form-control">
        </div>

        <div class="form-group" id="account_number_group" style="display: none;">
            <label for="account_number" class="form-label">บัญชีเลขที่</label>
            <input type="text" id="account_number" name="account_number" class="form-control">
        </div>

        <div class="form-group" id="account_name_group" style="display: none;">
            <label for="account_name" class="form-label">ชื่อบัญชี</label>
            <input type="text" id="account_name" name="account_name" class="form-control">
        </div>

        <hr>

        <div class="mb-3">
            <label for="attachments" class="form-label">แนบไฟล์บัตรประชาชน <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple required>
        </div>

        <div>
            <h4>แนบไฟล์ เอกสาร (สามารถกดแนบไฟล์พร้อมกันได้มากกว่า 1ไฟล์)</h4>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
            <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
            <!-- แสดงรายการไฟล์ที่แนบ -->
            <div id="file-list" class="mt-1">
                <div class="d-flex flex-wrap gap-3"></div>
            </div>
        </div>

        <br>

        <div class="text-center w-full border">
            <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>
                ส่งฟอร์มข้อมูล</button>
        </div>
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>

<script>
    // Toggle display of the welfare_other_types field based on the 'ย้ายภูมิลําเนาเข้ามาอยู่ใหม่' checkbox
    document.getElementById('welfare_type_relocation').addEventListener('change', function() {
        const otherTypesDiv = document.getElementById('welfare_other_types_div');
        otherTypesDiv.style.display = this.checked ? 'block' : 'none';
    });

</script>

<script>
    // Function to toggle the visibility of account number and account name fields
    function toggleAccountInputs() {
        var checkBox = document.getElementById("bank_option");
        var accountNumberGroup = document.getElementById("account_number_group");
        var accountNameGroup = document.getElementById("account_name_group");
        var bankNameGroup = document.getElementById("bank_name_group");

        // If checkbox is checked, show the account inputs, otherwise hide them
        if (checkBox.checked) {
            accountNumberGroup.style.display = "block";
            accountNameGroup.style.display = "block";
            bankNameGroup.style.display = "block";
        } else {
            accountNumberGroup.style.display = "none";
            accountNameGroup.style.display = "none";
            bankNameGroup.style.display = "none";
        }
    }

</script>

@endsection

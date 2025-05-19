@extends('users.layout.layout')
@section('pages_content')

<div class="container">
    <h3 class="text-center">แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ</h3>
    <form action="{{ route('DisabilityFormCreate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Personal Information -->
        <div class="my-4">
            <h4>ข้อมูลผู้พิการ</h4>

            <div class="row mb-3">
                <label for="written_at" class="col-sm-3 col-form-label">เขียนที่:</label>
                <div class="col-sm-9">
                    <input type="text" id="written_at" name="written_at" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="salutation" class="col-sm-3 col-form-label">คำนำหน้า:</label>
                    <select class="form-select" id="salutation" name="salutation">
                        <option value="" selected disabled>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="first_name" class="col-sm-3 col-form-label">ชื่อ: <span class="text-danger">*</span></label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="last_name" class="col-sm-3 col-form-label">นามสกุล: <span class="text-danger">*</span></label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
            </div>

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
                            dayInput.classList.add("is-invalid"); // เพิ่มคลาสที่ทำให้ input แสดงสถานะผิดพลาด
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
                            yearInput.classList.add("is-invalid"); // เพิ่มคลาสที่ทำให้ input แสดงสถานะผิดพลาด
                        } else {
                            // ซ่อนข้อความเตือนและลบคลาสผิดพลาดถ้าค่าถูกต้อง
                            yearError.style.display = "none";
                            yearInput.classList.remove("is-invalid");
                        }
                    });

                </script>

            </div>

            <div class="row mb-1">
                <div class="col-12 d-flex align-items-center">
                    <label for="birth_day" class="mb-0 me-2 " style="width: 12rem;">วันเกิดตามปฎิทินสากลคือ</label>
                    <input type="text" id="birth_day" name="birth_day" class="form-control" readonly>
                </div>
            </div>


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
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="age" class="col-sm-3 col-form-label">อายุ: <span class="text-danger">*</span></label>
                <input type="number" id="age" name="age" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="nationality" class="col-sm-3 col-form-label">สัญชาติ: <span class="text-danger">*</span></label>
                <input type="text" id="nationality" name="nationality" class="form-control" required>
            </div>

            <!-- Address Section -->
            <div class="col-md-3 mb-3">
                <label for="house_number" class="col-sm-3 col-form-label">บ้านเลขที่: <span class="text-danger">*</span></label>
                <input type="text" id="house_number" name="house_number" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="village" class="col-sm-3 col-form-label">หมู่: </label>
                <input type="text" id="village" name="village" class="form-control" >
            </div>

            <div class="col-md-3 mb-3">
                <label for="community" class="col-sm-3 col-form-label">ชุมชน:</label>
                <input type="text" id="community" name="community" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label for="alley" class="col-sm-3 col-form-label">ซอย: </label>
                <input type="text" id="alley" name="alley" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label for="road" class="col-sm-3 col-form-label">ถนน:</label>
                <input type="text" id="road" name="road" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label for="subdistrict" class="col-sm-3 col-form-label">ตำบล: <span class="text-danger">*</span></label>
                <input type="text" id="subdistrict" name="subdistrict" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="district" class="col-sm-3 col-form-label">อำเภอ: <span class="text-danger">*</span></label>
                <input type="text" id="district" name="district" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="province" class="col-sm-3 col-form-label">จังหวัด: <span class="text-danger">*</span></label>
                <input type="text" id="province" name="province" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="postal_code" class="col-form-label">รหัสไปรษณีย์: <span class="text-danger">*</span></label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="phone_number" class="col-sm-3 col-form-label">โทรศัพท์: <span class="text-danger">*</span></label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="citizen_id" class="col-form-label">เลขบัตรประชาชน: <span class="text-danger">*</span></label>
                <input type="text" id="citizen_id" name="citizen_id" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="marital_status" class="col-form-label">สถานภาพการสมรส: <span class="text-danger">*</span></label>
                <select id="marital_status" name="marital_status" class="form-select" required>
                    <option value="single">โสด</option>
                    <option value="married">แต่งงานแล้ว</option>
                    <option value="widowed">เป็นม่าย</option>
                    <option value="divorced">หย่าร้าง</option>
                    <option value="separated">แยกจากกัน</option>
                    <option value="other">อื่นๆ</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="monthly_income" class="col-form-label">รายได้ต่อเดือน: <span class="text-danger">*</span></label>
                <input type="text" id="monthly_income" name="monthly_income" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="occupation" class="col-sm-3 col-form-label">อาชีพ: <span class="text-danger">*</span></label>
                <input type="text" id="occupation" name="occupation" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="references_contacted" class="col-form-label">บุคคลอ้างอิงที่สามารถติดต่อได้: <span class="text-danger">*</span></label>
                <input type="text" id="references_contacted" name="references_contacted" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="references_phone" class="col-sm-3 col-form-label">โทรศัพท์: <span class="text-danger">*</span></label>
                <input type="text" id="references_phone" name="references_phone" class="form-control" required>
            </div>
        </div>
        <hr>
        <div class="my-4">
            <h4 for="type_of_disability" class="form-label">ประเภทความพิการ</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option1" name="type_of_disability" value="option1" required>
                        <label class="form-check-label" for="type_of_disability_option1">ความพิการทางการเห็น</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option2" name="type_of_disability" value="option2">
                        <label class="form-check-label" for="type_of_disability_option2">ความพิการทางสติปัญญา</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option3" name="type_of_disability" value="option3">
                        <label class="form-check-label" for="type_of_disability_option3">ความพิการทางการได้ยินหรือสื่อความหมาย</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option4" name="type_of_disability" value="option4">
                        <label class="form-check-label" for="type_of_disability_option4">ความพิการทางการเรียนรู้</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option5" name="type_of_disability" value="option5">
                        <label class="form-check-label" for="type_of_disability_option5">ความพิการทางการเคลื่อนไหวหรือทางร่างกาย</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option6" name="type_of_disability" value="option6">
                        <label class="form-check-label" for="type_of_disability_option6">ความพิการทางออทิสติก</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="type_of_disability_option7" name="type_of_disability" value="option7">
                        <label class="form-check-label" for="type_of_disability_option7">ความพิการทางการจิตใจหรือพฤติกรรม</label>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h4 class="form-label">ข้อมูลทั่วไป : สถานภาพการรับสวัสดิการภาครัฐ</h4>

        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="welfare_type[]" id="welfare_type_aid" value="option1">
                    <label class="form-check-label" for="welfare_type_aid">ไม่ได้รับเบี้ยยังชีพผู้สูงอายุ</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="welfare_type[]" id="welfare_type_disability" value="option2">
                    <label class="form-check-label" for="welfare_type_disability">ได้รับเงินสงเคราะห์เพื่อการยังชีพผู้ป่วยเอดส์</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="welfare_type[]" id="welfare_type_disability_2" value="option3">
                    <label class="form-check-label" for="welfare_type_disability_2">ได้รับเงินเบี้ยความพิการ</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="welfare_type[]" id="welfare_type_relocation" value="option4">
                    <label class="form-check-label" for="welfare_type_relocation">ย้ายภูมิลำเนาเข้ามาอยู่ใหม่
                    </label>
                </div>
            </div>
        </div>

        <!-- welfare_other_types input (visible when 'ย้ายภูมิลําเนาเข้ามาอยู่ใหม่' is checked) -->
        {{-- <div id="welfare_other_types_div" class="row mb-3" style="display: none;">
    <label class="col-sm-3 col-form-label" for="welfare_other_types">รายละเอียดอื่นๆ</label>
    <div class="col-sm-9">
        <input type="text" id="welfare_other_types" name="welfare_other_types" class="form-control" placeholder="กรอกข้อมูลเพิ่มเติม">
    </div>
</div> --}}
        <hr>

        <div class="my-4">
            <h4>มีความประสงค์ขอรับเงินเบี้ยยังชีพความพิการ โดยวิธีดังต่อไปนี้ (เลือก 1 วิธี)</h4>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option1" value="option1" required>
                <label class="form-check-label" for="money_type_option1">รับเงินสดด้วยตนเอง</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option2" value="option2">
                <label class="form-check-label" for="money_type_option2">รับเงินสดโดยบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option3" value="option3">
                <label class="form-check-label" for="money_type_option3">โอนเงินเข้าบัญชีเงินฝากธนาคารในนามผู้มีสิทธิ</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option4" value="option4">
                <label class="form-check-label" for="money_type_option4">โอนเงินเข้าบัญชีเงินฝากธนาคารในนามบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ</label>
            </div>
        </div>

        <hr>

        <h4>เลือกประเภทเอกสาร</h4>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="document_type[]" id="document_type_id_card" value="option1">
                    <label class="form-check-label" for="document_type_id_card">บัตรประจำตัวประชาชน</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="document_type[]" id="document_type_house_reg" value="option2">
                    <label class="form-check-label" for="document_type_house_reg">ทะเบียนบ้าน</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="document_type[]" id="document_type_bank_book" value="option3">
                    <label class="form-check-label" for="document_type_bank_book">สมุดบัญชีเงินฝากธนาคาร</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="document_type[]" id="document_type_auth_letter" value="option4">
                    <label class="form-check-label" for="document_type_auth_letter">หนังสือมอบอำนาจพร้อมบัตรประจำตัวประชาชนของผู้มอบอำนาจและผู้รับมอบอำนาจ</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="bank_option" id="bank_option" value="1" onclick="toggleAccountInputs()">
                <label class="form-check-label" for="bank_option">บัญชีเงินฝากธนาคาร</label>
            </div>

        </div>

        <div class="form-group" id="bank_name_group" style="display: none;">
            <label for="bank_name" class="form-label">ชื่อธนาคาร</label>
            <input type="text" id="bank_name" name="bank_name" class="form-control">
        </div>

        <!-- Account Number (Input) - Initially hidden -->
        <div class="form-group" id="account_number_group" style="display: none;">
            <label for="account_number" class="form-label">บัญชีเลขที่</label>
            <input type="text" id="account_number" name="account_number" class="form-control">
        </div>

        <!-- Account Name (Input) - Initially hidden -->
        <div class="form-group" id="account_name_group" style="display: none;">
            <label for="account_name" class="form-label">ชื่อบัญชี</label>
            <input type="text" id="account_name" name="account_name" class="form-control">
        </div>
        <br>
        <span style="width: 100%; ">
            "ข้าพเจ้าขอรับรองว่าข้าพเจ้าเป็นผู้มีคุณสมบัติครบถ้วน และข้อความดังกล่าวข้างต้นเป็นความจริงทุกประการ
            หากข้อความและเอกสารที่ยื่นเรื่องนี้เป็นเท็จ ข้าพเจ้ายินยอมให้ดำเนินการตามกฎหมาย"</span><br>
        <span style="width: 100%; ">
            "ข้าพเจ้ายินยอมให้นำข้อมูลส่วนบุคคลเข้าสู่ระบบคอมพิวเตอร์ของกรมส่งเสริมการปกครองท้องถิ่น และยินยอมให้
            ตรวจสอบข้อมูลกับฐานข้อมูลทะเบียนกลางภาครัฐ"
        </span>
        <hr>

        <div>
            <h4 for="attachments" class="form-label">แนบไฟล์เอกสาร (สามารถเลือกไฟล์พร้อมกันได้มากกว่า 1 ไฟล์)</h4>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
            <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 10MB)</small>
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

<script>
    // Toggle display of the welfare_other_types field based on the 'ย้ายภูมิลําเนาเข้ามาอยู่ใหม่' checkbox
    document.getElementById('welfare_type_relocation').addEventListener('change', function() {
        const otherTypesDiv = document.getElementById('welfare_other_types_div');
        otherTypesDiv.style.display = this.checked ? 'block' : 'none';
    });

</script>

<script src="{{ asset('js/multipart_files.js') }}"></script>

<script>
    function toggleAccountInputs() {
        var checkBox = document.getElementById("bank_option");
        var accountNumberGroup = document.getElementById("account_number_group");
        var accountNameGroup = document.getElementById("account_name_group");
        var bankNameGroup = document.getElementById("bank_name_group");

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

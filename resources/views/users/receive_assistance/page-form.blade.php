@extends('users.layout.layout')
@section('pages_content')
    <div class="container">
        <div class="mt-2 mb-3">
            <img src="{{ asset('eservice/4.png') }}" alt="" style="width: 100%; height: 600px;">
        </div>

        <h3 class="text-center"> แบบคำขอรับการสงเคราะห์ (ผู้ป่วยเอดส์) </h3><br>

        <form action="{{ route('ReceiveAssistanceFormCreate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5>ข้อมูลผู้ขอรับการสงเคราะห์</h5>
            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <label for="written_at" class="form-label">เขียนที่</label>
                    <input type="text" class="form-control" id="written_at" name="written_at">
                </div>
                <div class="col-md-6">
                    <input type="hidden" class="form-control" id="write_the_date" name="write_the_date"
                        value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="salutation" class="form-label">ชื่อนำหน้า</label>
                    <select class="form-select" id="salutation" name="salutation">
                        <option value="" selected disabled>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="first_name" class="form-label">ชื่อ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="last_name" class="form-label">นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <label for="reg_day">วันเกิดที่ (กรอกวันที่เกิด) <span class="text-danger">*</span></label>
                            <input type="number" id="reg_day" name="reg_day" class="form-control" min="1"
                                max="31" required>
                            <small id="reg_dayError" class="form-text text-danger"
                                style="display: none;">กรุณากรอกวันเป็นตัวเลขระหว่าง 1 - 31</small>
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
                            <input type="number" id="reg_year" name="reg_year" class="form-control" min="1900"
                                required>
                            <small id="reg_yearError" class="form-text text-danger" style="display: none;">กรุณากรอกปี 4
                                หลัก</small>
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
                            <label for="reg_birth_day" class="mb-0 me-2"
                                style="width: 12rem;">วันเกิดตามปฎิทินสากลคือ</label>
                            <input type="text" id="reg_birth_day" name="birth_day" class="form-control" readonly>
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
                            input.addEventListener("input", function() {
                                const regDay = document.getElementById("reg_day").value;
                                const regMonth = document.getElementById("reg_month").value;
                                const regYear = document.getElementById("reg_year").value;

                                if (regDay && regMonth && regYear) {
                                    const regYearAD = convertRegToAD(parseInt(regYear));
                                    const formattedRegDate =
                                        `${String(regDay).padStart(2, '0')}/${String(regMonth).padStart(2, '0')}/${regYearAD}`;

                                    document.getElementById("reg_birth_day").value = formattedRegDate;
                                }
                            });
                        });
                    </script>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="nationality" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="learn" class="form-label">บ้านเลขที่ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="learn" name="learn" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="village" class="form-label">หมู่</label>
                    <input type="text" class="form-control" id="village" name="village">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="community" class="form-label">ชุมชน</label>
                    <input type="text" class="form-control" id="community" name="community">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="alley" class="form-label">ซอย</label>
                    <input type="text" class="form-control" id="alley" name="alley">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="road" class="form-label">ถนน</label>
                    <input type="text" class="form-control" id="road" name="road">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="subdistrict" class="form-label">ตำบล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="subdistrict" name="subdistrict" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="district" name="district" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="province" name="province" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="postal_code" class="form-label">รหัสไปรษณีย์ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="phone_number" class="form-label">หมายเลขโทรศัพท์ <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="citizen_id" class="form-label">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="citizen_id" name="citizen_id" required>
                </div>
            </div>
            <hr>

            <div class="row mb-3">
                <div class="col-12">
                    <h5>1. ที่พักอาศัย</h5>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="accommodation[]" value="option_1"
                            id="option_1">
                        <label class="form-check-label" for="option_1">เป็นของตนเอง และมีลักษณะ</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="accommodation[]" value="option_2"
                            id="option_2">
                        <label class="form-check-label" for="option_2">ชำรุดทรุดโทรม</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="accommodation[]" value="option_3"
                            id="option_3">
                        <label class="form-check-label" for="option_3">ชำรุดทรุดโทรมบางส่วน</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="accommodation[]" value="option_4"
                            id="option_4">
                        <label class="form-check-label" for="option_4">มั่นคงถาวร</label>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="accommodation[]" value="option_5"
                                    id="option_5">
                                <label class="form-check-label" for="option_5">เป็นของ</label>
                            </div>
                        </div>

                        <div class="col">
                            <label for="accommodation_belongs_to" class="form-label visually-hidden">เป็นของ</label>
                            <input type="text" class="form-control" id="accommodation_belongs_to"
                                name="accommodation_belongs_to" placeholder="กรุณาระบุรายละเอียด">
                        </div>
                    </div>

                    <div class="col">
                        <label for="accommodation_relevant_as" class="form-label">เกี่ยวข้องเป็น</label>
                        <input type="text" class="form-control" id="accommodation_relevant_as"
                            name="accommodation_relevant_as" placeholder="กรุณาระบุรายละเอียด">
                    </div>
                </div>

                <hr>

                <!-- Section 1 -->
                <div class="row mb-3">
                    <div class="col-12">
                        <h5>2. ที่พักอาศัยอยู่ห่างจากบ้านหลังที่ใกล้ที่สุดเป็นระยะทาง</h5>
                        <input type="text" class="form-control" id="away_from_home" name="away_from_home"
                            placeholder="กรุณาระบุระยะทาง">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">สามารถเดินทางได้</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="away_from_home_option_1"
                                name="away_from_home_option" value="option_1">
                            <label class="form-check-label" for="away_from_home_option_1">สะดวก</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="away_from_home_option_2"
                                name="away_from_home_option" value="option_2">
                            <label class="form-check-label" for="away_from_home_option_2">ลำบาก</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="away_from_home_option_dueto" class="form-label">เนื่องจาก</label>
                        <input type="text" class="form-control" id="away_from_home_option_dueto"
                            name="away_from_home_option_dueto" placeholder="กรุณาระบุเหตุผลการลำบาก">
                    </div>
                </div>

                <br>
                <!-- Section 2 -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label"
                            for="away_from_community"><strong>อยู่ห่างจากชุมชน/หมู่บ้านเป็นระยะทาง</strong></label>
                        <input type="text" class="form-control" id="away_from_community" name="away_from_community"
                            placeholder="กรุณาระบุระยะทาง">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">สามารถเดินทางได้</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="away_from_community_option_1"
                                name="away_from_community_option" value="option_1">
                            <label class="form-check-label" for="away_from_community_option_1">สะดวก</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="away_from_community_option_2"
                                name="away_from_community_option" value="option_2">
                            <label class="form-check-label" for="away_from_community_option_2">ลำบาก</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="away_from_community_option_dueto" class="form-label">เนื่องจาก</label>
                        <input type="text" class="form-control" id="away_from_community_option_dueto"
                            name="away_from_community_option_dueto" placeholder="กรุณาระบุเหตุผลการลำบาก">
                    </div>
                </div>

                <br>
                <!-- Section 3 -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label"
                            for="stay_away_from_agency"><strong>อยู่ห่างจากหน่วยบริการของรัฐที่ใกล้ที่สุดเป็นระยะทาง</strong></label>
                        <input type="text" class="form-control" id="stay_away_from_agency"
                            name="stay_away_from_agency" placeholder="กรุณาระบุระยะทาง">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">สามารถเดินทางได้</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="stay_away_from_agency_option_1"
                                name="stay_away_from_agency_option" value="option_1">
                            <label class="form-check-label" for="stay_away_from_agency_option_1">สะดวก</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="stay_away_from_agency_option_2"
                                name="stay_away_from_agency_option" value="option_2">
                            <label class="form-check-label" for="stay_away_from_agency_option_2">ลำบาก</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="stay_away_from_agency_option_dueto" class="form-label">เนื่องจาก</label>
                        <input type="text" class="form-control" id="stay_away_from_agency_option_dueto"
                            name="stay_away_from_agency_option_dueto" placeholder="กรุณาระบุเหตุผลการลำบาก">
                    </div>
                </div>



                <hr>

                <div class="row mb-3">
                    <div class="col-12">
                        <h5>3. ที่พักอาศัย</h5>
                    </div>
                </div>

                <!-- อยู่เพียงลำพัง -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="residence" name="residence"
                                value="yes">
                            <label class="form-check-label" for="residence">อยู่เพียงลำพัง</label>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="residence_stay_alone_dueto" class="form-label">เนื่องจาก</label>
                        <input type="text" class="form-control" id="residence_stay_alone_dueto"
                            name="residence_stay_alone_dueto" placeholder="กรุณาระบุเหตุผล">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="residence_stay_alone_dueto_detail" class="form-label">มาประมาณ</label>
                        <input type="text" class="form-control" id="residence_stay_alone_dueto_detail"
                            name="residence_stay_alone_dueto_detail" placeholder="กรุณาระบุระยะเวลา">
                    </div>
                </div>


                <!-- อาศัยอยู่กับ -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="residence_living_with"
                                name="residence_living_with" value="yes">
                            <label class="form-check-label" for="residence_living_with">อาศัยอยู่กับ</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" id="residence_living_with_detail"
                            name="residence_living_with_detail" placeholder="กรุณาระบุรายละเอียด">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="residence_living_with_quantity" class="form-label">จำนวนคนที่อาศัยอยู่ด้วย</label>
                        <input type="text" class="form-control" id="residence_living_with_quantity"
                            name="residence_living_with_quantity">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="residence_living_with_working"
                            class="form-label">เป็นผู้สามารถประกอบอาชีพได้จำนวน</label>
                        <input type="text" class="form-control" id="residence_living_with_working"
                            name="residence_living_with_working">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="residence_living_with_total_income" class="form-label">มีรายได้รวม</label>
                        <input type="text" class="form-control" id="residence_living_with_total_income"
                            name="residence_living_with_total_income">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="residence_living_with_non_workers"
                            class="form-label">ผู้ที่ไม่สามารถประกอบอาชีพได้เนื่องจาก</label>
                        <input type="text" class="form-control" id="residence_living_with_non_workers"
                            name="residence_living_with_non_workers">
                    </div>
                </div>

                <hr>

                <div class="my-2">
                    <h5> 4. รายได้ – รายจ่าย</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="total_income">รายได้รวม (บาท/เดือน)</label>
                            <input type="text" class="form-control" id="total_income" name="total_income">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="source_of_income">แหล่งรายได้</label>
                            <input type="text" class="form-control" id="source_of_income" name="source_of_income">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="used_for_expenses">ใช้จ่ายสำหรับ</label>
                            <input type="text" class="form-control" id="used_for_expenses" name="used_for_expenses">
                        </div>
                    </div>
                </div>

                <hr>

                <h5>5. ข้อมูลการติดต่อ</h5>
                <div class="row my-3">
                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_person">ชื่อผู้ติดต่อ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_address_number">หมายเลขที่อยู่ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_address_number"
                            name="contact_address_number" required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_road">ถนน</label>
                        <input type="text" class="form-control" id="contact_road" name="contact_road">
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_alley">ซอย</label>
                        <input type="text" class="form-control" id="contact_alley" name="contact_alley">
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_village">หมู่บ้าน</label>
                        <input type="text" class="form-control" id="contact_village" name="contact_village">
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_subdistrict">ตำบล <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_subdistrict" name="contact_subdistrict"
                            required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_district">อำเภอ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_district" name="contact_district"
                            required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_province">จังหวัด <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_province" name="contact_province"
                            required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_postal_code">รหัสไปรษณีย์ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_postal_code" name="contact_postal_code"
                            required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_telephone">หมายเลขโทรศัพท์ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_telephone" name="contact_telephone"
                            required>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_fax">หมายเลขแฟกซ์</label>
                        <input type="text" class="form-control" id="contact_fax" name="contact_fax">
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 form-group mb-3">
                        <label for="contact_relevant_as">ผู้เกี่ยวข้องในฐานะ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_relevant_as" name="contact_relevant_as"
                            required>
                    </div>
                </div>

                <br>
                <br>
                <h5><strong>ข้าพเจ้าขอรับรองว่าถ้อยคำที่ให้ข้างต้น เป็นความจริงทุกประการ</strong></h5><br>
                <hr>

                <div class="mb-3">
                    <label for="attachments" class="form-label">แนบไฟล์บัตรประชาชน <span
                            class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="attachments" name="attachments[]" multiple required>
                </div>

                <div>
                    <h5 for="attachments" class="form-label">แนบไฟล์</h5>
                    <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                    <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
                    <!-- แสดงรายการไฟล์ที่แนบ -->
                    <div id="file-list" class="mt-1">
                        <div class="d-flex flex-wrap gap-3"></div>
                    </div>
                </div>

                <div class="text-center w-full border">
                    <button type="submit" class="btn btn-primary w-100 py-1"><i
                            class="fa-solid fa-file-arrow-up me-2"></i></i>
                        ส่งฟอร์มข้อมูล</button>
                </div>
        </form>
    </div>

    <script src="{{ asset('js/multipart_files.js') }}"></script>
@endsection

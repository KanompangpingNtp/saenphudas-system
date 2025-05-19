<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>PDF Report</title>

    <style>
        @font-face {
            font-family: 'sarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun-bold';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew-Bold.ttf') }}") format('truetype');
        }

        body {
            font-family: 'sarabun', 'sarabun-bold', sans-serif;
            font-size: 17px;
            margin: 0;
            padding: 0;
            line-height: 1;
        }


        .regis_number {
            text-align: right;
            margin-right: 8px;
        }

        .title_doc {
            text-align: center;
        }

        .box_text {
            border: 1px solid rgb(255, 255, 255);
            text-align: center;
        }

        .box_text span {
            display: inline-flex;
            align-items: center;
            line-height: 1;
        }

        .box_text input[type="checkbox"] {
            width: 17px;
            /* ปรับขนาด checkbox ให้พอดีกับข้อความ */
            height: 17px;
            /* ปรับความสูงให้พอดีกับข้อความ */
            margin-right: 5px;
            margin-left: 5px;
            /* เว้นระยะห่างระหว่าง checkbox และข้อความ */
        }

        .box_text_border {
            margin-top: 5px;
            padding-left: 5px;
            padding-right: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
            text-align: left;
            ;
        }

        .box_text_border span {
            display: inline-flex;
            align-items: left;
            line-height: 0.3;
        }

        .box_text_border input[type="checkbox"] {
            width: 17px;
            /* ปรับขนาด checkbox ให้พอดีกับข้อความ */
            height: 17px;
            /* ปรับความสูงให้พอดีกับข้อความ */
            margin-right: 5px;
            margin-left: 5px;
            /* เว้นระยะห่างระหว่าง checkbox และข้อความ */
        }

        .dotted-line {
            margin-left: 2px;
            color: blue;
            border-bottom: 2px dotted blue;
            word-wrap: break-word;
            /* ห่อข้อความที่ยาวเกิน */
            overflow-wrap: break-word;
            /* รองรับ browser อื่น */
        }

    </style>
</head>

<body>

    @php
    use Carbon\Carbon;
    $date = Carbon::parse($form->written_date);
    $day = $date->day;
    $month = $date->locale('th')->translatedFormat('F');
    $year = $date->year + 543;

    $birthday = Carbon::parse($form->birth_day);
    $birthday_day = $birthday->day;
    $birthday_month = $birthday->locale('th')->translatedFormat('F');
    $birthday_year = $birthday->year + 543;

    // $citizen_id = $form->traders->first()->citizen_id;
    // $tradersformatted_id =
    // substr($citizen_id, 0, 1) .
    // '-' .
    // substr($citizen_id, 1, 4) .
    // '-' .
    // substr($citizen_id, 5, 5) .
    // '-' .
    // substr($citizen_id, 10, 2) .
    // '-' .
    // substr($citizen_id, 12, 1);

    $citizen_c_id = $form->citizen_id;
    $formatted_id =
    substr($citizen_c_id, 0, 1) .
    '-' .
    substr($citizen_c_id, 1, 4) .
    '-' .
    substr($citizen_c_id, 5, 5) .
    '-' .
    substr($citizen_c_id, 10, 2) .
    '-' .
    substr($citizen_c_id, 12, 1);
    @endphp

    <div class="regis_number">ทะเบียนเลขที่............/ 2568</div>
    <div class="title_doc">แบบคำขอยืนยันสิทธิรับเงินเบี้ยยังชีพผู้สูงอายุ</div>
    <div class="box_text_border" style="font-size: 18px">
        <span style="text-align:left;">เฉพาะกรณีผู้สูงอายุมอบอำนาจให้บุคคลอื่นมายื่นคำขอยืนยันสิทธิแทน</span>
        <span></span>
        <div>
            <span>ผู้ยื่นคำขอฯ แทนตามหนังสือมอบอำนาจ เกี่ยวข้องเป็น</span>
            <span class="dotted-line" style="width: 42%; text-align:center; border-bottom: 2px dotted black;"></span>
            <span>กับผู้สูงอายุที่ขอยืนยันสิทธิ</span>
        </div>
        <div>
            <span>ชื่อ – สกุล (ผู้รับมอบอำนาจ) </span>
            <span class="dotted-line" style="width: 51%; text-align:center; border-bottom: 2px dotted black;"></span>เลขประจำตัวประชาชนผู้รับมอบอำนาจ
        </div>
        <div>
            <span></span><span class="dotted-line" style="width: 30%; text-align:center; border-bottom: 2px dotted black;">
            </span>
            <span>ที่อยู่</span><span class="dotted-line" style="width: 64%; text-align:center; border-bottom: 2px dotted black;">
            </span>
        </div>
        <div>
            <span class="dotted-line" style="width: 61%; text-align:center; border-bottom: 2px dotted black;">
            </span>
            <span>โทรศัพท์</span><span class="dotted-line" style="width: 30%; text-align:left; border-bottom: 2px dotted black;"></span>
        </div>
    </div>
    <div class="box_text" style="text-align: left;"><span>ข้อมูลผู้สูงอายุ</span>
    </div>
    <div class="box_text" style="text-align: right;"><span>เขียนที่</span>
        <span class="dotted-line" style="width: 25%; text-align: center;"> {{ $form->written_at }}
        </span>
        <div>
            <span>วันที่</span><span class="dotted-line" style="width: 5%; text-align: center;"> {{ $day }}
            </span><span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center;">
                {{ $month }}
            </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;">
                {{ $year }}
            </span>
        </div>
    </div>
    <div class="box_text" style="text-align: right;">
        <span>ด้วยข้าพเจ้า ชื่อ</span><span class="dotted-line" style="width: 35%; text-align: center;">{{ $form->salutation }}&nbsp;{{ $form->first_name }}
        </span>
        <span>นามสกุล</span><span class="dotted-line" style="width: 35%; text-align: center;"> {{ $form->last_name }}
        </span>
    </div>
    <div class="box_text">
        <span>เกิดวันที่</span><span class="dotted-line" style="width: 17%; text-align: center;"> {{ $birthday_day }}
        </span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center;"> {{ $birthday_month }}
        </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{ $birthday_year }}
        </span><span>อายุ</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->age }}
        </span><span>ปี</span> <span>สัญชาติ</span><span class="dotted-line" style="width: 15%; text-align: center;">
            {{ $form->nationality }}
        </span><span>มีชื่ออยู่ในสำเนา</span>
    </div>
    <div class="box_text">
        <span>ทะเบียนบ้านเลขที่</span><span class="dotted-line" style="width: 16%; text-align: center;">
            {{ $form->house_number }}
        </span>
        <span>หมู่ที่</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->village }}
        </span>
        <span>ชุมชน</span><span class="dotted-line" style="width: 23%; text-align: center;"> {{ $form->community }}
        </span>
        <span>ตรอก/ซอย</span><span class="dotted-line" style="width: 22%; text-align: center;"> {{ $form->alley }}
        </span>
    </div>
    <div class="box_text">
        <span>ถนน</span><span class="dotted-line" style="width: 21%; text-align: center;"> {{ $form->road }}
        </span>
        <span>ตำบล</span><span class="dotted-line" style="width: 17%; text-align: center;"> {{ $form->subdistrict }}
        </span>
        <span>อำเภอ</span><span class="dotted-line" style="width: 22%; text-align: center;"> {{ $form->district }}
        </span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 21%; text-align: center;"> {{ $form->province }}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>รหัสไปรษณีย์</span><span class="dotted-line" style="width: 20%; text-align: center;">
            {{ $form->postal_code }}
        </span>
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 20%; text-align: center;">
            {{ $form->phone_number }}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>หมายเลขบัตรประจำตัวประชาชนของผู้สูงอายุที่ยื่นคำขอ</span><span class="dotted-line" style="width: 50%; text-align: center;"> {{ $formatted_id }}
        </span>
    </div>
    <div class="box_text" style=" margin-left:7px; margin-top:2px;">
        <div style="text-align:left">
            <span>สถานภาพสมรส</span>
            <span>
                <input type="checkbox" {{ $form->marital_status == 'single' ? 'checked' : '' }}> โสด
            </span>
            <span>
                <input type="checkbox" {{ $form->marital_status == 'married' ? 'checked' : '' }}> สมรส
            </span>
            <span>
                <input type="checkbox" {{ $form->marital_status == 'widowed' ? 'checked' : '' }}> หม้าย
            </span>
            <span>
                <input type="checkbox" {{ $form->marital_status == 'divorced' ? 'checked' : '' }}> หย่าร้าง
            </span>
            <span>
                <input type="checkbox" {{ $form->marital_status == 'separated' ? 'checked' : '' }}> แยกกันอยู่
            </span>
            <span>
                <input type="checkbox" {{ $form->marital_status == 'other' ? 'checked' : '' }}> อื่นๆ
            </span>
        </div>
    </div>
    <div class="box_text" style=" margin-left:7px;">
        <span>รายได้ต่อเดือน</span><span class="dotted-line" style="width: 41%; text-align: center;">
            {{ $form->monthly_income }}
        </span>
        <span>อาชีพ</span><span class="dotted-line" style="width: 42%; text-align: center;"> {{ $form->occupation }}
        </span>
    </div>
    <div class="box_text" style="text-align:left; margin-left:8px; line-height: 12px; margin-top: 5px;">
        <span style="line-height: 10px;">ข้อมูลทั่วไป : สถานภาพการรับสวัสดิการภาครัฐ</span>
        <div style="width: 80%;">
            <span style="float: left; width: 30%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option1', $form->personsOption->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ไม่ได้รับเบี้ยยังชีพผู้สูงอายุ
            </span>
            <span style="float: right; width: 50%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option2', $form->personsOption->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ได้รับเงินสงเคราะห์เพื่อการยังชีพผู้ป่วยเอดส์
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 30%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option3', $form->personsOption->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ได้รับเงินเบี้ยความพิการ
            </span>
            <span style="float: right; width: 50%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option4', $form->personsOption->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ย้ายภูมิลำเนาเข้ามาอยู่ใหม่ เมื่อ
            </span>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div class="box_text" style="text-align:left; margin-left:8px; line-height: 12px; margin-top: 5px;">
        <span style="line-height: 10px;">มีความประสงค์ขอรับเงินเบี้ยยังชีพผู้สูงอายุ โดยวิธีดังต่อไปนี้ (เลือก 1
            วิธี)</span>
        <div style="width: 100%;">
            <span style="float: left; width: 40%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->personsOption->first()->request_for_money_type == 'option1' ? 'checked' : '' }}>
                รับเงินสดด้วยตนเอง
            </span>
            <span style="float: right; width: 60%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->personsOption->first()->request_for_money_type == 'option2' ? 'checked' : '' }}>
                รับเงินสดโดยบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 100%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->personsOption->first()->request_for_money_type == 'option3' ? 'checked' : '' }}>
                โอนเข้าบัญชีเงินฝากธนาคารในนามผู้มีสิทธิ
            </span>

            <span style="float: right; width: 60%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->personsOption->first()->request_for_money_type == 'option4' ? 'checked' : '' }}>
                โอนเข้าบัญชีเงินฝากธนาคารในนามบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ
            </span>
            <div style="clear: both;"></div>
        </div>


        <span style="line-height: 1;">พร้อมแนบเอกสาร ดังนี้</span>
        <div style="width: 100%;">
            <div style="width: 100%;">
                <span style="float: left; width: 60%; line-height: 0.9;">
                    <input type="checkbox" style="margin: 0;" {{ in_array('option1', $documentType) ? 'checked' : '' }}>
                    บัตรประจำตัวประชาชน หรือบัตรอื่นที่ออกโดยหน่วยงานของรัฐที่มีรูปถ่าย
                </span>
                <span style="float: right; width: 40%; line-height: 0.9;">
                    <input type="checkbox" style="margin: 0;" {{ in_array('option2', $documentType) ? 'checked' : '' }}>
                    ทะเบียนบ้าน
                </span>
                <div style="clear: both;"></div>

                <span style="float: left; width: 100%; line-height: 0.9;">
                    <input type="checkbox" style="margin: 0;" {{ in_array('option3', $documentType) ? 'checked' : '' }}>
                    สมุดบัญชีเงินฝากธนาคาร
                    (ในกรณีผู้ขอรับเงินเบี้ยยังชีพผู้สูงอายุประสงค์ขอรับเงินเบี้ยยังชีพผู้สูงอายุผ่านธนาคาร)
                </span>
                <div style="clear: both;"></div>

                <span style="float: left; width: 100%; line-height: 0.9;">
                    <input type="checkbox" style="margin: 0;" {{ in_array('option4', $documentType) ? 'checked' : '' }}>
                    หนังสือมอบอำนาจพร้อมบัตรประจำตัวประชาชนของผู้มอบอำนาจและผู้รับมอบอำนาจ
                </span>
                <div style="clear: both;"></div>
                <span style="float: left; width: 20%; line-height: 0.9;"><input type="checkbox" style="margin: 0;" {{ old('bank_option', $form->bank->first()->bank_option ?? '') == '1' ? 'checked' : '' }}>
                    บัญชีเงินฝากธนาคาร</span>
                <span class="dotted-line" style="width: 80%; text-align: left;">
                    {{ $form->bank->first()->bank_name ?? '-' }} </span>
                <div style="clear: both;"></div>
            </div>
        </div>
        <div class="box_text" style="text-align:right;">
            <span>บัญชีเลขที่</span><span class="dotted-line" style="width: 30%; text-align: center;">
                {{ $form->bank->first()->account_number ?? '-' }}
            </span>
            <span>ชื่อบัญชี</span><span class="dotted-line" style="width: 42%; text-align: center;">
                {{ $form->bank->first()->account_name ?? '-' }}
            </span>
        </div>
        <div class="box_text" style="text-align:left; margin-left:10px; line-height: 12px; ">
            <div style="width: 100%;">
                <span style="width: 100%; "><input type="checkbox" style="margin-left: 5rem;">
                    “ข้าพเจ้าขอรับรองว่าข้าพเจ้าเป็นผู้มีคุณสมบัติครบถ้วน ณ
                    วันที่ข้าพเจ้ามีสิทธิได้รับเบี้ยยังชีพผู้สูงอายุ
                    และขอรับรองว่าข้อความดังกล่าวข้างต้นเป็นความจริงทุกประการ”</span>
                <span style="width: 100%; "><input type="checkbox" style="margin-left: 5rem;">
                    "ข้าพเจ้ายินยอมให้นำข้อมูลส่วนบุคคลเข้าสู่ระบบคอมพิวเตอร์ของกรมส่งเสริมการปกครองท้องถิ่น
                    และยินยอมให้ตรวจสอบข้อมูลกับฐานข้อมูลทะเบียนกลางภาครัฐ"
                </span>
            </div>
        </div>

        <div class="box_text" style="margin-top: 0.6rem;">
            <div>
                <!-- ฝั่งซ้าย -->
                <div style="float: left; width: 50%;">
                    <span>(ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 50%; text-align: center; border-bottom: 2px dotted black;">
                    </span>
                    <div style="margin-left: 40px;">
                        <span>(</span>
                        <span class="dotted-line" style="width: 50%; text-align: center; border-bottom: 2px dotted black;">
                        </span>
                        <span>)</span>
                    </div>
                    <div style="margin-left: 40px;">
                        <span>ผู้ยื่นคำขอ/ผู้รับมอบอำนาจยื่นคำขอ</span>
                    </div>
                </div> <!-- ฝั่งขวา -->
                <div style="float: right; width: 50%;">
                    <span>(ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 50%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;">
                    </span>
                    <div style="margin-left: 40px;">
                        <span>(</span>
                        <span class="dotted-line" style="width: 50%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;">
                        </span>
                        <span>)</span>
                    </div>
                    <div>
                        <span>ตำแหน่ง</span>
                        <span class="dotted-line" style="width:50%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"">
                        </span>
                    </div>
                    <div style=" margin-left: 40px;">
                            <span>เจ้าหน้าที่ผู้รับยืนยันสิทธิ
                            </span>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div> <!-- ใช้ clear เพื่อยกเลิกการ float -->
        </div>

        {{-- new page --}}
        <div style="page-break-before: always;"></div>

        <div style="text-align: center">
            - 2 -
        </div>

        <div class="box_text_border" style="margin-top: 2rem; text-align:left; padding-left:5px; border-right: 2px solid black;">
            <div style="border-bottom:2px solid black;">
                <div id="left" style="float: left; width: 49%; padding-top:5px;">
                    <div>ความเห็นเจ้าหน้าที่ผู้รับยืนยันสิทธิ</div>
                    <div>เรียน คณะกรรมการตรวจสอบคุณสมบัติ
                    </div>
                    <div style="text-align:center;">ได้ตรวจสอบคุณสมบัติของ</div>
                    <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 10px; border-bottom: 2px dotted black;">{{ $form->salutation }}
                        {{ $form->first_name }} {{ $form->last_name }}</span>
                    <div>หมายเลขบัตรประจำตัวประชาชน</div>
                    <span class="dotted-line" style="width: 80%; text-align: center; margin-top: 10px; border-bottom: 2px dotted black;">{{ $formatted_id }}</span>
                    <span style="margin-left:10px;">แล้ว</span>
                    <div class="box_text" style="text-align:left; margin-top: 10px;">
                        <div style="width: 100%;">
                            <span style="width: 100%; "><input type="checkbox"> เป็นผู้มีคุณสมบัติ <span style="border-bottom: 2px solid black;">ในการยืนยันสิทธิ</span>ครบถ้วน</span>
                            <span style="width: 100%; margin-top:10px;"><input type="checkbox"> เป็นผู้ที่ <span style="border-bottom: 2px solid black;">รอตรวจสอบคุณสมบัติ</span> ณ
                                วันที่มีสิทธิได้รับ</span>
                            <span style="width: 100%; margin-left: 7px; margin-top:7px;">เงินเบี้ยยังชีพ</span>
                            <span style="width: 100%; margin-top:10px;"><input type="checkbox"> เป็นผู้ที่ขาดคุณสมบัติ
                                เนื่องจาก</span>
                        </div>
                    </div>
                    <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 20px; border-bottom: 2px dotted black;">
                    </span>
                    <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 20px; border-bottom: 2px dotted black;">
                    </span>
                    <div style=" width: 100%; text-align: center; margin-top:20px">
                        <span>(ลงชื่อ)</span>
                        <span class="dotted-line" style="width: 70%; text-align: center; border-bottom: 2px dotted black;"> </span>
                        <div style="margin-left: 40px;">
                            <span>(</span>
                            <span class="dotted-line" style="width: 70%; text-align: center; border-bottom: 2px dotted black; margin-top: 20px;">
                            </span>
                            <span>)</span>
                        </div>
                        <div style="margin-left: 55px; margin-top: 20px;">
                            <span>เจ้าหน้าที่ผู้รับยืนยันสิทธิ</span>
                        </div>
                    </div>
                </div>

                <div id="right" style="float: right; width: 49%;  height: 38%; padding-left: 9px; border-left: 2px solid black; padding-top:5px;">
                    <div>ความเห็นคณะกรรมการตรวจสอบคุณสมบัติ</div>
                    <div style="margin-top: 10px;">เรียน นายก เทศมนตรี/อบต.<span class="dotted-line" style="width: 100%; text-align: center; margin-top: 20px; border-bottom: 2px dotted black;">
                        </span></div>
                    <div style="text-align: center; margin-top: 10px;">คณะกรรมการตรวจสอบคุณสมบัติได้ตรวจสอบแล้ว</div>
                    <div style="text-align: left; margin-top: 10px;">มีความเห็นดังนี้</div>
                    <div class="box_text" style="text-align:left; margin-top: 10px;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="text-align: left; width: 50%;">
                                    <label style="display: flex; align-items: center;">
                                        <input type="checkbox" style="margin-right: 5px;"> สมควรรับยืนยันสิทธิ
                                    </label>
                                </td>
                                <td style="text-align: right; width: 50%;">
                                    <label style="display: flex; align-items: center;">
                                        <input type="checkbox" style="margin-right: 5px;"> ไม่สมควรรับยืนยันสิทธิ
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div style=" width: 100%; margin-top: 10px;">
                        <span>กรรมการ (ลงชื่อ)</span>
                        <span class="dotted-line" style="width: 60%; text-align: center; border-bottom: 2px dotted black;"> </span>
                        <div style="margin-left: 90px;">
                            <span>(</span>
                            <span class="dotted-line" style="width: 80%; text-align: center; border-bottom: 2px dotted black; margin-top: 20px;">
                            </span>
                            <span>)</span>
                        </div>
                        <span>กรรมการ (ลงชื่อ)</span>
                        <span class="dotted-line" style="width: 60%; text-align: center; border-bottom: 2px dotted black; margin-top: 20px;">
                        </span>
                        <div style="margin-left: 90px;">
                            <span>(</span>
                            <span class="dotted-line" style="width: 80%; text-align: center; border-bottom: 2px dotted black; margin-top: 20px;">
                            </span>
                            <span>)</span>
                        </div>
                        <span>กรรมการ (ลงชื่อ)</span>
                        <span class="dotted-line" style="width: 60%; text-align: center; border-bottom: 2px dotted black; margin-top: 20px;">
                        </span>
                        <div style="margin-left: 90px;">
                            <span>(</span>
                            <span class="dotted-line" style="width: 80%; text-align: center; border-bottom: 2px dotted black; margin-top: 20px;">
                            </span>
                            <span>)</span>
                        </div>
                    </div>
                </div>

                <div style="clear: both;"></div> <!-- ใช้ clear เพื่อยกเลิกการ float -->
            </div>
            <div style="margin-top: 5px;">
                <div>
                    คำสั่ง
                </div>
                <div style="text-align: center;"><input type="checkbox">รับลงทะเบียน <input type="checkbox">ไม่รับลงทะเบียน <input type="checkbox">อื่น ๆ<span class="dotted-line" style="width: 30%; text-align: center; margin-top:15px; border-bottom: 2px dotted black; margin-top:20px;">
                    </span></div>
                <span class="dotted-line" style="width: 100%; text-align: center; margin-top:15px; border-bottom: 2px dotted black; margin-top:20px;">
                </span>
                <div style=" width: 100%; text-align:center; margin-bottom:20px; margin-top:20px">
                    <span style="margin-left: 100px;">(ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 30%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;">
                    </span>
                    <div style="margin-left: 40px;">
                    </div>
                    <span>นายก เทศมนตรี/นายก อบต.</span>
                    <span class="dotted-line"
                        style="width: 30%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;">
                    </span>
                    <div style="margin-left: 40px;">
                    </div>
                    <span style="margin-left: 74px;">วัน/เดือน/ปี</span>
                    <span class="dotted-line"
                        style="width: 30%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;">
                    </span>
                </div>
            </div>
        </div>
        <div style="margin-top: 3rem; text-align:center; padding-left:5px;">
            <div style="font-size: 18px;">
                ตัดตามรอยเส้นประ ให้ผู้สูงอายุที่ยื่นคำขอยืนยันสิทธิเก็บเพื่อเป็นหลักฐานการยืนยันสิทธิ
            </div>
            <span class="dotted-line" style="width: 100%; text-align: center; display: block; border-bottom: 2px dotted black; margin-top: 5px;"></span>
        </div>

        <div style="font-size: 19px;">
            <div class="box_text" style="margin-top: 3rem;">
                <span>ยื่นแบบคำขอยืนยันสิทธิเมื่อวันที่</span><span class="dotted-line" style="width: 20%; text-align: center; border-bottom: 2px dotted black;">

                </span>
                <span>เดือน</span><span class="dotted-line" style="width: 25%; text-align: center; border-bottom: 2px dotted black;">
                </span><span>พ.ศ.</span><span class="dotted-line" style="width: 20%; text-align: center; border-bottom: 2px dotted black;">

            </div>
            <div class="box_text" style="margin-left: 3rem;">
                <span>การยืนยันสิทธิครั้งนี้
                    เพื่อขอรับเงินเบี้ยยังชีพผู้สูงอายุโดยจะได้รับเงินเบี้ยเบี้ยยังชีพผู้สูงอายุตามที่มีคุณสมบัติครบถ้วน</span>
            </div>
            <div class="box_text">
                <span>และตามช่วงระยะเวลาในการยืนยันสิทธิ ภายในวันที่ 10 ของทุกเดือน โดยได้รับตั้งแต่เดือน</span><span class="dotted-line" style="width: 32%; text-align: center; border-bottom: 2px dotted black;">
                </span>
            </div>
            <div class="box_text" style="text-align: left;">
                <span>พ.ศ.</span><span class="dotted-line" style="width: 15%; text-align: center; border-bottom: 2px dotted black;">
                </span>เป็นต้นไป&nbsp;กรณีผู้สูงอายุย้ายภูมิลำเนา
                ไปอยู่ที่อื่นจะต้องไปยืนยันสิทธิยื่นคำขอรับเงินเบี้ยยังชีพผู้สูงอายุ
            </div>
            <div class="box_text" style="text-align: left; margin-left:2px;">
                <span>ณ ที่องค์กรปกครองส่วนท้องถิ่นแห่งใหม่ภายในเดือนกันยายนของปีนั้น ทั้งนี้ผู้สูงอายุจะได้เบี้ยผู้สูงอายุ ณ องค์กรปกครองส่วนท้องถิ่นเดิม
                </span>
            </div>
            <div class="box_text" style="text-align: left; margin-left:2px;">
                <span>
                    จนสิ้นปีงบประมาณ และรับที่องค์กรปกครองส่วนท้องถิ่นใหม่ในปีงบประมาณถัดไป
                </span>
            </div>
        </div>
</body>

</html>

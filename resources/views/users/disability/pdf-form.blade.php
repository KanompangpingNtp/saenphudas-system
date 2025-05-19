<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ</title>

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
            font-size: 15.3px;
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
            margin-bottom: 5px;
            border: 2px solid black;
            text-align: center;
        }

        .box_text_border span {
            display: inline-flex;
            align-items: center;
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

    // $citizen_id = $form->disabilityTraders->first()->citizen_id;
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

    <div class="regis_number">ทะเบียนเลขที่ .........................../ 2568</div>
    <div class="title_doc">แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ</div>
    <div class="box_text_border">
        <span>เฉพาะกรณีคนพิการมอบอำนาจหรือผู้ดูแลคนพิการลงทะเบียนแทน :</span>
        <span>ผู้ยื่นคำขอฯแทนตามหนังสือมอบอำนาจเกี่ยวข้องกับคนพิการ</span>
        <div style="text-align:left; margin-left:11px;">
            <span>ที่ขอขึ้นทะเบียน โดยเป็น</span>
            <span><input type="checkbox"> บิดา-มารดา</span>
            <span><input type="checkbox"> บุตร</span>
            <span><input type="checkbox"> สามี-ภรรยา</span>
            <span><input type="checkbox"> พี่น้อง</span>
            <span><input type="checkbox"> ผู้ดูแลคนพิการตามระเบียบฯ</span>
        </div>
        <div>
            <span>ชื่อ – สกุล (ผู้รับมอบอำนาจ/ผู้ดูแลคนพิการ ) </span>
            <span class="dotted-line" style="width: 69%; border-bottom: 2px dotted black;">  </span>
        </div>
        <div>
            <span>เลขประจำตัวประชาชน</span><span class="dotted-line" style="width: 37%; border-bottom: 2px dotted black;">  </span>
            <span>ที่อยู่</span><span class="dotted-line" style="width: 40%; border-bottom: 2px dotted black;"> </span>
        </div>
        <div>
            <span class="dotted-line" style="width: 58%; text-align:center; border-bottom: 2px dotted black;">
            </span>
            <span>โทรศัพท์</span><span class="dotted-line" style="width: 30%; border-bottom: 2px dotted black;"> </span>
        </div>
    </div>
    <div class="box_text" style="text-align: right;"><span>เขียนที่</span>
        <span class="dotted-line" style="width: 25%; text-align: center;"> {{ $form->written_at }}
        </span>
        <div>
            <span>วันที่</span><span class="dotted-line" style="width: 5%; text-align: center;"> {{$day}}
            </span><span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center;"> {{$month}}
            </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$year}}
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
        <span>เกิดวันที่</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$birthday_day}}
        </span>
        <span>เดือน</span><span class="dotted-line" style="width: 24%; text-align: center;"> {{$birthday_month}}
        </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$birthday_year}}
        </span><span>อายุ</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->age }}
        </span><span>ปี</span> <span>สัญชาติ</span><span class="dotted-line" style="width: 15%; text-align: center;">
            {{ $form->nationality }}
        </span><span>มีชื่ออยู่ในสำเนา</span>
    </div>
    <div class="box_text">
        <span>ทะเบียนบ้านเลขที่</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->house_number }}
        </span>
        <span>หมู่ที่</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->village }}
        </span>
        <span>ชุมชน</span><span class="dotted-line" style="width: 25%; text-align: center;"> {{ $form->community }}
        </span>
        <span>ตรอก/ซอย</span><span class="dotted-line" style="width: 28%; text-align: center;"> {{ $form->alley }}
        </span>
    </div>
    <div class="box_text">
        <span>ถนน</span><span class="dotted-line" style="width: 22%; text-align: center;"> {{ $form->road }}
        </span>
        <span>ตำบล</span><span class="dotted-line" style="width: 17%; text-align: center;"> {{ $form->subdistrict }}
        </span>
        <span>อำเภอ</span><span class="dotted-line" style="width: 22%; text-align: center;"> {{ $form->district }}
        </span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 21%; text-align: center;"> {{ $form->province }}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>รหัสไปรษณีย์</span><span class="dotted-line" style="width: 20%; text-align: center;"> {{ $form->postal_code }}
        </span>
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 20%; text-align: center;"> {{ $form->phone_number }}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>หมายเลขบัตรประจำตัวคนพิการ/ประชาชน ที่ยื่นคำขอ</span><span class="dotted-line" style="width: 50%; text-align: center;"> {{ $formatted_id }}
        </span>
    </div>
    <div class="box_text" style="text-align:left; margin-left:8px; line-height: 10px;">
        <span style="line-height: 10px;">ประเภทความพิการ</span>
        <div style="width: 80%; line-height: 15px;">
            <span style="float: left; width: 50%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option1' ? 'checked' : '' }}>
                ความพิการทางการเห็น
            </span>
            <span style="float: right; width: 30%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option2' ? 'checked' : '' }}>
                ความพิการทางสติปัญญา
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 50%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option3' ? 'checked' : '' }}>
                ความพิการทางการได้ยินหรือสื่อความหมาย
            </span>
            <span style="float: right; width: 30%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option4' ? 'checked' : '' }}>
                ความพิการทางการเรียนรู้
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 50%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option5' ? 'checked' : '' }}>
                ความพิการทางการเคลื่อนไหวหรือทางร่างกาย
            </span>
            <span style="float: right; width: 30%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option6' ? 'checked' : '' }}>
                ความพิการทางออทิสติก
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 50%; line-height: 15px;">
                <input type="checkbox" style="margin: 0;" {{ $form->type_of_disability == 'option7' ? 'checked' : '' }}>
                ความพิการทางการจิตใจหรือพฤติกรรม
            </span>
            <div style="clear: both;"></div>
        </div>

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
            <span><input type="checkbox" {{ $form->marital_status == 'other' ? 'checked' : '' }}> อื่นๆ</span>
            {{-- <span class="dotted-line" style="width: 21%; text-align: center;"> --}}
            </span>
        </div>
    </div>
    <div class="box_text" style=" margin-left:7px;">
        <span>รายได้ต่อเดือน</span><span class="dotted-line" style="width: 44%; text-align: center;"> {{ $form->monthly_income }}
        </span>
        <span>อาชีพ</span><span class="dotted-line" style="width: 42%; text-align: center;"> {{ $form->occupation }}
        </span>
    </div>
    <div class="box_text" >
        <span>บุคคลอ้างอิงที่สามารถติดต่อได้</span><span class="dotted-line" style="width: 44%; text-align: center;">{{ $form->references_contacted }}</span>
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 30%; text-align: center;">{{ $form->references_phone }}</span>
    </div>

    <div class="box_text" style="text-align:left; margin-left:8px; line-height: 12px; margin-top: 5px;">
        <span style="line-height: 10px;">ข้อมูลทั่วไป : สถานภาพการรับสวัสดิการภาครัฐ</span>
        <div style="width: 80%;">
            <span style="float: left; width: 30%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option1', $form->disabilityOptions->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ไม่ได้รับเบี้ยยังชีพผู้สูงอายุ
            </span>
            <span style="float: right; width: 50%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option2', $form->disabilityOptions->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ได้รับเงินสงเคราะห์เพื่อการยังชีพผู้ป่วยเอดส์
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 30%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option3', $form->disabilityOptions->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ได้รับเงินเบี้ยความพิการ
            </span>
            <span style="float: right; width: 50%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ in_array('option4', $form->disabilityOptions->first()->welfare_type ?? []) ? 'checked' : '' }}>
                ย้ายภูมิลำเนาเข้ามาอยู่ใหม่ เมื่อ
            </span>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div class="box_text" style="text-align:left; margin-left:8px; line-height: 12px; margin-top: 5px;">
        <span style="line-height: 10px;">มีความประสงค์ขอรับเงินเบี้ยยังชีพความพิการ โดยวิธีดังต่อไปนี้ (เลือก 1
            วิธี)</span>
        <div style="width: 100%;">
            <span style="float: left; width: 40%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->disabilityOptions->first()->request_for_money_type == 'option1' ? 'checked' : '' }}>
                รับเงินสดด้วยตนเอง
            </span>
            <span style="float: right; width: 60%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->disabilityOptions->first()->request_for_money_type == 'option2' ? 'checked' : '' }}>
                รับเงินสดโดยบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ/ผู้ดูแล
            </span>
            <div style="clear: both;"></div>

            <span style="float: left; width: 100%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->disabilityOptions->first()->request_for_money_type == 'option3' ? 'checked' : '' }}>
                โอนเข้าบัญชีเงินฝากธนาคารในนามผู้มีสิทธิ
            </span>
            {{-- <div style="clear: both;"></div> --}}

            <span style="float: right; width: 60%; line-height: 0.9;">
                <input type="checkbox" style="margin: 0;" {{ $form->disabilityOptions->first()->request_for_money_type == 'option4' ? 'checked' : '' }}>
                โอนเข้าบัญชีเงินฝากธนาคารในนามบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ/ผู้ดูแล
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
                </span>
                <div style="clear: both;"></div>

                <span style="float: left; width: 100%; line-height: 0.9;">
                    <input type="checkbox" style="margin: 0;" {{ in_array('option4', $documentType) ? 'checked' : '' }}>
                    หนังสือมอบอำนาจพร้อมบัตรประจำตัวประชาชนของผู้มอบอำนาจและผู้รับมอบอำนาจ
                </span>

                <div style="clear: both;"></div>
                <span style="float: left; width: 20%; line-height: 0.9;"><input type="checkbox" style="margin: 0;" {{ old('bank_option', $form->disabilityBankAccounts->first()->bank_option ?? '') == '1' ? 'checked' : '' }}>
                    บัญชีเงินฝากธนาคาร</span>
                <span class="dotted-line" style="width: 80%; text-align: left;">
                    {{ $form->disabilityBankAccounts->first()->bank_name ?? '-' }} </span>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
    <div class="box_text" style="text-align:right;">
        <span>บัญชีเลขที่</span><span class="dotted-line" style="width: 30%; text-align: center;"> {{ $form->disabilityBankAccounts->first()->account_number ?? '-' }}
        </span>
        <span>ชื่อบัญชี</span><span class="dotted-line" style="width: 43%; text-align: center;"> {{ $form->disabilityBankAccounts->first()->account_name ?? '-' }}
        </span>
    </div>

    {{-- <div class="box_text" style="text-align:left; margin-left:10px; line-height: 12px;">
        <div style="width: 100%;">
            <span style="width: 100%; "><input type="checkbox" style="margin-left: 5rem;">
                "ข้าพเจ้าขอรับรองว่าข้าพเจ้าเป็นผู้มีคุณสมบัติครบถ้วน และข้อความดังกล่าวข้างต้นเป็นความจริงทุกประการ
                หากข้อความและเอกสารที่ยื่นเรื่องนี้เป็นเท็จ ข้าพเจ้ายินยอมให้ดำเนินการตามกฎหมาย"</span>
            <span style="width: 100%; "><input type="checkbox" style="margin-left: 5rem;">
                "ข้าพเจ้ายินยอมให้นำข้อมูลส่วนบุคคลเข้าสู่ระบบคอมพิวเตอร์ของกรมส่งเสริมการปกครองท้องถิ่น และยินยอมให้
                ตรวจสอบข้อมูลกับฐานข้อมูลทะเบียนกลางภาครัฐ"
            </span>
        </div>
    </div> --}}
    <div class="box_text" style="text-align:left; margin-left:10px; line-height: 12px;">
        <div style="width: 100%;">
            <span style="width: 100%; "><input type="checkbox" style="margin-left: 5rem;">
                "ข้าพเจ้าขอรับรองว่าข้าพเจ้าเป็นผู้มีคุณสมบัติครบถ้วน และข้อความดังกล่าวข้างต้นเป็นความจริงทุกประการหากข้อความและเอกสารที่ยื่น
                เรื่องนี้เป็นเท็จ ข้าพเจ้ายินยอมให้ดำเนินการตามกฎหมาย"</span>
            <span style="width: 100%; "><input type="checkbox" style="margin-left: 5rem;">
                "ข้าพเจ้ายินยอมให้นำข้อมูลส่วนบุคคลเข้าสู่ระบบคอมพิวเตอร์ของกรมส่งเสริมการปกครองท้องถิ่น และยินยอมให้ตรวจสอบข้อมูลกับฐานข้อมูล
               ทะเบียนกลางภาครัฐ"
            </span>
        </div>
    </div>
    <div class="box_text" style="margin-top: 5px;">
        <div>
            <!-- ฝั่งซ้าย -->
            <div style="float: left; width: 48%;">
                <span>(ลงชื่อ)</span>
                <span class="dotted-line" style="width: 48%; text-align: center;"> {{ $form->first_name }}&nbsp;{{ $form->last_name }} </span>
                <div style="margin-left: 40px;">
                    <span>(</span>
                    <span class="dotted-line" style="width: 70%; text-align: center;"> {{ $form->salutation }}{{ $form->first_name }}&nbsp;{{ $form->last_name }} </span>
                    <span>)</span>
                </div>
                <div style="margin-left: 40px;">
                    <span>ผู้ยื่นคำขอ/ผู้รับมอบอำนาจยื่นคำขอ</span>
                </div>
            </div> <!-- ฝั่งขวา -->
            <div style="float: right; width: 48%;">
                <span>(ลงชื่อ)</span>
                <span class="dotted-line" style="width: 48%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                <div style="margin-left: 40px;">
                    <span>(</span>
                    <span class="dotted-line" style="width: 48%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                    <span>)</span>
                </div>
                <div>
                    <span>ตำแหน่ง</span>
                    <span class="dotted-line" style="width:48%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                </div>
                <div style="margin-left: 40px;">
                    <span>เจ้าหน้าที่ผู้รับลงทะเบียน</span>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    {{-- new page --}}
    <div style="page-break-before: always;"></div>

    <div style="text-align: center">
        - 2 -
    </div>

    <div class="box_text_border" style=" text-align:left; padding-left:5px; border-right: 2px solid black;">
        <div style="border-bottom:2px solid black;">
            <div id="left" style="float: left; width: 49%; ">
                <div>ความเห็นเจ้าหน้าที่ผู้รับลงทะเบียน</div>
                <div>เรียน คณะกรรมการตรวจสอบคุณสมบัติ</div>
                <div style="text-align:center;">ได้ตรวจสอบคุณสมบัติของ </div>
                <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 10px; border-bottom: 2px dotted black;">{{ $form->salutation }}{{ $form->first_name }}&nbsp;{{ $form->last_name }}</span>
                <div>หมายเลขบัตรประจำตัวประชาชน</div>
                <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 10px; border-bottom: 2px dotted black;">{{ $formatted_id }}</span>
                <div class="box_text" style="text-align:left; margin-top: 10px;">
                    <div style="width: 100%;">
                        <span style="width: 100%; "><input type="checkbox"> เป็นผู้มีคุณสมบัติครบถ้วน</span>
                        <span style="width: 100%; "><input type="checkbox"> เป็นผู้ที่ขาดคุณสมบัติ เนื่องจาก</span>
                    </div>
                </div>
                <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 10px; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                <span class="dotted-line" style="width: 100%; text-align: center; margin-top: 10px; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                <div style=" width: 100%; text-align: center; margin-top:20px">
                    <span>(ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 70%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                    <div style="margin-left: 40px;">
                        <span>(</span>
                        <span class="dotted-line" style="width: 70%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                        <span>)</span>
                    </div>
                    <div style="margin-left: 55px; margin-top: 20px;">
                        <span>เจ้าหน้าที่ผู้รับลงทะเบียน</span>
                    </div>
                </div>
            </div>

            <div id="right" style="float: right; width: 49%;  height: 42%; padding-left: 9px; border-left: 2px solid black;">
                <div>ความเห็นคณะกรรมการตรวจสอบคุณสมบัติ</div>
                <div style="margin-top: 10px;">เรียน นายก เทศมนตรี/อบต.<span class="dotted-line" style="width: 100%; text-align: center; margin-top: 20px; border-bottom: 2px dotted black; "> </span></div>
                <div style="text-align: center; margin-top: 5px;">คณะกรรมการตรวจสอบคุณสมบัติได้ตรวจสอบแล้ว</div>
                <div style="text-align: left; margin-top: 10px;">มีความเห็นดังนี้</div>
                <div class="box_text" style="text-align:left; margin-top: 10px;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: left; width: 50%;">
                                <label style="display: flex; align-items: center;">
                                    <input type="checkbox" style="margin-right: 5px;"> สมควรรับลงทะเบียน
                                </label>
                            </td>
                            <td style="text-align: left; width: 50%;">
                                <label style="display: flex; align-items: center;">
                                    <input type="checkbox" style="margin-right: 5px;"> ไม่สมควรรับลงทะเบียน
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style=" width: 100%;">
                    <span>กรรมการ (ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 60%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                    <div style="margin-left: 90px;">
                        <span>(</span>
                        <span class="dotted-line" style="width: 80%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                        <span>)</span>
                    </div>
                    <span>กรรมการ (ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 60%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                    <div style="margin-left: 90px;">
                        <span>(</span>
                        <span class="dotted-line" style="width: 80%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                        <span>)</span>
                    </div>
                    <span>กรรมการ (ลงชื่อ)</span>
                    <span class="dotted-line" style="width: 60%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                    <div style="margin-left: 90px;">
                        <span>(</span>
                        <span class="dotted-line" style="width: 80%; text-align: center; border-bottom: 2px dotted black; margin-top:20px;"> </span>
                        <span>)</span>
                    </div>
                </div>
            </div>

            <div style="clear: both;"></div> <!-- ใช้ clear เพื่อยกเลิกการ float -->
        </div>
        <div>
            <div>
                คำสั่ง
            </div>
            <div style="text-align: center;"><input type="checkbox" style="margin-right: 2px;">รับลงทะเบียน <input type="checkbox" style="margin-right: 2px;">ไม่รับลงทะเบียน <input type="checkbox" style="margin-right: 2px;">อื่น ๆ<span class="dotted-line"
                style="width: 30%; text-align: center; margin-top:15px; border-bottom: 2px dotted black; margin-top:20px;">
            </span></div>
            <span class="dotted-line" style="width: 95%; text-align: center; margin-top:10px; border-bottom: 2px dotted black; margin-top:20px;"> </span>
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

    <div style="margin-top: 1rem; text-align:center; padding-left:5px;">
        <div style="font-size: 18px;">
            ตัดตามรอยเส้นประ ให้ผู้พิการที่ยื่นคำขอลงทะเบียนเก็บไว้
        </div>
        <span class="dotted-line" style="width: 100%; text-align: center; display: block; border-bottom: 2px dotted black; margin-top: 5px;"></span>
    </div>

    <div class="box_text" style="margin-top: 3rem;">
        <span>ยื่นแบบคำขอลงทะเบียนเมื่อวันที่</span><span class="dotted-line" style="width: 20%; text-align: center; border-bottom: 2px dotted black;">

        </span>
        <span>เดือน</span><span class="dotted-line" style="width: 25%; text-align: center; border-bottom: 2px dotted black;">
        </span><span>พ.ศ.</span><span class="dotted-line" style="width: 20%; text-align: center; border-bottom: 2px dotted black;">
    </div>
    <div class="box_text" style="margin-left: 3rem;">
        <span>การลงทะเบียนครั้งนี้ เพื่อขอรับเงินเบี้ยความพิการ ประจำปีงบประมาณ พ.ศ.</span><span class="dotted-line" style="width: 25%; text-align: center; border-bottom: 2px dotted black;">

        </span>
        <span>โดยจะได้รับ</span>
    </div>
    <div class="box_text">
        <span>เงินเบี้ยความพิการตั้งแต่เดือน</span><span class="dotted-line" style="width: 16%; text-align: center; border-bottom: 2px dotted black;">

        </span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 16%; text-align: center; border-bottom: 2px dotted black;">
        </span><span>ในอัตราเดือนละ </span><span class="dotted-line" style="width: 16%; text-align: center; border-bottom: 2px dotted black;">
        </span><span>บาท ภายในวันที่ 10 ของทุกเดือน</span>
    </div>
    <div class="box_text">
        <span>กรณีคนพิการย้ายภูมิลำเนาไปอยู่ที่อื่น จะต้องไปลงทะเบียนยื่นคำขอรับเงินเบี้ยความพิการ ณ
            ที่องค์กรปกครองส่วนท้องถิ่นแห่งใหม่โดย
        </span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ทันที ทั้งนี้เพื่อเป็นการรักษาสิทธิให้ต่อเนื่อง
        </span>
    </div>
</body>

</html>

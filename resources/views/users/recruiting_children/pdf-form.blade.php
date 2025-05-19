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
            font-size: 18px;
            margin: 0;
            padding: 0;
            line-height: 1;
        }

        .regis_number {
            text-align: right;
            margin-right: 8px;
        }

        .title_doc {
            font-family: 'sarabun-bold', sans-serif;
            /* ใช้ฟอนต์ sarabun-bold */
            font-size: 30px;
            font-weight: bold;
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
    $date = Carbon::parse($form->created_at);
    $day = $date->day;
    $month = $date->locale('th')->translatedFormat('F');
    $year = $date->year + 543;

    $birthday = Carbon::parse($form->birthday);
    $birthday_day = $birthday->day;
    $birthday_month = $birthday->locale('th')->translatedFormat('F');
    $birthday_year = $birthday->year + 543;

    $age_since_date = Carbon::parse($form->age_since_date);
    $age_since_date_day = $age_since_date->day;
    $age_since_date_month = $age_since_date->locale('th')->translatedFormat('F');
    $age_since_date_year = $age_since_date->year + 543;

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


    <div class="title_doc" style="text-align:center;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/logo.png'))) }}" alt="Logo" style="width: 120px; height: 120px;">
        <div>
            ใบสมัคร
        </div>
        ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร
    </div>
    <div class="regis_number" style="margin-top:2rem;">เขียนที่ ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร
    </div>
    <div class="box_text" style="text-align: right;">
        <span>วันที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center;"> {{ $day }} </span>
        <span>เดือน</span>
        <span class="dotted-line" style="width: 20%; text-align: center;"> {{ $month }} </span>
        <span>พ.ศ.</span>
        <span class="dotted-line" style="width: 15%; text-align: center;"> {{ $year }} </span>
    </div>
    <div style="text-align: left; display: inline-block; border-bottom: 2px solid black; font-size:25px; font-weight: bold; font-family: 'sarabun-bold', sans-serif;">
        ข้อมูลเด็ก
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>๑. เด็กชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 38%; text-align: center;"> {{ $form->full_name }} </span>
        <span>เชื้อชาติ</span>
        <span class="dotted-line" style="width: 17%; text-align: center;"> {{ $form->ethnicity }} </span>
        <span>สัญชาติ</span>
        <span class="dotted-line" style="width: 17%; text-align: center;"> {{ $form->nationality }} </span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>๒. เกิดวันที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center;"> {{ $birthday_day }} </span>
        <span>เดือน</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $birthday_month }} </span>
        <span>พ.ศ.</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $birthday_year }} </span>
        <span>อายุ</span>
        <span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->age }} </span>
        <span>ปี</span>
        <span class="dotted-line" style="width: 10%; text-align: center;"> {{ $form->age_months }} </span>
        <span>เดือน</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>(นับถึงวันที่ 16 พฤษภาคม พ.ศ.2568 )
            เลขประจำตัวประชาชน</span>
        <span class="dotted-line" style="width: 50%; text-align: center;"> {{ $formatted_id }} </span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>๓. ที่อยู่ตามสำเนาทะเบียนบ้าน บ้านเลขที่</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $form->regis_house_number }} </span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $form->regis_village }} </span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $form->regis_road }} </span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ตำบล</span>
        <span class="dotted-line" style="width: 27%; text-align: center;"> {{ $form->regis_subdistrict }} </span>
        <span>อำเภอ</span>
        <span class="dotted-line" style="width: 27%; text-align: center;"> {{ $form->regis_district }} </span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 27%; text-align: center;"> {{ $form->regis_province }} </span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>๔. ที่อยู่อาศัยจริงในปัจจุบัน บ้านเลขที่</span>
        <span class="dotted-line" style="width: 22%; text-align: center;"> {{ $form->current_house_number }} </span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $form->current_village }} </span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 19%; text-align: center;"> {{ $form->current_road }} </span>
    </div>
    <div class="box_text" style="text-align: left; ">
        <span>ตำบล</span>
        <span class="dotted-line" style="width: 27%; text-align: center;"> {{ $form->current_subdistrict }} </span>
        <span>อำเภอ</span>
        <span class="dotted-line" style="width: 27%; text-align: center;"> {{ $form->current_district }} </span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 27%; text-align: center;"> {{ $form->current_province }} </span>
    </div>
    <div class="box_text" style="text-align: left; ">
        <span>เบอร์โทรศัพท์</span>
        <span class="dotted-line" style="width: 88%; text-align: center;"> {{ $form->current_phone_number }} </span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>มีพี่น้องร่วมบิดา - มารดาเดียวกันจำนวน</span>
        <span class="dotted-line" style="width: 26%; text-align: center;"> {{ $form->number_of_siblings }} </span>
        <span>คน เป็นบุตรลำดับที่</span>
        <span class="dotted-line" style="width: 26%; text-align: center;"> {{ $form->the_child_number }} </span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>๕. โรคประจำตัว</span>
        <span class="dotted-line" style="width: 50%; text-align: center;"> {{ $form->congenital_disease }} </span>
        <span>หมู่โลหิต</span>
        <span class="dotted-line" style="width: 28%; text-align: center;"> {{ $form->blood_group }} </span>
    </div>
    <div style="text-align: left; display: inline-block; border-bottom: 2px solid black; font-size:25px; font-weight: bold; font-family: 'sarabun-bold', sans-serif;">
        ข้อมูลบิดา - มารดา หรือผู้อุปการะ
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>๑. บิดาชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">
            {{ $form->caregiverInformation->first()->father_name }} </span>
        <span>อาชีพ</span>
        <span class="dotted-line" style="width: 17%; text-align: center;">
            {{ $form->caregiverInformation->first()->father_occupation }} </span>
        <span>วุฒิการศึกษา</span>
        <span class="dotted-line" style="width: 17%; text-align: center;">
            {{ $form->caregiverInformation->first()->edu_qual_father }} </span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span> มารดาชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">
            {{ $form->caregiverInformation->first()->mother_name }} </span>
        <span>อาชีพ</span>
        <span class="dotted-line" style="width: 17%; text-align: center;">
            {{ $form->caregiverInformation->first()->mother_occupation }} </span>
        <span>วุฒิการศึกษา</span>
        <span class="dotted-line" style="width: 17%; text-align: center;">
            {{ $form->caregiverInformation->first()->edu_qual_mother }} </span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span> ๒. ปัจจุบันเด็กอยู่ในความดูแลอุปการะ/รับผิดชอบของ</span>
        <div style="text-align:left; margin-left:20px;">
            <span> ๒.๑</span>
            <span style="margin-left: 10px;"><input type="checkbox" {{ $form->caregiverInformation->first()->care_option == 'father' ? 'checked' : '' }}> บิดา</span>
            <span style="margin-left: 80px;"><input type="checkbox" {{ $form->caregiverInformation->first()->care_option == 'mother' ? 'checked' : '' }}> มารดา</span>
            <span style="margin-left: 80px;"><input type="checkbox" {{ $form->caregiverInformation->first()->care_option == 'fatherAdmother' ? 'checked' : '' }}>
                ทั้งบิดา - มารดาร่วมกัน</span>
        </div>
        <div style="text-align:left; margin-left:20px;">
            <span> ๒.๒</span>
            <span style="margin-left: 10px;"><input type="checkbox"> ญาติ (โปรดระบุความเกี่ยวข้อง)</span>
            <span class="dotted-line" style="width: 65%; text-align: center;">{{ $form->caregiverInformation->first()->care_option_relative }}</span>
        </div>
        <div style="text-align:left; margin-left:20px;">
            <span> ๒.๓</span>
            <span style="margin-left: 10px;"><input type="checkbox" {{ $form->caregiverInformation->first()->care_option == 'Other' ? 'checked' : '' }}> อื่น ๆ
                (โปรดระบุความเกี่ยวข้อง)</span>
            <span class="dotted-line" style="width: 64%; text-align: center;">
                {{ $form->caregiverInformation->first()->care_option_other }} </span>
        </div>
    </div>
    {{-- new page --}}
    <div style="page-break-before: always;"></div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span> ๓. ผู้ดูแลอุปการะเด็กตามข้อ ๑. มีรายได้ในครอบครัวต่อเดือน</span>
        <span class="dotted-line" style="width: 49%; text-align: center;">
            {{ $form->caregiverInformation->first()->caretaker_income }} </span>
        <span>บาท</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span> ๔. ผู้นำเด็กมาสมัครชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 39%; text-align: center;">
            {{ $form->caregiverInformation->first()->applicants_name }} </span>
        <span>เกี่ยวข้องเป็น</span>
        <span class="dotted-line" style="width: 20%; text-align: center;">
            {{ $form->caregiverInformation->first()->applicants_relevant }} </span>
        <span>ของเด็ก</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span> ๕. ผู้ที่จะรับส่งเด็กชื่อ - สกุล</span>
        <span class="dotted-line" style="width:78%; text-align: center;">
            {{ $form->caregiverInformation->first()->child_carrier_name }} </span>
        <div>
            <span> โดยเกี่ยวข้องเป็น</span>
            <span class="dotted-line" style="width:35%; text-align: center;">
                {{ $form->caregiverInformation->first()->child_carrier_relevant }} </span>
            <span> เบอร์โทรศัพท์ติดต่อ</span>
            <span class="dotted-line" style="width:35%; text-align: center;">
                {{ $form->caregiverInformation->first()->child_carrier_phone }} </span>
        </div>
    </div>
    <div style="text-align: left; display: inline-block; border-bottom: 2px solid black; margin-top:5rem; font-size:25px; font-weight: bold; font-family: 'sarabun-bold', sans-serif;">
        คำรับรอง
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px; ">
        <div style="margin-left: 2rem;"> ๑. ข้าพเจ้าขอรับรองว่า
            ได้อ่านประกาศรับสมัครของศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบล
            คลองบ้านโพธิ์เข้าใจแล้วเด็ก </div>
        <span> ที่นำมาสมัครมีคุณสมบัติถูกต้องตรงตามประกาศ และหลักฐานที่ใช้สมัครใน
            วันนี้เป็นหลักฐานที่ถูกต้องจริง</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px; ">
        <div style="margin-left: 2rem;"> ๒.
            ข้าพเจ้ามีสิทธิถูกต้องในการที่จะให้เด็กสมัครเข้ารับการศึกษาเลี้ยงดูในศูนย์พัฒนาเด็กเล็กขององค์การบริหารส่วนตำบล
        </div>
        <span>คลองบ้านโพธิ์</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px; ">
        <div style="margin-left: 2rem;"> ๓. ข้าพเจ้ายินดีปฏิบัติตามระเบียบ
            ข้อกำหนดขององค์การบริหารส่วนตำบลคลองอุดมชลจร และยินดี
            ปฏิบัติคำแนะนำเกี่ยวกับ
        </div>
        <span>การพัฒนาความพร้อมที่ศูนย์พัฒนาเด็กเล็กฯ กำหนด</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:8rem;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">
            {{ $form->caregiverInformation->first()->applicants_name }} </span>
        <span>ผู้นำเด็กมาสมัคร</span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 35%; text-align: center;">
                {{ $form->caregiverInformation->first()->applicants_name }} </span>
            <span>)</span>
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <div class="title_doc" style="text-align:center;">
        <div>
            ใบมอบตัว
        </div>
        <div>
            ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร
        </div>
        <div>
            องค์การบริหารส่วนตำบลคลองอุดมชลจร อำเภอขลุง จังหวัดจันทบุรี
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 1rem; ">
        <div style="margin-left: 2rem;"> ข้าพเจ้า <span class="dotted-line" style="width: 61%; text-align: center; margin-top:5px;">{{ $form->surrenderTheChild->first()->salutation }}&nbsp;{{ $form->surrenderTheChild->first()->full_name }}</span> อายุ
            <span class="dotted-line" style="width: 25%; text-align: center; margin-top:5px;"> {{ $form->surrenderTheChild->first()->age }}</span> ปี
        </div>
        <div> อาชีพ <span class="dotted-line" style="width: 20%; text-align: center; margin-top:5px;"> {{ $form->surrenderTheChild->first()->occupation }} </span> รายได้
            <span class="dotted-line" style="width: 15%; text-align: center; margin-top:20px;"> {{ $form->surrenderTheChild->first()->income }} </span> บาท/เดือน
            ที่อยู่ปัจจุบัน เลขที่ <span class="dotted-line" style="width: 11%; text-align: center; margin-top:5px;">{{ $form->surrenderTheChild->first()->hour_number }} </span> หมู่ที่ <span class="dotted-line" style="width: 11%; text-align: center; margin-top:20px;">{{ $form->surrenderTheChild->first()->village }}
        </div>
        <div> ถนน/ตรอก/ซอย <span class="dotted-line" style="width: 30%; text-align: center; margin-top:5px;">{{ $form->surrenderTheChild->first()->alley_road }} </span>
            ตำบล
            <span class="dotted-line" style="width: 22%; text-align: center; margin-top:5px;"> {{ $form->surrenderTheChild->first()->subdistrict }} </span> อำเภอ <span class="dotted-line" style="width: 21%; text-align: center; margin-top:20px;"> {{ $form->surrenderTheChild->first()->district }}</span>
        </div>
        <div> จังหวัด <span class="dotted-line" style="width: 20%; text-align: center; margin-top:5px;"> {{ $form->surrenderTheChild->first()->province }} </span>
            โทรศัพท์
            <span class="dotted-line" style="width: 20%; text-align: center; margin-top:5px;">{{ $form->surrenderTheChild->first()->phone_number }} </span>
            เป็นผู้ปกครองของ<span style="width: 30%; text-align: center; margin-top:5px;"></span>
        </div>
        <div> {{$form->surrenderTheChild->first()->child_surrender_salutation1}} <span class="dotted-line" style="width: 65%; text-align: left; margin-top:20px;">{{ $form->surrenderTheChild->first()->childs_name }}
            </span> เข้าเป็นนักเรียนของศูนย์
            <div>พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร และพร้อมที่จะปฏิบัติตามระเบียบการของศูนย์</div>
            <div>พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร ดังนี้</div>
        </div>
        <div style="margin-left: 2rem;"> 1. จะปฏิบัติตามระเบียบ
            ข้อบังคับของศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร อย่างเคร่งครัด
        </div>
        <div style="margin-left: 2rem;"> 2. จะร่วมมือกับศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร
            ในการจัดการเรียนการสอนและขจัดปัญหาต่างๆ
        </div>
        <div>ที่อาจเกิดขึ้นแก่เด็กอย่างใกล้ชิด</div>
        <div style="margin-left: 2rem;">สถานที่ที่สามารถติดต่อกับผู้ปกครองได้สะดวกรวดเร็วที่สุด</div>
        <div><span class="dotted-line" style="width: 40%; text-align: center; margin-top:5px;">{{ $form->surrenderTheChild->first()->contact_location }} </span></div>
        <div>โทรศัพท์<span class="dotted-line" style="width: 40%; text-align: center; margin-top:10px;">{{ $form->surrenderTheChild->first()->contact_phone }} </span></div>
        <div style="margin-left: 2rem;">อนึ่ง ถ้า{{ $form->surrenderTheChild->first()->child_recipient_salutation }} <span class="dotted-line" style="width: 73%; text-align: center; margin-top:20px;"> {{ $form->surrenderTheChild->first()->child_recipient }} </span>เจ็บป่วย </div>
        <div>จำเป็นต้องรีบส่งโรงพยาบาลหรือพบแพทย์ทันที ข้าพเจ้าอนุญาตให้ศูนย์พัฒนาเด็กเล็กจัดการไปตามความเห็นชอบก่อน
            และแจ้งให้ข้าพ
        </div>
        <div>เจ้าทราบโดยข้าพเจ้าขอรับผิดชอบค่าใช้จ่ายที่เกิดขึ้น</div>
    </div>
    <div style="text-align: left; display: inline-block; border-bottom: 2px solid black; margin-top:1rem; font-size:25px; font-weight: bold; font-family: 'sarabun-bold', sans-serif;">
        ผู้รับส่งเด็ก
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <div style="padding-bottom: -4px;">
            ชื่อ-สกุล
            <span class="dotted-line" style="width: 82%; text-align: center;">
                {{ $form->surrenderTheChild->first()->child_recipient_relevant }}
            </span>
            โดยเกี่ยวข้องเป็น
            <span class="dotted-line" style="width: 85%; text-align: center;">
                {{ $form->surrenderTheChild->first()->child_recipient_related }}
            </span>
            เบอร์โทรศัพท์ติดต่อ
            <span class="dotted-line" style="width: 83%; text-align: center;">
                {{ $form->surrenderTheChild->first()->child_recipient_phone }}
            </span>
        </div>
    </div>


    <div class="box_text" style="text-align: right; margin-top:2rem;">
        <span>ลงชื่อผู้ปกครอง</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">
            {{ $form->surrenderTheChild->first()->full_name }} </span>
    </div>
    <div class="box_text" style="text-align: right;">
        <span>ลงชื่อผู้รับมอบตัว</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">
        </span>
    </div>
    <div class="box_text" style="text-align: right;">
        <span>วันที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center;"> </span>
        <span>เดือน</span>
        <span class="dotted-line" style="width: 15%; text-align: center;"> </span>
        <span>พ.ศ.</span>
        <span class="dotted-line" style="width: 15%; text-align: center;"> </span>
    </div>
    {{-- new page --}}
    <div style="page-break-before: always;"></div>
    <div class="title_doc" style="text-align:center;">
        <div>
            ทะเบียนประวัติเด็กปฐมวัย
        </div>
        <div>
            ศูนย์พัฒนาเด็กเล็กองค์การบริหารส่วนตำบลคลองอุดมชลจร
        </div>
        <div>
            องค์การบริหารส่วนตำบลคลองอุดมชลจร อำเภอขลุง จังหวัดจันทบุรี
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 5px;">
        <span>ชื่อ-สกุล เด็ก</span>
        <span class="dotted-line" style="width: 50%; text-align: center;">{{ $form->surrenderTheChild->first()->child_salutation }}&nbsp;{{ $form->childRegistration->first()->child_name }} </span>
        <span>ชื่อเล่น</span>
        <span class="dotted-line" style="width: 29%; text-align: center;"> {{ $form->childRegistration->first()->child_nickname }} </span>
    </div>
    @php
    $formatted_citizen_id =
    substr($form->childRegistration->first()->citizen_id, 0, 1) .
    '-' .
    substr($form->childRegistration->first()->citizen_id, 1, 4) .
    '-' .
    substr($form->childRegistration->first()->citizen_id, 5, 5) .
    '-' .
    substr($form->childRegistration->first()->citizen_id, 10, 2) .
    '-' .
    substr($form->childRegistration->first()->citizen_id, 12, 1);

    @endphp
    <div class="box_text" style="text-align: left;">
        <span>เลขประจำตัวประชาชน</span>
        <span class="dotted-line" style="width: 81%; text-align: center;"> {{ $formatted_citizen_id }} </span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>วัน เดือน ปี เกิด</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"> {{ \Carbon\Carbon::parse($form->childRegistration->first()->birthday)
                ->locale('th')
                ->translatedFormat('j F ') . ( \Carbon\Carbon::parse($form->childRegistration->first()->birthday)->year + 543) }}
        </span>
        <span>จังหวัดที่เกิด</span>
        <span class="dotted-line" style="width: 46%; text-align: center;">{{ $form->childRegistration->first()->birth_province }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เชื้อชาติ</span>
        <span class="dotted-line" style="width: 24%; text-align: center;">{{ $form->childRegistration->first()->ethnicity }}</span>
        <span>สัญชาติ</span>
        <span class="dotted-line" style="width: 30%; text-align: center;">{{ $form->childRegistration->first()->nationality }}</span>
        <span>ศาสนา</span>
        <span class="dotted-line" style="width: 25%; text-align: center;">{{ $form->childRegistration->first()->religion }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ที่อยู่ปัจจุบันเลขที่</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{ $form->childRegistration->first()->house_number }}</span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{ $form->childRegistration->first()->village }}</span>
        <span>ซอย</span>
        <span class="dotted-line" style="width: 15%; text-align: center;"> {{ $form->childRegistration->first()->alley }} </span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 26%; text-align: center;">{{ $form->childRegistration->first()->alley_road }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ตำบล</span>
        <span class="dotted-line" style="width: 27%; text-align: center;">{{ $form->childRegistration->first()->subdistrict }}</span>
        <span>อำเภอ</span>
        <span class="dotted-line" style="width: 27%; text-align: center;">{{ $form->childRegistration->first()->district }}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 27%; text-align: center;">{{ $form->childRegistration->first()->province }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>สุขภาพโดยรวมของเด็ก</span>
        <span style="margin-left: 20px;">
            <input type="checkbox" {{ $form->childRegistration->first()->health_option == 'option_1' ? 'checked' : '' }}>
            สมบูรณ์
        </span>
        <span style="margin-left: 20px;">
            <input type="checkbox" {{ $form->childRegistration->first()->health_option == 'option_2' ? 'checked' : '' }}>
            ไม่สมบูรณ์ คือ
        </span>
        <span class="dotted-line" style="width: 49%; text-align: center;">{{$form->childRegistration->first()->health_option_detail}}</span>
    </div>

    <div class="box_text" style="text-align: left;">
        <span>กลุ่มเลือด</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->blood_group == 'option_1' ? 'checked' : '' }}> เอ</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->blood_group == 'option_2' ? 'checked' : '' }}> บี</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->blood_group == 'option_3' ? 'checked' : '' }}> เอบี</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->blood_group == 'option_4' ? 'checked' : '' }}> โอ</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เด็กมีโรคประจำตัว คือ</span>
        <span class="dotted-line" style="width: 32%; text-align: center;">{{$form->childRegistration->first()->congenital_disease}}</span>
        <span>เมื่อมีอาการแก้ไขโดย</span>
        <span class="dotted-line" style="width: 33%; text-align: center;">{{$form->childRegistration->first()->edited_by}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เด็กมีประวัติการแพ้ยา คือ</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">{{$form->childRegistration->first()->drug_allergy}}</span>
        <span>แพ้อาหาร คือ</span>
        <span class="dotted-line" style="width: 33%; text-align: center;">{{$form->childRegistration->first()->drug_allergy_detail}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ประวัติการได้รับอุบัติเหตุหรือเจ็บป่วย</span>
        <span class="dotted-line" style="width: 33%; text-align: center;">{{$form->childRegistration->first()->accident_history}}</span>
        <span>เมื่ออายุ</span>
        <span class="dotted-line" style="width: 30%; text-align: center;">{{$form->childRegistration->first()->accident_history_when_age}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>การได้รับภูมิคุ้มกัน</span>
        <span style="margin-left: 50px;">
            <input type="checkbox" {{ in_array('option_1', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> คอตีบ
        </span>
        <span style="margin-left: 50px;">
            <input type="checkbox" {{ in_array('option_2', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> หัดเยอรมัน
        </span>
        <span style="margin-left: 50px;">
            <input type="checkbox" {{ in_array('option_3', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> ไอกรน
        </span>
        <span style="margin-left: 50px;">
            <input type="checkbox" {{ in_array('option_4', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> บาดทะยัก
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left: 2rem;">
        <span style="margin-left: 50px;">
            <input type="checkbox" {{ in_array('option_5', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> โปลิโอ
        </span>
        <span style="margin-left: 48px;">
            <input type="checkbox" {{ in_array('option_6', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> ตับอักเสบ
        </span>
        <span style="margin-left: 46px;">
            <input type="checkbox" {{ in_array('option_7', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> บีซีจี
        </span>
        <span style="margin-left: 46px;">
            <input type="checkbox" {{ in_array('option_8', $form->childRegistration->first()->ge_immunity ?? []) ? 'checked' : '' }}> อื่นๆ
        </span>
        <span class="dotted-line" style="width: 29%; text-align: center;">{{ $form->childRegistration->first()->ge_immunity_detail }}</span>
    </div>

    <div class="box_text" style="text-align: left;">
        <div style="margin-bottom: 1rem; display: inline;">เด็กควรได้รับการดูแลเป็นพิเศษเรื่อง</div>
        <span class="dotted-line" style="width: 100%; text-align: left;">{{$form->childRegistration->first()->specially_about}}</span>
    </div>

    <div class="box_text" style="text-align: left;">
        <span>เด็กเป็นบุตรคนที่</span>
        <span class="dotted-line" style="width: 11%; text-align: center;">{{$form->childRegistration->first()->the_eldest_son}}</span>
        <span>จำนวนพี่น้องร่วมสายโลหิต</span>
        <span class="dotted-line" style="width: 10%; text-align: center;">{{$form->childRegistration->first()->number_of_siblings}}</span>
        <span>คน พี่ชาย</span><span class="dotted-line" style="width: 10%; text-align: center;">{{$form->childRegistration->first()->elder_brother}}</span><span>คน
            น้องชาย</span><span class="dotted-line" style="width: 12%; text-align: center;">{{$form->childRegistration->first()->younger_brother}}</span><span>คน</span>
        <span>พี่สาว</span><span class="dotted-line" style="width: 12%; text-align: center;">{{$form->childRegistration->first()->elder_sister}}</span><span>คน น้องสาว</span><span class="dotted-line" style="width: 12%; text-align: center;">{{$form->childRegistration->first()->younger_brother}}</span><span>คน</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top: 10px;">
        <span>บิดาชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 40%; text-align: center;">{{$form->childRegistration->first()->fathers_name}}</span>
        <span>อายุ</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{$form->childRegistration->first()->fathers_age}}</span>
        <span>ปี อาชีพ</span>
        <span class="dotted-line" style="width: 21%; text-align: center;">{{$form->childRegistration->first()->fathers_occupation}}</span>
        <span>สถานที่ทำงาน</span>
        <span class="dotted-line" style="width: 59%; text-align: center;">{{$form->childRegistration->first()->fathers_workplace}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 21%; text-align: center;">{{$form->childRegistration->first()->fathers_phone}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>มารดาชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 38%; text-align: center;">{{$form->childRegistration->first()->mother_name}}</span>
        <span>อายุ</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{$form->childRegistration->first()->mother_age}}</span>
        <span>ปี อาชีพ</span>
        <span class="dotted-line" style="width: 20%; text-align: center;">{{$form->childRegistration->first()->mother_occupation}}</span>
        <span>สถานที่ทำงาน</span>
        <span class="dotted-line" style="width: 59%; text-align: center;">{{$form->childRegistration->first()->mother_workplace}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 21%; text-align: center;">{{$form->childRegistration->first()->mother_phone}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <div>สถานภาพสมรสของบิดา/มารดา</div>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->marital_status == 'option_1' ? 'checked' : '' }}> อยู่ด้วยกัน</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->marital_status == 'option_2' ? 'checked' : '' }}> แยกกันอยู่</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->marital_status == 'option_3' ? 'checked' : '' }}> เลิกร้างกัน</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->marital_status == 'option_4' ? 'checked' : '' }}> บิดาหรือมารดาแต่งงานใหม</span>
        <span style="margin-left: 50px;"><input type="checkbox" {{ $form->childRegistration->first()->marital_status == 'option_5' ? 'checked' : '' }}> อื่นๆ</span><span class="dotted-line" style="width: 70%; text-align: center;"></span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ผู้ปกครองชื่อ - สกุล</span>
        <span class="dotted-line" style="width: 52%; text-align: center;">{{$form->childRegistration->first()->parent_name}}</span>
        <span>อายุ</span>
        <span class="dotted-line" style="width: 25%; text-align: center;">{{$form->childRegistration->first()->parent_age}}</span>
        <span>ปี </span><span>เกี่ยวข้องเป็น</span>
        <span class="dotted-line" style="width: 27%; text-align: center;">{{$form->childRegistration->first()->parent_relevant_as}}</span>
        <span>ของเด็กอาชีพ</span>
        <span class="dotted-line" style="width: 50%; text-align: center;">{{$form->childRegistration->first()->parent_occupation}}</span>
        <span>สถานที่ทำงาน</span>
        <span class="dotted-line" style="width: 50%; text-align: center;">{{$form->childRegistration->first()->parent_workplace}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 21%; text-align: center;">{{$form->childRegistration->first()->parent_phone}}</span>
    </div>

</body>

</html>

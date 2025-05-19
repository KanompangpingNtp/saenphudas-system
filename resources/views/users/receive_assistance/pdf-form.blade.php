<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แบบคำขอรับการสงเคราะห์</title>

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
            font-size: 16.5px;
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

@php
    use Carbon\Carbon;
    $date = Carbon::parse($form->write_the_date);
    $day = $date->day;
    $month = $date->locale('th')->translatedFormat('F');
    $year = $date->year + 543;

    $birthday = Carbon::parse($form->birth_day);
    $birthday_day = $birthday->day;
    $birthday_month = $birthday->locale('th')->translatedFormat('F');
    $birthday_year = $birthday->year + 543;

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

<body>
    <div class="regis_number">ทะเบียนเลขที่ .........................../ 2568</div>
    <div style="text-align: center; font-size: 25px;">แบบคำขอรับการสงเคราะห์</div>
    <div class="box_text" style="text-align: right;"><span>เขียนที่</span>
        <span class="dotted-line" style="width: 25%; text-align: center;"> {{$form->written_at}}
        </span>
        <div>
            <span>วันที่</span><span class="dotted-line" style="width: 5%; text-align: center;"> {{$day}}
            </span><span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center;"> {{$month}}
            </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$year}}
            </span>
        </div>
        <div class="box_text" style="text-align: left;">
            <span>เรียน นายยกอค์การบริหารส่วนตำบลคลองอุดมชลจร
        </div>
        <div class="box_text" style="text-align: left; margin-left: 4rem;">
            <span>ด้วยข้าพเจ้า ชื่อ</span><span class="dotted-line" style="width: 34%; text-align: center;">
                {{$form->salutation}}&nbsp;{{$form->first_name}}
            </span>
            <span>นามสกุล</span><span class="dotted-line" style="width: 34%; text-align: center;">{{$form->last_name}}
            </span>
        </div>
        <div class="box_text">
            <span>เกิดวันที่</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$birthday_day}}
            </span>
            <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center;"> {{$birthday_month}}
            </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$birthday_year}}
            </span><span>อายุ</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$form->age}}
            </span><span>ปี</span> <span>สัญชาติ</span><span class="dotted-line"
                style="width: 15%; text-align: center;">
                {{$form->nationality}}
            </span><span>มีชื่ออยู่ในสำเนา</span>
        </div>
        <div class="box_text">
            <span>ทะเบียนบ้านเลขที่</span><span class="dotted-line" style="width: 10%; text-align: center;">  {{$form->learn}}
            </span>
            <span>หมู่ที่</span><span class="dotted-line" style="width: 10%; text-align: center;"> {{$form->village}}
            </span>
            <span>ชุมชน</span><span class="dotted-line" style="width: 23%; text-align: center;">{{$form->community}}
            </span>
            <span>ตรอก/ซอย</span><span class="dotted-line" style="width: 22%; text-align: center;"> {{$form->road}}
            </span>
        </div>
        <div class="box_text">
            <span>ถนน</span><span class="dotted-line" style="width: 17%; text-align: center;"> {{$form->road}}
            </span>
            <span>ตำบล</span><span class="dotted-line" style="width: 17%; text-align: center;"> {{$form->subdistrict}}
            </span>
            <span>อำเภอ</span><span class="dotted-line" style="width: 22%; text-align: center;"> {{$form->district}}
            </span>
            <span>จังหวัด</span><span class="dotted-line" style="width: 21%; text-align: center;"> {{$form->province}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:7px;">
            <span>รหัสไปรษณีย์</span><span class="dotted-line" style="width: 20%; text-align: center;"> {{$form->postal_code}}
            </span>
            <span>โทรศัพท์</span><span class="dotted-line" style="width: 20%; text-align: center;"> {{$form->phone_number}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:7px;">
            <span>หมายเลขบัตรประจำตัวประชาชนของผู้เป็นเอดส์ที่ยื่นคำขอ</span><span class="dotted-line"
                style="width: 50%; text-align: center;"> {{$formatted_id}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:7px;">
            <span>ขอแจ้งความประสงค์ขอรับเงินสงเคราะห์เพื่อการยังชีพผู้ป่วยเอดส์ โดยขอให้รายละเอียดเพิ่มเติม
                ดังนี้</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span>1. ที่พักอาศัย</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ in_array('option_1', $form->assistImpartings->first()->accommodation ?? []) ? 'checked' : '' }}> เป็นของตนเอง และมีลักษณะ</span>
            <span><input type="checkbox" {{ in_array('option_2', $form->assistImpartings->first()->accommodation ?? []) ? 'checked' : '' }}> ชำรุดทรุดโทรม</span>
            <span><input type="checkbox" {{ in_array('option_3', $form->assistImpartings->first()->accommodation ?? []) ? 'checked' : '' }}> ชำรุดทรุดโทรมบางส่วน</span>
            <span><input type="checkbox" {{ in_array('option_4', $form->assistImpartings->first()->accommodation ?? []) ? 'checked' : '' }}> มั่นคงถาวร</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ in_array('option_5', $form->assistImpartings->first()->accommodation ?? []) ? 'checked' : '' }}> เป็นของ</span>
            <span class="dotted-line" style="width: 37%; text-align: center;"> {{$form->assistImpartings->first()->accommodation_belongs_to}}
            </span><span>เกี่ยวข้องเป็น</span><span class="dotted-line" style="width: 37%; text-align: center;"> {{$form->assistImpartings->first()->accommodation_relevant_as}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span>2. ที่พักอาศัยอยู่ห่างจากบ้านหลังที่ใกล้ที่สุดเป็นระทาง</span> </span><span
                class="dotted-line" style="width: 23%; text-align: center;"> {{$form->assistImpartings->first()->away_from_home}}
            </span><span>สามารถเดินทางได้</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ $form->assistImpartings->first()->away_from_home_option == 'option_1' ? 'checked' : '' }}> สะดวก</span>
            <span><input type="checkbox" {{ $form->assistImpartings->first()->away_from_home_option == 'option_2' ? 'checked' : '' }}> ลำบาก</span>
            <span> เนื่องจาก</span>
            <span class="dotted-line" style="width: 67%; text-align: center;"> {{$form->assistImpartings->first()->away_from_home_option_dueto}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span>อยู่ห่างจากชุมชน/หมู่บ้านเป็นระยะทาง</span><span class="dotted-line"
                style="width: 48%; text-align: center;"> {{$form->assistImpartings->first()->away_from_community}}
            </span><span>สามารถเดินทางได้</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ $form->assistImpartings->first()->away_from_community_option == 'option_1' ? 'checked' : '' }}> สะดวก</span>
            <span><input type="checkbox" {{ $form->assistImpartings->first()->away_from_community_option == 'option_2' ? 'checked' : '' }}> ลำบาก</span>
            <span> เนื่องจาก</span>
            <span class="dotted-line" style="width: 67%; text-align: center;"> {{$form->assistImpartings->first()->away_from_community_option_dueto}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span>อยู่ห่างจากหน่วยบริการของรัฐที่ใกล้ที่สุดเป็นระยะทาง</span><span class="dotted-line"
                style="width: 35%; text-align: center;"> {{$form->assistImpartings->first()->stay_away_from_agency}}
            </span><span>สามารถเดินทางได้</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ $form->assistImpartings->first()->stay_away_from_agency_option == 'option_1' ? 'checked' : '' }}> สะดวก</span>
            <span><input type="checkbox" {{ $form->assistImpartings->first()->stay_away_from_agency_option == 'option_2' ? 'checked' : '' }}> ลำบาก</span>
            <span> เนื่องจาก</span>
            <span class="dotted-line" style="width: 67%; text-align: center;"> {{$form->assistImpartings->first()->stay_away_from_agency_option_dueto}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span>3. การพักอาศัย</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ $form->assistImpartings->first()->residence == 'yes' ? 'checked' : '' }}> อยู่เพียงลำพัง</span>
            <span> เนื่องจาก</span>
            <span class="dotted-line" style="width: 31%; text-align: center;"> {{$form->assistImpartings->first()->residence_stay_alone_dueto}}
            </span>
            <span> มาประมาณ</span>
            <span class="dotted-line" style="width: 31%; text-align: center;"> {{$form->assistImpartings->first()->residence_stay_alone_dueto_detail}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span><input type="checkbox" {{ $form->assistImpartings->first()->residence_living_with == 'yes' ? 'checked' : '' }}> พักอาศัยกับ</span>
            <span class="dotted-line" style="width: 18%; text-align: center;"> {{$form->assistImpartings->first()->residence_living_with_detail}}
            </span>
            <span> รวม</span>
            <span class="dotted-line" style="width: 10%; text-align: center;"> {{$form->assistImpartings->first()->residence_living_with_quantity}}
            </span>
            <span> คน</span>
            <span> เป็นผู้สามารถประกอบอาชีพได้จำนวน</span>
            <span class="dotted-line" style="width: 10%; text-align: center;"> {{$form->assistImpartings->first()->residence_living_with_working}}
            </span>
            <span>คน</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span> มีรายได้รวม</span>
            <span class="dotted-line" style="width: 15%; text-align: center;"> {{$form->assistImpartings->first()->residence_living_with_total_income}}
            </span>
            <span> บาท/เดือน</span>
            <span> ผู้ที่ไม่สามารถประกอบอาชีพได้เนื่องจาก</span>
            <span class="dotted-line" style="width: 24%; text-align: center;"> {{$form->assistImpartings->first()->residence_living_with_non_workers}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 7rem;">
            <span>4. รายได้ – รายจ่าย</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span> มีรายได้รวม</span>
            <span class="dotted-line" style="width: 18%; text-align: center;"> {{$form->assistImpartings->first()->total_income}}
            </span>
            <span> บาท/เดือน</span>
            <span> แหล่งที่มาของรายได้</span>
            <span class="dotted-line" style="width: 41%; text-align: center;"> {{$form->assistImpartings->first()->source_of_income}}
            </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: 5rem;">
            <span> นำไปใช้จ่ายเป็นค่า</span>
            <span class="dotted-line" style="width: 83%; text-align: center;"> {{$form->assistImpartings->first()->used_for_expenses}}
            </span>
        </div>
    </div>
    {{-- new page --}}
    {{-- <div style="page-break-before: always;"></div> --}}

    {{-- <div style="text-align: center">
        - 2 -
    </div> --}}
    <div class="box_text" style="text-align: left; margin-left:7px; margin-top:1rem;">
        <span>บุคคลที่สามารถติดต่อได้</span><span class="dotted-line" style="width: 30%; text-align: center;"> {{$form->assistImpartings->first()->contact_person}}
        </span><span>สถานที่ติดต่อเลขที่</span><span class="dotted-line" style="width: 35%; text-align: center;"> {{$form->assistImpartings->first()->contact_address_number}}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>ถนน</span><span class="dotted-line" style="width: 18%; text-align: center;"> {{$form->assistImpartings->first()->contact_road}}
        </span><span>ตรอก/ซอย</span><span class="dotted-line" style="width: 18%; text-align: center;"> {{$form->assistImpartings->first()->contact_alley}}
        </span><span>หมู่ที่</span><span class="dotted-line" style="width: 18%; text-align: center;"> {{$form->assistImpartings->first()->contact_village}}
        </span><span>ตำบล</span><span class="dotted-line" style="width: 24%; text-align: center;"> {{$form->assistImpartings->first()->contact_subdistrict}}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>อำเภอ</span><span class="dotted-line" style="width: 24%; text-align: center;"> {{$form->assistImpartings->first()->contact_district}}
        </span><span>จังหวัด</span><span class="dotted-line" style="width: 24%; text-align: center;"> {{$form->assistImpartings->first()->contact_province}}
        </span><span>รหัสไปรษณีย์</span><span class="dotted-line" style="width: 30%; text-align: center;"> {{$form->assistImpartings->first()->contact_postal_code}}
        </span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:7px;">
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 24%; text-align: center;"> {{$form->assistImpartings->first()->contact_telephone}}
        </span><span>โทรสาร</span><span class="dotted-line" style="width: 24%; text-align: center;">  {{$form->assistImpartings->first()->contact_fax}}
        </span><span>เกี่ยวข้องเป็น</span><span class="dotted-line" style="width: 28%; text-align: center;"> {{$form->assistImpartings->first()->contact_relevant_as}}
        </span>
    </div>
    <div class="box_text" style="text-align: center; margin-top:5px;">
        <span>ข้าพเจ้าขอรับรองว่าถ้อยคำที่ให้ข้างต้นเป็นความจริงทุกประการ</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:5px;">
        <span class="dotted-line" style="width: 35%; text-align: center;"> {{$form->first_name}}&nbsp;{{$form->last_name}} </span>
        <span>ผู้ให้ถอยคำ</span>
        <div style="margin-right: 60px;">
            <span>(</span>
            <span class="dotted-line" style="width: 35%; text-align: center;"> {{$form->salutation}}{{$form->first_name}}&nbsp;{{$form->last_name}} </span>
            <span>)</span>
        </div>
    </div>
</body>


</html>

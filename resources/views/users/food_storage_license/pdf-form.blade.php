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
            font-size: 19.3px;
            margin: 0;
            padding: 0;
            line-height: 0.8;
        }

        .regis_number {
            text-align: right;
            margin-right: 8px;
        }

        .title_doc {
            text-align: center;
            font-weight: bold;
        }

        .box_text {
            border: 1px solid rgb(255, 255, 255);
            text-align: center;
        }

        .box_text span {
            display: inline-flex;
            line-height: 1;
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
    $created = Carbon::parse($form->created_at);
    $created_day = $created->day;
    $created_month = $created->locale('th')->translatedFormat('F');
    $created_year = $created->year + 543;
    @endphp

    <div style="width: 100%; display: table;">
        <!-- โลโก้อยู่ตรงกลาง -->
        <div style="display: table-cell; width: 75%; text-align: center; vertical-align: top;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/logo.png'))) }}"
                alt="Logo" height="120" style="margin-right: -180px;">
        </div>

        <!-- กล่องข้อความอยู่ขวาสุด -->
        <div style="display: table-cell; width: 25%; vertical-align: top; text-align: right;">
            <div class="box_text_border" style="display: inline-block;">
                <div class="box_text" style="text-align: left;">
                    <span>ลงรับเลขที่</span>
                    <span class="dotted-line" style="width: 85px;"></span> <br>
                    <span>วันที่</span>
                    <span class="dotted-line" style="width: 120px;"></span><br>
                    <span>เวลา</span>
                    <span class="dotted-line" style="width: 120px;"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="title_doc" style="text-align:center;">
        คำขอรับ ใบอนุญาต <br>
        จัดตั้งสถานที่จำหน่ายอาหาร หรือ สถานที่สะสมอาหาร
    </div>
    <div class="box_text" style="text-align: right; margin-top:1rem;">
        <span>เขียนที่</span>
        <span class="dotted-line" style="width: 32%; text-align: center; line-height: 1;">เทศบาลตำบลแสนภูดาษ </span>
    </div>
    <div class="box_text" style="text-align: right; ">
        <span>วันที่</span>
        <span class="dotted-line" style="width: 5%; text-align: center;">{{$created_day}}</span>
        <span>เดือน</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{$created_month}}</span>
        <span>พ.ศ.</span>
        <span class="dotted-line" style="width: 10%; text-align: center;">{{$created_year}}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:5rem;">
        <span>ข้าพเจ้า</span><input type="checkbox" style="margin: 0px 5px;" {{ $form->title_name == 'บุคคลธรรมดา' ? 'checked' : '' }}><span>บุคคลธรรมดา</span>
        <input type="checkbox" style="margin: 0px 5px;" {{ $form->title_name == 'นิติบุคคล' ? 'checked' : '' }}><span>นิติบุคคล ชื่อ</span>
        <span class="dotted-line" style="width: 43%; text-align: center;">{{$form->full_name}}</span>
        <span>อายุ</span>
        <span class="dotted-line" style="width: 10%; text-align: center;">{{$form->age}}</span>
        <span>ปี</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>สัญชาติ</span>
        <span class="dotted-line" style="width: 10%; text-align: center;">{{$form->nationality}}</span>
        <span>เลขบัตรประจำตัวประชาชน</span>
        <span class="dotted-line" style="width: 17%; text-align: center;">{{$form->id_card_number}}</span>
        <span>อยู่บ้าน/สำนักงานเลขที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center;">{{$form->address}}</span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center;">{{$form->village}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ตรอกซอย</span>
        <span class="dotted-line" style="width: 22%; text-align: center;">{{$form->alley}}</span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 22%; text-align: center;">{{$form->road}}</span>
        <span>ตำบล/แขวง</span>
        <span class="dotted-line" style="width: 22%; text-align: center;">{{$form->subdistrict}}</span>
        <span>อำเภอ/เขต</span>
        <span class="dotted-line" style="width: 20%; text-align: center;">{{$form->district}}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 20%; text-align: center;">{{$form->province}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 19%; text-align: center;">{{$form->telephone}}</span>
        <span>โทรสาร</span>
        <span class="dotted-line" style="width: 18%; text-align: center;">{{$form->fax}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ขอยื่นคำร้องขอรับ/ขอต่ออายุใบอนุญาตจัดตั้งสถานที่ ต่อเจ้าพนักงานท้องถิ่น</span> <br>
        <div style="margin-left:4rem;">
            <input type="checkbox" style="margin: 0px 10px;" {{ $form['details']->confirm_option == '1' ? 'checked' : '' }}><span>จัดตั้งสถานที่จำหน่ายอาหาร</span>
        <input type="checkbox" style="margin: 0px 10px;" {{ $form['details']->confirm_option == '2' ? 'checked' : '' }}><span>จัดตั้งสถานที่สะสมอาหาร</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ตามใบอนุญาติ เล่มที่</span>
        <span class="dotted-line" style="width: 12%; text-align: center;">{{$form['details']->confirm_volume}}</span>
        <span>เลขที่</span>
        <span class="dotted-line" style="width: 12%; text-align: center;">{{$form['details']->confirm_number}}</span>
        <span>ปี</span>
        <span class="dotted-line" style="width: 12%; text-align: center;">{{$form['details']->confirm_year}}</span>
        <span>ซึ่งจะหมดอายุลงในวันที่</span>
        <span class="dotted-line" style="width: 20%; text-align: center;">{{$form['details']->confirm_expiration_date}}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:5rem;">
        <span>๑. สถานที่ชื่อ</span>
        <span class="dotted-line" style="width: 40.5%; text-align: center;">{{$form['details']->place_name}}</span>
        <span>ประเภทร้าน</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">{{$form['details']->shop_type}}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:5rem;">
        <span>๒. สถานที่ตั้งเลขที่</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{$form['details']->location}}</span>
        <span>หมู่</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{$form['details']->details_village}}</span>
        <span>ตรอกซอย</span>
        <span class="dotted-line" style="width: 15%; text-align: center;">{{$form['details']->details_alley}}</span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 18%; text-align: center;">{{$form['details']->details_road}}</span>
        <span>ตำบล</span>
        <span class="dotted-line" style="width: 18%; text-align: center;">{{$form['details']->details_subdistrict}}</span>
        <span>อำเภอ</span>
        <span class="dotted-line" style="width: 16%; text-align: center;">{{$form['details']->details_district}}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 18%; text-align: center;">{{$form['details']->details_province}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 18%; text-align: center;">{{$form['details']->details_telephone}}</span>
        <span>โทรสาร</span>
        <span class="dotted-line" style="width: 32%; text-align: center;">{{$form['details']->details_fax}}</span>
        <span>พื้นที่ประกอบการ</span>
        <span class="dotted-line" style="width: 33%; text-align: center;">{{$form['details']->business_area}}</span>
        <span>ตารางเมตร</span>
        <span>จำนวนผู้ปรุง</span>
        <span class="dotted-line" style="width: 6.8%; text-align: center;">{{$form['details']->number_of_cooks}}</span>
        <span>คน ผู้เสิร์ฟ</span>
        <span class="dotted-line" style="width: 6.8%; text-align: center;">{{$form['details']->number_of_food}}</span>
        <span>คน รวมผู้สัมผัสอาหาร</span>
        <span class="dotted-line" style="width: 6.8%; text-align: center;">{{$form['details']->including_food_handlers}}</span>
        <span>คน ผ่านการอบรมแล้วจำนวน</span>
        <span class="dotted-line" style="width: 6.8%; text-align: center;">{{$form['details']->number_of_trainees}}</span>
        <span>คน</span>
        <span>เปิดประกอบการตั้งแต่เวลา</span>
        <span class="dotted-line" style="width: 16%; text-align: center;">{{$form['details']->opening_hours}}</span>
        <span>น. ถึงเวลา</span>
        <span class="dotted-line" style="width: 16%; text-align: center;">{{$form['details']->opening_for_business_until}}</span>
        <span>น. รวม</span>
        <span class="dotted-line" style="width: 16%; text-align: center;">{{$form['details']->total_hours}}</span>
        <span>ชั่วโมง/วัน</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:5rem; margin-top:-10px;">
        <span>๓. พร้อมคำร้องนี้ข้าพเจ้าได้แนบหนังสือรับรองการแจ้งเดิมและเอกสารหลักฐานต่างๆ มาด้วย คือ</span> <br>
        <div style="margin-left:0.5rem;">
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option1", $document_option ?? []) ? 'checked' : '' }}><span>สำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านเจ้าของกิจการ</span> <br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option2", $document_option ?? []) ? 'checked' : '' }}><span>สำเนาหนังสือรับรองการจดทะเบียนนิติบุคคลพร้อมสำเนาบัตรประชาชนของผู้แทนนิติบุคคล</span> <br>
            <span style="margin-left: 2rem; margin-top:-10px;">(กรณีผู้ประกอบการเป็นนิติบุคคล)</span><br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option3", $document_option ?? []) ? 'checked' : '' }}><span>หนังสือยินยอมให้ใช้สถานที่ / สัญญาเช่า</span> <br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option4", $document_option ?? []) ? 'checked' : '' }}><span>หนังสือยินมอบอำนาจพร้อมสำเนาบัตรประชาชน / สำเนาทะเบียนบ้านผู้มอบ และผู้รับมอบอำนาจ</span> <br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option5", $document_option ?? []) ? 'checked' : '' }}><span>ใบรับรองแพทย์ของผู้สัมผัสอาหาร (กรณีขอรับ / ขอต่ออายุใบอนุญาตแจ้งจัดตั้งสถานที่จำหน่ายอาหาร)</span> <br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option6", $document_option ?? []) ? 'checked' : '' }}><span>ใบอนุญาตแจ้งจัดตั้งสถานที่จำหน่ายอาหาร หรือ สถานที่สะสมอาหารฉบับเดิม (ต้นฉบับ) (กรณีต่อ)</span> <br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option7", $document_option ?? []) ? 'checked' : '' }}><span>แผนที่สถานที่ตั้งของสถานประกอบการ (กรณีขอรับ)</span> <br>
            <input type="checkbox" style="margin: 0px 10px;" {{ in_array("option8", $document_option ?? []) ? 'checked' : '' }}><span>อื่นๆ</span><span class="dotted-line" style="width: 20%; text-align: center;">{{$form['details']->document_option_detail}}</span> <br>
        </div>
        <span>ข้าพเจ้าขอรับรองว่า ข้อความในแบบคำขอนี้เป็นความจริงทุกประการ</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:1rem;">
        <span>(ลงชื่อ)</span>
        <span class="dotted-line" style="width: 35%; text-align: center;"> {{$form->full_name}}</span>
        <span>ผู้ขอต่อ/ขอรับ/ผู้แจ้ง</span>
        <div style="margin-right: 130px;">
            <span>(</span>
            <span class="dotted-line" style="width: 35%; text-align: center;"> {{$form->salutation}}{{$form->full_name}} </span>
            <span>)</span>
        </div>
    </div>
</body>


</html>

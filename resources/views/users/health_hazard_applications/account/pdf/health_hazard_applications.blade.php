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
            padding-top: 0px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 7px;
            border: 2px solid #ad3d58;
            font-size: 16px;
            text-align: left;
        }


        .dotted-line {
            margin-left: 2px;
            color: black;
            border-bottom: 2px dotted black;
            word-wrap: break-word;
            /* ห่อข้อความที่ยาวเกิน */
            overflow-wrap: break-word;
            /* รองรับ browser อื่น */
        }
    </style>
</head>
<?php
function DateTimeThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $time = date("H:i", strtotime($strDate));
    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function convertMonthsToThai($date)
{
    $string = date('m', strtotime($date));
    if (!$string) {
        return "วันที่ไม่ถูกต้อง";
    }

    $months = array(
        '01' => 'มกราคม',
        '02' => 'กุมภาพันธ์',
        '03' => 'มีนาคม',
        '04' => 'เมษายน',
        '05' => 'พฤษภาคม',
        '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม',
        '08' => 'สิงหาคม',
        '09' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม'
    );
    $monthThai = $months[$string];
    return $monthThai;
}

function convertDay($date)
{
    $day = date('d', strtotime($date));
    if (!$day) {
        return "วันที่ไม่ถูกต้อง";
    }

    $day = $day;

    $dayThai = $day;
    return $dayThai;
}

function convertYear($date)
{
    $day = date('Y', strtotime($date)) + 543;
    if (!$day) {
        return "วันที่ไม่ถูกต้อง";
    }

    $day = $day;

    $dayThai = $day;
    return $dayThai;
}
function convertYearPlus($date)
{
    $day = date('Y', strtotime($date)) + 544;
    if (!$day) {
        return "วันที่ไม่ถูกต้อง";
    }

    $day = $day;

    $dayThai = $day;
    return $dayThai;
}
?>

<body>
    <div class="box_text">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/ครุฑ.png'))) }}"
            alt="Logo" height="120"><br>
        <span>ใบอนุญาต</span><br>
        <span>ประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</span>
    </div>
    <table style="width: 100%; margin-top: 1rem;">
        <tr>
            <td style="text-align: left;">
                <span>เลขที่</span>
                <span class="dotted-line" style="width: 34%; display: inline-block; text-align: center; line-height: 1;">{{$info_number->book}}/{{$info_number->year}}</span>
            </td>
            <td style="text-align: right;">
                <span>ที่ทำการ</span>
                <span class="dotted-line" style="width: 50%; display: inline-block; text-align: center; line-height: 1;">อบต.คลองอุดมชลจร</span>
            </td>
        </tr>
    </table>

    <div class="box_text" style="text-align: left; margin-top:1rem;">
        <div style="margin-left:3rem;">
            <span>ข้อ 1) เจ้าพนักงานท้องถิ่นอนุญาตให้ นิติบุคคล ชื่อ</span>
            <span class="dotted-line" style="width: 43%; text-align: center; line-height: 1;">{{$form->full_name}}</span>
            <span>อายุ</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form->age}}</span>
            <span>ปี </span>
        </div>
        <span>สัญชาติ</span>
        <span class="dotted-line" style="width: 14%; text-align: center; line-height: 1;">{{$form->nationality}}</span>
        <span>เลขประจำตัวผู้เสียภาษี</span>
        <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;">{{$form->id_card_number}}</span>
        <span>อยู่บ้าน/สำนักงานเลขที่</span>
        <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;">{{$form->address}}</span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$form->village}}</span>

        <span>ตรอก/ซอย</span>
        <span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$form->alley}}</span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$form->road}}</span>
        <span>ตำบล/แขวง</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->subdistrict}}</span>
        <span>อำเภอ/เขต</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->district}}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->province}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->telephone}}</span>
        <span>โทรสาร</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->fax}}</span>
        <div style="margin-left:3rem;">
            <span>ประกอบกิจการที่เป็นอันตรายต่อสุขภาพ ประเภท</span>
            <span class="dotted-line" style="width: 60.4%; text-align: center; line-height: 1;">{{$form['details']->type_request}}</span>
        </div>
        <span>ลำดับที่</span>
        <span class="dotted-line" style="width: 11.5%; text-align: center; line-height: 1;">{{$info_number->id}}</span>
        <span>ค่าธรรมเนียม</span>
        <span class="dotted-line" style="width: 11.5%; text-align: center; line-height: 1;">{{$explore->price}}</span>
        <span>บาท</span>
        <span>ใบเสร็จรับเงินเล่มที่</span>
        <span class="dotted-line" style="width: 17.5%; text-align: center; line-height: 1;">{{$file->receipt_book}}</span>
        <span>เลขที่</span>
        <span class="dotted-line" style="width: 17.5%; text-align: center; line-height: 1;">{{$file->receipt_number}}</span>
        <span>ลงวันที่</span>
        <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertDay($file->updated_at)}}</span>
        <span>เดือน</span>
        <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertMonthsToThai($file->updated_at)}}</span>
        <span>พ.ศ.</span>
        <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertYear($file->updated_at)}}</span>
        <span>โดยใช้ชื่อสถานประกอบการว่า</span>
        <span class="dotted-line" style="width: 36.5%; text-align: center; line-height: 1;">{{$form['details']->name_establishment}}</span>
        <span>พื้นที่ประกอบการ</span>
        <span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$form['details']->business_area}}</span>
        <span>ตารางเมตร กำลังเครื่องจักร</span>
        <span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$form['details']->machine_power}}</span>
        <span>แรงม้า จำนวนคงาน</span>
        <span class="dotted-line" style="width: 14%; text-align: center; line-height: 1;">{{$form['details']->number_male_workers + $form['details']->number_female_workers}}</span>
        <span>คน</span>
        <span>ตั้ง อยู่ ณ เลขที่</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->location}}</span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_village}}</span>
        <span>ตรอก/ซอย</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_alley}}</span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_road}}</span>
        <span>ตำบล</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_subdistrict}}</span>
        <span>อำเภอ</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_district}}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_province}}</span>
        <span>โทรศัพท์</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_telephone}}</span>
        <span>โทรสาร</span>
        <span class="dotted-line" style="width: 12.5%; text-align: center; line-height: 1;">{{$form['details']->details_fax}}</span>
        <div style="margin-left:3rem;">
            <span>(๒) ผู้รับใบอนุญาตต้องปฎิบัติให้ถูกต้อง ครบถ้วน ตามหลักเกณฑ์ วิธีการ
                และเงื่อนนไขที่กำหนดในข้อบัญญัติท้องถิ่น</span>
            <span>(๓)
                หากปรากฎในภายหลังว่าการประกอบกิจการที่ได้รับอนุญาตนี้เป็นการขัดต่อกฎหมายอื่นที่เกี่ยวข้องโดยมิอาจแก้ไขได้
            </span>
        </div>
        <span>เจ้าพนักงานท้องถิ่นอาจพิจารณาให้เพิกถอนการอนุญาตนี้ได้</span>
        <div style="margin-left:3rem;">
            <span>(๔) ผู้รับใบอนุญาตต้องปฎิบัติตามเงื่อนไขเฉพาะดังต่อไปนี้อีกด้วย คือ</span>
            <div style="margin-left:1rem;">
                <span>(๔.๑) ต้องจัดบริเวณการผลิตอย่างเป็นสัดส่วน สะอาด มีความเป็นระเบียบเรียบร้อย</span>
                <span>(๔.๒) ต้องทำความสะอาดกำจัดฝุ่นละอองตามพื้นอย่างสม่ำเสมอไม่มีฝุ่นละอองสะสม</span>
            </div>
        </div>
        <div style="margin-left:3rem; margin-top:0.5rem;">
            <span>ใบอนุญาตฉบับนี้ให้ใช้ได้จนถึงวันที่</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertDay($info_number->updated_at)}}</span>
            <span>เดือน</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertMonthsToThai($info_number->updated_at)}}</span>
            <span>พ.ศ.</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertYearPlus($info_number->updated_at)}}</span>

            <div style="margin-left:6rem;">
                <span>ออกให้ ณ วันที่</span>
                <span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{convertDay($info_number->updated_at)}}</span>
                <span>เดือน</span>
                <span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{convertMonthsToThai($info_number->updated_at)}}</span>
                <span>พ.ศ.</span>
                <span class="dotted-line" style="width: 11%; text-align: center; line-height: 1;">{{convertYear($info_number->updated_at)}}</span>
            </div>
        </div>
        <div class="box_text" style="text-align: right; margin-top:1rem; position: relative;">
            <span>(ลายมือชื่อ)</span>
            <span class="dotted-line" style="width: 35%; text-align: center;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/payment/signature.png'))) }}" alt="ลายเซ็นมือ" height="40">
            </span>

            <!-- ตราประทับแบบลอยและสามารถทะลุออกนอก div ได้ -->
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/payment/S__40829013-removebg-preview-Photoroom.png'))) }}"
                 alt="stamp"
                 height="100"
                 style="position: absolute; top: 10px; right: 0px; z-index: -10; opacity: 0.8;">

            <div style="margin-right: 10px;">
                <span>(</span>
                <span class="dotted-line" style="width: 30%; text-align: center;">นายมนูศักดิ์ หม่องศิริ</span>
                <span>)</span>
            </div>
            <div style="margin-right: 10px;">
                <span>นายกองค์การบริหารส่วนตำบลคลองอุดมชลจร</span><br>
                <span style="margin-right: 60px;">เจ้าพนักงานท้องถิ่น</span>
            </div>
        </div>

        <div class="box_text_border" style=" color:#e40013; line-height: 0.8; display: inline-block; text-align: left; margin-top: 0rem;">
            <span style="text-decoration: underline;">คำเตือน</span>
            <span style="margin-left: 5px;">(๑) ผู้รับใบอนุญาตินี้ไว้โดยเปิดเผยและเห็นได้ง่าย ณ สถานที่</span><br style="margin: 0px;">
            <span style="margin-top: -10px;">ประกอบกิจการตลอดเวลาที่ประกอบกิจการ หากฝ่าฝืนมีโทษปรับไม่เกิน ๒,๕๐๐ บาท</span><br>
            <div style="margin-top: -10px;">
                <span style="margin-left: 45px;">(๒) หากประสงค์จะประกอบกิจการในปีต่อไปต้องยื่นคำขอต่ออายุใบอนุญาต</span><br>
            <span style="text-decoration: underline; color:black;">ก่อน</span>
            <span>ใบอนุญาตสิ้นอายุ ๓๐ วัน พร้อมเสียค่าธรรมเนียมใบอนุญาต</span>
            </div>
        </div>

    </div>
</body>


</html>

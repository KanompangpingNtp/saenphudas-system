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
            padding-top: 7px;
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
const BAHT_TEXT_NUMBERS = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
const BAHT_TEXT_UNITS = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
const BAHT_TEXT_TWENTY = 'ยี่';
const BAHT_TEXT_INTEGER = 'ถ้วน';
const BAHT_TEXT_BAHT = 'บาท';
const BAHT_TEXT_SATANG = 'สตางค์';
const BAHT_TEXT_POINT = 'จุด';
function baht_text($number, $include_unit = true, $display_zero = true)
{
    if (!is_numeric($number)) {
        return null;
    }

    $log = floor(log($number, 10));
    if ($log > 5) {
        $millions = floor($log / 6);
        $million_value = pow(1000000, $millions);
        $normalised_million = floor($number / $million_value);
        $rest = $number - ($normalised_million * $million_value);
        $millions_text = '';
        for ($i = 0; $i < $millions; $i++) {
            $millions_text .= BAHT_TEXT_UNITS[6];
        }
        return baht_text($normalised_million, false) . $millions_text . baht_text($rest, true, false);
    }

    $number_str = (string)floor($number);
    $text = '';
    $unit = 0;

    if ($display_zero && $number_str == '0') {
        $text = BAHT_TEXT_NUMBERS[0];
    } else for ($i = strlen($number_str) - 1; $i > -1; $i--) {
        $current_number = (int)$number_str[$i];

        $unit_text = '';
        if ($unit == 0 && $i > 0) {
            $previous_number = isset($number_str[$i - 1]) ? (int)$number_str[$i - 1] : 0;
            if ($current_number == 1 && $previous_number > 0) {
                $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
            } else if ($current_number > 0) {
                $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
            }
        } else if ($unit == 1 && $current_number == 2) {
            $unit_text .= BAHT_TEXT_TWENTY;
        } else if ($current_number > 0 && ($unit != 1 || $current_number != 1)) {
            $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
        }

        if ($current_number > 0) {
            $unit_text .= BAHT_TEXT_UNITS[$unit];
        }

        $text = $unit_text . $text;
        $unit++;
    }

    if ($include_unit) {
        $text .= BAHT_TEXT_BAHT;

        $satang = explode('.', number_format($number, 2, '.', ''))[1];
        $text .= $satang == 0
            ? BAHT_TEXT_INTEGER
            : baht_text($satang, false) . BAHT_TEXT_SATANG;
    } else {
        $exploded = explode('.', $number);
        if (isset($exploded[1])) {
            $text .= BAHT_TEXT_POINT;
            $decimal = (string)$exploded[1];
            for ($i = 0; $i < strlen($decimal); $i++) {
                $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
            }
        }
    }

    return $text;
}
?>

<body>
    <div class="box_text">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/ครุฑ.png'))) }}"
            alt="Logo" height="120"><br>
        <span>หนังสือรับรองการแจ้ง</span><br>
        <span>จัดตั้งสถานที่จำหน่ายอาหาร</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top:1rem;">
        <span>เลขที่</span>
        <span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$info_number->book}}/{{$info_number->year}}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top:1rem;">
        <div style="margin-left:3rem;">
            <span>(๑) เจ้าพนักงานท้องถิ่นอนุญาตให้</span>
            <span class="dotted-line" style="width: 50%; text-align: center; line-height: 1;">{{$form->full_name}}</span>
            <span>สัญชาติ</span>
            <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;">{{$form->nationality}}</span>
        </div>
        <span>สำนักงานเลขที่</span>
        <span class="dotted-line" style="width: 45%; text-align: center; line-height: 1;">{{$form->address}}</span>
        <span>ถนน</span>
        <span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$form->road}}</span>
        <span>แขวง</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->subdistrict}}</span>
        <span>เขต</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->district}}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->province}}</span>
        <span>หมายเลขโทรศัพท์</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;">{{$form->telephone}}</span>
        <div style="margin-left:3rem;">
            <span>ชื่อสถานประกอบกิจการ</span>
            <span class="dotted-line" style="width: 50%; text-align: center; line-height: 1;">{{$form['details']->place_name}}</span>
            <span>ประเภท</span>
            <span class="dotted-line" style="width: 22%; text-align: center; line-height: 1;">{{$form['details']->shop_type}}</span>
        </div>
        <span>อยู่บ้านเลขที่</span>
        <span class="dotted-line" style="width: 7%; text-align: center; line-height: 1;">{{$form['details']->location}}</span>
        <span>หมู่ที่</span>
        <span class="dotted-line" style="width: 7%; text-align: center; line-height: 1;">{{$form['details']->details_village}}</span>
        <span>ตำบล</span>
        <span class="dotted-line" style="width: 17.5%; text-align: center; line-height: 1;">{{$form['details']->details_subdistrict}}</span>
        <span>อำเภอ</span>
        <span class="dotted-line" style="width: 17.5%; text-align: center; line-height: 1;">{{$form['details']->details_district}}</span>
        <span>จังหวัด</span>
        <span class="dotted-line" style="width: 17.5%; text-align: center; line-height: 1;">{{$form['details']->details_province}}</span>
        <span>หมายเลขโทรศัพท์</span>
        <span class="dotted-line" style="width: 18%; text-align: center; line-height: 1;">{{$form['details']->details_telephone}}</span>
        <span>พื้นที่ประกอบการ</span>
        <span class="dotted-line" style="width: 18%; text-align: center; line-height: 1;">{{$form['details']->business_area}}</span>
        <span>ตารางเมตร</span>
        <div style="margin-left:3rem;">
            <span>อัตราค่าธรรมเนียมปีละ</span>
            <span class="dotted-line" style="width: 30%; text-align: center; line-height: 1;">{{$explore->price}}</span>
            <span>บาท (</span>
            <span class="dotted-line" style="width: 43.5%; text-align: center; line-height: 1;">{{baht_text($explore->price)}}</span>
            <span>)</span>
        </div>
        <span>ตามใบเสร็จรับเงินเล่มที่</span>
        <span class="dotted-line" style="width: 34.2%; text-align: center; line-height: 1;">{{$file->receipt_number}}</span>
        <span>ลงวันที่</span>
        <span class="dotted-line" style="width: 34.2%; text-align: center; line-height: 1;">{{DateTimeThai($file->updated_at)}}</span>
        <div style="margin-left:3rem;">
            <span>(๒) ผู้รับใบอนุญาตต้องปฎิบัติให้ถูกต้อง ครบถ้วน ตามหลักเกณฑ์ วิธีการ และเงื่อนนไขที่กำหนดในข้อบัญญัติท้องถิ่น</span>
            <span>(๓) หากปรากฎในภายหลังว่าการประกอบกิจการที่ได้รับอนุญาตนี้เป็นการขัดต่อกฎหมายอื่นที่เกี่ยวข้องโดยมิอาจแก้ไขได้ </span>
        </div>
        <span>เจ้าพนักงานท้องถิ่นอาจพิจารณาให้เพิกถอนการอนุญาตนี้ได้</span>
        <div style="margin-left:3rem;">
            <span>(๔) ผู้รับใบอนุญาตต้องปฎิบัติตามเงื่อนไขเฉพาะดังต่อไปนี้อีกด้วย คือ</span>
            <div style="margin-left:1rem;">
                <span>(๔.๑) ต้องปฎิบัติตามข้อบัญญัติตำบล เรื่อง ควบคุมสถานที่จำหน่ายอาหารและสถานที่สะสมอาหาร และปฎิบัติตามคำแนะนำ</span>
                <div style="margin-left: -4rem;">
                    ของเจ้าพนักงานสาธารณสุข คำสั่งเจ้าพนักงานท้องถิ่น รวมทั้งระเบียบและกฎหมายอื่นๆ ที่เกี่ยวข้อง
                </div>
                <span>(๔.๒) มีที่เก็บรวบรวมหรือรองรับขยะมูลฝอยให้ถูกต้องตามหลักสุขาภิบาล</span>
            </div>
        </div>
        <div style="margin-left:3rem; margin-top:2rem;">
            <span>ใบอนุญาตฉบับนี้ให้ใช้ได้จนถึงวันที่</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertDay($form['details']->confirm_expiration_date)}}</span>
            <span>เดือน</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertMonthsToThai($form['details']->confirm_expiration_date)}}</span>
            <span>พ.ศ.</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertYearPlus($form['details']->confirm_expiration_date)}}</span>
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
        <div class="box_text_border" style=" color:#e40013; line-height: 0.8; display: inline-block; text-align: left; margin-top: 1rem;">
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
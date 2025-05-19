<!DOCTYPE html>
<html lang="th">
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
            border: 1px solid rgba(255, 255, 255, 0);
            text-align: start;
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
            margin-bottom: 5px;
            /* เว้นระยะห่างระหว่าง checkbox และข้อความ */
        }

        .box_text_border {
            margin-top: 5px;
            padding-left: 5px;
            padding-right: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
            text-align: left;

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
    <div class="box_text" style="text-align: center; font-weight: bold;">
        <span>หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง/ห้องชุด</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:2rem;">
        <span>เขียนที่</span><span class="dotted-line" style="width: 34%; text-align: center; line-height: 1;">องค์การบริหารส่วนตำบลคลองอุดมชลจร</span><br>
        <span>วันที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertDay($form->created_at)}}</span>
        <span>เดือน</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{convertMonthsToThai($form->created_at)}}</span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertYear($form->created_at)}}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top:1rem;">
        <span>เรื่อง ขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด</span><br>
        <span>เรียน นายกองค์การบริหารส่วนตำบลคลองอุดมชลจร</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top:2rem;">
        <div style="margin-left: 6rem;">
            <span>๑. ก. กรณีเป็นบุคคลธรรมดา ข้าพเจ้า</span><span class="dotted-line"
                style="width: 56%; text-align: center; line-height: 1;">{{$form['details']->personal_salutation}} {{$form['details']->personal_full_name}}</span>
            <span>อายุ</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->personal_age}}</span>
            <span>ปี</span>
        </div>
        <span>บัตรประจำตัวประชาชนที่</span><span class="dotted-line"
            style="width: 40%; text-align: center; line-height: 1;">{{$form['details']->personal_id_card_number}}</span>
        <span>ออกให้โดย</span><span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;">{{$form['details']->personal_id_card_by}}</span>
        <span>หมดอายุวันที่</span><span class="dotted-line"
            style="width: 8%; text-align: center; line-height: 1;"><?= ($form['details']->personal_id_card_date != '') ? convertDay($form['details']->personal_id_card_date) : '' ?></span>
        <span>เดือน</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"><?= ($form['details']->personal_id_card_date != '') ? convertMonthsToThai($form['details']->personal_id_card_date) : '' ?></span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"><?= ($form['details']->personal_id_card_date != '') ? convertYear($form['details']->personal_id_card_date) : '' ?></span>
        <span>อยู่บ้านเลขที่</span><span class="dotted-line"
            style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->personal_address}}</span>
        <span>หมู่ที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->personal_village}}</span>
        <span>ตรอก/ซอย</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->personal_alley}}</span>
        <span>ถนน</span><span class="dotted-line" style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->personal_road}}</span>
        <span>แขวง/ตำบล</span><span class="dotted-line"
            style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->personal_subdistrict}}</span>
        <span>เขต/อำเภอ</span><span class="dotted-line"
            style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->personal_district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 25%; text-align: center; line-height: 1;">{{$form['details']->personal_province}}</span>
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->personal_telephone}}</span>
        <span>Line ID (ถ้ามี)</span><span class="dotted-line"
            style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->personal_line}}</span>
        <span>อีเมล</span><span class="dotted-line" style="width: 50%; text-align: center; line-height: 1;">{{$form['details']->personal_email}}</span>
        <span>(แนบสำเนาบัตรประจำตัวประชาชน)</span>

        <div style="margin-left: 6rem; margin-top:1rem;">
            <span>ข. กรณีเป็นนิติบุคคล ข้าพเจ้า</span><span class="dotted-line"
                style="width: 41%; text-align: center; line-height: 1;">{{$form['details']->org_salutation}} {{$form['details']->org_full_name}}</span>
            <span>มีสำนักงานใหญ่ที่</span><span class="dotted-line"
                style="width: 23%; text-align: center; line-height: 1;">{{$form['details']->org_address}}</span>
        </div>
        <span>หมู่ที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->org_village}}</span>
        <span>ตรอก/ซอย</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->org_alley}}</span>
        <span>ถนน</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form['details']->org_road}}</span>
        <span>แขวง/ตำบล</span><span class="dotted-line"
            style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->org_subdistrict}}</span>
        <span>เขต/อำเภอ</span><span class="dotted-line"
            style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->org_district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 28%; text-align: center; line-height: 1;">{{$form['details']->org_province}}</span>
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 26.5%; text-align: center; line-height: 1;">{{$form['details']->org_telephone}}</span>
        <span>โดย นาย/นาง/นางสาว</span><span class="dotted-line"
            style="width: 33.5%; text-align: center; line-height: 1;">{{$form['details']->org_salutation_2}} {{$form['details']->org_full_name_2}}</span>
        <span>อายุ</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->org_age_2}}</span>
        <span>ปี บัตรประจำตัวประชาชนเลขที่</span><span class="dotted-line"
            style="width: 17%; text-align: center; line-height: 1;">{{$form['details']->org_id_card_2}}</span>
        <span>ออกให้โดย</span><span class="dotted-line"
            style="width: 40.5%; text-align: center; line-height: 1;">{{$form['details']->org_id_card_by_2}}</span>
        <span>หมดอายุวันที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;"><?= ($form['details']->org_id_card_date_2 != '') ? convertDay($form['details']->org_id_card_date_2) : '' ?></span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->org_id_card_date_2 != '') ? convertMonthsToThai($form['details']->org_id_card_date_2) : '' ?></span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"><?= ($form['details']->org_id_card_date_2 != '') ? convertYear($form['details']->org_id_card_date_2) : '' ?></span>
        <span>มีอำนาจลงนามผูกพันนิติบุคคล ตามหนังสือรับรองของสำนักงานทะเบียนหุ้นส่วนบริษัท</span><span
            class="dotted-line" style="width: 45%; text-align: center; line-height: 1;">{{$form['details']->org_certificate}}</span>
        <span>ลงวันที่</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"><?= ($form['details']->org_certificate_date != '') ? convertDay($form['details']->org_certificate_date) : '' ?></span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->org_certificate_date != '') ? convertMonthsToThai($form['details']->org_certificate_date) : '' ?></span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"><?= ($form['details']->org_certificate_date != '') ? convertYear($form['details']->org_certificate_date) : '' ?></span>
        <span>Line ID (ถ้ามี)</span><span class="dotted-line"
            style="width: 42%; text-align: center; line-height: 1;">{{$form['details']->org_line}}</span>
        <span>อีเมล (ถ้ามี)</span><span class="dotted-line"
            style="width: 36%; text-align: center; line-height: 1;">{{$form['details']->org_email}}</span>
        <span>(แนบสำเนาหนังสือรับรอง สำเนาบัตรประจำตัวประชาชน และหนังสือมอบอำนาจ (ถ้ามี))</span>
        <div style="margin-left: 6rem; margin-top:1rem;">
            <span>๒. ข้าพเจ้ายอมรับว่าได้รับแจ้งการประเมินภาษีที่ดินและสิ่งปลูกสร้าง/ห้องชุด ประจำปีภาษี</span><span
                class="dotted-line" style="width: 25%; text-align: center; line-height: 1;">{{$form['details']->year}}</span>
            <span>(ภ.ด.ส.๖)</span>
        </div>
    </div>
    <div class="box_text">
        <span>เมื่อวันที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{convertDay($form['details']->date)}}</span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;">{{convertMonthsToThai($form['details']->date)}}</span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertYear($form['details']->date)}}</span>
        <span>เป็นเงินทั้งสิ้น</span><span class="dotted-line"
            style="width: 38.5%; text-align: center; line-height: 1;">{{$form['details']->total}}</span>
        <span>บาท</span><span>(</span><span class="dotted-line"
            style="width: 38%; text-align: center; line-height: 1;">{{baht_text($form['details']->total)}}</span>
        <span>)</span><span> ตามรายการที่ปรากฎในแบบแสดงรายการคำนวณภาษีที่ดินและ</span><span>สิ่งปลูกสร้าง (ภ.ด.ส.๗) /
            ห้องชุด (ภ.ด.ส.๘)</span>
    </div>
    <div style="margin-left: 6rem; margin-top:1rem;">
        <span>๓. ค่าภาษีที่ดินและสิ่งปลูกสร้าง/ห้องชุด ตามข้อ ๒.
            ข้าพเจ้าไม่สามารถชำระให้เสร็จสิ้นในคราวเดียวกันได้จึงขอผ่อนชำระ</span>
    </div>
    <span>เป็นจำนวน ๓ งวด ๆ ละเท่า ๆ กัน ภายในกำหนดเวลา หากมีเศษเหลือเท่าใดใช้ชำระในงวดที่ ๑ ดังนี้</span>
    <div class="box_text" style=" margin-top:1rem;">
        <div style="margin-left: 6rem;">
            <span>งวดที่ ๑ ชำระภายในวันที่</span><span class="dotted-line"
                style="width: 10%; text-align: center; line-height: 1;">{{convertDay($form['details']->round_date_1)}}</span>
            <span>เดือน</span><span class="dotted-line"
                style="width: 11.5%; text-align: center; line-height: 1;">{{convertMonthsToThai($form['details']->round_date_1)}}</span>
            <span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertYear($form['details']->round_date_1)}}</span>
            <span>จำนวน</span><span class="dotted-line"
                style="width: 30%; text-align: center; line-height: 1;">{{$form['details']->round_total_1}}</span>
            <span>บาท</span>
        </div>
        <span>(</span><span class="dotted-line" style="width: 60%; text-align: center; line-height: 1;">{{baht_text($form['details']->round_total_1)}}</span>
        <span>)</span>
        <div style="margin-left: 6rem;">
            <span>งวดที่ ๒ ชำระภายในวันที่</span><span class="dotted-line"
                style="width: 10%; text-align: center; line-height: 1;">{{convertDay($form['details']->round_date_2)}}</span>
            <span>เดือน</span><span class="dotted-line"
                style="width: 11.5%; text-align: center; line-height: 1;">{{convertMonthsToThai($form['details']->round_date_2)}}</span>
            <span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertYear($form['details']->round_date_2)}}</span>
            <span>จำนวน</span><span class="dotted-line"
                style="width: 30%; text-align: center; line-height: 1;">{{$form['details']->round_total_2}}</span>
            <span>บาท</span>
        </div>
        <span>(</span><span class="dotted-line" style="width: 60%; text-align: center; line-height: 1;">{{baht_text($form['details']->round_total_2)}}</span>
        <span>)</span>
        <div style="margin-left: 6rem;">
            <span>งวดที่ ๓ ชำระภายในวันที่</span><span class="dotted-line"
                style="width: 10%; text-align: center; line-height: 1;">{{convertDay($form['details']->round_date_3)}}</span>
            <span>เดือน</span><span class="dotted-line"
                style="width: 11.5%; text-align: center; line-height: 1;">{{convertMonthsToThai($form['details']->round_date_3)}}</span>
            <span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{convertYear($form['details']->round_date_3)}}</span>
            <span>จำนวน</span><span class="dotted-line"
                style="width: 30%; text-align: center; line-height: 1;">{{$form['details']->round_total_3}}</span>
            <span>บาท</span>
        </div>
        <span>(</span><span class="dotted-line" style="width: 60%; text-align: center; line-height: 1;">{{baht_text($form['details']->round_total_3)}}</span>
        <span>)</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:2rem;">
        /๔. ข้าพเจ้า...
    </div>
    <div style="page-break-before: always;"></div>
    <div class="box_text" style="text-align: center;">
        <span>- ๒ -</span>
    </div>
    <div class="box_text" style="margin-top:2rem;">
        <div style="margin-left:6rem;">
            <span>๔. ข้าพเจ้ายอมรับและตกลงว่า ถ้าข้าพเจ้าผิดนัดชำระงวดหนึ่งงวดใด ถือว่าหมดสิทธิที่จะผ่อนชำระ และต้องเสียเงินเพิ่มอีกร้อยละ</span>
        </div>
        <span>หนึ่งต่อเดือนของจำนวนภาษีที่ค้างชำระ เศษของเดือนให้นับเป็นหนึ่งเดือน ตามมาตรา ๕๒ แห่งพระราชบัญญัติภาษีที่ดินและสิ่งปลูกสร้าง พ.ศ. ๒๕๖๒</span>
        <div style="margin-left:6rem; margin-top:0rem;">
            <span>จึงเรียนมาเพื่อโปรดพิจารณา</span>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"><?= ($form['details']->personal_full_name != '') ? $form['details']->personal_salutation . ' ' . $form['details']->personal_full_name : $form['details']->org_salutation_2 . ' ' . $form['details']->org_full_name_2 ?></span>
        <span>ผู้ยื่นคำร้อง</span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"><?= ($form['details']->personal_full_name != '') ? $form['details']->personal_salutation . ' ' . $form['details']->personal_full_name : $form['details']->org_salutation_2 . ' ' . $form['details']->org_full_name_2 ?></span>
            <span>)</span>
        </div>
    </div>
    <div class="box_text" style="margin-top:1rem;">
        <div style="margin-left:6rem;">
            <span>ความเห็นเจ้าหน้าที่</span><br>
            <span>เรียน ผู้อำนวยการกองคลัง</span>
            <div style="margin-left: 3rem;">
                <input type="checkbox"><span>สมควรให้มีการผ่อนชำระภาษี</span><br>
                <input type="checkbox"><span>ไม่สมควรให้มีการผ่อนชำระภาษี</span><br>
                <span style="margin-left: 0.4rem; margin-top: -10px;">จึงเรียนมาเพื่อโปรดพิจารณา</span>
            </div>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
        <span>ตำแหน่ง</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span><br>
        <span>วันที่</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
    </div>
    <div class="box_text" style="margin-top:0rem;">
        <div style="margin-left:6rem;">
            <span>เรียน ปลัดองค์การบริหารส่วนตำบลคลองอุดมชลจร</span>
            <div style="margin-left: -0.5rem;">
                <span class="dotted-line" style="width: 40%; text-align: center; ">(นายกองค์การบริหารส่วนตำบลคลองอุดมชลจร)</span>
            </div>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
        <span>ตำแหน่ง</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span><br>
        <span>วันที่</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
    </div>
    <div class="box_text" style="margin-top:0rem;">
        <div style="margin-left:6rem;">
            <span>เรียน นายกองค์การบริหารส่วนตำบลคลองอุดมชลจร</span>
            <div style="margin-left: -0.5rem;">
                <span class="dotted-line" style="width: 40%; text-align: center; ">(นายกองค์การบริหารส่วนตำบลคลองอุดมชลจร)</span>
            </div>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
        <span>ตำแหน่ง</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span><br>
        <span>วันที่</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
    </div>
    <div class="box_text" style="margin-top:0rem;">
        <div style="margin-left:6rem;">
            <span>ความเห็นนายกองค์การบริหารส่วนตำบลคลองอุดมชลจร</span>
            <div style="margin-left: 3rem;">
                <input type="checkbox"><span>อณุมัติตามเสนอ และให้แจ้งผู้เสียภาษีทราบ</span><br>
                <input type="checkbox"><span>ไม่อณุมัติ เนื่องจาก</span><span class="dotted-line" style="width: 50%; text-align: center; "></span>
                <span>และแจ้งให้ผู้เสียภาษีทราบ</span>
            </div>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:3rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
        <span style="margin-right: 65px;">นายกองค์การบริหารส่วนตำบลคลองอุดมชลจร</span> <br>
        <span>วันที่</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
    </div>
</body>

</html>
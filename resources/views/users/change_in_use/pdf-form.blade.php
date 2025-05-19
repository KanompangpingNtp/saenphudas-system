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
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 50%; text-align: left;">
                <!-- ด้านซ้าย (เว้นไว้ หรือใส่ข้อความก็ได้) -->
            </td>
            <td style="width: 50%; text-align: right;">
                <div style="display: inline-block; padding: 5px; border: 1px solid #000;">
                    <span style="margin-right: 100px; font-weight: bold;">สำหรับเจ้าหน้าที่</span><br>
                    <span>เลขรับ</span>
                    <span
                        style="display: inline-block; width: 100px; border-bottom: 1px dotted #000; margin-left: 5px;"></span>
                    <span>วันที่</span>
                    <span
                        style="display: inline-block; width: 100px; border-bottom: 1px dotted #000; margin-left: 5px;"></span>
                    <br><span>ผู้รับเรื่อง</span>
                    <span
                        style="display: inline-block; width: 220px; border-bottom: 1px dotted #000; margin-left: 5px;"></span>

                </div>
            </td>
        </tr>
    </table>
    <div class="box_text" style="text-align: right; margin-top:0rem; margin-right:7rem;">
        <span>ภ.ด.ส. ๕</span>
    </div>
    <div style="text-align: center; margin-top: 0rem; ">
        <strong>
            แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ในที่ดินหรือสิ่งปลูกสร้าง
        </strong>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0rem;">
        <span>เขียนที่</span><span class="dotted-line" style="width: 30%; text-align: center; line-height: 1;">องค์การบริหารส่วนตำบลคลองอุดมชลจร</span><br>
        <span>วันที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertDay($form->created_at)}}</span>
        <span>เดือน</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{convertMonthsToThai($form->created_at)}}</span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertYear($form->created_at)}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <div style="margin-left: 6rem;margin-top:-0.5rem;">
            <span>ข้าพเจ้า</span><span class="dotted-line" style="width: 53.2%; text-align: center; line-height: 1;">{{$form->salutation}} {{$form->full_name}}</span>
            <span>อยู่บ้านเลขที่</span><span class="dotted-line" style="width: 13%; text-align: center; line-height: 1;">{{$form->address}}</span>
            <span>หมู่ที่</span><span class="dotted-line" style="width: 13%; text-align: center; line-height: 1;">{{$form->village}}</span>
        </div>
        <span>ถนน</span><span class="dotted-line" style="width: 29%; text-align: center; line-height: 1;">{{$form->road}}</span>
        <span>ตำบล</span><span class="dotted-line" style="width: 29%; text-align: center; line-height: 1;">{{$form->subdistrict}}</span>
        <span>อำเภอ</span><span class="dotted-line" style="width: 29%; text-align: center; line-height: 1;">{{$form->district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 29%; text-align: center; line-height: 1;">{{$form->province}}</span>
        <span>ขอยื่นแบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ในที่ดินหรือสิ่งปลูกสร้างต่อองค์กรปกครองส่วนท้องถิ่น</span>
        <span>ดังมีข้อความต่อไปนี้</span>
        <div style="margin-left: 6rem;">
            <span>ข้าพเจ้ามีทรัพท์สินประเภท</span><br>
            <span>๑. ที่ดิน จำนวน</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->land_total}}</span>
            <span>แปลง ดังนี้</span>
            <div style="margin-left: 1rem;">
                <span>๑.๑ แปลงที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$form['details']->land_on}}</span>
                <span>ตั้งอยู่หมู่ที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->land_village}}</span>
                <span>ถนน</span><span class="dotted-line" style="width: 25%; text-align: center; line-height: 1;">{{$form['details']->land_road}}</span>
                <span>ตำบล</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form['details']->land_subdistrict}}</span>
            </div>
        </div>
        <span>อำเภอ</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->land_district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->land_province}}</span>
        <span>เลขที่โฉนดหรือหนังสือสำคัญ</span><span class="dotted-line" style="width: 31%; text-align: center; line-height: 1;">{{$form['details']->land_deed}}</span>
        <span>เนื้อที่ดิน</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->land_rai}}</span>
        <span>ไร่</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->land_unit}}</span>
        <span>งาน</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->land_wa}}</span>
        <span>ตร.ว. เดิมที่ดินแปลงนี้ใช้ทำประโยชน์</span><span class="dotted-line" style="width: 34%; text-align: center; line-height: 1;">{{$form['details']->land_default_use}}</span>
        <span>บัดนี้ ที่ดินแปลงดังกล่าวใช้ทำประโยชน์</span><span class="dotted-line" style="width: 74%; text-align: center; line-height: 1;">{{$form['details']->land_current_use}}</span>
        <span>ตั้งแต่วันที่</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->land_current_date ? convertDay($form['details']->land_current_date) : '')?></span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->land_current_date ? convertMonthsToThai($form['details']->land_current_date) : '')?></span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->land_current_date ? convertYear($form['details']->land_current_date) : '')?></span>
    </div>
    <div class="box_text" style="text-align: center">
        <span>ฯลฯ</span>
    </div>
    <div class="box_text" style="">
        <div style="margin-left: 6rem;">
            <span>๒. สิ่งปลูกสร้าง จำนวน</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->build_total}}</span>
            <span>หลัง ดังนี้</span>
            <div style="margin-left: 1rem;">
                <span>๒.๑ หลังที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$form['details']->build_on}}</span>
                <span>ตั้งอยู่หมู่ที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->build_village}}</span>
                <span>ถนน</span><span class="dotted-line" style="width: 25%; text-align: center; line-height: 1;">{{$form['details']->build_road}}</span>
                <span>ตำบล</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form['details']->build_subdistrict}}</span>
            </div>
        </div>
        <span>อำเภอ</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->build_district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->build_province}}</span>
        <span>เลขที่โฉนดหรือหนังสือสำคัญ</span><span class="dotted-line" style="width: 31%; text-align: center; line-height: 1;">{{$form['details']->build_deed}}</span>
        <span>ขนาดพื้นที่สิ่งปลูกสร้าง</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->build_meter}}</span>
        <span>ตร.ม. เดิมที่ดินแปลงนี้ใช้ทำประโยชน์</span><span class="dotted-line" style="width: 40%; text-align: center; line-height: 1;">{{$form['details']->build_default_use}}</span>
        <span>บัดนี้ ที่ดินแปลงดังกล่าวใช้ทำประโยชน์</span><span class="dotted-line" style="width: 74%; text-align: center; line-height: 1;">{{$form['details']->build_current_use}}</span>
        <span>ตั้งแต่วันที่</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->build_current_date ? convertDay($form['details']->build_current_date) : '')?></span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->build_current_date ? convertMonthsToThai($form['details']->build_current_date) : '')?></span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->build_current_date ? convertYear($form['details']->build_current_date) : '')?></span>
    </div>
    <div class="box_text" style="text-align: center;margin-top:-0.5rem;margin-bottom:-0.5rem;">
        <span>ฯลฯ</span>
    </div>
    <div class="box_text" style="">
        <div style="margin-left: 6rem;">
            <span>๓. อาคารชุด/ห้องชุด จำนวน</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{$form['details']->room_total}}</span>
            <span>ห้อง ดังนี้</span>
            <div style="margin-left: 1rem;">
                <span>๓.๑ ชื่ออาคารชุด/ห้องชุด</span><span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;">{{$form['details']->room_name}}</span>
                <span>เลขที่/ห้องที่</span><span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;">{{$form['details']->room_on}}</span>
            </div>
        </div>
        <span>ตั้งอยู่หมู่ที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$form['details']->room_village}}</span>
        <span>ถนน</span><span class="dotted-line" style="width: 15.5%; text-align: center; line-height: 1;">{{$form['details']->room_road}}</span>
        <span>ตำบล</span><span class="dotted-line" style="width: 15.5%; text-align: center; line-height: 1;">{{$form['details']->room_subdistrict}}</span>
        <span>อำเภอ</span><span class="dotted-line" style="width: 15.5%; text-align: center; line-height: 1;">{{$form['details']->room_district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 16%; text-align: center; line-height: 1;">{{$form['details']->room_province}}</span>
        <span>บนที่ดินเลขโฉนดหรือหนังสือสำคัญ</span><span class="dotted-line" style="width: 34%; text-align: center; line-height: 1;">{{$form['details']->room_deed}}</span>
        <span>ขนาดพื้นที่อาคารชุด/ห้องชุด</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->room_meter}}</span>
        <span>ตร.ม.</span>
        <span>เดิมอาคารชุด/ห้องชุดนี้ใช้ทำประโยชน์</span><span class="dotted-line" style="width: 55%; text-align: center; line-height: 1;">{{$form['details']->room_default_use}}</span>
        <span>บัดนี้ อาคารชุด/ห้องชุดดังกล่าว</span>
        <span>ใช้ทำประโยชน์</span><span class="dotted-line" style="width: 90%; text-align: center; line-height: 1;">{{$form['details']->room_current_use}}</span>
        <span>ตั้งแต่วันที่</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->room_current_date ? convertDay($form['details']->room_current_date) : '')?></span>
        <span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->room_current_date ? convertMonthsToThai($form['details']->room_current_date) : '')?></span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"><?= ($form['details']->room_current_date ? convertYear($form['details']->room_current_date) : '')?></span>
    </div>
    <div class="box_text" style="text-align: right;  position: relative;">
        <span>(ลงชื่อ)</span>
        <span class="dotted-line" style="width: 30%; text-align: center;">{{$form->salutation}} {{$form->full_name}}</span>
        <span style="margin-right: 80px">ผู้แจ้ง</span>
        <div style="margin-right: 110px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;">{{$form->salutation}} {{$form->full_name}}</span>
            <span>)</span>
        </div>
        <span>โทร</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 100px;"></span>
    </div>
    <div class="box_text" style="text-align: right;  position: relative;">
        <span>(ลงชื่อ)</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"></span>
        <span>เจ้าหน้าที่ผู้รับตำแหน่ง</span>
        <div style="margin-right: 110px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
        <span>ตำแหน่ง</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 100px;"></span>
    </div>

</body>

</html>
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

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .sub-header {
            font-weight: normal;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="title_doc">
        <img src=":image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/logo.png'))) }}"
            alt="Logo" height="90">
    </div>
    <div class="box_text" style="text-align: left; margin-top:-5rem;">
        <span style="margin-left: 3rem;">ภ.ป.1</span><br>
        <span>แบบแสดงรายการภาษีป้าย</span><br>
        <span>ประจำ พ.ศ.</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{convertYear($form->created_at)}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>ชื่อเจ้าของป้าย</span><span class="dotted-line"
            style="width: 37.5%; text-align: center; line-height: 1;">{{$form['details']->salutation}} {{$form['details']->full_name}}</span>
        <span>ชื่อสถานที่ประกอบการค้าหรือกิจการอื่น</span><span class="dotted-line"
            style="width: 37.5%; text-align: center; line-height: 1;">{{$form['details']->build_name}}</span>
        <span>เลขที่</span><span class="dotted-line"
            style="width: 21.6%; text-align: center; line-height: 1;">{{$form['details']->address}}</span>
        <span>ตรอก/ซอย</span><span class="dotted-line"
            style="width: 21.6%; text-align: center; line-height: 1;">{{$form['details']->alley}}</span>
        <span>ถนน</span><span class="dotted-line" style="width: 21.6%; text-align: center; line-height: 1;">{{$form['details']->road}}</span>
        <span>หมู่ที่</span><span class="dotted-line"
            style="width: 21.6%; text-align: center; line-height: 1;">{{$form['details']->village}}</span>
        <span>ตำบล</span><span class="dotted-line" style="width: 21.5%; text-align: center; line-height: 1;">{{$form['details']->subdistrict}}</span>
        <span>อำเภอ</span><span class="dotted-line"
            style="width: 21.5%; text-align: center; line-height: 1;">{{$form['details']->district}}</span>
        <span>จังหวัด</span><span class="dotted-line"
            style="width: 21.5%; text-align: center; line-height: 1;">{{$form['details']->province}}</span>
        <span>โทรศัพท์</span><span class="dotted-line"
            style="width: 21.5%; text-align: center; line-height: 1;">{{$form['details']->telephone}}</span>
        <span>ขอยื่นแบบแสดงรายการภาษีป้ายต่อพนักงานเจ้าหน้าที่ ณ</span><span class="dotted-line"
            style="width: 40%; text-align: center; line-height: 1;">{{$form['details']->emp_fullname}}</span>
        <span style="margin-left: 6rem;">ตามรายการต่อไปนี้</span>

    </div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 17px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 0px;
            text-align: center;
            vertical-align: middle;
            line-height: 0.9;
        }

        .sub-header {
            font-weight: normal;
            font-size: 15px;
        }
    </style>

    <table>
        <thead>
            <tr>
                <th rowspan="2">1.ประเภทป้าย</th>
                <th colspan="2">2.ขนาดป้าย (ซม.)</th>
                <th rowspan="2">3.เนื้อที่ป้าย<br>(ตารางซม.)</th>
                <th rowspan="2">4.จำนวนป้าย</th>
                <th rowspan="2">5.ข้อความหรือภาพหรือ<br>เครื่องหมายที่ปรากฏในป้ายโดยย่อ</th>
                <th rowspan="2">6.สถานที่ติดตั้งป้ายและวันติดตั้ง(แสดงป้าย)<br>ถนน, ตรอก, ซอย, แขวง, เขต <br>สถานที่ใกล้เคียง หรือระหว่าง ก.ม. ที่</th>
                <th rowspan="2">หมายเหตุ</th>
            </tr>
            <tr>
                <th class="sub-header">กว้าง</th>
                <th class="sub-header">ยาว</th>
            </tr>
        </thead>
        <tbody>
            <!-- ป้ายประเภทที่ 1 (rowspan 4) -->
            <tr>
                <td rowspan="4">ภาษีป้ายมีอักษรไทยล้วน</td>
                <?php if (count($type1) > 0) {
                    if ($type1[0]) { ?>
                        <td>{{$type1[0]['wide']}}</td>
                        <td>{{$type1[0]['long']}}</td>
                        <td>{{$type1[0]['meter']}}</td>
                        <td>{{$type1[0]['amount']}}</td>
                        <td>{{$type1[0]['text']}}</td>
                        <td>{{$type1[0]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type1[0]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type1) > 1) {
                    if ($type1[1]) { ?>
                        <td>{{$type1[1]['wide']}}</td>
                        <td>{{$type1[1]['long']}}</td>
                        <td>{{$type1[1]['meter']}}</td>
                        <td>{{$type1[1]['amount']}}</td>
                        <td>{{$type1[1]['text']}}</td>
                        <td>{{$type1[1]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type1[1]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type1) > 2) {
                    if ($type1[2]) { ?>
                        <td>{{$type1[2]['wide']}}</td>
                        <td>{{$type1[2]['long']}}</td>
                        <td>{{$type1[2]['meter']}}</td>
                        <td>{{$type1[2]['amount']}}</td>
                        <td>{{$type1[2]['text']}}</td>
                        <td>{{$type1[2]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type1[2]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type1) > 3) {
                    if ($type1[3]) { ?>
                        <td>{{$type1[3]['wide']}}</td>
                        <td>{{$type1[3]['long']}}</td>
                        <td>{{$type1[3]['meter']}}</td>
                        <td>{{$type1[3]['amount']}}</td>
                        <td>{{$type1[3]['text']}}</td>
                        <td>{{$type1[3]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type1[3]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>

            <!-- ป้ายประเภทที่ 2 (rowspan 6) -->
            <tr>
                <td rowspan="6" style="max-width:100px;">ภาษีป้ายมีอักษรไทย<br>ปนอักษรต่างประเทศ<br>หรือเครื่องหมาย</td>
                <?php if (count($type2) > 0) {
                    if ($type2[0]) { ?>
                        <td>{{$type2[0]['wide']}}</td>
                        <td>{{$type2[0]['long']}}</td>
                        <td>{{$type2[0]['meter']}}</td>
                        <td>{{$type2[0]['amount']}}</td>
                        <td>{{$type2[0]['text']}}</td>
                        <td>{{$type2[0]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type2[0]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type2) > 1) {
                    if ($type2[1]) { ?>
                        <td>{{$type2[1]['wide']}}</td>
                        <td>{{$type2[1]['long']}}</td>
                        <td>{{$type2[1]['meter']}}</td>
                        <td>{{$type2[1]['amount']}}</td>
                        <td>{{$type2[1]['text']}}</td>
                        <td>{{$type2[1]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type2[1]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type2) > 2) {
                    if ($type2[2]) { ?>
                        <td>{{$type2[2]['wide']}}</td>
                        <td>{{$type2[2]['long']}}</td>
                        <td>{{$type2[2]['meter']}}</td>
                        <td>{{$type2[2]['amount']}}</td>
                        <td>{{$type2[2]['text']}}</td>
                        <td>{{$type2[2]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type2[2]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type2) > 3) {
                    if ($type2[3]) { ?>
                        <td>{{$type2[3]['wide']}}</td>
                        <td>{{$type2[3]['long']}}</td>
                        <td>{{$type2[3]['meter']}}</td>
                        <td>{{$type2[3]['amount']}}</td>
                        <td>{{$type2[3]['text']}}</td>
                        <td>{{$type2[3]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type2[3]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type2) > 4) {
                    if ($type2[4]) { ?>
                        <td>{{$type2[4]['wide']}}</td>
                        <td>{{$type2[4]['long']}}</td>
                        <td>{{$type2[4]['meter']}}</td>
                        <td>{{$type2[4]['amount']}}</td>
                        <td>{{$type2[4]['text']}}</td>
                        <td>{{$type2[4]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type2[4]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type2) > 5) {
                    if ($type2[5]) { ?>
                        <td>{{$type2[5]['wide']}}</td>
                        <td>{{$type2[5]['long']}}</td>
                        <td>{{$type2[5]['meter']}}</td>
                        <td>{{$type2[5]['amount']}}</td>
                        <td>{{$type2[5]['text']}}</td>
                        <td>{{$type2[5]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type2[5]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>


            <!-- ป้ายประเภทที่ 3 (rowspan 4) -->
            <tr>
                <td rowspan="4">ภาษีป้ายที่ไม่มีอักษรไทย</td>
                <?php if (count($type3) > 0) {
                    if ($type3[0]) { ?>
                        <td>{{$type3[0]['wide']}}</td>
                        <td>{{$type3[0]['long']}}</td>
                        <td>{{$type3[0]['meter']}}</td>
                        <td>{{$type3[0]['amount']}}</td>
                        <td>{{$type3[0]['text']}}</td>
                        <td>{{$type3[0]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type3[0]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type3) > 1) {
                    if ($type3[1]) { ?>
                        <td>{{$type3[1]['wide']}}</td>
                        <td>{{$type3[1]['long']}}</td>
                        <td>{{$type3[1]['meter']}}</td>
                        <td>{{$type3[1]['amount']}}</td>
                        <td>{{$type3[1]['text']}}</td>
                        <td>{{$type3[1]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type3[1]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type3) > 2) {
                    if ($type3[2]) { ?>
                        <td>{{$type3[2]['wide']}}</td>
                        <td>{{$type3[2]['long']}}</td>
                        <td>{{$type3[2]['meter']}}</td>
                        <td>{{$type3[2]['amount']}}</td>
                        <td>{{$type3[2]['text']}}</td>
                        <td>{{$type3[2]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type3[2]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>
            <tr>
                <?php if (count($type3) > 3) {
                    if ($type3[3]) { ?>
                        <td>{{$type3[3]['wide']}}</td>
                        <td>{{$type3[3]['long']}}</td>
                        <td>{{$type3[3]['meter']}}</td>
                        <td>{{$type3[3]['amount']}}</td>
                        <td>{{$type3[3]['text']}}</td>
                        <td>{{$type3[3]['place']}} วันที่ติดตั้ง {{DateTimeThai($type1[0]['date'])}}</td>
                        <td>{{$type3[3]['remark']}}</td>
                    <?php }
                } else { ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <?php } ?>
            </tr>

        </tbody>
    </table>
    <div class="box_text" style="text-align: right;">
        <span>ข้าพเจ้าขอรับรองว่ารายการที่แจ้งไว้ในแบบนี้ถูกต้องและครบถ้วนตาความจริงทุกประการ</span><br>
        <span>วันที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertDay($form->created_at)}}</span>
        <span>เดือน</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{convertMonthsToThai($form->created_at)}}</span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{convertYear($form->created_at)}}</span><br>
        <span>ลงชื่อ</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form['details']->salutation}} {{$form['details']->full_name}}</span><span>เจ้าของป้าย</span>
    </div>
</body>

</html>
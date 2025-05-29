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

<body>
    <div class="box_text" style="font-weight: bold; text-align: right;">
        <span>03-30-05</span>
    </div>
    <div class="box_text" style="font-weight: bold; margin-top:3rem;">
        <span style="font-size: 35px;">เรื่องราวขอรับใบอณุญาตตั้งตลาดเอกชน</span>
    </div>
    <div class="box_text" style="font-weight: bold; text-align: right; margin-top:2rem; ">
        <table width="100%" style="margin-top: 1rem;">
            <tr>
                <!-- ฝั่งซ้าย -->
                <td style="width: 40%; vertical-align: top;">
                    <div style="border: 1px solid #000; padding: 1rem 0.5rem; display: inline-block;">
                        ปิดอากร
                    </div>
                </td>

                <!-- ฝั่งขวา -->
                <td style="width: 60%; text-align: right; vertical-align: top;">
                    <span>เขียนที่</span>
                    <span class="dotted-line" style="width: 40%; text-align: center; line-height: 1;"></span>
                    <br>
                    <span>วันที่</span>
                    <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                    <span>เดือน</span>
                    <span class="dotted-line" style="width: 18%; text-align: center; line-height: 1;"></span>
                    <span>พ.ศ.</span>
                    <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                </td>
            </tr>
        </table>
        <span style="margin-top: 2rem;">ข้าพเจ้า</span>
        <span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;"></span>
        <span>อายุ</span>
        <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"></span>
        <span>ปี สัญชาติ</span>
        <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"></span>
    </div>
    <div class="box_text" style="font-weight: bold; text-align: left; ">
        <span >บังคับ</span>
        <span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;"></span>
        <span >อยู่บ้านเลขที่</span>
        <span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;"></span>
        <span >ถนน</span>
        <span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;"></span>
        <span >หมู่ที่</span>
        <span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;"></span>
        <span >ตำบล</span>
        <span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;"></span>
        <span >อำเภอ</span>
        <span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;"></span>
        <span >จังหวัด</span>
        <span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;"></span>
    </div>
    <div class="box_text" style="font-weight: bold; text-align: left; ">
        <div style="margin-left: 9rem;">
            <span >ขอยื่นเรื่องราวต่อ</span>
            <span class="dotted-line" style="width: 57%; text-align: center; line-height: 1;"></span>
            <span >เพื่อขออนุญาตใช้สถานที่</span>
        </div>
        <span >ซึ่งตั้งอยู่ ถนน</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;"></span>
        <span >เลขที่</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;"></span>
        <span >ตำบล</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;"></span>
        <span >อำเภอ</span>
        <span class="dotted-line" style="width: 17%; text-align: center; line-height: 1;"></span>
        <span >จังหวัด</span>
        <span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;"></span>
        <span >เพื่อใช้เป็นตลาดเอกชนประจำปี</span>
        <span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;"></span>
        <span>ได้แนบแผนผังแบบ</span>
        <span>ก่อสร้างและรายการปลูกสร้างมาพร้อมกับเรื่องราวนี้ด้วยแล้ว</span>
        <div style="margin-left: 9rem;">
            <span>ข้าพเจ้าขอรับรองว่าจะปฎิบัติตามเทศบัญญัติ ข้อบังคับและเงื่อนไขที่ได้วางไว้ทุกประการ</span>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:7rem; position: relative;">
            <span>(ลงนาม)</span>
            <span class="dotted-line" style="width: 35%; text-align: center;"></span>
    </div>
    <hr style=" margin-top:2rem;">
    <div class="box_text" style="font-weight: bold; text-align: left; margin-top:2rem;">
        <div style="margin-left: 9rem;">
            <span>เจ้าหน้าที่ผู้มีนามข้างท้าย ได้รับเรื่องราวเลขที่</span>
            <span class="dotted-line" style="width: 15%; text-align: center;"></span>
            <span>ลง</span>
            <span class="dotted-line" style="width: 37%; text-align: center;"></span>
        </div>
        <span>เรื่อง ขออนุญาตตั้งตลาดเอกชน จาก</span>
        <span class="dotted-line" style="width: 60%; text-align: center;"></span>
        <span>แล้ว</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:7rem; margin-right:1rem; position: relative;">
            <span class="dotted-line" style="width: 35%; text-align: center;"></span>
            <span>ผู้รับ</span> <br>
            <span class="dotted-line" style="width: 30%; text-align: center; margin-right:2rem;">ทดลอง</span>
    </div>
</body>


</html>

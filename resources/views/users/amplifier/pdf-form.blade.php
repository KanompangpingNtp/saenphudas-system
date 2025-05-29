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
            font-size: 20px;
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
            border: 0px solid rgb(255, 255, 255);
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
            padding-left: 5px;
            padding-right: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
            text-align: left;
            ;
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

            overflow-wrap: break-word;
        }

        .footer {
            position: absolute;
            /* ทำให้ footer ยึดที่ด้านล่าง */
            bottom: -50px;
            font-size: 23px;
            /* ตั้งให้ footer อยู่ที่ด้านล่างสุดของหน้ากระดาษ */
            width: 100%;
            /* ให้ footer กว้างเต็มหน้ากระดาษ */
            text-align: center;
            /* จัดข้อความให้ตรงกลาง */
            padding: 5px 0;
            /* เพิ่มพื้นที่ด้านบนและล่างให้กับ footer */
        }

        .title_doc {
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .title_table {
        width: 100%;
        text-align: center;
    }

    .title_table td {
        vertical-align: top;
    }

    .logo {
        height: 100px;
    }
    </style>
</head>

<body>
    <div class="title_doc">
        <table class="title_table">
            <tr>
                <td style="width: 20%; text-align: left;"><span style="margin-left: 0.7rem;">ปิด</span><br>แสตมป์<br><span style="margin-left: 0.4rem;">อากร</span></td>
                <td style="width: 60%;">
                    <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/ครุฑ.png'))) }}" alt="Logo">
                </td>
                <td style="width: 20%; text-align: right;">05-30-01 <br>(แบบ ฆ.ษ.๑)</td>
            </tr>
        </table>
        <div class="box_text" style="font-weight: bold; text-align: center; margin-top:1rem;">
            <span style="font-size: 35px; text-decoration:underline;">คำร้องขออนุญาตทำการโฆษณาโดยใช้เครื่องขยายเสียง</span>
        </div>
        <div class="box_text" style=" text-align: right; margin-top:1rem;">
            <span>เขียนที่</span>
            <span class="dotted-line" style="width: 40%; text-align: center; line-height: 1;"></span>
            <br>
            <span>วันที่</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
            <span>เดือน</span>
            <span class="dotted-line" style="width: 18%; text-align: center; line-height: 1;"></span>
            <span>พ.ศ.</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
        </div>
        <div class="box_text" style=" text-align: left;">
            <div style="margin-left: 4rem;">
                <span>ข้าพเจ้า (ชื่อและนามสกุล)</span>
                <span class="dotted-line" style="width: 59%; text-align: center; line-height: 1;"></span>
                <span>อายุ</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span>ปี</span>
            </div>
            <span>เชื้อชาติ</span>
            <span class="dotted-line" style="width: 14.3%; text-align: center; line-height: 1;"></span>
            <span>สัญชาติ</span>
            <span class="dotted-line" style="width: 14.3%; text-align: center; line-height: 1;"></span>
            <span>อยู่บ้านเลขที่</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
            <span>หมู่ที่</span>
            <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
            <span>ถนน</span>
            <span class="dotted-line" style="width: 14.3%; text-align: center; line-height: 1;"></span>
            <span>ตำบล</span>
            <span class="dotted-line" style="width: 22.4%; text-align: center; line-height: 1;"></span>
            <span>อำเภอ</span>
            <span class="dotted-line" style="width: 22.4%; text-align: center; line-height: 1;"></span>
            <span>จังหวัด</span>
            <span class="dotted-line" style="width: 22.4%; text-align: center; line-height: 1;"></span>
            <span>เป็นผู้ครอบครอง</span>
            <span>เครื่องขยายเสียงเลขหมายทะเบียนที่</span>
            <span class="dotted-line" style="width: 30%; text-align: center; line-height: 1;"></span>
            <span>ไมโครโฟนแลขหมายทะเบียนที่</span>
            <span>และเครื่องบันทึกเสียงเลขหมายทะเบียนที่</span>
            <span class="dotted-line" style="width: 38%; text-align: center; line-height: 1;"></span>
            <span>ขอทำคำร้องยื่นต่อเจ้าพนักงานผู้ออก</span>
            <span>ใบอณุญาตมีข้อความดังต่อไปนี้ :-</span>
            <div style="margin-left: 4rem;">
                <span>ข้อ ๑. ข้าพเจ้ามีความประสงค์จะใช้เครื่องดังกล่าวมานั้นเพื่อทำการโฆษณากิจการ</span>
                <div style="margin-left: -4rem;">
                    <span class="dotted-line" style="width: 100%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>ณ ที่</span>
                    <span class="dotted-line" style="width: 19.7%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>เลขที่</span>
                    <span class="dotted-line" style="width: 19.7%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>หมู่ที่</span>
                    <span class="dotted-line" style="width: 19.7%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>ถนน</span>
                    <span class="dotted-line" style="width: 19.7%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>ตำบล</span>
                    <span class="dotted-line" style="width: 26.9%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>อำเภอ</span>
                    <span class="dotted-line" style="width: 26.9%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>จังหวัด</span>
                    <span class="dotted-line" style="width: 26.9%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>มีกำหนด</span>
                    <span class="dotted-line" style="width: 22%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>วัน ตั้งแต่วันนที่</span>
                    <span class="dotted-line" style="width:11.8%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>เดือน</span>
                    <span class="dotted-line" style="width: 22%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>พ.ศ.</span>
                    <span class="dotted-line" style="width:11.8%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>ถึงวันที่</span>
                    <span class="dotted-line" style="width:11.8%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>เดือน</span>
                    <span class="dotted-line" style="width: 22%; text-align: center; line-height: 1;">ทดลอง</span>
                    <span>พ.ศ.</span>
                    <span class="dotted-line" style="width:11.8%; text-align: center; line-height: 1;">ทดลอง</span>
                </div>
                <span>ข้อ ๒. ข้าพเจ้ารับรองว่าจะปฎิบัติให้ถูกต้องตามกฎหมาย กฏข้อบังคับและเงื่อนไขว่าด้วยการควบคุมการโฆษณา</span>
                <div style="margin-left: -4rem;">
                    <span>โดยเครื่องขยายเสียงทุกประการ</span>
                </div>
                <span>ข้อ ๓. ข้าพเจ้าได้แนบใบอนุญาตให้มิเพื่อใช้ฯ ซึ่งมีเลขหมายทะเบียนตามที่แจ้งในคำร้องนี้รวม</span>
                <span class="dotted-line" style="width:15%; text-align: center; line-height: 1;">ทดลอง</span>
                <span>ฉบับ</span>
            </div>
            <span>มาเพื่อประกอบการพิจารณาด้วยแล้ว</span>
        </div>
        <div class="box_text" style=" text-align: right; margin-top:1rem;">
            <span>(ลงชื่อ)</span>
            <span class="dotted-line" style="width:30%; text-align: center; line-height: 1;">ทดลอง</span>
            <span>ผู้ยื่นคำร้อง</span>
        </div>
        <div class="box_text" style=" text-align: left; margin-top:1rem;">
            <span>เสนอ เจ้าพนักงานผู้ออกใบอนุญาต</span>
            <div style="margin-left: 4rem;">
                <span>ข้าพเจ้าได้พิจารณาแล้วเห็นว่า</span>
                <span class="dotted-line" style="width:73%; text-align: center; line-height: 1;">ทดลอง</span>
            </div>
        </div>
        <div class="box_text" style=" text-align: right; margin-top:2rem;">
            <span>(ลงชื่อ)</span>
            <span class="dotted-line" style="width:30%; text-align: center; line-height: 1;">ทดลอง</span><br>
            <span>(</span>
            <span class="dotted-line" style="width:30%; text-align: center; line-height: 1;">ทดลอง</span>
            <span>)</span><br>
            <span>(ตำแหน่ง)</span>
            <span class="dotted-line" style="width:30%; text-align: center; line-height: 1;">ทดลอง</span><br>
            <span>วันที่</span>
            <span class="dotted-line" style="width:8%; text-align: center; line-height: 1;"></span>
            <span>/</span>
            <span class="dotted-line" style="width:8%; text-align: center; line-height: 1;"></span>
            <span>/</span>
            <span class="dotted-line" style="width:8%; text-align: center; line-height: 1;"></span>
        </div>
    </div>
    <div class="box_text" style="font-weight: bold; text-align: center; margin-top:1rem;">
        <table width="100%" cellspacing="0" cellpadding="5" style="margin-top:10rem; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 50%; text-align: center; text-decoration:underline;">บันทึกของเจ้าหน้าที่ตรวจสอบ (แผนกประชาสัมพันธ์)</th>
                    <th style="width: 50%; text-align: center; text-decoration:underline;">คำสั่งเจ้าพนักงานผู้ออกใบอนนุญาต</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border-bottom: 1px solid #000; padding: 10px;">
                        <span>เสนอ จ.ผ.ว.</span><br>
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <div style="text-align: right;">
                            <span>(ลงชื่อ)</span>
                            <span class="dotted-line" style="width:70%; text-align: center; line-height: 1;">ทดลอง</span><br>
                            <span>วันที่</span>
                            <span class="dotted-line" style="width:15%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:25%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:15%; text-align: center; line-height: 1;"></span>
                        </div>
                    </td>
                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; padding: 10px;">
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <span class="dotted-line" style="width:100%; text-align: center; line-height: 1;">ทดลอง</span>
                        <div style="text-align: right;">
                            <span>(ลงชื่อ)</span>
                            <span class="dotted-line" style="width:70%; text-align: center; line-height: 1;">ทดลอง</span><br>
                            <span>วันที่</span>
                            <span class="dotted-line" style="width:15%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:25%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:15%; text-align: center; line-height: 1;"></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="box_text" style="font-weight: bold; text-align: center; margin-top:1rem;">
            <span style="font-size: 35px; text-decoration:underline;">สำหรับพนักงานเจ้าหน้าที่</span>
        </div>
        <div class="box_text" style="text-align: left; margin-top:1rem;">
            <div style="margin-left:4rem;">
                <span>ได้ออกใบอนุญาตให้ทำการโฆษณาโดยใช้เครื่องขยายเสียงเลขที่</span>
                <span class="dotted-line" style="width:45%; text-align: center; line-height: 1;"></span>
            </div>
            <span>และได้รับค่าธรรมเนียม</span>
            <span class="dotted-line" style="width:24%; text-align: center; line-height: 1;"></span>
            <span>บาท ตามใบอนุญาตเลขที่</span>
            <span class="dotted-line" style="width:24%; text-align: center; line-height: 1;"></span>
            <span>ไว้ถูกต้องแล้ว</span>
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-top: 8rem;">
            <thead>
                <tr>
                    <th style="width: 50%; text-align: center;"></th>
                    <th style="width: 50%; text-align: center;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="text-align: right;">
                            <span>(ลงชื่อ)</span>
                            <span class="dotted-line" style="width:70%; text-align: center; line-height: 1;">ทดลอง</span><br>
                            <span style="margin-right: 6rem;">ผู้รับเงิน</span><br>
                            <span>วันที่</span>
                            <span class="dotted-line" style="width:12%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:20%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:12%; text-align: center; line-height: 1;"></span>
                        </div>
                    </td>
                    <td>
                        <div style="text-align: right;">
                            <span>(ลงชื่อ)</span>
                            <span class="dotted-line" style="width:70%; text-align: center; line-height: 1;">ทดลอง</span><br>
                            <span style="margin-right: 6rem;">เจ้าหน้าที่</span><br>
                            <span>วันที่</span>
                            <span class="dotted-line" style="width:12%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:20%; text-align: center; line-height: 1;"></span>
                            <span>/</span>
                            <span class="dotted-line" style="width:12%; text-align: center; line-height: 1;"></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

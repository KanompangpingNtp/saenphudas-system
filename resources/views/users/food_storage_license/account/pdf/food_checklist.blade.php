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

<body>
    <div class="box_text" style="font-weight: bold;">
        <span>แบบตรวจสถานที่จำหน่ายอาหารและสะสมอาหาร</span><br>
        <span>กองสาธารณสุขและสิ่งแวดล้อม เทศบาลตำบลแสนภูดาษ</span>
    </div>
    <div class="box_text" style="text-align: left; margin-top:1rem;">
        <div>
            <span style="font-weight: bold;">1. ประเภทกิจการ</span>
            <input type="checkbox" style="margin-left: 34px; margin-right: 5px;">
            <span>จำหน่ายอาหาร</span>
            <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
            <span>สะสมอาหาร</span>
        </div>
        <div style="margin-top: -8px;">
            <span style="font-weight: bold;">2. ประเภทการตรวจ</span>
            <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
            <span>ขออณุญาตใหม่</span>
            <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
            <span>ต่ออายุใบอนุญาต</span>
        </div>
        <div style="margin-top: -8px;">
            <span style="font-weight: bold;">3. ชื่อสถานประกอบกิจการ</span>
            <span class="dotted-line" style="width: 78%; text-align: center; line-height: 1;">{{$form->full_name}}</span>
            <div style="margin-left: 1rem; margin-top: -5px;">
                <span>ชื่อผู้ประกอบการ/เจ้าของ</span>
                <span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;">{{$form->full_name}}</span>
                <span>ชื่อผู้จัดการ</span>
                <span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;">{{$form->full_name}}</span>
            </div>
        </div>
        <div style="margin-top: -8px;">
            <span style="font-weight: bold;">4. สถานที่ตั้งเลขที่</span>
            <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"></span>
            <span>หมู่</span>
            <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"></span>
            <span>ซอย</span>
            <span class="dotted-line" style="width: 6%; text-align: center; line-height: 1;"></span>
            <span>ถนน</span>
            <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"></span>
            <span>ตำบลแสนภูดาษ</span>
            <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"></span>
            <span>อำเภอบ้านโพธิ์</span>
            <span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;"></span>
            <div style="margin-left: 1rem; margin-top: -5px;">
                <span>จังหวัดฉะเชิงเทรา</span>
                <span>หมายเลขติดต่อ</span>
                <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"></span>
                <span>โทรศัพท์</span>
                <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"></span>
                <span>โทรสาร</span>
                <span class="dotted-line" style="width: 15%; text-align: center; line-height: 1;"></span>
            </div>
        </div>
        <div style="margin-top: -4px;">
            <span style="font-weight: bold;">5. ลักษณะอาคารประกอบการ</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>อาคารเอกเทศ</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>ห้องแถว</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>อาคารพักอาศัย</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>ตึกแถว</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>ตึกแถวไม้</span>
            <div style="margin-left: 1rem; margin-top: -5px;">
                <span>จำนวน</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span>ชั้น</span>
                <span style="margin-left: 40px;">ประกอบกิจการชั้นที่</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span style="margin-left: 40px;">พื้นที่ประกอบกิจการ</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span>ตร.ม</span>
            </div>
        </div>
        <div style="margin-top: -8px;">
            <table cellspacing="0" cellpadding="2" width="100%" style="margin-top: 0.8rem; line-height: 0.4">
                <thead>
                    <tr>
                        <th style="text-align: left;" width="80%">6. การสุขาภิบาลทั่วไป</th>
                        <th width="10%">มี</th>
                        <th width="10%">ไม่มี</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีทางระบายน้ำหรือบ่อรับน้ำโสโครกที่ทำด้วยวัสดุถาวร เรียบ ไม่รั่ว ไม่ซึม ระบายน้ำได้สะดวก</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;"> - มีระบบบำบัดน้ำเสียหรือไม่ (ถ้ามีระบายน้ำเสียไปสู่ที่ใด<span class="dotted-line" style="width: 40%; text-align: center; line-height: 1;"></span>)</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;"> - มีบ่อพักและบ่อดักไขมันที่ถูกต้องตามหลักสุขาภิบาลหรือไม่</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;"> - มีอ่างล้างภาชนะและอุปกรณ์ที่ถูกต้องตามหลักสุขาภิบาลหรือไม่</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                </tbody>
            </table>
            <table cellspacing="0" cellpadding="2" width="100%" style="margin-top: 0.3rem; line-height: 0.4">
                <thead>
                    <tr>
                        <th width="80%"></th>
                        <th width="10%">เพียงพอ</th>
                        <th width="10%">ไม่เพียงพอ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีแสงสว่างและการระบายอากาศเพียงพอหรือไม่</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีที่รองรับขยะมูลฝอยและสิ่งปฏิกูลที่ถูกสุขลักษณะและเพียงพอหรือไม่</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีอ่างล้างมือที่ถูกสุขลักษณะและมีสบู่ใช้เพียงพอหรือไม่</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีห้องน้ำ ห้องส้วม ที่ถูกสุขลักษณะและเพียงพอหรือไม่</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                </tbody>
            </table>
            <table cellspacing="0" cellpadding="2" width="100%" style="margin-top: 0.3rem; line-height: 0.4">
                <thead>
                    <tr>
                        <th width="80%"></th>
                        <th width="10%">ถูกต้อง</th>
                        <th width="10%">ไม่ถูกต้อง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีการจัดสถานที่ให้สะอาด เป็นระเบียบเรียบร้อย ไม่เป็นที่อยู่อาศัยของสัตว์นำโรค</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีการจัดโต๊ะ เก้าอี้ หรือที่นั่ง มีสภาพแข็งแรง สะอาดเป็นระเบียบเรียบร้อย</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 1.3rem;">- มีภาชนะอุปกรณ์เครื่องใช้ในการทำ ประกอบ ปรุง และบริโภค เพียงพอ ปลอดภัย <span style="margin-left: 0.5rem;">และถูกต้องด้วยสุขลักษณะตามเกณฑ์มาตรฐานหรือไม่</span></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin-top: -8px;">
            <span style="font-weight: bold;">7. สุขวิทยาส่วนบุคคลของผู้สัมผัสอาหาร (เฉพาะสถานที่จำหน่ายอาหาร)</span>
            <div style="margin-left: 1rem; margin-top: 0px;">
                <span>- ผู้สัมผัสอาหาร จำนวน</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span>คน</span>
                <span style="margin-left: 2rem;">ผู้ปรุง</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span>คน</span>
                <span style="margin-left: 2rem;">ผู้เสิร์ฟ</span>
                <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span>
                <span>คน</span>
            </div>
            <div style="margin-left: 1rem; margin-top: -4px;">
                <span>- มีการตรวจสุขภาพประจำปีหรือไม่</span>
                <input type="checkbox" style="margin-left: 30px; margin-right: 5px;">
                <span>มี</span>
                <input type="checkbox" style="margin-left: 80px; margin-right: 5px;">
                <span>ไม่มี</span>
            </div>
            <div style="margin-left: 1rem; margin-top: -4px;">
                <span>- การแต่งกายของผู้สัมผัสอาหาร</span>
                <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
                <span>สะอาด</span>
                <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
                <span>สวมเสื้อมีแขน</span>
                <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
                <span>ผูกผ้ากันเปื้อน</span>
                <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
                <span>สวมหมวกหรือเน็ตคลุมผม</span>
            </div>
            <div style="margin-left: 1rem; margin-top: -4px;">
                <span>- เคยผ่านการอบรมด้านสุขาภิบาลอาหารหรือไม่</span>
                <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
                <span>เคย</span>
                <input type="checkbox" style="margin-left: 20px; margin-right: 5px;">
                <span>ไม่เคย</span>
            </div>
        </div>
        <div style="margin-top: -6px;">
            <span style="font-weight: bold;">8. มีถังดับเพลิงอยู่ในสภาพสมบูรณ์ ไม่ชำรุด สามารถหยิบใช้งานได้ดี สะดวก และมีการตรวจสอบทุกปี</span>
            <input type="checkbox" style="margin-left: 30px; margin-right: 5px;">
            <span>มี</span>
            <input type="checkbox" style="margin-left: 30px; margin-right: 5px;">
            <span>ไม่มี</span>
        </div>
        <div style="margin-top: -6px;">
            <span style="font-weight: bold;">9. สรุปผลการตรวจ</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>เห็นควรอนุญาต</span>
            <input type="checkbox" style="margin-left: 10px; margin-right: 5px;">
            <span>ไม่เห็นควรอนุญาต เนื่องจาก</span>
            <span class="dotted-line" style="width: 40%; text-align: center; line-height: 1;"></span>
        </div>
        <div style="margin-top: -5px;">
            <span style="font-weight: bold;">10. ข้อสรุปแนะนำของเจ้าหน้าที่ผู้ตรวจ</span>
            <span class="dotted-line" style="width: 68%; text-align: center; line-height: 1;"></span>
        </div>
        <div class="box_text" style="margin-top: 20px;">
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <!-- ฝั่งซ้าย -->
                    <td style="width: 50%; vertical-align: middle;">
                        <div>
                            <span>ลงชื่อ</span>
                            <span style="display: inline-block; width: 40%; border-bottom: 1px dotted #000;"></span>
                            <span>ผู้ประกอบการ/ผู้รับตรวจ</span>
                            <br>
                            <span style="margin-left: 25px;">(</span>
                            <span style="display: inline-block; width: 40%; border-bottom: 1px dotted #000;"></span>
                            <span>)</span>
                        </div>
                    </td>

                    <!-- ฝั่งขวา -->
                    <td style="width: 40%; vertical-align: top; border:1px solid #000; padding:5px;">
                        <div>
                            <span>1. ลายมือชื่อ</span>
                            <span style="display: inline-block; width: 45%; border-bottom: 1px dotted #000;"></span>
                            <span>ผู้ตรวจ</span>
                            <br>
                            <span style="margin-left: 12px;">(</span>
                            <span style="display: inline-block; width: 40%; border-bottom: 1px dotted #000;"></span>
                            <span>) ว/ด/ป</span>
                            <span style="display: inline-block; width: 30%; border-bottom: 1px dotted #000;"></span>
                            <br>
                            <span>ตำแหน่ง</span>
                            <span style="display: inline-block; width: 60%; border-bottom: 1px dotted #000;"></span>
                            <br><span>2. ลายมือชื่อ</span>
                            <span style="display: inline-block; width: 45%; border-bottom: 1px dotted #000;"></span>
                            <span>ผู้ตรวจ</span>
                            <br>
                            <span style="margin-left: 12px;">(</span>
                            <span style="display: inline-block; width: 40%; border-bottom: 1px dotted #000;"></span>
                            <span>) ว/ด/ป</span>
                            <span style="display: inline-block; width: 30%; border-bottom: 1px dotted #000;"></span>
                            <br>
                            <span>ตำแหน่ง</span>
                            <span style="display: inline-block; width: 60%; border-bottom: 1px dotted #000;"></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>

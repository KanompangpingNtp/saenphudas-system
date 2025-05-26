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
            /* ห่อข้อความที่ยาวเกิน */
            overflow-wrap: break-word;
            /* รองรับ browser อื่น */
        }
    </style>
</head>

<body>
    <div class="box_text" style="text-align: center; font-weight: bold;">
        <span>แบบขอรับการประเมินค่าธรรมเนียมการกำจัดสิ่งปฏิกูลและมูลฝอย</span><br>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0.5rem;">
        <span>เขียนที่</span><span class="dotted-line" style="width: 30%; text-align: center; line-height: 1;"></span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0.5rem; margin-right:8rem;">
        <span>วันที่</span><span class="dotted-line"
            style="width: 35%; text-align: center; line-height: 1;">{{ $form->created_at }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เรื่อง ขอรับบริการจัดเก็บขยะมูลฝอย</span><br>
        <span>เรียน นายกเทศมลตรีตำบลแสนภูดาษ</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span>ข้าพเจ้า</span><span class="dotted-line"
            style="width: 46%; text-align: center; line-height: 1;">{{ $form->salutation }} {{ $form->name }}</span>
        <span>อยู่บ้านเลขที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->address }}</span>
        <span>หมู่ที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->village }}</span>
        <span>ตำบล</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->sub_district }}</span>
        <div class="box_text" style="text-align: left; margin-left:-2rem;">
            <span>อำเภอ</span><span class="dotted-line"
                style="width: 15%; text-align: center; line-height: 1;">{{ $form->district }}</span>
            <span>จังหวัด</span><span class="dotted-line"
                style="width: 15%; text-align: center; line-height: 1;">{{ $form->province }}</span>
            <span>เบอร์โทรศัพท์</span><span class="dotted-line"
                style="width: 15%; text-align: center; line-height: 1;">{{ $form->phone }}</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span class="font-weight: bold;">โปรดขีดเครื่องหมาย / ลงใน ()
            หน้าข้อความที่ตรงกับประเภทของสถานที่จัดเก็บขยะมูลฝอยของท่าน</span>
        <div class="box_text" style="text-align: left; margin-left:-2rem;">
            <span>
                <input type="checkbox" {{ $form->optione == 1 ? 'checked' : '' }}> บ้านที่อยู่อาศัย
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 2 ? 'checked' : '' }}> บ้านเช่า / อาคารให้เช่า
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 3 ? 'checked' : '' }}> ร้านค้า
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 4 ? 'checked' : '' }}> โรงงาน / ประกอบธุรกิจ
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 5 ? 'checked' : '' }}> อื่นๆ โปรดระบุ
            </span>
            <span class="dotted-line"
                style="width: 22%; text-align: center; line-height: 1;">{{ $form->optione_detail }}</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span>มีความประสงค์จะขอรับบริการจัดเก็บขยะมูลฝอย กับเทศบาลตำบลแสนภูดาษ ณ บ้านเลขที่</span><span
            class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{ $form->address }}</span>
        <span>หมู่ที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->village }}</span>
        <span>ตำบลแสนภูดาษ</span>
        <div class="box_text" style="text-align: left; margin-left:-2rem;">
            <span>อำเภอบ้านโพธิ์ จังหวัดฉะเชิงเทรา เบอร์โทรศัพท์</span><span class="dotted-line"
                style="width: 20%; text-align: center; line-height: 1;">{{ $form->phone }}</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span style="font-weight: bold; text-decoration:underline; ">"โดยข้าพเจ้ามีข้อตกลงกับเทศบาลตำบลแสนภูดาษ
            ดังนี้"</span>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span style="font-weight: bold; text-decoration:underline;">๑.ข้าพเจ้าฯ
                จะให้ความร่วมมือในการนำขยะมูลฝอยใส่ถุงดำหรือถุงบรรจุอื่นๆ</span>
            <span> และมัดปากถุงให้แน่นหนา พร้อมทั้งนำขยะมูลฝอยไปทิ้ง ตามวัน เวลา </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: -2rem; margin-top:-0.7rem;">
            <span>ที่เทศบาลตำบลแสนภูดาษ ได้กำหนดไว้</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span style="font-weight: bold; text-decoration:underline;">๒.ข้าพเจ้าฯ รับทราบว่าเทศบาลตำบลแสนภูดาษ
                ไม่รับกำจัดสิ่งต่อไปนี้ (ไม่ใช่ขยะ)</span>
            <span> เศษวัสดุก่อสร้างทุกชนิด เช่น อิฐ หิน ปูน ทราบ กระเบื้อง โถส้วม</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: -2rem; margin-top:-0.7rem;">
            <span>โถปัสสาวะ ตู้เสื้อผ้า เตียงนอน ที่นอน ยางรถทุกชนิด กระจก กันชนรถ เสื้อผ้าเก่า รองเท้า ต้นไม้ หญ้า
                ซากสัตว์ ต่างๆ หรือสัตว์เลี้ยงที่ตายแล้ว เป็นต้น</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span>๓.ข้าพเจ้าฯ ยินดีชำระค่าธรรมเนียมการจัดเก็บขยะมูลฝอย ตามอัตราที่เทศบาลตำบลแสนภูดาษ
                ได้กำหนดไว้ในอัตรา</span>
            <span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;"></span><span>
                บาท/เดือน</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span>๔.พร้อมนี้ ข้าพเจ้าได้แนบสำเนาบัตรประจำตัวประชาชน จำนวน ๑ ฉบับ</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span>๕.เอกสารอื่นๆ</span><span class="dotted-line"
                style="width: 30%; text-align: center; line-height: 1;"></span>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:1rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center;">{{ $form->name }}</span>
        <span>ผู้ยื่นคำร้อง</span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line"
                style="width: 30%; text-align: center;">{{ $form->salutation }}&nbsp;{{ $form->name }}</span>
            <span>)</span>
        </div>
    </div>
    <div style="width: 100%; margin-top: 2rem;">
        <!-- ฝั่งซ้าย -->
        <div style="width: 48%; float: left; text-align: right;">
            <span>ลงชื่อ</span>
            <span class="dotted-line" style="display: inline-block; width: 60%; text-align: center;">

            </span>
            <span>ผู้รับคำร้อง</span>
            <div style="margin-right: 55px;">
                <span>(</span>
                <span class="dotted-line" style="display: inline-block; width: 60%; text-align: center;">

                </span>
                <span>)</span>
            </div>
        </div>

        <!-- ฝั่งขวา -->
        <div style="width: 48%; float: right; text-align: right;">
            <span>ลงชื่อ</span>
            <span class="dotted-line"
                style="margin-right: 55px; display: inline-block; width: 60%; text-align: center;">
                {{ $form->full_name }}
            </span>
            <div style="margin-right: 80px;">
                <span>(นายถวัลย์ณจักษณ์ สนพะเนา)</span>
            </div>
            <div style="margin-right: 50px;">
                <span>ผู้อำนวยการกองสาธารณสุขและสิ่งแวดล้อม</span>
            </div>
        </div>

        <div style="clear: both;"></div>
    </div>
    <div style="width: 100%; margin-top: 2rem;">
        <!-- ฝั่งซ้าย -->
        <div style="width: 48%; float: left; text-align: left; margin-left:2rem;">
            <span>- ความเห็นของรองปลัดฯ</span> <br>
            <span><input type="checkbox"> เห็นควรดำเนินการตามเสนอ</span><br>
            <span><input type="checkbox"> ไม่เห็นควรดำเนินการ เนื่องจาก</span>
            <span class="dotted-line" style="display: inline-block; width: 40%; text-align: center;">
        </div>

        <!-- ฝั่งขวา -->
        <div style="width: 48%; float: right; text-align: right; ">
            <span style="margin-right:6.5rem;">- ความเห็นนายกเทศมนตรีตำบลแสนภูดาษ</span> <br>
            <span style="margin-right:9.5rem;"><input type="checkbox"> เห็นควรดำเนินการตามเสนอ</span><br>
            <span><input type="checkbox"> ไม่เห็นควรดำเนินการ เนื่องจาก</span>
            <span class="dotted-line" style="display: inline-block; width: 40%; text-align: center;">
        </div>

        <div style="clear: both;"></div>
    </div>
    <div style="width: 100%; margin-top: 2rem;">
        <!-- ฝั่งซ้าย -->
        <div style="width: 48%; float: left; text-align: center; ">
            <span>(นางสาวกฤติญา งามระเบียบ)</span> <br>
            <span>รองปลัดเทศบาล รักษาราชการแทน</span><br>
            <span> ปลัดเทศบาลตำบลแสนภูดาษ</span>
        </div>

        <!-- ฝั่งขวา -->
        <div style="width: 48%; float: left; text-align: center; ">
            <span>(นายสุเทพ กรัสประพันธ์ุ)</span> <br>
            <span>นายกเทศมนตรีตำบลแสนภูดาษ</span><br>
        </div>

        <div style="clear: both;"></div>
    </div>
    {{-- new page --}}
    <div style="page-break-before: always;"></div>

    <div class="box_text" style="text-align: center; font-weight: bold;">
        แบบขอรับถังขยะมูลฝอยทั่วไป
    </div>
    <div class="box_text" style="text-align: right; margin-top:0.5rem;">
        <span>เขียนที่</span><span class="dotted-line" style="width: 30%; text-align: center; line-height: 1;"></span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0.5rem; margin-right:8rem;">
        <span>วันที่</span><span class="dotted-line"
            style="width: 35%; text-align: center; line-height: 1;">{{ $form->created_at }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เรื่อง ขอรับบริการจัดเก็บขยะมูลฝอย</span><br>
        <span>เรียน นายกเทศมลตรีตำบลแสนภูดาษ</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span>ข้าพเจ้า</span><span class="dotted-line"
            style="width: 46%; text-align: center; line-height: 1;">{{ $form->salutation }}
            {{ $form->name }}</span>
        <span>อยู่บ้านเลขที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->address }}</span>
        <span>หมู่ที่</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->village }}</span>
        <span>ตำบล</span><span class="dotted-line"
            style="width: 10%; text-align: center; line-height: 1;">{{ $form->sub_district }}</span>
        <div class="box_text" style="text-align: left; margin-left:-2rem;">
            <span>อำเภอ</span><span class="dotted-line"
                style="width: 15%; text-align: center; line-height: 1;">{{ $form->district }}</span>
            <span>จังหวัด</span><span class="dotted-line"
                style="width: 15%; text-align: center; line-height: 1;">{{ $form->province }}</span>
            <span>เบอร์โทรศัพท์</span><span class="dotted-line"
                style="width: 15%; text-align: center; line-height: 1;">{{ $form->phone }}</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span class="font-weight: bold;">โปรดขีดเครื่องหมาย / ลงใน ()
            หน้าข้อความที่ตรงกับประเภทของสถานที่จัดเก็บขยะมูลฝอยของท่าน</span>
        <div class="box_text" style="text-align: left; margin-left:-2rem;">
            <span>
                <input type="checkbox" {{ $form->optione == 1 ? 'checked' : '' }}> บ้านที่อยู่อาศัย
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 2 ? 'checked' : '' }}> บ้านเช่า / อาคารให้เช่า
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 3 ? 'checked' : '' }}> ร้านค้า
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 4 ? 'checked' : '' }}> โรงงาน / ประกอบธุรกิจ
            </span>
            <span>
                <input type="checkbox" {{ $form->optione == 5 ? 'checked' : '' }}> อื่นๆ โปรดระบุ
            </span>
            <span class="dotted-line" style="width: 22%; text-align: center; line-height: 1;">{{ $form->optione_detail }}</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span>โดยมีความประสงค์จะขอรับบริการ ขอถังขยะมูลฝอยทั่วไปเพื่อใช้กับบ้านเลขที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{ $form->address }}</span>
        <span>หมู่ที่</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;">{{ $form->village }}</span>
        <span>ตำบลแสนภูดาษ อำเภอบ้านโพธิ์</span>
        <div class="box_text" style="text-align: left; margin-left:-2rem; margin-top:-0.8rem;">
            <span>จังหวัดฉะเชิงเทรา</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-left:2rem; margin-top:1rem;">
        <span style="font-weight: bold; text-decoration:underline; ">"โดยข้าพเจ้ามีข้อตกลงกับเทศบาลตำบลแสนภูดาษ
            ดังนี้"</span>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span style="font-weight: bold; text-decoration:underline;">๑.ข้าพเจ้าฯ
                จะให้ความร่วมมือในการนำขยะมูลฝอยใส่ถุงดำหรือถุงบรรจุอื่นๆ</span>
            <span> และมัดปากถุงให้แน่นหนา พร้อมทั้งนำขยะมูลฝอยไปทิ้ง ตามวัน เวลา </span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: -2rem; margin-top:-0.7rem;">
            <span>ที่เทศบาลตำบลแสนภูดาษ ได้กำหนดไว้</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span style="font-weight: bold; text-decoration:underline;">๒.ข้าพเจ้าฯ รับทราบว่าเทศบาลตำบลแสนภูดาษ
                ไม่รับกำจัดสิ่งต่อไปนี้ (ไม่ใช่ขยะ)</span>
            <span> เศษวัสดุก่อสร้างทุกชนิด เช่น อิฐ หิน ปูน ทราบ กระเบื้อง โถส้วม</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left: -2rem; margin-top:-0.7rem;">
            <span>โถปัสสาวะ ตู้เสื้อผ้า เตียงนอน ที่นอน ยางรถทุกชนิด กระจก กันชนรถ เสื้อผ้าเก่า รองเท้า ต้นไม้ หญ้า
                ซากสัตว์ ต่างๆ หรือสัตว์เลี้ยงที่ตายแล้ว เป็นต้น</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span>๓.ข้าพเจ้าฯ ยินดีชำระค่าธรรมเนียมการจัดเก็บขยะมูลฝอย ตามอัตราที่เทศบาลตำบลแสนภูดาษ
                ได้กำหนดไว้ในอัตรา</span>
            <span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;"></span><span>
                บาท/เดือน</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span>๔.พร้อมนี้ ข้าพเจ้าได้แนบสำเนาบัตรประจำตัวประชาชน จำนวน ๑ ฉบับ</span>
        </div>
        <div class="box_text" style="text-align: left; margin-left:-0.3rem;">
            <span>๕.เอกสารอื่นๆ</span><span class="dotted-line"
                style="width: 30%; text-align: center; line-height: 1;"></span>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:1rem; position: relative;">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 30%; text-align: center;">{{ $form->name }}</span>
        <span>ผู้ยื่นคำร้อง</span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line"
                style="width: 30%; text-align: center;">{{ $form->salutation }}&nbsp;{{ $form->name }}</span>
            <span>)</span>
        </div>
    </div>
    <div style="width: 100%; margin-top: 2rem;">
        <!-- ฝั่งซ้าย -->
        <div style="width: 48%; float: left; text-align: right;">
            <span>ลงชื่อ</span>
            <span class="dotted-line" style="display: inline-block; width: 60%; text-align: center;">

            </span>
            <span>ผู้รับคำร้อง</span>
            <div style="margin-right: 55px;">
                <span>(</span>
                <span class="dotted-line" style="display: inline-block; width: 60%; text-align: center;">

                </span>
                <span>)</span>
            </div>
        </div>

        <!-- ฝั่งขวา -->
        <div style="width: 48%; float: right; text-align: right;">
            <span>ลงชื่อ</span>
            <span class="dotted-line"
                style="margin-right: 55px; display: inline-block; width: 60%; text-align: center;">
                {{ $form->full_name }}
            </span>
            <div style="margin-right: 80px;">
                <span>(นายถวัลย์ณจักษณ์ สนพะเนา)</span>
            </div>
            <div style="margin-right: 50px;">
                <span>ผู้อำนวยการกองสาธารณสุขและสิ่งแวดล้อม</span>
            </div>
        </div>

        <div style="clear: both;"></div>
    </div>
    <div style="width: 100%; margin-top: 2rem;">
        <!-- ฝั่งซ้าย -->
        <div style="width: 48%; float: left; text-align: left; margin-left:2rem;">
            <span>- ความเห็นของรองปลัดฯ</span> <br>
            <span><input type="checkbox"> เห็นควรดำเนินการตามเสนอ</span><br>
            <span><input type="checkbox"> ไม่เห็นควรดำเนินการ เนื่องจาก</span>
            <span class="dotted-line" style="display: inline-block; width: 40%; text-align: center;">
        </div>

        <!-- ฝั่งขวา -->
        <div style="width: 48%; float: right; text-align: right; ">
            <span style="margin-right:6.5rem;">- ความเห็นนายกเทศมนตรีตำบลแสนภูดาษ</span> <br>
            <span style="margin-right:9.5rem;"><input type="checkbox"> เห็นควรดำเนินการตามเสนอ</span><br>
            <span><input type="checkbox"> ไม่เห็นควรดำเนินการ เนื่องจาก</span>
            <span class="dotted-line" style="display: inline-block; width: 40%; text-align: center;">
        </div>

        <div style="clear: both;"></div>
    </div>
    <div style="width: 100%; margin-top: 2rem;">
        <!-- ฝั่งซ้าย -->
        <div style="width: 48%; float: left; text-align: center; ">
            <span>(นางสาวกฤติญา งามระเบียบ)</span> <br>
            <span>รองปลัดเทศบาล รักษาราชการแทน</span><br>
            <span> ปลัดเทศบาลตำบลแสนภูดาษ</span>
        </div>

        <!-- ฝั่งขวา -->
        <div style="width: 48%; float: left; text-align: center; ">
            <span>(นายสุเทพ กรัสประพันธ์ุ)</span> <br>
            <span>นายกเทศมนตรีตำบลแสนภูดาษ</span><br>
        </div>

        <div style="clear: both;"></div>
    </div>
</body>

</html>

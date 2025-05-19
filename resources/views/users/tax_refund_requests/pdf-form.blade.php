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
            font-size: 18px;
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
    @php
    use Carbon\Carbon;

    $dated = Carbon::parse($form->dated);
    $dated_day = $dated->day;
    $dated_month = $dated->locale('th')->translatedFormat('F');
    $dated_year = $dated->year + 543;

    $created = Carbon::parse($form->created_at);
    $created_day = $created->day;
    $created_month = $created->locale('th')->translatedFormat('F');
    $created_year = $created->year + 543;
    @endphp

    <div class="box_text" style="text-align: right;">
        <span>ภ.ด.ส.๙</span>
    </div>
    <div class="box_text" style="text-align: center; font-weight: bold;">
        <span>คำร้องขอรับเงินนภาษีที่ดินและสิ่งปลูกสร้างคืน</span><br>
        <span>ตามมาตรา ๕๔ วรรคสอง แห่งพระราชบัญญัติภาษีที่ดินและสิ่งปลูกสร้าง พ.ศ. ๒๕๖๒</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0.5rem;">
        <span>วันที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$created_day}}</span>
        <span>เดือน</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$created_month}}</span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$created_year}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เรียน</span><span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;">นายกองค์การบริหารส่วนตำบลตลองอุดมชลจร</span>
        <div style="margin-left: 6rem;">
            <span>ข้าพเจ้า</span><span class="dotted-line" style="width: 50%; text-align: center; line-height: 1;">{{$form->salutation}}&nbsp;{{$form->full_name}}</span>
            <span>อยู่บ้านเลขที่</span><span class="dotted-line" style="width: 13%; text-align: center; line-height: 1;">{{$form->house_number}}</span>
            <span>หมู่ที่</span><span class="dotted-line" style="width: 13%; text-align: center; line-height: 1;">{{$form->village}}</span>
        </div>
        <span>ตรอก/ซอย</span><span class="dotted-line" style="width: 25.5%; text-align: center; line-height: 1;">{{$form->alley}}</span>
        <span>ถนน</span><span class="dotted-line" style="width: 25.5%; text-align: center; line-height: 1;">{{$form->road}}</span>
        <span>แขวง/ตำบล</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form->subdistrict}}</span>
        <span>เขต/อำเภอ</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form->district}}</span>
        <span>จังหวัด</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form->province}}</span>
        <span>โทรศัพท์</span><span class="dotted-line" style="width: 26%; text-align: center; line-height: 1;">{{$form->phone}}</span>
        <span>ได้ชำระเงินค่าภาษีที่ดินและสิ่งปลูกสร้าง ประจำปี พ.ศ.</span><span class="dotted-line" style="width: 25%; text-align: center; line-height: 1;">{{ $form->tax_year }}</span>
        <span>จำนวน</span><span class="dotted-line" style="width: 29%; text-align: center; line-height: 1;">{{$form->amount}}</span><span>บาท</span>
        <span>(</span><span class="dotted-line" style="width: 35%; text-align: center; line-height: 1;"></span><span>)</span>
        <span>ตามใบเสร็จรับเงินเลขที่</span><span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form->receipt_number}}</span>
        <span>ลงวันที่</span><span class="dotted-line" style="width: 19%; text-align: center; line-height: 1;">{{$dated_day}}&nbsp;{{$dated_month}}&nbsp;{{$dated_year}}</span>
        <span>(อาจมีกรณีมากกว่าใบเสร็จเดียว)</span>
        <div style="margin-left: 6rem; margin-top:1rem;">
            <span>มีความประสงค์ขอรับเงินภาษีที่ดินนและสิ่งปลูกสร้างที่จ่ายเกินคืน จำนวน</span>
            <span class="dotted-line" style="width: 33%; text-align: center; line-height: 1;">{{$form->tax_money}}</span>
            <span>บาท</span>
        </div>

        @php
        $dueToOptions = json_decode($form->due_to_options, true) ?? [];
        @endphp

        <span>เนื่องจาก</span>
        <input type="checkbox" style="margin: 0px 10px;" {{ in_array('option1', $dueToOptions) ? 'checked' : '' }}>
        <span>ไม่มีหน้าที่ต้องเสีย</span><br>
        <input type="checkbox" style="margin-left:60px; margin-right:10px;" {{ in_array('option2', $dueToOptions) ? 'checked' : '' }}>
        <span>เสียเกินกว่าที่ควรจะเสีย</span><br>
        <span>โดยได้ยื่นเอกสารเพื่อเป็นหลักฐานประกอบการพิจารณา ดังนี้</span>
        <div style="margin-left: 8rem;">
            <span>๑. ใบเสร็จรับเงินปีที่ผ่านมา หรือหลักฐานการชำระเงิน</span><br>
            <span>๒. หนังสือมอบอำนาจกรณียื่นคำร้องแทน</span><br>
            <span>๓. บัตรประจำตัวประชาชน</span><br>
            <span>๔. อื่นๆ</span><span class="dotted-line" style="width: 40%; text-align: center; line-height: 1;">{{$form->other_documents}}</span><br>
            <span>ขอรับรองว่า ข้อความข้างต้นเป็นจริงทุกประการ</span>
        </div>
    </div>
    <div class="box_text" style="text-align: right; margin-top:1rem; position: relative;">
        <span>(ลงชื่อ)</span>
        <span class="dotted-line" style="width: 30%; text-align: center;">{{$form->full_name}}</span>
        <span>ผู้ยื่นคำร้อง</span>
        <div style="margin-right: 55px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;">{{$form->salutation}}&nbsp;{{$form->full_name}}</span>
            <span>)</span>
        </div>
        <span>วันที่</span>
        <span class="dotted-line" style="width: 30%; text-align: center; margin-right: 55px;"></span>
    </div>
    <div style="width: 100%; border-bottom: 1px dotted #000; margin-top:5rem;"></div>
    <div class="box_text" style="text-align: left; margin-top:2rem;">
        <span>ได้รับคำร้องฉบับนี้</span><br>
        <span>แต่วันที่</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"></span>
    </div>
    <div class="box_text" style="text-align: left; margin-top:0rem; position: relative;">
        <span>(ลงชื่อ)</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"></span>
        <span>เจ้าหน้าที่ผู้รับคำร้อง</span>
        <div style="margin-left: 38px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-top:2rem;">
        <span>หมายเหตุ : ถ้าผู้เสียภาษีมิได้ยื่นคำร้องขอรับเงินคืนภายในสามปีนับแต่วันที่ชำระภาษี หรือไม่มารับเงินคืน</span><br>
        <span>ภายในหนึ่งปีนับแต่วันที่ได้รับแจ้ง ให้เงินนั้นตกเป็นขององค์กรปกครองส่วนท้องถิ่น</span>
    </div>
</body>
</html>

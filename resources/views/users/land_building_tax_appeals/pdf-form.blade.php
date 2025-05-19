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
            text-align: left;
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

    // dated
    $dated = Carbon::parse($form->dated);
    $dated_day = $dated->day;
    $dated_month = $dated->locale('th')->translatedFormat('F');
    $dated_year = $dated->year + 543;

    // received_date
    $received = Carbon::parse($form->received_date);
    $received_day = $received->day;
    $received_month = $received->locale('th')->translatedFormat('F');
    $received_year = $received->year + 543;

    // created_at
    $created = Carbon::parse($form->created_at);
    $created_day = $created->day;
    $created_month = $created->locale('th')->translatedFormat('F');
    $created_year = $created->year + 543;
    @endphp


    <div class="box_text" style="text-align: right;">
        <span>ภ.ด.ส.๑๐</span>
    </div>
    <div class="box_text" style="text-align: center; font-weight: bold;">
        <span>คำร้องคัดค้านการประเมินภาษีหรือการเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง</span><br>
        <span>ตามมาตรา ๗๓ วรรคหนึ่ง แห่งพระราชบัญญัติภาษีที่ดินและสิ่งปลูกสร้าง พ.ศ. ๒๕๖๒</span>
    </div>
    <div class="box_text" style="text-align: right; margin-top:0.5rem;">
        <span>วันที่</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$dated_day}}</span>
        <span>เดือน</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$dated_month }}</span>
        <span>พ.ศ.</span><span class="dotted-line" style="width: 8%; text-align: center; line-height: 1;">{{$dated_year}}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เรื่อง ขอคัดค้านการประเมินภาษีหรือการเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง</span><br>
        <span>เรียน</span><span class="dotted-line" style="width: 50%; text-align: center; line-height: 1;">{{$form->delivered_to}}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:6rem;">
        <span>ตามที่พนักงานประเมินได้แจ้งการประเมินหรือเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง ประจำปี พ.ศ.</span>
        <span class="dotted-line" style="width: 20%; text-align: center; line-height: 1;">{{$form->year}}</span>
        <div style="text-align: left; margin-left:-6rem;">
            <span>ตามหนังสือแจ้งการประเมิน เลขที่</span><span class="dotted-line" style="width: 22%; text-align: center; line-height: 1;">{{$form->number}}</span>
            {{-- <span>/</span><span class="dotted-line" style="width: 10%; text-align: center; line-height: 1;"></span> --}}
            <span>ลงวันที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$received_day}}</span>
            <span>เดือน</span><span class="dotted-line" style="width: 14.5%; text-align: center; line-height: 1;">{{$received_month}}</span>
            <span>พ.ศ.</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$received_year}}</span>
            <span>ซึ่งข้าพเจ้าได้รับเมื่อวันที่</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$created_day}}</span>
            <span>เดือน</span><span class="dotted-line" style="width: 18%; text-align: center; line-height: 1;">{{$created_month}}</span>
            <span>พ.ศ.</span><span class="dotted-line" style="width: 12%; text-align: center; line-height: 1;">{{$created_year}}</span>
            <span>นั้น</span>
        </div>
        <span>ข้าพเจ้า</span>
        <span class="dotted-line" style="width: 61%; text-align: center; line-height: 1;">{{$form->salutation}}&nbsp;{{$form->full_name}}</span>
        <span>ขอยื่นคำร้องคัดค้านการประเมินภาษี</span>
        <div style="text-align: left; margin-left:-6rem;">
            <span>หรือการเรียกเก็บภาษีไม่ถูกต้อง เนื่องจาก</span><span class="dotted-line" style="width: 70%; text-align: center; line-height: 1;">{{$form->due_to}}</span>
            {{-- <span class="dotted-line" style="width: 100%; text-align: center; line-height: 1; margin-top: 1px;"></span> --}}
            {{-- <span class="dotted-line" style="width: 100%; text-align: center; line-height: 1;"></span>
            <span class="dotted-line" style="width: 100%; text-align: center; line-height: 1;"></span>
            <span class="dotted-line" style="width: 100%; text-align: center; line-height: 1;"></span> --}}
            <span style="margin-top: 10px;">โดยข้าพเจ้าได้แนบเอกสารหลักฐาน จำนวน</span><span class="dotted-line" style="width: 30%; text-align: center; line-height: 1;">{{$form->documents}}</span>
            <span>ฉบับ มาเพื่อประกอบการพิจารณาทบทวนการประ</span><span>เมินหรือการเรียกเก็บภาษีใหม่</span>
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
    </div>
    <div style="width: 100%; border-bottom: 2px dotted #000; margin-top:17rem;"></div>
    <div class="box_text" style="margin-top:2rem;">
        <span>ได้รับคำร้องฉบับนี้ตั้งแต่วันที่</span>
        <span class="dotted-line" style="width: 10%; text-align: center;"></span>
        <span>เดือน</span>
        <span class="dotted-line" style="width: 16%; text-align: center;"></span>
        <span>พ.ศ.</span>
        <span class="dotted-line" style="width: 16%; text-align: center;"></span>

    </div>
    <div class="box_text" style="text-align: left; margin-top:1rem; position: relative;">
        <span>(ลงชื่อ)</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"></span>
        <span>เจ้าหน้าที่ผู้รับคำร้อง</span>
        <div style="margin-left: 38px;">
            <span>(</span>
            <span class="dotted-line" style="width: 30%; text-align: center;"></span>
            <span>)</span>
        </div>
        <span>ตำแหน่ง</span>
        <span class="dotted-line" style="width: 30%; text-align: center;"></span>

    </div>

</body>

</html>

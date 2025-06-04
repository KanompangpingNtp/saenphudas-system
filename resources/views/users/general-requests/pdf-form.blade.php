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
            border: 1px solid rgb(255, 255, 255);
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
    </style>
</head>

<body>

    @php
        use Carbon\Carbon;
        $date = Carbon::parse($form->date);
        $day = $date->day;
        $month = $date->locale('th')->translatedFormat('F');
        $year = $date->year + 543;

        $birthday = Carbon::parse($form->birth_day);
        $birthday_day = $birthday->day;
        $birthday_month = $birthday->locale('th')->translatedFormat('F');
        $birthday_year = $birthday->year + 543;

        $citizen_c_id = $form->citizen_id;
        $formatted_id =
            substr($citizen_c_id, 0, 1) .
            '-' .
            substr($citizen_c_id, 1, 4) .
            '-' .
            substr($citizen_c_id, 5, 5) .
            '-' .
            substr($citizen_c_id, 10, 2) .
            '-' .
            substr($citizen_c_id, 12, 1);
    @endphp

    <div class="title_doc">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pdf/logo.png'))) }}"
            alt="Logo" height="120"> <br><strong>แบบฟอร์มคำร้องทั่วไป</strong>
    </div>
    <div class="box_text" style="text-align: right;">
        <span style="line-height: 0.7;">
            เทศบาลตำบลแสนภูดาษ <br>
            ตำบลแสนภูดาษ <br>
            อำเภอบ้านโพธิ์ จังหวัดฉะเชิงเทรา
        </span>


        <div style="margin-right: 80px; margin-top: 10px;">
            <span>วันที่</span><span class="dotted-line" style="width: 5%; text-align: center;"> {{ $day }}
            </span><span>เดือน</span><span class="dotted-line" style="width: 15%; text-align: center;">
                {{ $month }}
            </span><span>พ.ศ.</span><span class="dotted-line" style="width: 10%; text-align: center;">
                {{ $year }}
            </span>
        </div>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เรื่อง</span><span class="dotted-line"
            style="min-width: 95%; text-align: start; margin-left: 10px;">{{ $form->subject }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>เรียน นายกเทศบาลตำบลแสนภูดาษ</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span>สิ่งที่ส่งมาด้วย</span><span class="dotted-line"
            style="min-width: 88%; text-align: start; margin-left: 10px;">{{$form->included}}</span><br>
    </div>

    <div class="box_text" style="text-align: left; margin-left:50px;">
        <span style="margin-left:2rem;">ข้าพเจ้า</span><span class="dotted-line"
            style="width: 87%; text-align: start; margin-left: 10px;">{{ $form->salutation }}{{ $form->name }}</span>
    </div>
    <div class="box_text" style="text-align: left; ">
        <span>อาศัยอยู่บ้านเลขที่</span><span class="dotted-line"
            style="width: 16%; text-align: center;">{{ $form->house_number }}</span><span>หมู่ที่</span><span
            class="dotted-line" style="width: 17%; text-align: center;">{{ $form->village }}</span>
        <span>ซอย</span><span class="dotted-line" style="width: 20%; text-align: center;">{{ $form->village }}</span>
        <span>ถนน</span><span class="dotted-line" style="width: 20%; text-align: center;">{{ $form->village }}</span>
        <span>ตำบล</span><span class="dotted-line"
            style="width: 18%; text-align: center;">{{ $form->subdistrict }}</span><span>อำเภอ</span><span
            class="dotted-line"
            style="width: 18%; text-align: center;">{{ $form->district }}</span><span>จังหวัด</span><span
            class="dotted-line"
            style="width: 18%; text-align: center;">{{ $form->province }}</span><span>เบอร์โทรติดต่อ</span><span
            class="dotted-line" style="width: 19%; text-align: center;">{{ $form->phone }}</span>
    </div>
    <div class="box_text" style="text-align: left; margin-left:5rem">
        <span>เรื่องที่ร้องต่อองค์การบริหารส่วนตำบลคลองอุดชลจร กรณี</span><span class="dotted-line"
            style="min-width: 50%; text-align: start;">{{ $form->request_details }}</span>
    </div>
    <div class="box_text" style="text-align: left;">
        <span style="margin-left:5rem;">ข้าพเจ้าขอความอนุเคราะห์ให้เทศบาลตำบลแสนภูดาษ ดำเนินการ</span>
        <span class="dotted-line"
            style="min-width: 30%; text-align: start;">{{ $form->proceedings }}</span>
    </div>
    <div class="box_text" style="text-align: center; ">
        <span style="margin-left:2rem;">จึงเรียนมาเพื่อโปรดพิจารณาให้ความอนุเคราะห์ในเรื่อง ดังกล่าว จักขอบคุณยิ่ง</span>
    </div>

    <div class="box_text" style="text-align: center; margin-top:2rem; margin-bottom:2rem; margin-left: 30px;">
        <span>ขอแสดงความนับถือ</span>
    </div>
    <div class="box_text" style="text-align: center; margin-top:0.5rem; margin-bottom:1.5rem; ">
        <span>ลงชื่อ</span>
        <span class="dotted-line" style="width: 35%; text-align: center;">{{ $form->name }}
        </span>
        <div style="margin-left: 30px;">
            <span>(</span>
            <span class="dotted-line"
                style="width: 35%; text-align: center;">{{ $form->salutation }}{{ $form->name }}</span>
            <span>)</span>
        </div>
        <div style="margin-left: 30px;">
            <span>ผู้ยื่นคำร้อง</span>
        </div>
    </div>
    <div class="box_text" style="text-align: left; margin-top:2rem; margin-bottom:2rem;">
        {{-- <span style="line-height: 0.7;">
            สำนักปลัด <br>
            โทร/โทรสาร 038-093908 ต่อ 11 <br>
            www.kudc.go.th
        </span> --}}
    </div>
    <div class="footer font-sarabun-bold">
        <p>"ซื่อสัตย์สุจริต มุ่งสัมฤทธิ์ของงาน ยืดมั่นมาตรฐาน บริการด้วยใจเป็นธรรม"</p>
    </div>

</body>
</html>

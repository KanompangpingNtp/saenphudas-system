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



</body>
</html>

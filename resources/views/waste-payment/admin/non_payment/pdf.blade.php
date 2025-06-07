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
    </style>
</head>

<body>

    <h3 style="text-align: center;">รายงานยอดค้างชำระ </h3>

    <p>ชื่อ : {{ $user->name }}</p>

    <p>
        @if ($month || $year)
        @if ($month)
        เดือน: {{ \Carbon\Carbon::create()->month($month)->locale('th')->isoFormat('MMMM') }}
        @endif
        @if ($year)
        ปี: {{ $year + 543 }}
        @endif
        @else
        แสดงรายการทั้งหมด
        @endif
    </p>

    <table border="1" width="100%" cellspacing="0" cellpadding="5" style="text-align: center;">
        <thead>
            <tr>
                <th>#</th>
                <th>ที่อยู่</th>
                <th>เดือน/ปี</th>
                <th>เบอร์โทร</th>
                <th>จำนวนเงิน</th>
                <th>วันครบกำหนด</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    {{ $payment->wasteManagement->address }},
                    หมู่ {{ $payment->wasteManagement->village }},
                    ต.{{ $payment->wasteManagement->sub_district }},
                    อ.{{ $payment->wasteManagement->district }},
                    จ.{{ $payment->wasteManagement->province }}
                </td>
                <td>{{ \Carbon\Carbon::parse($payment->due_date)->locale('th')->translatedFormat('F') }} {{ ($payment->end_date) ? '-' : '' }} {{ ($payment->end_date) ? \Carbon\Carbon::parse($payment->end_date)->locale('th')->translatedFormat('F') : '' }} {{ \Carbon\Carbon::parse($payment->end_date)->locale('th')->translatedFormat('Y')+543 }}</td>
                <td>{{ $payment->wasteManagement->phone }}</td>
                <td>{{ number_format($payment->amount, 2) }} บาท</td>
                <td>{{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"><strong>รวมยอดค้างชำระทั้งหมด</strong></td>
                <td colspan="2"><strong>{{ number_format($totalAmount, 2) }} บาท</strong></td>
            </tr>
        </tbody>
    </table>

</body>

</html>
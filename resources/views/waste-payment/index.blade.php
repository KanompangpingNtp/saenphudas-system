@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mb-4">Dashboard</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-white">บิลที่ชำระเงินแล้ว</h5>
                                    <p class="card-text display-6">{{ $paidCount }} บิล</p>
                                    <a href="{{ route('PaymentHistoryPage') }}"
                                        class="btn btn-light btn-sm">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-white">บิลที่ขาดการชำระเงิน</h5>
                                    <p class="card-text display-6">{{ $unpaidCount }} บิล</p>
                                    <a href="{{ route('NonPaymentPage') }}" class="btn btn-light btn-sm">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-white">รอตรวจสอบการชำระ</h5>
                                    <p class="card-text display-6">{{ $verifyCount }} บิล</p>
                                    <a href="{{ route('VerifyPaymentPage') }}" class="btn btn-light btn-sm">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    {{-- <div class="row">
                        <div class="col-md-6">
                            <canvas id="paymentChart" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="revenueChart" height="150"></canvas>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === กราฟผู้ชำระและยังไม่ชำระเงิน ===
        const ctx = document.getElementById('paymentChart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(
                    $monthlyData->pluck('month')->map(function ($m) {
                        return \Carbon\Carbon::createFromDate(null, $m)->locale('th')->isoFormat('MMMM');
                    }),
                ) !!},
                datasets: [{
                        label: 'ชำระแล้ว',
                        data: {!! json_encode($monthlyData->pluck('paid')) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    },
                    {
                        label: 'ยังไม่ชำระ',
                        data: {!! json_encode($monthlyData->pluck('unpaid')) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + ' บิล';
                            }
                        },
                        title: {
                            display: true,
                            text: 'จำนวนผู้ชำระเงิน'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'สรุปจำนวนผู้ชำระเงินและยังไม่ชำระรายเดือน'
                    }
                }
            }
        });
    </script>

    <script>
        // === กราฟรายรับและขาดทุน ===
        const ctx2 = document.getElementById('revenueChart').getContext('2d');

        const revenueChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! json_encode(
                    $revenueData->map(function ($item) {
                        return \Carbon\Carbon::createFromDate($item->year, $item->month)->locale('th')->isoFormat('MMMM YYYY');
                    }),
                ) !!},
                datasets: [{
                        label: 'รายรับ (บาท)',
                        data: {!! json_encode($revenueData->pluck('income')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    },
                    {
                        label: 'ขาดทุน (บาท)',
                        data: {!! json_encode($revenueData->pluck('loss')) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number(value).toLocaleString() + ' บาท';
                            }
                        },
                        title: {
                            display: true,
                            text: 'จำนวนเงิน (บาท)'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'รายรับและขาดทุนรายเดือน'
                    }
                }
            }
        });
    </script> --}}
@endsection

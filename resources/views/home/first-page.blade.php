@extends('home.layouts.app')
@section('title', 'Home Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 68vh;
    }

    .gradient-bg {
        background: linear-gradient(to top, white 0%, rgba(255, 255, 255, 0) 100%);
        box-shadow: 0 4px 5px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        font-size: 25px;
        font-weight: bold;
    }

    .border-x-custom {
        border-left: 8px solid #ffffff;
        border-right: 8px solid #ffffff;
        border-top: none;
        border-bottom: none;
    }

    .border-x-custom2 {
        border-left: 5px solid #ffffff;
        border-right: none;
        border-top: none;
        border-bottom: none;
    }

    .border-y-custom {
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 5px solid #ffffff;
    }


    .btn-first-effect img {
        transition: all 0.3s ease;
    }

    .btn-first-effect:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }

    .bg-green {
        background: #19aa60;
        border-radius: 20px;
        padding: 10px 2px;
    }
</style>
@section('content')
    <div class="body-bg py-2">
        <div class="container">
            <div class="row">
                <div class="col-3 d-none d-lg-flex flex-column justify-content-center align-content-center ">
                    <img src="{{ asset('first-page/รูปนายก.png') }}" alt="nayok" class="img-fluid" width="300">
                    <div class="text-center gradient-bg py-3" style="line-height: 1;">
                        นายสุเทพ กรัสประพันธฺ์ <br>
                        นายกเทศมนตรีตำบลแสนภูดาษ
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center align-content-center px-0">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('first-page/logo 24.png') }}" alt="ear-phone" class="img-fluid">
                        <div class="pt-1 pb-3" style="line-height: 0.7;">
                            <span class="fw-bold" style="font-size: 70px;">E-service</span><br>
                            <span class="fw-bold" style="font-size: 30px;">One Stop Service (OSS)</span>
                        </div>
                    </div>
                    <div class="fs-4 fw-bold text-center">
                        บริการยื่นคำร้องออนไลน์สะดวกรวดเร็วตลอด 24 ชั่วโมง
                    </div>
                    <div class="text-center border-x-custom py-3 ms-4">
                        <a href="{{ route('Eservice') }}" class="btn-first-effect">
                            <img src="{{ asset('first-page/ปุ่ม e-service.png') }}" alt="btn-คำร้อง" class="img-fluid">
                        </a>
                    </div>
                    <a href="#" class="text-center mb-2 btn-first-effect">
                        <img src="{{ asset('first-page/VDO แนะนำการใช้งาน.png') }}" alt="vdo" class="img-fluid">
                    </a>
                    <a href="#" class="text-center mb-2 btn-first-effect">
                        <img src="{{ asset('first-page/คู่มือแนะนำการใช้งาน.png') }}" alt="vdo" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex flex-column justify-content-center align-content-center px-0">
                    <div class="d-flex justify-content-center align-items-end fs-2 fw-bold gap-2" style="line-height: 0.4;">
                        <img src="{{ asset('first-page/ถังขยะ.png') }}" alt="trash">
                        การแจ้งเตือนและธนาคารขยะ
                    </div>
                    <div class="bg-green d-flex flex-column justify-content-center align-items-center mt-3 mx-auto px-3">
                        <a href="{{ route('UserWastePayment') }}" class="text-center mb-2 btn-first-effect border-y-custom pb-2">
                            <img src="{{ asset('first-page/กดmock up.png') }}" alt="alert-trash" class="img-fluid">
                        </a>
                        <a href="#" class="text-center btn-first-effect">
                            <img src="{{ asset('first-page/ธนาคารขยะ.png') }}" alt="bank-trash" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="cool-12 col-md-6 d-flex flex-column justify-content-center align-content-center px-0 my-4">
                    <div class="d-flex justify-content-center align-items-end fs-2 fw-bold gap-2" style="line-height: 0.4;">
                        <img src="{{ asset('first-page/ใบอนุญาต.png') }}" alt="ใบอนุญาต">
                        ใบประกอบอนุญาติ
                    </div>
                    <div class="bg-green mx-auto d-flex flex-column align-items-center  mt-3 ">
                        <div class="text-center text-white fs-4 fw-bold">
                            ประกอบกิจการสาธารณสุข ยื่นขออณุญาต / ต่ออายุ
                        </div>
                        <div class="d-flex justify-content-center align-items-center px-3 gap-2">
                            <a href="{{ route('FoodStorageLicenseFormPage') }}" class="text-center btn-first-effect ">
                                <img src="{{ asset('first-page/ใบอนุญาตสถานที่สะสมอาหาร.png') }}"
                                    alt="ใบอนุญาตสถานที่สะสมอาหาร" class="img-fluid">
                            </a>
                            <a href="{{ route('HealthHazardApplicationFormPage') }}" class="text-center btn-first-effect border-x-custom2 ps-3">
                                <img src="{{ asset('first-page/ใบอนุญาตประกอบกิจการ.png') }}" alt="ใบอนุญาตประกอบกิจการ"
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="cool-12 col-md-6 d-flex flex-column justify-content-center align-content-center px-0 my-4">
                    <div class="d-flex justify-content-center align-items-end fs-2 fw-bold gap-2" style="line-height: 0.4;">
                        <img src="{{ asset('first-page/แจ้งเหตุ-icon.png') }}" alt="แจ้งเหตุ-icon">
                        การแจ้งเตือนเหตุฉุกเฉิน
                    </div>
                    <div class="bg-green mx-auto d-flex justify-content-center align-items-center gap-2 mt-3 px-3">
                        <a href="{{ route('emergency.index') }}" class="text-center btn-first-effect ">
                            <img src="{{ asset('first-page/แจ้งเหตุ.png') }}" alt="แจ้งเหตุ" class="img-fluid">
                        </a>
                        <div class="d-flex flex-column justify-content-center align-items-center border-x-custom2 ps-3 gap-1">
                            <a href="#" class="text-center btn-first-effect ">
                                <img src="{{ asset('first-page/แจ้งเหตุไฟเสีย.png') }}" alt="แจ้งเหตุไฟเสีย"
                                    class="img-fluid">
                            </a>
                            <a href="#" class="text-center btn-first-effect ">
                                <img src="{{ asset('first-page/แจ้งถนนพัง.png') }}" alt="แจ้งถนนพัง" class="img-fluid">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

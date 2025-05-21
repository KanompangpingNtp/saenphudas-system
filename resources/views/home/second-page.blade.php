@extends('home.layouts.app')
@section('title', 'Home 2 Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 68vh;
    }
</style>
@section('content')
    <div class="body-bg py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-start gap-3">
                    <div class="d-flex justify-content-start align-items-start gap-2">
                        <img src="{{ asset('second-page/สำนักปลัด.png') }}" alt="สำนักปลัด">
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                คำร้องทั่วไป
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำขอยืนยันสิทธิรับเงินเบี้ยยังชีพผู้สูงอายุ
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำขอรับการสงเคราะห์ (ผู้ป่วยเอดส์)
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-start gap-2">
                        <img src="{{ asset('second-page/กองช่าง.png') }}" alt="กองช่าง">
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบฟอร์มคำร้องทั่วไป(แจ้งเรื่องไฟฟ้า)
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบฟอร์มคำร้องทั่วไป(แจ้งถนนชำรุด)
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-start gap-2">
                        <img src="{{ asset('second-page/กองสาธารณสุข.png') }}" alt="กองสาธารณสุข">
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำร้องใบอนนุญาตประกิจการที่เป็นอันตรายต่อสุขภาพ
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                คำขอรับใบอนุญาต จัดตั้งสถานที่จำหน่ายอาหารหรือสถานที่สะสมอาหาร
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                คำร้องทั่วไปขอถังขยะ
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-start gap-3">
                    <div class="d-flex justify-content-start align-items-start gap-2">
                        <img src="{{ asset('second-page/กองคลัง.png') }}" alt="กองคลัง">
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                คำร้องทั่วไป
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำขอยืนยันสิทธิรับเงินเบี้ยยังชีพผู้สูงอายุ
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบคำขอรับการสงเคราะห์ (ผู้ป่วยเอดส์)
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-start gap-2">
                        <img src="{{ asset('second-page/กองช่าง.png') }}" alt="กองช่าง">
                        <div class="d-flex flex-column justify-content-start align-items-start">
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบฟอร์มคำร้องทั่วไป(แจ้งเรื่องไฟฟ้า)
                            </a>
                            <a href="#" class="d-flex align-items-end text-decoration-none text-dark fw-bold fs-4 gap-1 " style="line-height: 0.5;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow">
                                แบบฟอร์มคำร้องทั่วไป(แจ้งถนนชำรุด)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

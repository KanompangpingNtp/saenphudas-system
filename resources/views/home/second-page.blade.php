@extends('home.layouts.app')
@section('title', 'Home 2 Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 68vh;
    }

    .link-hover {
        text-decoration: none;
        color: #000;
        transition: all 0.3s ease;
    }

    .link-hover:hover {
        color: #0d6efd;
        text-decoration: underline;
    }
</style>
@section('content')
    <div class="body-bg py-2">
        <div class="container">
            <div class="row pt-5 px-3">
                <div class="col-lg-6 d-flex flex-column justify-content-start align-items-center align-items-sm-start gap-3">
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-start align-items-center align-items-sm-start gap-2 mt-2 mt-lg-5 w-100">

                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('second-page/สำนักปลัด.png') }}" alt="สำนักปลัด">
                        </div>
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 w-100">
                            <a href="{{ route('GeneralRequestsFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                คำร้องทั่วไป
                            </a>
                            <a href="{{ route('ElderlyAllowanceFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                แบบคำขอยืนยันสิทธิรับเงินเบี้ยยังชีพผู้สูงอายุ
                            </a>
                            <a href="{{ route('DisabilityFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
                            </a>
                            <a href="{{ route('ReceiveAssistanceFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                แบบคำขอรับการสงเคราะห์ (ผู้ป่วยเอดส์)
                            </a>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-start align-items-center align-items-sm-start gap-2 mt-2 mt-lg-5 w-100">

                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('second-page/กองช่าง.png') }}" alt="กองช่าง">
                        </div>
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 w-100">
                            <a href="#" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                แบบฟอร์มคำร้องทั่วไป(แจ้งเรื่องไฟฟ้า)
                            </a>
                            <a href="#" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                แบบฟอร์มคำร้องทั่วไป(แจ้งถนนชำรุด)
                            </a>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-start align-items-center align-items-sm-start gap-2 mt-2 mt-lg-5 w-100">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('second-page/กองสาธารณสุข.png') }}" alt="กองสาธารณสุข">
                        </div>
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 w-100">
                            <a href="#" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-2 mb-xl-0">
                                แบบคำร้องใบอนนุญาตประกิจการที่เป็นอันตรายต่อสุขภาพ
                            </a>
                            <a href="#" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-2 mb-xl-0">
                                คำขอรับใบอนุญาต จัดตั้งสถานที่จำหน่ายอาหารหรือสถานที่สะสมอาหาร
                            </a>
                            <a href="{{ route('GarbageCollectionForm') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                คำร้องทั่วไปขอถังขยะ
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 d-flex flex-column justify-content-start align-items-center align-items-sm-start gap-3 mb-4 mb-sm-0 mt-3 mt-lg-0">
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-start align-items-center align-items-sm-start gap-2 mt-2 mt-lg-5 w-100">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('second-page/กองคลัง.png') }}" alt="กองคลัง">
                        </div>
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 w-100">
                            <a href="{{ route('LicenseTaxFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-1 mb-xl-0">
                                (ภ.ป.๑ แนบแสดงรายการ ภาษีป้าย)
                            </a>
                            <a href="{{ route('PayTaxBuildAndRoomFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-3 mb-xl-0">
                                หนังสือขอผ่อนชำระเงินภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด
                            </a>
                            <a href="{{ route('LandBuildingTaxAppealPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-3 mb-xl-0">
                                (ภ.ด.ส.๑๐) คำร้องคัดค้านการประเมินภาษีหรือ การเรียนเก็บภาษีที่ดินและสิ่งปลูกสร้าง
                            </a>
                            <a href="{{ route('ChangeInUseFormPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow" class="mb-3 mb-xl-0">
                                (ภ.ป.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง
                            </a>
                            <a href="{{ route('LandTaxRefundRequestPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow"
                                    class="mb-3 mb-xl-0">
                                (ภ.ป.ส.๙) คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน
                            </a>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-start align-items-center align-items-sm-start gap-2 mt-2 mt-lg-5 w-100">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('second-page/กองการศึกษา.png') }}" alt="กองการศึกษา">
                        </div>
                        <div class="d-flex flex-column justify-content-start align-items-start gap-2 w-100">
                            <a href="{{ route('ChildApplyPage') }}" class="d-flex align-items-end fw-bold fs-4 gap-1 link-hover"
                                style="line-height: 1;">
                                <img src="{{ asset('second-page/นิ้วหัวข้อ.png') }}" alt="arrow"
                                    class="mb-1 mb-xl-0">
                                แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

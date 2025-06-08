@extends('home.layouts.app')
@section('title', 'Trash Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        height: 68vh;
    }

    .btn-back-effect img {
        transition: all 0.3s ease;
    }

    .btn-back-effect:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }
</style>
@section('content')
    <div class="body-bg ">
        <div class="container d-flex flex-column justify-content-center align-items-start">
            <div class="d-flex justify-content-start my-3">
                <a href="#" class="btn-back-effect">
                    <img src="{{ asset('trash-page/btn-back.png') }}" alt="btn-back" class="img-fluid">
                </a>
            </div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-6 col-md-3 d-flex flex-column justify-content-start align-items-center">
                    <a href="{{ route('StatusTrash') }}" class="btn-back-effect">
                        <img src="{{ asset('trash-page/ดูสถานะรถขยะ.png') }}" alt="ดูสถานะรถขยะ" class="img-fluid">
                    </a>
                    <div class="d-none d-md-block fs-4 fw-bold mt-3 px-xl-5" style="line-height: 1;">
                        ติดตามตำแหน่งของรถขยะเพื่อความสะดวกในการเตรียมขยะนำไปทิ้งสามารถวางแผนและจัดการการทิ้งขยะได้อย่างง่าย
                    </div>
                </div>
                <div class="col-6 col-md-3 d-flex flex-column justify-content-start align-items-center">
                    <a href="{{ route('CheckValuetrash') }}" class="btn-back-effect">
                        <img src="{{ asset('trash-page/ดูข้อมูลการชำระ.png') }}" alt="ดูข้อมูลการชำระ" class="img-fluid">
                    </a>
                    <div class="d-none d-md-block fs-4 fw-bold mt-3 px-xl-5" style="line-height: 1;">
                        ติดตามข้อมูลการชำระค่าขยะ เพื่อติดตามสถานะการชำระ
                        เพิ่มความสะดวกในการวางแผน
                        การชำระครั้งถัดไป
                    </div>
                </div>
                <div class="col-6 col-md-3 d-flex flex-column justify-content-start align-items-center" style="margin-bottom: 9px;">
                    <a href="{{ route('TrashToxic') }}" class="btn-back-effect">
                        <img src="{{ asset('trash-page/ดูจุดทิ้งขยะ.png') }}" alt="ดูจุดทิ้งขยะ" class="img-fluid">
                    </a>
                    <div class="d-none d-md-block fs-4 fw-bold mt-3 px-xl-5" style="line-height: 1;">
                        ติดตามตำแหน่งจุดทิ้งขยะมีพิษ
                        เพื่อ รวบรวม จัดการ และกำจัดขยะอันตรายอย่างปลอดภัยเพื่อปกป้องสุขภาพ์และสิ่งแวดล้อม
                    </div>
                </div>
                <div class="col-6 col-md-3 d-flex flex-column justify-content-start align-items-center" style="margin-bottom: 9px;">
                    <a href="{{ route('GarbageCollectionForm') }}" class="btn-back-effect">
                        <img src="{{ asset('trash-page/image_69.png') }}" alt="image_69" class="img-fluid">
                    </a>
                    <div class="d-none d-md-block fs-4 fw-bold mt-3 px-xl-5" style="line-height: 1;">
                        ยื่นคำร้องเพื่อขอใช้บริการถัง
                        ขยะตามจุดต่างๆ เพื่อความสะอาดเป็นระเบียบ
                        เรียบร้อยของชุมชนที่อยู่อาศัย
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

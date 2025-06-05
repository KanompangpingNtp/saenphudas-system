@extends('home.layouts.app')
@section('title', 'Trash Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 68vh;
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
                <div class="col-6 col-md-4 d-flex flex-column justify-content-start align-items-center">
                    <a href="{{ route('StatusTrash') }}" class="btn-back-effect">
                        <img src="{{ asset('license/คำร้อง 1.png') }}" alt="คำร้อง 1" class="img-fluid">
                    </a>
                </div>
                <div class="col-6 col-md-4 d-flex flex-column justify-content-start align-items-center">
                    <a href="{{ route('CheckValuetrash') }}" class="btn-back-effect">
                        <img src="{{ asset('license/คำร้อง 2.png') }}" alt="คำร้อง 2" class="img-fluid">
                    </a>

                </div>
                <div class="col-6 col-md-4 d-flex flex-column justify-content-start align-items-center">
                    <a href="{{ route('TrashToxic') }}" class="btn-back-effect">
                        <img src="{{ asset('license/คำร้อง 3.png') }}" alt="คำร้อง 3" class="img-fluid">
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection

@extends('auth.layouts.layout-login-register')
@section('title', 'Login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>ลงชื่อเข้าสู่ระบบ</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="กรุณากรอกอีเมล">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="กรุณากรอกรหัสผ่าน">
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 text-center">
                            <span class="text-black">ยังไม่มีบัญชี?</span><a href="{{ route('RegisterPage') }}" class="text-decoration-none text-primary"> ลงทะเบียน</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
    }
    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .text-primary {
        color: #007bff !important;
    }
    .text-primary:hover {
        text-decoration: underline;
    }
    .form-label {
        font-weight: bold;
    }
</style>

@endsection

@extends('auth.layouts.layout-login-register')
@section('title', 'Register')
@section('content')

@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ $message }}'
        })
    </script>
@endif


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>ลงทะเบียน</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('Register') }}" method="POST">
                        @csrf

                        {{-- แถว 1: ชื่อนำหน้า, ชื่อ-นามสกุล --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="salutation" class="form-label">คำนำหน้า</label>
                                <select class="form-select" id="salutation" name="salutation" required>
                                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="name" class="form-label">ชื่อ-นามสกุล<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ-นามสกุล" required>
                            </div>
                        </div>

                        {{-- แถว 2: Email, Phone --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">อีเมล<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}">
                            </div>
                        </div>

                        {{-- แถว 3: Password, Confirm --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">รหัสผ่าน (ไม่ต่ำกว่า 9 ตัว)<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" required>
                            </div>
                        </div>

                        {{-- แถว 4: อายุ --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="age" class="form-label">อายุ</label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="อายุ">
                            </div>
                        </div>

                        {{-- แถว 5: ที่อยู่ --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="house_number" class="form-label">บ้านเลขที่</label>
                                <input type="text" class="form-control" id="house_number" name="house_number" placeholder="บ้านเลขที่" oninput="this.value = this.value.replace(/[^0-9/]/g, '')">
                            </div>
                            <div class="col-md-4">
                                <label for="village" class="form-label">หมู่บ้าน</label>
                                <input type="text" class="form-control" id="village" name="village" placeholder="หมู่บ้าน">
                            </div>
                            <div class="col-md-4">
                                <label for="subdistrict" class="form-label">ตำบล</label>
                                <input type="text" class="form-control" id="subdistrict" name="subdistrict" placeholder="ตำบล">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="district" class="form-label">อำเภอ</label>
                                <input type="text" class="form-control" id="district" name="district" placeholder="อำเภอ">
                            </div>
                            <div class="col-md-6">
                                <label for="province" class="form-label">จังหวัด</label>
                                <input type="text" class="form-control" id="province" name="province" placeholder="จังหวัด">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">ลงทะเบียน</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>มีบัญชีแล้ว? <a href="{{ route('LoginPage') }}" class="text-decoration-none text-primary">เข้าสู่ระบบ</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-primary {
        font-size: 16px;
    }
    .form-label {
        font-weight: 600;
    }
    .form-control {
        border-radius: 6px;
    }
</style>


@endsection

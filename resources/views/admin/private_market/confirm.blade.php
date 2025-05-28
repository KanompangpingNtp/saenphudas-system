@extends('admin.layout.layout')
@section('admin_content')
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ $message }}',
            })
        </script>
    @endif

    <div class="container">
        <h2 class="text-center mb-4">แบบคำร้องขอจัดตั้งตลาดเอกชน</h2>

        <form action="{{ route('PrivateMarketAdminConfirmSave') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <div class="col-md-3">
                    <label for="written_at" class="form-label">เขียนที่</label>
                    <input type="text" class="form-control" id="written_at" name="written_at"
                        value="{{ $form->written_at }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="salutation" class="form-label">คำนำหน้า</label>
                    <select class="form-select" id="salutation" name="salutation" disabled>
                        <option value="">เลือกคำนำหน้า</option>
                        <option value="นาย" {{ $form->salutation == 'นาย' ? 'selected' : '' }}>นาย</option>
                        <option value="นาง" {{ $form->salutation == 'นาง' ? 'selected' : '' }}>นาง</option>
                        <option value="นางสาว" {{ $form->salutation == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="full_name" class="form-label">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="{{ $form->full_name }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="age" class="form-label">อายุ</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{ $form->age }}"
                        disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">สัญชาติ</label>
                    <input type="text" class="form-control" value="ไทย" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="force" class="form-label">บังคับ</label>
                    <input type="text" class="form-control" id="force" name="force" value="{{ $form->force }}"
                        disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="house_number" class="form-label">อยู่บ้านเลขที่</label>
                    <input type="text" class="form-control" id="house_number" name="house_number"
                        value="{{ $form->house_number }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="road" class="form-label">ถนน</label>
                    <input type="text" class="form-control" id="road" name="road" value="{{ $form->road }}"
                        disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="village" class="form-label">หมู่ที่</label>
                    <input type="text" class="form-control" id="village" name="village" value="{{ $form->village }}"
                        disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="sub_district" class="form-label">ตำบล</label>
                    <input type="text" class="form-control" id="sub_district" name="sub_district"
                        value="{{ $form->sub_district }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="district" class="form-label">อำเภอ</label>
                    <input type="text" class="form-control" id="district" name="district" value="{{ $form->district }}"
                        disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="province" class="form-label">จังหวัด</label>
                    <input type="text" class="form-control" id="province" name="province"
                        value="{{ $form->province }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="submit_request" class="form-label">ขอยื่นเรื่องราวต่อ</label>
                    <input type="text" class="form-control" id="submit_request" name="submit_request"
                        value="{{ $form->submit_request }}" disabled>
                </div>

                <p>เพื่อขออนุญาตใช้สถานที่ซึ่งตั้งอยู่ </p>

                <div class="col-md-3 mb-3">
                    <label for="submit_road" class="form-label">ถนน</label>
                    <input type="text" class="form-control" id="submit_road" name="submit_road"
                        value="{{ $form->submit_road }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_number" class="form-label">เลขที่</label>
                    <input type="text" class="form-control" id="submit_number" name="submit_number"
                        value="{{ $form->submit_number }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_sub_district" class="form-label">ตำบล</label>
                    <input type="text" class="form-control" id="submit_sub_district" name="submit_sub_district"
                        value="{{ $form->submit_sub_district }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_district" class="form-label">อำเภอ</label>
                    <input type="text" class="form-control" id="submit_district" name="submit_district"
                        value="{{ $form->submit_district }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="submit_province" class="form-label">จังหวัด</label>
                    <input type="text" class="form-control" id="submit_province" name="submit_province"
                        value="{{ $form->submit_province }}" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="annual_market" class="form-label">เพื่อใช้เป็นตลาดเอกชนประจำปี</label>
                    <input type="text" class="form-control" id="annual_market" name="annual_market"
                        value="{{ $form->annual_market }}" disabled>
                </div>
            </div>

            <div class="mb-3 mt-2">
                <label for="attachments" class="form-label">ไฟล์แนบ</label>
                @foreach ($form->files as $file)
                    <div>
                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                            {{ basename($file->file_path) }}
                        </a>
                    </div>
                @endforeach
            </div>


            <div>
                <h5>ผลการตรวจสอบ</h5><br>
                <div class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="result" value="1" required>
                        <label class="form-check-label">
                            ผ่าน
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="result" value="2">
                        <label class="form-check-label">
                            ไม่ผ่าน
                        </label>
                    </div>
                </div>
                <div class="col-md-7">
                    <label for="number_of_food" class="form-label">หมายเหตุ : </label>
                    <textarea rows="6" class="form-control" name="detail" id="detail"></textarea>
                </div>

                <br>
                <button type="submit" class="btn btn-primary py-1">
                    <i class="fa fa-save"></i></i> บันทึกข้อมูล</button>
                <input type="hidden" name="id" value="{{ old('id', $form->id) }}">
            </div>

        </form>
    </div>
@endsection

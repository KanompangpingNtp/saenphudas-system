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
    <h2 class="text-center mb-4">แบบคำร้องใบอนุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</h2>

    <form action="{{route('HealthHazardApplicationAdminConfirmSave')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label class="form-label d-block">ข้าพเจ้า <span class="text-danger">*</span></label>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_individual" value="บุคคลธรรมดา" @checked(old('title_name', $form->title_name) == 'บุคคลธรรมดา') disabled>
                    <label class="form-check-label" for="person_individual">
                        บุคคลธรรมดา
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_legal" value="นิติบุคคล" @checked(old('title_name', $form->title_name) == 'นิติบุคคล') disabled>
                    <label class="form-check-label" for="person_legal">
                        นิติบุคคล
                    </label>
                </div>
            </div>


            <div class="col-md-2">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="salutation" name="salutation" disabled>
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $form->full_name) }}" disabled>
            </div>

            <div class="col-md-2">
                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="age" name="age" value="{{ old('age', $form->age) }}" disabled>
            </div>

            <div class="col-md-2">
                <label for="nationality" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $form->nationality) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="id_card_number" class="form-label">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="id_card_number" name="id_card_number" value="{{ old('id_card_number', $form->id_card_number) }}" disabled maxlength="13">
            </div>

            <div class="col-md-3">
                <label for="address" class="form-label">อยู่บ้าน/สำนักงานเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $form->address) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="village" class="form-label">หมู่ที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $form->village) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="alley" class="form-label">ตรอก/ซอย <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="alley" name="alley" value="{{ old('alley', $form->alley) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="road" class="form-label">ถนน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="road" name="road" value="{{ old('road', $form->road) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="subdistrict" class="form-label">ตำบล/แขวง <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $form->subdistrict) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $form->district) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $form->province) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="telephone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $form->telephone) }}" disabled maxlength="10">
            </div>

            <div class="col-md-3">
                <label for="fax" class="form-label">โทรสาร <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', $form->fax) }}" disabled>
            </div>
        </div>

        <br>
        <h5>ขอยื่นเรื่องต่อเจ้าพนักงานท้องถิ่น เพื่อขอรับ/ขอต่อใบอนุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</h5><br>

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label for="type_request" class="form-label">ประเภท</label>
                <input type="text" class="form-control" id="type_request" name="type_request" value="{{ old('type_request', $form['details']->type_request ?? '') }}" disabled>
            </div>

            <div class="col-md-4">
                <label for="petition" class="form-label">ข้อ</label>
                <input type="text" class="form-control" id="petition" name="petition" value="{{ old('petition', $form['details']->petition ?? '') }}" disabled>
            </div>

            <div class="col-md-12">
                <label for="name_establishment" class="form-label">ชื่อสถานประกอบการ</label>
                <input type="text" class="form-control" id="name_establishment" name="name_establishment value=" {{ old('name_establishment', $form['details']->name_establishment ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="location" class="form-label">ตั้งอยู่ที่</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $form['details']->location ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="details_village" name="details_village" value="{{ old('details_village', $form['details']->details_village ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="details_alley" name="details_alley" value="{{ old('details_alley', $form['details']->details_alley ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="details_road" name="details_road" value="{{ old('details_road', $form['details']->details_road ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_subdistrict" class="form-label">ตำบล/แขวง</label>
                <input type="text" class="form-control" id="details_subdistrict" name="details_subdistrict" value="{{ old('details_subdistrict', $form['details']->details_subdistrict ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="details_district" name="details_district" value="{{ old('details_district', $form['details']->details_district ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="details_province" name="details_province" value="{{ old('details_province', $form['details']->details_province ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_telephone" class="form-label">โทรศัพท์</label>
                <input type="text" class="form-control" id="details_telephone" name="details_telephone" maxlength="10" value="{{ old('details_telephone', $form['details']->details_telephone ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_fax" class="form-label">โทรสาร</label>
                <input type="text" class="form-control" id="details_fax" name="details_fax" value="{{ old('details_fax', $form['details']->details_fax ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="business_area" class="form-label">พื้นที่ประกอบการ (ตารางเมตร)</label>
                <input type="text" class="form-control" id="business_area" name="business_area" value="{{ old('details_fax', $form['details']->business_area ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="machine_power" class="form-label">กำลังเครื่องจักร (แรงม้า)</label>
                <input type="text" class="form-control" id="machine_power" name="machine_power" value="{{ old('details_fax', $form['details']->machine_power ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="number_male_workers" class="form-label">จำนวนคนงานชาย (คน)</label>
                <input type="text" class="form-control" id="number_male_workers" name="number_male_workers" value="{{ old('details_fax', $form['details']->number_male_workers ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="number_female_workers" class="form-label">จำนวนคนงานหญิง (คน)</label>
                <input type="text" class="form-control" id="number_female_workers" name="number_female_workers" value="{{ old('details_fax', $form['details']->number_female_workers ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="opening_hours" class="form-label">เปิดประกอบการตั้งแต่เวลา (น.)</label>
                <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ old('details_fax', $form['details']->opening_hours ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="opening_for_business_until" class="form-label">ถึงเวลา (น.)</label>
                <input type="text" class="form-control" id="opening_for_business_until" name="opening_for_business_until" value="{{ old('details_fax', $form['details']->opening_for_business_until ?? '') }}" disabled>
            </div>

            <br>
            <p><strong>3. </strong>พร้อมคำร้องนี้ข้าพเจ้าได้แนบหนังสือรับรองการแจ้งเดิมและเอกสารหลักฐานต่างๆ มาด้วยคือ</p>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option1" id="option1"
                            @if(in_array("option1", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option1">
                            สำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านเจ้าของกิจการ
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 1)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option2" id="option2"
                            @if(in_array("option2", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option2">
                            สำเนาหนังสือรับรองการจดทะเบียนนิติบุคคลพร้อมสำเนาบัตรประชาชนของผู้แทนนิติบุคคล
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 2)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option3" id="option3"
                            @if(in_array("option3", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option3">
                            หนังสือยินยอมให้ใช้สถานที่ / สัญญาเช่า
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 3)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option4" id="option4"
                            @if(in_array("option4", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option4">
                            หนังสือยินมอบอำนาจพร้อมสำเนาบัตรประชาชน / สำเนาทะเบียนบ้านผู้มอบ และผู้รับมอบอำนาจ
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 4)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option5" id="option5"
                            @if(in_array("option5", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option5">
                            ใบรับรองแพทย์ของผู้สัมผัสอาหาร
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 5)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option6" id="option6"
                            @if(in_array("option6", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option6">
                            ใบอนุญาตแจ้งจัดตั้งสถานที่จำหน่ายอาหาร หรือ สถานที่สะสมอาหารฉบับเดิม (ต้นฉบับ)
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 6)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option7" id="option7"
                            @if(in_array("option7", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option7">
                            แผนที่สถานที่ตั้งของสถานประกอบการ
                        </label>
                        @foreach($form['files'] as $rs)
                        @if($rs->document_type == 7)
                        <a href="{{url('storage/'.$rs->file_path)}}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option8" id="option8"
                            @if(in_array("option8", $form['details']->document_option)) checked @endif disabled>
                        <label class="form-check-label" for="option8">
                            อื่นๆ
                        </label>
                    </div>

                    <div class="col-md-7" id="document_option_detail_div">
                        <label for="document_option_detail" class="form-label">รายละเอียดอื่นๆ</label>
                        <input type="text" class="form-control" id="document_option_detail" name="document_option_detail"
                            value="{{ old('document_option_detail', $form['details']->document_option_detail) }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
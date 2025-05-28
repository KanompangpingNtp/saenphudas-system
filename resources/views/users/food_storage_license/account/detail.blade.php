@extends('users.layout.layout')
@section('pages_content')
<div class="container">
    <h2 class="text-center mb-4">แบบคำร้องใบอนุญาต</h2><br>

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label class="form-label d-block">ข้าพเจ้า </label>

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
                <label for="full_name" class="form-label">ชื่อ - นามสกุล </label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $form->full_name) }}" disabled>
            </div>

            <div class="col-md-2">
                <label for="age" class="form-label">อายุ </label>
                <input type="text" class="form-control" id="age" name="age" value="{{ old('age', $form->age) }}" disabled>
            </div>

            <div class="col-md-2">
                <label for="nationality" class="form-label">สัญชาติ </label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $form->nationality) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="id_card_number" class="form-label">เลขบัตรประชาชน </label>
                <input type="text" class="form-control" id="id_card_number" name="id_card_number" value="{{ old('id_card_number', $form->id_card_number) }}" disabled maxlength="13">
            </div>

            <div class="col-md-3">
                <label for="address" class="form-label">อยู่บ้าน/สำนักงานเลขที่ </label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $form->address) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="village" class="form-label">หมู่ที่ </label>
                <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $form->village) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="alley" class="form-label">ตรอก/ซอย </label>
                <input type="text" class="form-control" id="alley" name="alley" value="{{ old('alley', $form->alley) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="road" class="form-label">ถนน </label>
                <input type="text" class="form-control" id="road" name="road" value="{{ old('road', $form->road) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="subdistrict" class="form-label">ตำบล/แขวง </label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $form->subdistrict) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="district" class="form-label">อำเภอ </label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $form->district) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="province" class="form-label">จังหวัด </label>
                <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $form->province) }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="telephone" class="form-label">โทรศัพท์ </label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $form->telephone) }}" disabled maxlength="10">
            </div>

            <div class="col-md-3">
                <label for="fax" class="form-label">โทรสาร </label>
                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', $form->fax) }}" disabled>
            </div>
        </div>

        <br>
        <h5>ขอยื่นคำร้องขอรับ/ขอต่ออายุใบอนุญาตจัดตั้งสถานที่ ต่อเข้าพนักงานท้องถิ่น</h5><br>

        <div class="col-md-5 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="confirm_option" id="confirm_food_selling"
                    value="จัดตั้งสถานที่จำหน่ายอาหาร"
                    @checked(old('confirm_option', $form["details"]->confirm_option ?? '') == '1') disabled>
                <label class="form-check-label" for="confirm_food_selling">
                    จัดตั้งสถานที่จำหน่ายอาหาร
                </label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="confirm_option" id="confirm_food_storage"
                    value="จัดตั้งสถานที่สะสมอาหาร"
                    @checked(old('confirm_option', $form['details']->confirm_option ?? '') == '2') disabled>
                <label class="form-check-label" for="confirm_food_storage">
                    จัดตั้งสถานที่สะสมอาหาร
                </label>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="confirm_volume" class="form-label">ตามใบอนุญาต เล่มที่</label>
                <input type="text" class="form-control" id="confirm_volume" name="confirm_volume" value="{{ old('confirm_volume', $form->details->first()->confirm_volume ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="confirm_number" class="form-label">เลขที่</label>
                <input type="text" class="form-control" id="confirm_number" name="confirm_number" value="{{ old('confirm_number', $form->details->first()->confirm_number ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="confirm_year" class="form-label">ปี</label>
                <input type="text" class="form-control" id="confirm_year" name="confirm_year" value="{{ old('confirm_year', $form->details->first()->confirm_year ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="confirm_expiration_date" class="form-label">ซึ่งจะหมดอายุลงในวันที่</label>
                <input type="date" class="form-control" id="confirm_expiration_date" name="confirm_expiration_date" value="{{ old('confirm_expiration_date', $form->details->first()->confirm_expiration_date ?? '') }}" disabled>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="place_name" class="form-label"><strong>1.</strong> สถานที่ชื่อ</label>
                <input type="text" class="form-control" id="place_name" name="place_name" value="{{ old('place_name', $form->details->first()->place_name ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="shop_type" class="form-label">ประเภทร้าน</label>
                <input type="text" class="form-control" id="shop_type" name="shop_type" value="{{ old('shop_type', $form->details->first()->shop_type ?? '') }}" disabled>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="location" class="form-label"><strong>2.</strong> สถานที่ตั้งเลขที่</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $form->details->first()->location ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="details_village" name="details_village" value="{{ old('details_village', $form->details->first()->details_village ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="details_alley" name="details_alley" value="{{ old('details_alley', $form->details->first()->details_alley ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="details_road" name="details_road" value="{{ old('details_road', $form->details->first()->details_road ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_subdistrict" class="form-label">ตำบล/แขวง</label>
                <input type="text" class="form-control" id="details_subdistrict" name="details_subdistrict" value="{{ old('details_subdistrict', $form->details->first()->details_subdistrict ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="details_district" name="details_district" value="{{ old('details_district', $form->details->first()->details_district ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="details_province" name="details_province" value="{{ old('details_province', $form->details->first()->details_province ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_telephone" class="form-label">โทรศัพท์</label>
                <input type="text" class="form-control" id="details_telephone" name="details_telephone" maxlength="10" value="{{ old('details_telephone', $form->details->first()->details_telephone ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="details_fax" class="form-label">โทรสาร</label>
                <input type="text" class="form-control" id="details_fax" name="details_fax" value="{{ old('details_fax', $form->details->first()->details_fax ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="business_area" class="form-label">พื้นที่ประกอบการ (ตารางเมตร)</label>
                <input type="text" class="form-control" id="business_area" name="business_area" value="{{ old('business_area', $form->details->first()->business_area ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="number_of_cooks" class="form-label">จำนวนผู้ปรุง (คน)</label>
                <input type="text" class="form-control" id="number_of_cooks" name="number_of_cooks" value="{{ old('number_of_cooks', $form->details->first()->number_of_cooks ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="number_of_food" class="form-label">ผู้เสิร์ฟ (คน)</label>
                <input type="text" class="form-control" id="number_of_food" name="number_of_food" value="{{ old('number_of_food', $form->details->first()->number_of_food ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="including_food_handlers" class="form-label">รวมผู้สัมผัสอาหาร (คน)</label>
                <input type="text" class="form-control" id="including_food_handlers" name="including_food_handlers" value="{{ old('including_food_handlers', $form->details->first()->including_food_handlers ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="number_of_trainees" class="form-label">ผ่านการอบรมแล้วจำนวน (คน)</label>
                <input type="text" class="form-control" id="number_of_trainees" name="number_of_trainees" value="{{ old('number_of_trainees', $form->details->first()->number_of_trainees ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="opening_hours" class="form-label">เปิดประกอบการตั้งแต่เวลา (น.)</label>
                <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $form->details->first()->opening_hours ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="opening_for_business_until" class="form-label">ถึงเวลา (น.)</label>
                <input type="text" class="form-control" id="opening_for_business_until" name="opening_for_business_until" value="{{ old('opening_for_business_until', $form->details->first()->opening_for_business_until ?? '') }}" disabled>
            </div>

            <div class="col-md-3">
                <label for="total_hours" class="form-label">รวม (ชั่วโมง/วัน)</label>
                <input type="text" class="form-control" id="total_hours" name="total_hours" value="{{ old('total_hours', $form->details->first()->total_hours ?? '') }}" disabled>
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
        <br>
    </form>
</div>

<script src="{{asset('js/multipart_files.js')}}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
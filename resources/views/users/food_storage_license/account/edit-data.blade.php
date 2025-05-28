@extends('users.layout.layout')
@section('pages_content')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">
    <a href="#">กลับ</a><br>
    <h2 class="text-center mb-4">แบบคำร้องใบอนุญาตสะสมอาหาร</h2><br>
    <h2 class="text-center">แก้ไขฟอร์ม</h2><br>

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label class="form-label d-block">ข้าพเจ้า <span class="text-danger">*</span></label>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_individual" value="บุคคลธรรมดา" @checked(old('title_name', $form->title_name) == 'บุคคลธรรมดา') required>
                    <label class="form-check-label" for="person_individual">
                        บุคคลธรรมดา
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="title_name" id="person_legal" value="นิติบุคคล" @checked(old('title_name', $form->title_name) == 'นิติบุคคล')>
                    <label class="form-check-label" for="person_legal">
                        นิติบุคคล
                    </label>
                </div>
            </div>


            <div class="col-md-2">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="full_name" class="form-label">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $form->full_name) }}" required>
            </div>

            <div class="col-md-2">
                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="age" name="age" value="{{ old('age', $form->age) }}" required>
            </div>

            <div class="col-md-2">
                <label for="nationality" class="form-label">สัญชาติ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $form->nationality) }}" required>
            </div>

            <div class="col-md-3">
                <label for="id_card_number" class="form-label">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="id_card_number" name="id_card_number" value="{{ old('id_card_number', $form->id_card_number) }}" required maxlength="13">
            </div>

            <div class="col-md-3">
                <label for="address" class="form-label">อยู่บ้าน/สำนักงานเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $form->address) }}" required>
            </div>

            <div class="col-md-3">
                <label for="village" class="form-label">หมู่ที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $form->village) }}" required>
            </div>

            <div class="col-md-3">
                <label for="alley" class="form-label">ตรอก/ซอย <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="alley" name="alley" value="{{ old('alley', $form->alley) }}" required>
            </div>

            <div class="col-md-3">
                <label for="road" class="form-label">ถนน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="road" name="road" value="{{ old('road', $form->road) }}" required>
            </div>

            <div class="col-md-3">
                <label for="subdistrict" class="form-label">ตำบล/แขวง <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $form->subdistrict) }}" required>
            </div>

            <div class="col-md-3">
                <label for="district" class="form-label">อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $form->district) }}" required>
            </div>

            <div class="col-md-3">
                <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $form->province) }}" required>
            </div>

            <div class="col-md-3">
                <label for="telephone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $form->telephone) }}" required maxlength="10">
            </div>

            <div class="col-md-3">
                <label for="fax" class="form-label">โทรสาร <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', $form->fax) }}" required>
            </div>
        </div>

        <br>
        <h5>ขอยื่นคำร้องขอรับ/ขอต่ออายุใบอนุญาตจัดตั้งสถานที่ ต่อเจ้าพนักงานท้องถิ่น</h5><br>

        <div class="col-md-5 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="confirm_option" id="confirm_food_selling"
                    value="จัดตั้งสถานที่จำหน่ายอาหาร"
                    @checked(old('confirm_option', $form['details']->confirm_option ?? '') == 'จัดตั้งสถานที่จำหน่ายอาหาร') required>
                <label class="form-check-label" for="confirm_food_selling">
                    จัดตั้งสถานที่จำหน่ายอาหาร
                </label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="confirm_option" id="confirm_food_storage"
                    value="จัดตั้งสถานที่สะสมอาหาร"
                    @checked(old('confirm_option', $form['details']->confirm_option ?? '') == 'จัดตั้งสถานที่สะสมอาหาร')>
                <label class="form-check-label" for="confirm_food_storage">
                    จัดตั้งสถานที่สะสมอาหาร
                </label>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="confirm_volume" class="form-label">ตามใบอนุญาต เล่มที่</label>
                <input type="text" class="form-control" id="confirm_volume" name="confirm_volume" value="{{ old('confirm_volume', $form['details']->confirm_volume ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="confirm_number" class="form-label">เลขที่</label>
                <input type="text" class="form-control" id="confirm_number" name="confirm_number" value="{{ old('confirm_number', $form['details']->confirm_number ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="confirm_year" class="form-label">ปี</label>
                <input type="text" class="form-control" id="confirm_year" name="confirm_year" value="{{ old('confirm_year', $form['details']->confirm_year ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="confirm_expiration_date" class="form-label">ซึ่งจะหมดอายุลงในวันที่</label>
                <input type="date" class="form-control" id="confirm_expiration_date" name="confirm_expiration_date" value="{{ old('confirm_expiration_date', $form['details']->confirm_expiration_date ?? '') }}">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="place_name" class="form-label"><strong>1.</strong> สถานที่ชื่อ</label>
                <input type="text" class="form-control" id="place_name" name="place_name" value="{{ old('place_name', $form['details']->place_name ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="shop_type" class="form-label">ประเภทร้าน</label>
                <input type="text" class="form-control" id="shop_type" name="shop_type" value="{{ old('shop_type', $form['details']->shop_type ?? '') }}">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="location" class="form-label"><strong>2.</strong> สถานที่ตั้งเลขที่</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $form['details']->location ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="details_village" name="details_village" value="{{ old('details_village', $form['details']->details_village ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="details_alley" name="details_alley" value="{{ old('details_alley', $form['details']->details_alley ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="details_road" name="details_road" value="{{ old('details_road', $form['details']->details_road ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_subdistrict" class="form-label">ตำบล/แขวง</label>
                <input type="text" class="form-control" id="details_subdistrict" name="details_subdistrict" value="{{ old('details_subdistrict', $form['details']->details_subdistrict ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="details_district" name="details_district" value="{{ old('details_district', $form['details']->details_district ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="details_province" name="details_province" value="{{ old('details_province', $form['details']->details_province ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_telephone" class="form-label">โทรศัพท์</label>
                <input type="text" class="form-control" id="details_telephone" name="details_telephone" maxlength="10" value="{{ old('details_telephone', $form['details']->details_telephone ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="details_fax" class="form-label">โทรสาร</label>
                <input type="text" class="form-control" id="details_fax" name="details_fax" value="{{ old('details_fax', $form['details']->details_fax ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="business_area" class="form-label">พื้นที่ประกอบการ (ตารางเมตร)</label>
                <input type="text" class="form-control" id="business_area" name="business_area" value="{{ old('business_area', $form['details']->business_area ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="number_of_cooks" class="form-label">จำนวนผู้ปรุง (คน)</label>
                <input type="text" class="form-control" id="number_of_cooks" name="number_of_cooks" value="{{ old('number_of_cooks', $form['details']->number_of_cooks ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="number_of_food" class="form-label">ผู้เสิร์ฟ (คน)</label>
                <input type="text" class="form-control" id="number_of_food" name="number_of_food" value="{{ old('number_of_food', $form['details']->number_of_food ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="including_food_handlers" class="form-label">รวมผู้สัมผัสอาหาร (คน)</label>
                <input type="text" class="form-control" id="including_food_handlers" name="including_food_handlers" value="{{ old('including_food_handlers', $form['details']->including_food_handlers ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="number_of_trainees" class="form-label">ผ่านการอบรมแล้วจำนวน (คน)</label>
                <input type="text" class="form-control" id="number_of_trainees" name="number_of_trainees" value="{{ old('number_of_trainees', $form['details']->number_of_trainees ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="opening_hours" class="form-label">เปิดประกอบการตั้งแต่เวลา (น.)</label>
                <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $form['details']->opening_hours ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="opening_for_business_until" class="form-label">ถึงเวลา (น.)</label>
                <input type="text" class="form-control" id="opening_for_business_until" name="opening_for_business_until" value="{{ old('opening_for_business_until', $form['details']->opening_for_business_until ?? '') }}">
            </div>

            <div class="col-md-3">
                <label for="total_hours" class="form-label">รวม (ชั่วโมง/วัน)</label>
                <input type="text" class="form-control" id="total_hours" name="total_hours" value="{{ old('total_hours', $form['details']->total_hours ?? '') }}">
            </div>

            <br>
            <p><strong>3. </strong>พร้อมคำร้องนี้ข้าพเจ้าได้แนบหนังสือรับรองการแจ้งเดิมและเอกสารหลักฐานต่างๆ มาด้วยคือ</p>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option1" id="option1"
                            @if(in_array("option1", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option1">
                            Option 1
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option2" id="option2"
                            @if(in_array("option2", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option2">
                            Option 2
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option3" id="option3"
                            @if(in_array("option3", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option3">
                            Option 3
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option4" id="option4"
                            @if(in_array("option4", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option4">
                            Option 4
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option5" id="option5"
                            @if(in_array("option5", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option5">
                            Option 5
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option6" id="option6"
                            @if(in_array("option6", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option6">
                            Option 6
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option7" id="option7"
                            @if(in_array("option7", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option7">
                            Option 7
                        </label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_option[]" value="option8" id="option8"
                            @if(in_array("option8", $form['details']->document_option)) checked @endif>
                        <label class="form-check-label" for="option8">
                            อื่นๆ
                        </label>
                    </div>

                    <!-- Input ที่จะซ่อน/แสดงเมื่อเลือก checkbox -->
                    <div class="col-md-7" id="document_option_detail_div" style="display:
                        @if(in_array("option8", $form['details']->document_option)) block @else none @endif;">
                        <label for="document_option_detail" class="form-label">รายละเอียดอื่นๆ</label>
                        <input type="text" class="form-control" id="document_option_detail" name="document_option_detail"
                            value="{{ old('document_option_detail', $form['details']->document_option_detail) }}">
                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Row 7: แนบไฟล์ -->
        <div class="mb-3">
            <label for="attachments" class="form-label">แนบไฟล์ (รูปหรือเอกสารประกอบคำร้อง)</label>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
            <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
            <div id="file-list" class="mt-1">
                <div class="d-flex flex-wrap gap-3"></div>
            </div>
        </div>

        <!-- ปุ่มบันทึก -->
        <div class="text-center w-full border">
            <button type="submit" class="btn btn-primary w-100 py-1"><i class="fa-solid fa-file-arrow-up me-2"></i></i>
                ส่งฟอร์มข้อมูล</button>
        </div>
    </form>

</div>

@endsection

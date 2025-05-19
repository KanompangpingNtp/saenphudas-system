@extends('users.layout.layout')
@section('pages_content')

    <div class="container">
        <h3 class="text-center">แก้ไขแบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ</h3>

        <form action="{{ route('DisabilityUserFormUpdate', $form->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- <h3>ข้อมูลมอบอำนาจหรือผู้ดูแลคนพิการ</h3> --}}
            {{-- <div class="row mb-3 w-100">
                <label class="col-12 col-xl-3 col-form-label">ขอขึ้นทะเบียน โดยเป็น:</label>
                <div class="col-12 col-xl-9">
                    <div class="d-flex flex-column flex-xl-row">
                        <div class="form-check me-xl-4">
                            <input class="form-check-input" type="radio" id="trade_condition_option1"
                                name="trade_condition" value="option1"
                                {{ old('trade_condition', $form->disabilityTraders->first()->trade_condition ?? '') == 'option1' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="trade_condition_option1">บิดา - มารดา</label>
                        </div>
                        <div class="form-check me-xl-4">
                            <input class="form-check-input" type="radio" id="trade_condition_option2"
                                name="trade_condition" value="option2"
                                {{ old('trade_condition', $form->disabilityTraders->first()->trade_condition ?? '') == 'option2' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="trade_condition_option2">บุตร</label>
                        </div>
                        <div class="form-check me-xl-4">
                            <input class="form-check-input" type="radio" id="trade_condition_option3"
                                name="trade_condition" value="option3"
                                {{ old('trade_condition', $form->disabilityTraders->first()->trade_condition ?? '') == 'option3' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="trade_condition_option3">สามี - ภรรยา</label>
                        </div>
                        <div class="form-check me-xl-4">
                            <input class="form-check-input" type="radio" id="trade_condition_option4"
                                name="trade_condition" value="option4"
                                {{ old('trade_condition', $form->disabilityTraders->first()->trade_condition ?? '') == 'option4' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="trade_condition_option4">พี่น้อง</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="trade_condition_option5"
                                name="trade_condition" value="option5"
                                {{ old('trade_condition', $form->disabilityTraders->first()->trade_condition ?? '') == 'option5' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="trade_condition_option5">ผู้ดูแลคนพิการตามระเบียบฯ</label>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row mb-3">
                <label for="elderly_name" class="col-sm-3 col-form-label">ชื่อผู้มอบอำนาจ:</label>
                <div class="col-sm-9">
                    <input type="text" id="elderly_name" name="elderly_name" class="form-control"
                        value="{{ old('elderly_name', $form->disabilityTraders->first()->elderly_name ?? '') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="trader_citizen_id" class="col-sm-3 col-form-label">เลขบัตรประชาชน:</label>
                <div class="col-sm-9">
                    <input type="text" id="trader_citizen_id" name="trader_citizen_id" class="form-control"
                        value="{{ old('trader_citizen_id', $form->disabilityTraders->first()->citizen_id ?? '') }}"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="trader_phone_number" class="col-sm-3 col-form-label">โทรศัพท์:</label>
                <div class="col-sm-9">
                    <input type="text" id="trader_phone_number" name="trader_phone_number" class="form-control"
                        value="{{ old('trader_phone_number', $form->disabilityTraders->first()->phone_number ?? '') }}"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="trader_address" class="col-sm-3 col-form-label">ที่อยู่:</label>
                <div class="col-sm-9">
                    <textarea id="trader_address" name="trader_address" class="form-control" rows="3" required> {{ old('elderly_name', $form->disabilityTraders->first()->address ?? '') }}</textarea>
                </div>
            </div> --}}

            <!-- Personal Information -->
            <div class="my-4">
                <h3>ข้อมูลผู้พิการ</h3>

                <div class="row mb-3">
                    <label for="written_at" class="col-sm-3 col-form-label">เขียนที่:</label>
                    <div class="col-sm-9">
                        <input type="text" id="written_at" name="written_at" class="form-control"
                            value="{{ old('date', $form->written_at) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="written_date" class="col-sm-3 col-form-label">วันที่:</label>
                    <div class="col-sm-9">
                        <input type="date" id="written_date" name="written_date" class="form-control"
                            value="{{ old('written_date', $form->written_date) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="salutation" class="col-sm-3 col-form-label">คำนำหน้า:</label>
                    <div class="col-sm-9">
                        <input type="text" id="salutation" name="salutation" class="form-control"
                            value="{{ old('salutation', $form->salutation) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="first_name" class="col-sm-3 col-form-label">ชื่อ:</label>
                    <div class="col-sm-9">
                        <input type="text" id="first_name" name="first_name" class="form-control"
                            value="{{ old('first_name', $form->first_name) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="last_name" class="col-sm-3 col-form-label">นามสกุล:</label>
                    <div class="col-sm-9">
                        <input type="text" id="last_name" name="last_name" class="form-control"
                            value="{{ old('last_name', $form->last_name) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="birth_day" class="col-sm-3 col-form-label">วันเกิด:</label>
                    <div class="col-sm-9">
                        <input type="date" id="birth_day" name="birth_day" class="form-control"
                            value="{{ old('birth_day', $form->birth_day) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="age" class="col-sm-3 col-form-label">อายุ:</label>
                    <div class="col-sm-9">
                        <input type="number" id="age" name="age" class="form-control"
                            value="{{ old('age', $form->age) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nationality" class="col-sm-3 col-form-label">สัญชาติ:</label>
                    <div class="col-sm-9">
                        <input type="text" id="nationality" name="nationality" class="form-control"
                            value="{{ old('nationality', $form->nationality) }}" required>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="row mb-3">
                    <label for="house_number" class="col-sm-3 col-form-label">บ้านเลขที่:</label>
                    <div class="col-sm-9">
                        <input type="text" id="house_number" name="house_number" class="form-control"
                            value="{{ old('house_number', $form->house_number) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="village" class="col-sm-3 col-form-label">หมู่:</label>
                    <div class="col-sm-9">
                        <input type="text" id="village" name="village" class="form-control"
                            value="{{ old('village', $form->village) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alley" class="col-sm-3 col-form-label">ซอย:</label>
                    <div class="col-sm-9">
                        <input type="text" id="alley" name="alley" class="form-control"
                            value="{{ old('alley', $form->alley) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="road" class="col-sm-3 col-form-label">ถนน:</label>
                    <div class="col-sm-9">
                        <input type="text" id="road" name="road" class="form-control"
                            value="{{ old('road', $form->road) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="subdistrict" class="col-sm-3 col-form-label">ตำบล:</label>
                    <div class="col-sm-9">
                        <input type="text" id="subdistrict" name="subdistrict" class="form-control"
                            value="{{ old('subdistrict', $form->subdistrict) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="district" class="col-sm-3 col-form-label">อำเภอ:</label>
                    <div class="col-sm-9">
                        <input type="text" id="district" name="district" class="form-control"
                            value="{{ old('district', $form->district) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="province" class="col-sm-3 col-form-label">จังหวัด:</label>
                    <div class="col-sm-9">
                        <input type="text" id="province" name="province" class="form-control"
                            value="{{ old('province', $form->province) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="postal_code" class="col-sm-3 col-form-label">รหัสไปรษณีย์:</label>
                    <div class="col-sm-9">
                        <input type="text" id="postal_code" name="postal_code" class="form-control"
                            value="{{ old('postal_code', $form->postal_code) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone_number" class="col-sm-3 col-form-label">โทรศัพท์:</label>
                    <div class="col-sm-9">
                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                            value="{{ old('phone_number', $form->phone_number) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="citizen_id" class="col-sm-3 col-form-label">เลขบัตรประชาชน:</label>
                    <div class="col-sm-9">
                        <input type="text" id="citizen_id" name="citizen_id" class="form-control"
                            value="{{ old('citizen_id', $form->citizen_id) }}" required>
                    </div>
                </div>
            </div>

            <hr>

            <div class="my-4">
                <h3 for="type_of_disability" class="form-label">ประเภทความพิการ</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option1"
                                name="type_of_disability" value="option1"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option1' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="type_of_disability_option1">ความพิการทางการเห็น</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option2"
                                name="type_of_disability" value="option2"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option2' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="type_of_disability_option2">ความพิการทางสติปัญญา</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option3"
                                name="type_of_disability" value="option3"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option3' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="type_of_disability_option3">ความพิการทางการได้ยินหรือสื่อความหมาย</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option4"
                                name="type_of_disability" value="option4"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option4' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="type_of_disability_option4">ความพิการทางการเรียนรู้</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option5"
                                name="type_of_disability" value="option5"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option5' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="type_of_disability_option5">ความพิการทางการเคลื่อนไหวหรือทางร่างกาย</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option6"
                                name="type_of_disability" value="option6"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option6' ? 'checked' : '' }}>
                            <label class="form-check-label" for="type_of_disability_option6">ความพิการทางออทิสติก</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="type_of_disability_option7"
                                name="type_of_disability" value="option7"
                                {{ old('type_of_disability', $form->type_of_disability) == 'option7' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="type_of_disability_option7">ความพิการทางการจิตใจหรือพฤติกรรม</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <label for="marital_status" class="col-sm-3 col-form-label">สถานภาพการสมรส:</label>
                <div class="col-sm-9">
                    <select id="marital_status" name="marital_status" class="form-select" required>
                        <option value="single">โสด</option>
                        <option value="married">แต่งงานแล้ว</option>
                        <option value="widowed">เป็นม่าย</option>
                        <option value="divorced">หย่าร้าง</option>
                        <option value="separated">แยกจากกัน</option>
                        <option value="other">อื่นๆ</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="monthly_income" class="col-sm-3 col-form-label">รายได้ต่อเดือน:</label>
                <div class="col-sm-9">
                    <input type="text" id="monthly_income" name="monthly_income" class="form-control"
                        value="{{ old('monthly_income', $form->monthly_income) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="occupation" class="col-sm-3 col-form-label">อาชีพ:</label>
                <div class="col-sm-9">
                    <input type="text" id="occupation" name="occupation" class="form-control"
                        value="{{ old('occupation', $form->occupation) }}">
                </div>
            </div>

            <hr>

            <h3 class="form-label">ข้อมูลทั่วไป : สถานภาพการรับสวัสดิการภาครัฐ</h3>
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="welfare_type[]" id="welfare_type_aid"
                            value="option1"
                            {{ in_array('option1', old('welfare_type', $form->disabilityOptions->first()->welfare_type ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="welfare_type_aid">ไม่ได้รับเบี้ยยังชีพผู้สูงอายุ</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="welfare_type[]"
                            id="welfare_type_disability" value="option2"
                            {{ in_array('option2', old('welfare_type', $form->disabilityOptions->first()->welfare_type ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="welfare_type_disability">ได้รับเงินสงเคราะห์เพื่อการยังชีพผู้ป่วยเอดส</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="welfare_type[]"
                            id="welfare_type_disability_2" value="option3"
                            {{ in_array('option3', old('welfare_type', $form->disabilityOptions->first()->welfare_type ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="welfare_type_disability_2">ได้รับเงินเบี้ยความพิการ</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="welfare_type[]"
                            id="welfare_type_relocation" value="option4"
                            {{ in_array('option4', old('welfare_type', $form->disabilityOptions->first()->welfare_type ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="welfare_type_relocation">ย้ายภูมิลำเนาเข้ามาอยู่ใหม่
                            เมื่อ</label>
                    </div>
                </div>
            </div>

            <!-- welfare_other_types input (visible when 'ย้ายภูมิลําเนาเข้ามาอยู่ใหม่' is checked) -->
            <div id="welfare_other_types_div" class="row mb-3"
                style="display: {{ in_array('option4', old('welfare_type', $form->disabilityOptions->first()->welfare_type ?? [])) ? 'block' : 'none' }};">
                <label class="col-sm-3 col-form-label" for="welfare_other_types">รายละเอียดอื่นๆ</label>
                <div class="col-sm-9">
                    <input type="text" id="welfare_other_types" name="welfare_other_types" class="form-control"
                        value="{{ old('welfare_other_types', $form->disabilityOptions->first()->welfare_other_types ?? '') }}"
                        placeholder="กรอกข้อมูลเพิ่มเติม">
                </div>
            </div>

            <hr>

            <div class="my-4">
                <h3>มีความประสงค์ขอรับเงินเบี้ยยังชีพผู้สูงอายุ โดยวิธีดังต่อไปนี้ (เลือก 1 วิธี)</h3>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option1"
                        value="option1"
                        {{ old('request_for_money_type', $form->disabilityOptions->first()->request_for_money_type ?? '') == 'option1' ? 'checked' : '' }}
                        required>
                    <label class="form-check-label" for="money_type_option1">รับเงินสดด้วยตนเอง</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option2"
                        value="option2"
                        {{ old('request_for_money_type', $form->disabilityOptions->first()->request_for_money_type ?? '') == 'option2' ? 'checked' : '' }}>
                    <label class="form-check-label"
                        for="money_type_option2">รับเงินสดโดยบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option3"
                        value="option3"
                        {{ old('request_for_money_type', $form->disabilityOptions->first()->request_for_money_type ?? '') == 'option3' ? 'checked' : '' }}>
                    <label class="form-check-label"
                        for="money_type_option3">โอนเงินเข้าบัญชีเงินฝากธนาคารในนามผู้มีสิทธิ</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="request_for_money_type" id="money_type_option4"
                        value="option4"
                        {{ old('request_for_money_type', $form->disabilityOptions->first()->request_for_money_type ?? '') == 'option4' ? 'checked' : '' }}>
                    <label class="form-check-label"
                        for="money_type_option4">โอนเงินเข้าบัญชีเงินฝากธนาคารในนามบุคคลที่ได้รับมอบอำนาจจากผู้มีสิทธิ</label>
                </div>
            </div>

            <hr>

            @php
                $documentType = $form->disabilityOptions->first()->document_type ?? '[]';
                if (!is_string($documentType)) {
                    $documentType = '[]';
                }
                $documentTypeArray = json_decode($documentType, true);
            @endphp

            <h3>เลือกประเภทเอกสาร</h3>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_type[]"
                            id="document_type_id_card" value="option1"
                            {{ in_array('option1', $documentTypeArray) ? 'checked' : '' }}>
                        <label class="form-check-label" for="document_type_id_card">สำเนาบัตรประจำตัวประชาชน</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_type[]"
                            id="document_type_house_reg" value="option2"
                            {{ in_array('option2', $documentTypeArray) ? 'checked' : '' }}>
                        <label class="form-check-label" for="document_type_house_reg">สำเนาทะเบียนบ้าน</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_type[]"
                            id="document_type_bank_book" value="option3"
                            {{ in_array('option3', $documentTypeArray) ? 'checked' : '' }}>
                        <label class="form-check-label" for="document_type_bank_book">สำเนาสมุดบัญชีเงินฝากธนาคาร</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_type[]"
                            id="document_type_auth_letter" value="option4"
                            {{ in_array('option4', $documentTypeArray) ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="document_type_auth_letter">หนังสือมอบอำนาจพร้อมสำเนาบัตรประจำตัวประชาชนของผู้มอบอำนาจและผู้รับมอบอำนาจ</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="bank_option" id="bank_option" value="1"
                        onclick="toggleAccountInputs()"
                        {{ old('bank_option', $form->disabilityBankAccounts->first()->bank_option ?? '') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="bank_option">บัญชีเงินฝากธนาคาร</label>
                </div>
            </div>

            <div class="form-group" id="bank_name_group" style="display: none;">
                <label for="bank_name" class="form-label">ชื่อธนาคาร</label>
                <input type="text" id="bank_name" name="bank_name" class="form-control"
                    value="{{ old('bank_name', $form->disabilityBankAccounts->first()->bank_name ?? '') }}">
            </div>

            <!-- Account Number (Input) - Initially hidden -->
            <div class="form-group" id="account_number_group" style="display: none;">
                <label for="account_number" class="form-label">บัญชีเลขที่</label>
                <input type="text" id="account_number" name="account_number" class="form-control"
                    value="{{ old('account_number', $form->disabilityBankAccounts->first()->account_number ?? '') }}">
            </div>

            <!-- Account Name (Input) - Initially hidden -->
            <div class="form-group" id="account_name_group" style="display: none;">
                <label for="account_name" class="form-label">ชื่อบัญชี</label>
                <input type="text" id="account_name" name="account_name" class="form-control"
                    value="{{ old('account_name', $form->disabilityBankAccounts->first()->account_name ?? '') }}">
            </div>

            <hr>

            <div class="mb-3">
                <label class="form-label">ไฟล์แนบปัจจุบัน</label>
                <div class="list-group">
                    @foreach ($form->disabilityAttachments as $attachment)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                                class="text-truncate" style="max-width: 80%;">
                                {{ basename($attachment->file_path) }}
                            </a>
                            <div class="form-check">
                                <input type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}"
                                    class="form-check-input">
                                <label class="form-check-label"
                                    for="delete_attachments_{{ $attachment->id }}">ลบไฟล์นี้</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 for="attachments" class="form-label">แนบไฟล์</h3>
                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
                <!-- แสดงรายการไฟล์ที่แนบ -->
                <div id="file-list" class="mt-1">
                    <div class="d-flex flex-wrap gap-3"></div>
                </div>
            </div>

            <div class="text-center w-full border">
                <button type="submit" class="btn btn-primary w-100 py-1"><i
                        class="fa-solid fa-file-arrow-up me-2"></i></i>
                    ส่งฟอร์มข้อมูล</button>
            </div>
        </form>
    </div>


    <script src="{{ asset('js/multipart_files.js') }}"></script>

    <script>
        // Toggle display of the welfare_other_types field based on the 'ย้ายภูมิลําเนาเข้ามาอยู่ใหม่' checkbox
        document.getElementById('welfare_type_relocation').addEventListener('change', function() {
            const otherTypesDiv = document.getElementById('welfare_other_types_div');
            otherTypesDiv.style.display = this.checked ? 'block' : 'none';
        });
    </script>

    <script>
        // Function to toggle the visibility of account inputs based on the checkbox
        function toggleAccountInputs() {
            var checkBox = document.getElementById("bank_option");
            var accountNumberGroup = document.getElementById("account_number_group");
            var accountNameGroup = document.getElementById("account_name_group");
            var bankNameGroup = document.getElementById("bank_name_group");

            // If checkbox is checked, show the account inputs, otherwise hide them
            if (checkBox.checked) {
                accountNumberGroup.style.display = "block";
                accountNameGroup.style.display = "block";
                bankNameGroup.style.display = "block";
            } else {
                accountNumberGroup.style.display = "none";
                accountNameGroup.style.display = "none";
                bankNameGroup.style.display = "none";
            }
        }

        // Check inputs on page load to determine visibility
        document.addEventListener("DOMContentLoaded", function() {
            var checkBox = document.getElementById("bank_option");
            var accountNumberInput = document.getElementById("account_number");
            var accountNameInput = document.getElementById("account_name");
            var bankNameInput = document.getElementById("bank_name");

            // If any of the inputs have values or the checkbox is checked, display the groups
            if (
                checkBox.checked ||
                accountNumberInput.value.trim() !== "" ||
                accountNameInput.value.trim() !== "" ||
                bankNameInput.value.trim() !== ""
            ) {
                checkBox.checked = true; // Ensure the checkbox is checked
                toggleAccountInputs();
            }
        });
    </script>


@endsection

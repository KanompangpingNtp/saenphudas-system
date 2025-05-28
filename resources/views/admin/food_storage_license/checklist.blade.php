@extends('admin.layout.layout')
@section('admin_content')
    <div class="container">
        <h2 class="text-center mb-4">แบบสำรวจสถานที่จำหน่ายอาหารและสะสมอาหาร <br> กองสาธารณสุขและสิ่งแวดล้อม </h2><br>

        <form action="{{ route('FoodStorageLicenseAdminChecklistSave') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <h5 class="mb-2">1. ประเภทกิจการ</h5>
                <div class="mb-2">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="business_type" name="business_type" value="1">
                        <label class="form-check-label" for="business_type">จำหน่ายอาหาร</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="business_type" name="business_type" value="2">
                        <label class="form-check-label" for="business_type">สะสมอาหาร</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">2. ประเภทการตรวจ</h5>
                <div class="mb-2">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="inspection_type" name="inspection_type" value="1">
                        <label class="form-check-label" for="inspection_type">ขออนุญาตใหม่</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="inspection_type" name="inspection_type" value="2">
                        <label class="form-check-label" for="inspection_type">ต่ออายุใบอนุญาต</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">3. ชื่อสถานประกอบกิจการ</h5>
                <div class="row g-3 align-items-center ">
                    <div class="col-md-4">
                        <label for="name_establishment" class="form-label">ชื่อสถานประกอบกิจการ</label>
                        <input type="text" class="form-control" id="name_establishment" name="name_establishment">
                    </div>
                    <div class="col-md-4">
                        <label for="owner_name" class="form-label">ชื่อผู้ประกอบการ/เจ้าของ</label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name">
                    </div>
                    <div class="col-md-4">
                        <label for="manager_name" class="form-label">ชื่อผู้จัดการ</label>
                        <input type="text" class="form-control" id="manager_name" name="manager_name">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">4. สถานที่ตั้ง</h5>
                <div class="row mb-2">
                    <div class="col-md-3 ">
                        <label for="location" class="form-label">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>
                    <div class="col-md-3 ">
                        <label for="village" class="form-label">หมู่</label>
                        <input type="text" class="form-control" id="village" name="village">
                    </div>
                    <div class="col-md-3 ">
                        <label for="alley" class="form-label">ซอย</label>
                        <input type="text" class="form-control" id="alley" name="alley">
                    </div>
                    <div class="col-md-3 ">
                        <label for="road" class="form-label">ถนน</label>
                        <input type="text" class="form-control" id="road" name="road">
                    </div>
                    <div class="col-md-3 ">
                        <label for="subdistrict" class="form-label">ตำบล/แขวง</label>
                        <input type="text" class="form-control" id="subdistrict" name="subdistrict">
                    </div>
                    <div class="col-md-3 ">
                        <label for="district" class="form-label">อำเภอ/เขต</label>
                        <input type="text" class="form-control" id="district" name="district">
                    </div>
                    <div class="col-md-3 ">
                        <label for="province" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="province" name="province">
                    </div>
                    <div class="col-md-3 ">
                        <label for="phone" class="form-label">หมายเลขโทรศัพท์</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="col-md-3 ">
                        <label for="fax" class="form-label">โทรสาร</label>
                        <input type="text" class="form-control" id="fax" name="fax">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">5. ลักษณะการประกอบการ</h5>
                <div class="mb-2">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="characteristics_options1"
                            name="characteristics_options[]" value="1">
                        <label class="form-check-label" for="characteristics_options1">อาคารเทศบาล</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="characteristics_options2"
                            name="characteristics_options[]" value="2">
                        <label class="form-check-label" for="characteristics_options2">ห้องแถว</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="characteristics_options3"
                            name="characteristics_options[]" value="3">
                        <label class="form-check-label" for="characteristics_options3">อาคารพักอาศัย</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="characteristics_options4"
                            name="characteristics_options[]" value="4">
                        <label class="form-check-label" for="characteristics_options4">ตึกแถว</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="characteristics_options5"
                            name="characteristics_options[]" value="5">
                        <label class="form-check-label" for="characteristics_options5">ศึกษาไม่ชัดเจน</label>
                    </div>
                </div>

                <div class="row g-3 align-items-center ">
                    <div class="col-md-4">
                        <label for="characteristics_floor" class="form-label">จำนวน (ชั้น)</label>
                        <input type="text" class="form-control" id="characteristics_floor"
                            name="characteristics_floor">
                    </div>
                    <div class="col-md-4">
                        <label for="characteristics_floor_no" class="form-label">ประกอบกิจการชั้นที่</label>
                        <input type="text" class="form-control" id="characteristics_floor_no"
                            name="characteristics_floor_no">
                    </div>
                    <div class="col-md-4">
                        <label for="characteristics_area" class="form-label">พื้้นที่ประกอบกิจการ (ตร.ม)</label>
                        <input type="text" class="form-control" id="characteristics_area"
                            name="characteristics_area">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">6. การสุขาภิบาลทั่วไป</h5>
                <div class="mb-2">
                    <label class="form-label ">- มีทางระบายน้ำหรือบ่อรับน้ำโสโครกที่ทำด้วยวัสดุถาวร เรียบ ไม่รั่ว
                        ไม่ซึม ระบายน้ำได้สะดวก</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option1"
                                id="sanitary_option1_yes" value="1" required>
                            <label class="form-check-label" for="sanitary_option1_yes">มี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option1"
                                id="sanitary_option1_no" value="2">
                            <label class="form-check-label" for="sanitary_option1_no">ไม่มี</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">
                        - มีระบบบำบัดน้ำเสียหรือไม่ (ถ้ามีระบายน้ำเสียไปสู่ที่ใด)
                        <input type="text" name="sanitary_option2_detail"
                            class="form-control d-inline-block w-auto ms-2" placeholder="ระบุสถานที่">
                    </label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option2"
                                id="sanitary_option2_yes" value="1" required>
                            <label class="form-check-label" for="sanitary_option2_yes">มี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option2"
                                id="sanitary_option2_no" value="2">
                            <label class="form-check-label" for="sanitary_option2_no">ไม่มี</label>
                        </div>
                    </div>
                </div>


                <div class="mb-2">
                    <label class="form-label ">- มีบ่อพักและบ่อดักไขมันที่ถูกต้องตามหลักสุขาภิบาลหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option3" id="sanitary_option3"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option3">มี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option3" id="sanitary_option3"
                                value="2">
                            <label class="form-check-label" for="sanitary_option3">ไม่มี</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label ">- มีอ่างล้างภาชนะและอุปกรณ์ที่ถูกต้องตามหลักสุขาภิบาลหรือไม่ </label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option4" id="sanitary_option4"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option4">มี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option4" id="sanitary_option4"
                                value="2">
                            <label class="form-check-label" for="sanitary_option4">ไม่มี</label>
                        </div>
                    </div>
                </div>

                <br>

                <div class="mb-2">
                    <label class="form-label ">- มีแสงสว่างและการระบายอากาศเพียงพอหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option5" id="sanitary_option5"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option5">เพียงพอ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option5" id="sanitary_option5"
                                value="2">
                            <label class="form-check-label" for="sanitary_option5">ไม่เพียงพอ</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label ">-
                        มีที่รองรับขยะมูลฝอยและสิ่งปฏิกูลที่ถูกสุขลักษณะและเพียงพอหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option6" id="sanitary_option6"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option6">เพียงพอ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option6" id="sanitary_option6"
                                value="2">
                            <label class="form-check-label" for="sanitary_option6">ไม่เพียงพอ</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label ">- มีอ่างล้างมือที่ถูกสุขลักษณะและมีสบู่ใช้เพียงพอหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option7" id="sanitary_option7"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option7">เพียงพอ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option7" id="sanitary_option7"
                                value="2">
                            <label class="form-check-label" for="sanitary_option7">ไม่เพียงพอ</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label ">- มีห้องน้ำ ห้องส้วม ที่ถูกสุขลักษณะและเพียงพอหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option8" id="sanitary_option8"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option8">เพียงพอ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option8" id="sanitary_option8"
                                value="2">
                            <label class="form-check-label" for="sanitary_option8">ไม่เพียงพอ</label>
                        </div>
                    </div>
                </div>

                <br>

                <div class="mb-2">
                    <label class="form-label ">- มีการจัดสถานที่ให้สะอาด เป็นระเบียบเรียบร้อย
                        ไม่เป็นที่อยู่อาศัยของสัตว์นำโรค</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option9" id="sanitary_option9"
                                value="1" required>
                            <label class="form-check-label" for="sanitary_option9">ถูกต้อง</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option9" id="sanitary_option9"
                                value="2">
                            <label class="form-check-label" for="sanitary_option9">ไม่ถูกต้อง</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label ">- มีการจัดโต๊ะ เก้าอี้ หรือที่นั่ง มีสภาพแข็งแรง
                        สะอาดเป็นระเบียบเรียบร้อย</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option10"
                                id="sanitary_option10" value="1" required>
                            <label class="form-check-label" for="sanitary_option10">ถูกต้อง</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option10"
                                id="sanitary_option10" value="2">
                            <label class="form-check-label" for="sanitary_option10">ไม่ถูกต้อง</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label ">- มีภาชนะอุปกรณ์เครื่องใช้ในการทำ ประกอบ ปรุง และบริโภค เพียงพอ
                        ปลอดภัย และถูกต้องด้วยสุขลักษณะตามเกณฑ์มาตรฐานหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option11"
                                id="sanitary_option11" value="1" required>
                            <label class="form-check-label" for="sanitary_option11">ถูกต้อง</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sanitary_option11"
                                id="sanitary_option11" value="2">
                            <label class="form-check-label" for="sanitary_option11">ไม่ถูกต้อง</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">7. จำนวนผู้สัมผัสอาหาร</h5>
                <div class="row g-3 align-items-center ">
                    <div class="col-md-4">
                        <label for="food_handlers" class="form-label">ผู้สัมผัสอาหาร จำนวน (คน)</label>
                        <input type="text" class="form-control" id="food_handlers" name="food_handlers">
                    </div>
                    <div class="col-md-4">
                        <label for="cook" class="form-label">ผู้ปรุง (คน)</label>
                        <input type="text" class="form-control" id="cook" name="cook">
                    </div>
                    <div class="col-md-4">
                        <label for="server" class="form-label">ผู้เสิร์ฟ (คน)</label>
                        <input type="text" class="form-control" id="server" name="server">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">- มีการตรวจสุขภาพประจำปีหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="health_check_option"
                                id="health_check_yes" value="1" required>
                            <label class="form-check-label" for="health_check_yes">มี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="health_check_option"
                                id="health_check_no" value="2">
                            <label class="form-check-label" for="health_check_no">ไม่มี</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">- การแต่งกายของผู้สัมผัสอาหาร</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dressing_option" id="dressing_clean"
                                value="1" required>
                            <label class="form-check-label" for="dressing_clean">สะอาด</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dressing_option" id="dressing_sleeves"
                                value="2">
                            <label class="form-check-label" for="dressing_sleeves">สวมเสื้อมีแขน</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dressing_option" id="dressing_apron"
                                value="3">
                            <label class="form-check-label" for="dressing_apron">ผูกผ้ากันเปื้อน</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dressing_option" id="dressing_cap"
                                value="4">
                            <label class="form-check-label" for="dressing_cap">สวมหมวกหรือเน็ตคลุมผม</label>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">- เคยผ่านการอบรมด้านสุขาภิบาลอาหารหรือไม่</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="training_option" id="training_yes"
                                value="1" required>
                            <label class="form-check-label" for="training_yes">เคย</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="training_option" id="training_no"
                                value="2">
                            <label class="form-check-label" for="training_no">ไม่เคย</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="mb-2">8. มีถังดับเพลิงอยู่ในสภาพสมบูรณ์ ไม่ชำรุด สามารถหยิบใช้งานได้ดี สะดวก
                    และมีการตรวจสอบทุกปี</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="extinguisher_yes" name="extinguisher_option"
                        value="1" required>
                    <label class="form-check-label" for="extinguisher_yes">มี</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="extinguisher_no" name="extinguisher_option"
                        value="2">
                    <label class="form-check-label" for="extinguisher_no">ไม่มี</label>
                </div>
            </div>


            <div class="row g-3  mt-4">
                <div class="col-md-7">
                    <label for="formFile" class="form-label">อัตราค่าธรรมเนียม :</label>
                    <input class="form-control" type="text" id="price" name="price">
                </div>
                <h5>สรุปผลการตรวจ</h5><br>
                <div class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="result" value="1">
                        <label class="form-check-label">
                            เห็นควรอนุญาต
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="result" value="2">
                        <label class="form-check-label">
                            ไม่เห็นควรอนุญาต
                        </label>
                    </div>
                </div>
                <div class="col-md-7">
                    <label for="number_of_food" class="form-label"> ข้อสรุปแนะนำของเจ้าหน้าที่ผู้ตรวจ : </label>
                    <textarea rows="6" class="form-control" name="detail" id="detail"></textarea>
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-primary py-1"><i class="fa fa-save"></i></i> บันทึกข้อมูล</button>
            <input type="hidden" name="id" value="{{ old('id', $form->id) }}">
        </form>
    </div>

    <script src="{{ asset('js/multipart_files.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>

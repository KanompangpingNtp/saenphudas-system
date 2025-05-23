@extends('users.layout.layout')
@section('pages_content')
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 10px;
        }
    </style>


    <h3 class="text-center">แบบคำขอรับการประเมินค่าธรรมเนียมการกำจัดสิ่งปฏิกูลและมูลฝอย และ แบบขอรับถังขยะมูลฝอยทั่วไป</h3>
    <br>

    <div class="container">
        <form action="{{ route('GarbageCollectionFormCreate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-3">

                <div class="col-md-2">
                    <label for="salutation" class="form-label">คำนำหน้า</label>
                    <select class="form-select" id="salutation" name="salutation">
                        <option value="" selected disabled>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="full_name" class="form-label">ชื่อ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>

                <div class="col-md-3">
                    <label for="address" class="form-label">อยู่บ้านเลขที่<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="col-md-3">
                    <label for="village" class="form-label">หมู่ที่</label>
                    <input type="text" class="form-control" id="village" name="village" required>
                </div>

                <div class="col-md-3">
                    <label for="sub_district" class="form-label">ตำบล</label>
                    <input type="text" class="form-control" id="sub_district" name="sub_district" required>
                </div>

                <div class="col-md-3">
                    <label for="district" class="form-label">อำเภอ</label>
                    <input type="text" class="form-control" id="district" name="district" required>
                </div>

                <div class="col-md-3">
                    <label for="province" class="form-label">จังหวัด</label>
                    <input type="text" class="form-control" id="province" name="province" required>
                </div>

                <div class="col-md-3">
                    <label for="phone" class="form-label">เบอร์ติดต่อ</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label">
                    โปรดขีดเครื่องหมาย / ลงใน ( ) หน้าข้อความที่ตรงกับประเภทของสถานที่จัดเก็บขยะมูลฝอยของท่าน
                </label>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="optione" id="option1" value="1">
                        <label class="form-check-label" for="option1"> บ้านที่อยู่อาศัย</label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="optione" id="option2" value="2">
                        <label class="form-check-label" for="option2"> บ้านเช่า/อาคารให้เช่า</label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="optione" id="option3" value="3">
                        <label class="form-check-label" for="option3"> ร้านค้า</label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="optione" id="option4" value="4">
                        <label class="form-check-label" for="option4"> โรงงาน/ประกอบธุรกิจ</label>
                    </div>
                    <div class="form-check me-3 d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="optione" id="option5" value="5">
                        <label class="form-check-label me-2" for="option5">อื่นๆ</label>
                    </div>
                </div>
            </div>

            <div id="optione_detail_container" style="display: none;" class="col-md-6 mt-3">
                <input type="text" class="form-control" id="optione_detail" name="optione_detail"
                    placeholder="โปรดระบุ">
            </div>

            <br>

            <p>ระบุที่ตั้งถังขยะ <i class="bi bi-caret-down-fill"></i></p>
            <div id="map" style="height: 400px;"></div>

            <p class="mt-2">
                ตำแหน่งที่เลือก:
                Latitude: <span id="lat-display"></span>,
                Longitude: <span id="lng-display"></span>
            </p>

            <!-- ตำแหน่งถังขยะที่เลือก -->
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            <!-- ตำแหน่งผู้ใช้ -->
            <input type="hidden" name="user_latitude" id="user_latitude">
            <input type="hidden" name="user_longitude" id="user_longitude">

            <br>

            <div class="mb-3">
                <label for="attachments" class="form-label">แนบไฟล์ (รูปหรือเอกสารประกอบคำร้อง)</label>
                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 2MB)</small>
                <div id="file-list" class="mt-1">
                    <div class="d-flex flex-wrap gap-3"></div>
                </div>
            </div>

            <div class="text-center w-full border mt-5">
                <button type="submit" class="btn btn-primary w-100 py-1"><i
                        class="fa-solid fa-file-arrow-up me-2"></i></i>
                    ส่งฟอร์มข้อมูล</button>
            </div>

        </form>
    </div>

    <script src="{{ asset('js/multipart_files.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll('input[name="optione"]');
            const otherDetail = document.getElementById("optione_detail_container");

            radios.forEach(radio => {
                radio.addEventListener("change", function() {
                    if (this.value === "5") {
                        otherDetail.style.display = "block";
                    } else {
                        otherDetail.style.display = "none";
                        document.getElementById("optione_detail").value =
                            "";
                    }
                });
            });
        });
    </script>

    <script>
        // let map, userMarker, trashMarker;

        // function loadMapWithLocation() {
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(
        //             (position) => {
        //                 const userLocation = {
        //                     lat: position.coords.latitude,
        //                     lng: position.coords.longitude
        //                 };
        //                 initMap(userLocation);
        //             },
        //             (error) => {
        //                 alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้ กรุณาอนุญาตการใช้ตำแหน่งหรือลองใหม่อีกครั้ง");
        //                 // fallback ตำแหน่งกลางกรุงเทพฯ
        //                 initMap({
        //                     lat: 13.736717,
        //                     lng: 100.523186
        //                 });
        //             }
        //         );
        //     } else {
        //         alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
        //         initMap({
        //             lat: 13.736717,
        //             lng: 100.523186
        //         }); // fallback
        //     }
        // }

        // function initMap(centerLocation) {
        //     map = new google.maps.Map(document.getElementById("map"), {
        //         zoom: 15,
        //         center: centerLocation,
        //     });

        //     // สร้าง marker สำหรับตำแหน่งผู้ใช้ (ไอคอนปกติ)
        //     userMarker = new google.maps.Marker({
        //         position: centerLocation,
        //         map: map,
        //         title: "ตำแหน่งของคุณ",
        //         // ไอคอน default หรือจะเปลี่ยนก็ได้ตามต้องการ
        //         // icon: 'path/to/custom-icon.png'  <-- ใส่ถ้าต้องการไอคอนอื่น
        //     });

        //     // เมื่อคลิกบนแผนที่จะสร้างหรือขยับ marker ถังขยะ
        //     map.addListener("click", (e) => {
        //         const lat = e.latLng.lat();
        //         const lng = e.latLng.lng();

        //         if (!trashMarker) {
        //             trashMarker = new google.maps.Marker({
        //                 position: e.latLng,
        //                 map: map,
        //                 icon: {
        //                     url: "https://cdn-icons-png.flaticon.com/512/679/679922.png", // ไอคอนถังขยะ
        //                     scaledSize: new google.maps.Size(40, 40),
        //                 },
        //                 title: "ตำแหน่งถังขยะ",
        //             });
        //         } else {
        //             trashMarker.setPosition(e.latLng);
        //         }

        //         updateLatLngInputs(lat, lng);
        //     });
        // }

        // function updateLatLngInputs(lat, lng) {
        //     document.getElementById("latitude").value = lat;
        //     document.getElementById("longitude").value = lng;
        //     document.getElementById("lat-display").textContent = lat.toFixed(6);
        //     document.getElementById("lng-display").textContent = lng.toFixed(6);
        // }

        let map, userMarker, trashMarker;

        function loadMapWithLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        // เก็บตำแหน่งผู้ใช้ใน input hidden
                        document.getElementById("user_latitude").value = userLocation.lat;
                        document.getElementById("user_longitude").value = userLocation.lng;

                        initMap(userLocation);
                    },
                    (error) => {
                        alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้ กรุณาอนุญาตการใช้ตำแหน่งหรือลองใหม่อีกครั้ง");
                        // fallback ตำแหน่งกลางกรุงเทพฯ
                        initMap({
                            lat: 13.736717,
                            lng: 100.523186
                        });
                    }
                );
            } else {
                alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
                initMap({
                    lat: 13.736717,
                    lng: 100.523186
                }); // fallback
            }
        }

        function initMap(centerLocation) {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: centerLocation,
            });

            // สร้าง marker สำหรับตำแหน่งผู้ใช้ (ไอคอนปกติ)
            userMarker = new google.maps.Marker({
                position: centerLocation,
                map: map,
                title: "ตำแหน่งของคุณ",
                // icon: 'path/to/custom-icon.png'  <-- ถ้าต้องการเปลี่ยนไอคอน
            });

            // เมื่อคลิกบนแผนที่จะสร้างหรือขยับ marker ถังขยะ
            map.addListener("click", (e) => {
                const lat = e.latLng.lat();
                const lng = e.latLng.lng();

                if (!trashMarker) {
                    trashMarker = new google.maps.Marker({
                        position: e.latLng,
                        map: map,
                        icon: {
                            url: "https://cdn-icons-png.flaticon.com/512/679/679922.png",
                            scaledSize: new google.maps.Size(40, 40),
                        },
                        title: "ตำแหน่งถังขยะ",
                    });
                } else {
                    trashMarker.setPosition(e.latLng);
                }

                updateLatLngInputs(lat, lng);
            });
        }

        function updateLatLngInputs(lat, lng) {
            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
            document.getElementById("lat-display").textContent = lat.toFixed(6);
            document.getElementById("lng-display").textContent = lng.toFixed(6);
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB525cpMEpjYlG8HiWgBqPCbaZU6HHxprY&callback=loadMapWithLocation">
    </script>
@endsection

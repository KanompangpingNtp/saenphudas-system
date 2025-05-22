@extends('home.layouts.app')
@section('title', 'OSS')
@section('content')
    <style>
        .bg-firstpage {
            background-image: url('{{ asset('images/secondary-pages/BG.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        .bg-header {
            background-image: url('{{ asset('images/secondary-pages/บนหน้า2.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 18vh;
        }

        .bg-footer {
            background-image: url('{{ asset('images/secondary-pages/ล่างหน้า2.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 18vh;
        }

        a img {
            transition: all 0.3s ease-in-out;
        }

        a img:hover {
            transform: scale(1.05);
            /* ขยายขนาดเล็กน้อย */
            opacity: 0.8;
            /* ลดความโปร่งใสลง */
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.2));
            /* เพิ่มเงา */
        }

        .gradient-background {
            background: linear-gradient(to bottom, #005bb5, #3478bb, #005bb5);
            border-radius: 20px;

            font-size: 35px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.8);
        }


        ul li {
            list-style: none;
            /* ลบจุดเดิม */
            position: relative;
            padding-left: 30px;
            margin: 10px 0px;
        }

        ul li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 40%;
            transform: translateY(-50%);
            width: 25px;
            /* กำหนดขนาดรูป */
            height: 25px;
            background-image: url('{{ asset('images/secondary-pages/droplet.png') }}');
            /* เปลี่ยนเป็นรูปของคุณ */
            background-size: contain;
            background-repeat: no-repeat;
        }

        ul a {
            text-decoration: none;
            font-size: 23px;
            font-weight: bold;
            white-space: nowrap;
            color: #000;
            position: relative;
        }

        ul a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 3px;
            background-color: #007bff;
            transition: width 0.3s ease-in-out;
        }

        ul a:hover::after {
            width: 100%;
        }

        #map {
            height: 500px;
            width: 100%;
        }

        .btn-check:checked+.btn {
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.6);
        }

        .btn-check:active+.btn {
            box-shadow: 0 0 12px rgba(255, 0, 0, 0.9);
        }
    </style>
    <main>
        <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center text-center">
            <div class="card w-100 m-3">
                <div class="card-body">
                    <div id="map"></div>
                    <button type="button" class="btn btn-primary mt-2" onclick="markMyLocation()">ตำแหน่งของคุณ</button>
                </div>
            </div>

            <div class="row ms-0 ms-lg-3 w-100">
                <div class="col-lg-12 d-flex flex-column justify-content-center align-items-center align-items-lg-start">
                    <div class="card w-100">
                        <div class="card-body">
                            <form id="myform" enctype="multipart/form-data">
                                <div class="row">
                                    <label for="selectBookregist"
                                        class="col-sm-5 col-form-label d-flex justify-content-start">ตัวอย่างรูปสถานที่เกิดเหตุ
                                        : </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label class="input-group-text" id="basic-addon2" for="file"
                                                style="cursor: pointer;">
                                                <i class="fa fa-camera"></i>
                                            </label>
                                            <input type="text" id="fileNameDisplay" class="form-control"
                                                placeholder="ตัวอย่างรูปสถานที่เกิดเหตุ" readonly>
                                            <input type="file" accept="image/*" capture="environment" id="file"
                                                name="file" style="display: none;" onchange="displayFileName()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="selectBookregist"
                                        class="col-sm-4 col-form-label d-flex justify-content-start">เบอร์โทรศัพท์ :
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="tel" name="tel"
                                            maxlength="10" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="selectBookregist"
                                        class="col-sm-4 col-form-label d-flex justify-content-start">รายละเอียด : </label>
                                    <div class="col-sm-12">
                                        <textarea rows="5" class="form-control" name="detail" id="detail" required></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row d-flex justify-content-center">
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="options" id="option1" value="1"
                                            autocomplete="off">
                                        <label class="" for="option1" title="อุบัติเหตุ"><img class="imgoption"
                                                src="{{ asset('images/emergency/cd7724c584b81b30.png') }}" id="imgoption1"
                                                alt="อุบัติเหตุ"></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="options" id="option2" value="2"
                                            autocomplete="off">
                                        <label class="" for="option2" title="ไฟไหม้"><img class="imgoption"
                                                src="{{ asset('images/emergency/bd0643ac1d33ccb2.png') }}" id="imgoption2"
                                                style="padding-top:9px" alt="ไฟไหม้"></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" class="btn-check" name="options" id="option3" value="5"
                                            autocomplete="off">
                                        <label class="" for="option3" title="ต้นไม้ล้ม"><img class="imgoption"
                                                src="{{ asset('images/emergency/f24c8a8dfa8caac9.png') }}" id="imgoption3"
                                                style="padding-top:6px" alt="ต้นไม้ล้ม"></label>
                                    </div>
                                </div>
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <div class="mt-3 row">
                                    <div class="col-sm-12">
                                        <a href="javascript:void();" id="btn">
                                            <img src="{{ asset('images/emergency/04028b6b4ab29497.png') }}">
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let map;
        let marker;

        function initMap(position) {
            const userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: userLocation,
                zoom: 15,
            });
        }

        function loadMapWithLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    initMap,
                    function() {
                        alert("ไม่สามารถดึงตำแหน่งของคุณได้");
                    }
                );
            } else {
                alert("เบราว์เซอร์ไม่รองรับ Geolocation");
            }
        }

        function markMyLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(userLocation);
                        map.setZoom(16);
                        if (marker) {
                            marker.setMap(null);
                        }
                        marker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "คุณอยู่ที่นี่",
                        });
                        const info = new google.maps.InfoWindow({
                            content: "ตำแหน่งของคุณ"
                        });
                        info.open(map, marker);

                        document.getElementById("latitude").value = userLocation.lat;
                        document.getElementById("longitude").value = userLocation.lng;
                    },
                    function() {
                        alert("ไม่สามารถดึงตำแหน่งของคุณได้");
                    }
                );
            } else {
                alert("เบราว์เซอร์ไม่รองรับ Geolocation");
            }
        }

        const buttons = document.querySelectorAll('input[name="options"]');
        buttons.forEach(btn => {
            btn.addEventListener('change', () => {
                $('.imgoption').css('filter', '');
                $('#img' + btn.id).css('filter', 'drop-shadow(2px 4px 6px red)');
            });
        });

        function displayFileName() {
            var input = document.getElementById("file");
            var fileNameDisplay = document.getElementById("fileNameDisplay");
            var fileName = input.files[0] ? input.files[0].name : "ไม่มีไฟล์ที่เลือก";
            fileNameDisplay.value = fileName;
        }
        document.getElementById("fileNameDisplay").addEventListener("click", function() {
            document.getElementById("file").click();
        });

        $('#myform').submit(function(e) {
            e.preventDefault();
            const lat = $('#latitude').val();
            const lng = $('#longitude').val();
            const file = $('#file').val();
            const detail = $('#detail').val().trim();
            const selectedOption = $('input[name="options"]:checked').val();

            if (!lat && !lng) {
                Swal.fire({
                    title: "กรุณาแจ้งตำแหน่งอุบัติเหตุของท่าน",
                    text: "",
                    icon: "warning"
                });
                return;
            }
            if (!file) {
                Swal.fire({
                    title: "กรุณาเลือกถ่ายภาพสถานที่เกิดเหตุ",
                    text: "",
                    icon: "warning"
                });
                return;
            }
            if (!tel) {
                Swal.fire({
                    title: "กรุณากรอกเบอร์ติดต่อกลับ",
                    text: "",
                    icon: "warning"
                });
                return;
            }
            if (detail === "") {
                Swal.fire({
                    title: "กรุณากรอกรายละเอียด",
                    text: "",
                    icon: "warning"
                });
                return;
            }
            if (!selectedOption) {
                Swal.fire({
                    title: "กรุณาบอกประเภทของอุบัติเหตุ",
                    text: "",
                    icon: "warning"
                });
                return;
            }
            var formData = new FormData(this);

            $.ajax({
                url: '/emergency/send',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: response.message,
                            text: "",
                            icon: "success"
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    } else {
                        Swal.fire({
                            title: response.message,
                            text: "",
                            icon: "error"
                        });
                    }
                },
                error: function(err) {
                    console.error('เกิดข้อผิดพลาด:', err);
                }
            });
        });

        $('#btn').click(function(e) {
            e.preventDefault();
            $('#myform').submit();
        });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB525cpMEpjYlG8HiWgBqPCbaZU6HHxprY&callback=loadMapWithLocation&signature=32RwW2GW7neU_vipuV3KKE4KFBw=">
    </script>
@endsection

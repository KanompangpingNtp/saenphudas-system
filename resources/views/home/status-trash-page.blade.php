@extends('home.layouts.app')
@section('title', 'Status Trash Page')
<style>
    .body-bg {
        background-image: url("{{ asset('first-page/พื้นหลัง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 68vh;
    }

    .big-text {
        font-weight: bold;
        font-size: 60px;
        white-space: nowrap;
    }

    @media (max-width: 476px) {
        .big-text {
            font-size: 50px;
            /* ลดขนาดลงตามต้องการ */
        }
    }

    .btn-back-effect img {
        transition: all 0.3s ease;
    }

    .btn-back-effect:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }

    .btn-search-effect {
        border: 0px solid #0000;
        background: transparent;
    }

    .btn-search-effect img {
        transition: all 0.3s ease;
    }

    .btn-search-effect:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }

    #map {
        border-radius: 20px;
        height: 450px;
        width: 100%;
    }
</style>
@php
    // จำลองข้อมูลพิกัด 5 จุดเริ่มต้น
    $movingPoints = [
        ['id' => 1, 'lat' => 13.736717, 'lng' => 100.523186],
        ['id' => 2, 'lat' => 13.738, 'lng' => 100.525],
        ['id' => 3, 'lat' => 13.734, 'lng' => 100.522],
        ['id' => 4, 'lat' => 13.737, 'lng' => 100.526],
        ['id' => 5, 'lat' => 13.7355, 'lng' => 100.524],
    ];
@endphp
@section('content')
    <div class="body-bg py-4">
        <div class="container">
            <div class="d-flex justify-content-center justify-content-lg-start align-items-center">
                <div class="big-text">
                    ดูสถานะรถขยะ
                </div>
                <a href="{{ route('UserWastePayment') }}" class="btn-back-effect">
                    <img src="{{ asset('trash-page/btn-back.png') }}" alt="btn-back" class="img-fluid">
                </a>
            </div>
            <div class="row">
                <div class="col-lg-4 d-flex flex-column justify-content-start align-items-center mb-3">
                    <button class="btn-search-effect">
                        <img id="goToUserLocation" src="{{ asset('icon-location/btn-search.png') }}" alt="btn-search"
                            class="img-fluid">
                    </button>
                    <img src="{{ asset('icon-location/detail-truck.png') }}" alt="detail-truck"
                        class="img-fluid d-none d-lg-block">
                    <img src="{{ asset('icon-location/detail-user.png') }}" alt="detail-user"
                        class="img-fluid d-none d-lg-block">
                </div>
                <div class="col-lg-8 d-flex flex-column justify-content-start align-items-center">
                    <div id="map"></div>
                    <div class="fs-4 fw-bold mt-2">
                        แสดงตำแหน่งการวิ่งของรถขยะในแต่ละคันบริเวณพื้นที่ตำบลภูแสนดาษ
                    </div>
                    <div class="row justify-content-center align-items-center ">
                        <div class="col-6 d-block d-lg-none">
                            <img src="{{ asset('icon-location/detail-truck.png') }}" alt="detail-truck" class="img-fluid ">
                        </div>
                        <div class="col-6 d-block d-lg-none">
                            <img src="{{ asset('icon-location/detail-user.png') }}" alt="detail-user" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- สคริปต์เรียก Google Maps API -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB525cpMEpjYlG8HiWgBqPCbaZU6HHxprY&callback=loadMapWithLocation&signature=32RwW2GW7neU_vipuV3KKE4KFBw=">
    </script>

    <!-- ฟังก์ชันโหลดแผนที่ -->
    <script>
        let map;
        let userMarker;
        let movingMarkers = [];
        let userLatLng;

        const movingPoints = @json($movingPoints);

        function loadMapWithLocation() {
            const defaultCenter = {
                lat: 13.736717,
                lng: 100.523186
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultCenter,
                zoom: 15,
            });

            // ตำแหน่งผู้ใช้
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        userLatLng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        // console.log(userLatLng)
                        map.setCenter(userLatLng);

                        userMarker = new google.maps.Marker({
                            position: userLatLng,
                            map: map,
                            title: "ตำแหน่งของคุณ",
                            icon: {
                                url: "{{ asset('icon-location/user.png') }}",
                                scaledSize: new google.maps.Size(32, 32),
                            },
                        });
                    },
                    () => {
                        alert("ไม่สามารถเข้าถึงตำแหน่งของคุณ");
                    }
                );
            }

            // สร้าง marker สำหรับแต่ละจุดที่เคลื่อนที่
            movingPoints.forEach((point, index) => {
                const marker = new google.maps.Marker({
                    position: {
                        lat: point.lat,
                        lng: point.lng
                    },
                    map: map,
                    title: `จุดที่เคลื่อนที่ ${point.id}`,
                    icon: {
                        url: "{{ asset('icon-location/truck.png') }}",
                        scaledSize: new google.maps.Size(32, 32),
                    },
                });
                movingMarkers.push(marker);
            });

            // อัปเดตตำแหน่งทุก 5 วินาที
            setInterval(updateMovingMarkers, 5000);
        }

        function updateMovingMarkers() {
            movingMarkers.forEach((marker) => {
                const oldPos = marker.getPosition();
                const newLat = oldPos.lat() + (Math.random() - 0.5) * 0.001;
                const newLng = oldPos.lng() + (Math.random() - 0.5) * 0.001;
                marker.setPosition({
                    lat: newLat,
                    lng: newLng
                });
            });
        }

        document.getElementById("goToUserLocation").addEventListener("click", () => {
            console.log(userLatLng)
            if (userLatLng) {
                map.panTo(userLatLng);
                map.setZoom(16); // ซูมเข้าอีกนิดถ้าต้องการ
            } else {
                alert("ยังไม่สามารถระบุตำแหน่งของคุณได้");
            }
        });
    </script>
@endsection

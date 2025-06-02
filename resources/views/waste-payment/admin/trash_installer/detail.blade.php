@extends('waste-payment.layouts.master')
@section('content')
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mb-5">รายละเอียดข้อมูลการติดตั้งถังขยะ</h3>

                    <p><strong>ชื่อ :</strong> {{ $form->salutation }} {{ $form->name }}</p>
                    <p><strong>ที่อยู่ :</strong>
                        {{ $form->address }}
                        หมู่ที่{{ $form->village }}
                        ต.{{ $form->sub_district }}
                        อ.{{ $form->district }}
                        จ.{{ $form->province }}
                    </p>
                    <p><strong>เบอร์โทรศัพท์ :</strong> {{ $form->phone }}</p>
                    <p><strong>ตัวเลือก :</strong>
                        @if ($form->optione == '1')
                            บ้านที่อยู่อาศัย
                        @elseif ($form->optione == '2')
                            บ้านเช่า/อาคารให้เช่า
                        @elseif ($form->optione == '3')
                            ร้านค้า
                        @elseif ($form->optione == '4')
                            โรงงาน/ประกอบธุรกิจ
                        @elseif ($form->optione == '5')
                            อื่นๆ
                        @endif
                    </p>

                    @if ($form->optione == 5)
                        <p><strong>รายละเอียดเพิ่มเติม :</strong> {{ $form->optione_detail }}</p>
                    @endif

                    <input type="hidden" name="latitude" id="latitude" value="{{ $form->lat }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ $form->lng }}">
                    <input type="hidden" name="user_latitude" id="user_latitude" value="{{ $form->user_latitude }}">
                    <input type="hidden" name="user_longitude" id="user_longitude" value="{{ $form->user_longitude }}">

                    {{-- <p class="mt-2">
                        <strong>ตำแหน่ง :</strong>
                        Latitude : <span id="lat-display">{{ number_format($form->lat) }}</span>,
                        Longitude : <span id="lng-display">{{ number_format($form->lng) }}</span>
                    </p> --}}

                    <p><strong>สถานะ : </strong>
                        @if ($form->trash_can_status == 1)
                            <span class="badge bg-warning text-dark">ยังไม่ติดตั้ง</span>
                        @else
                            <span class="badge bg-success">ติดตั้งถังขยะแล้ว</span>
                        @endif
                    </p>

                    <div id="map" style="height: 500px;"></div>

                    <br>

                    <h5 class="text-center mt-3">ข้อมูลบิล</h5>

                    <table class="table table-bordered" id="data_table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">จำนวนเงิน</th>
                                <th class="text-center">สถานะการชำระ</th>
                                <th class="text-center">วันที่ครบกำหนด</th>
                                <th class="text-center">วันที่ชำระ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($form->payments as $index => $payment)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ number_format($payment->amount, 2) }} บาท</td>
                                    <td class="text-center">
                                        @if ($payment->payment_status == 1)
                                            <span class="badge bg-danger">ยังไม่ชำระ</span>
                                        @elseif ($payment->payment_status == 2)
                                            <span class="badge bg-warning text-dark">รอตรวจสอบ</span>
                                        @elseif ($payment->payment_status == 3)
                                            <span class="badge bg-success">ชำระแล้ว</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        @if ($payment->issued_at)
                                            {{ \Carbon\Carbon::parse($payment->issued_at)->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
        let map, userMarker, trashMarker;

        // ดึงค่า trash_can_status จาก Blade
        const trashCanStatus = {{ $form->trash_can_status }};

        function loadMapWithLocation() {
            const userLat = parseFloat(document.getElementById('user_latitude').value);
            const userLng = parseFloat(document.getElementById('user_longitude').value);
            const trashLat = parseFloat(document.getElementById('latitude').value);
            const trashLng = parseFloat(document.getElementById('longitude').value);

            const userLocation = {
                lat: userLat,
                lng: userLng
            };
            const trashLocation = {
                lat: trashLat,
                lng: trashLng
            };

            initMap(userLocation, trashLocation);
        }

        function initMap(userLocation, trashLocation) {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: userLocation,
            });

            userMarker = new google.maps.Marker({
                position: userLocation,
                map: map,
                title: "ตำแหน่งของคุณ",
            });

            // เลือก icon ตาม trashCanStatus
            const trashIcon = (trashCanStatus == 1) ? {
                url: "https://cdn-icons-png.flaticon.com/512/679/679922.png",
                scaledSize: new google.maps.Size(40, 40),
            } : {
                url: "{{ asset('images/garbage_collection/trash-bin.png') }}",
                scaledSize: new google.maps.Size(32, 32),
            };

            trashMarker = new google.maps.Marker({
                position: trashLocation,
                map: map,
                icon: trashIcon,
                title: "ตำแหน่งถังขยะ",
            });

            updateLatLngInputs(trashLocation.lat, trashLocation.lng);
        }

        function updateLatLngInputs(lat, lng) {
            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
            document.getElementById("lat-display").textContent = lat.toFixed(6);
            document.getElementById("lng-display").textContent = lng.toFixed(6);
        }

        window.onload = loadMapWithLocation;
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB525cpMEpjYlG8HiWgBqPCbaZU6HHxprY&callback=loadMapWithLocation">
    </script>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<style>
    @font-face {
        font-family: 'sarabun-new';
        src: url('/fonts/THSarabunNew.ttf') format('woff2');
        font-weight: normal;
    }

    @font-face {
        font-family: 'sarabun-new';
        src: url('/fonts/THSarabunNew-Bold.ttf') format('woff2');
        font-weight: bold;
    }

    body {
        font-family: 'sarabun-new', sans-serif;
        font-size: 20px;
    }

    /* สำหรับเบราว์เซอร์ที่รองรับ WebKit (Chrome, Edge, Safari) */
    ::-webkit-scrollbar {
        width: 12px;
        /* ความกว้างของ scrollbar */
        background-color: #d0f0c0;
        /* สีพื้นหลัง scrollbar (เขียวอ่อน) */
    }

    ::-webkit-scrollbar-thumb {
        background-color: #2e7d32;
        /* สีตัวเลื่อน (เขียวเข้ม) */
        border-radius: 6px;
        /* มุมโค้งมน */
        border: 3px solid #d0f0c0;
        /* เว้นขอบเพื่อให้เห็นพื้นหลัง */
    }

    /* สำหรับ Firefox */
    * {
        scrollbar-width: thin;
        scrollbar-color: #2e7d32 #d0f0c0;
        /* thumb color | track color */
    }


    /* ////////// header ////////// */
    .header-bg {
        background-image: url("{{ asset('header/แถบบน.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 185px;
    }

    .title-header {
        font-size: 50px;
        font-weight: bold;
    }

    .sub-title-header {
        font-size: 32px;
        font-weight: bold;
    }

    .text-warn {
        font-size: 22px;
        color: #ffffff;
        font-weight: bold;
    }

    .btn-hover-effect {
        width: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-hover-effect:hover {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        opacity: 0.9;
    }



    @media (max-width: 768px) {
        .title-header {
            font-size: 40px;
        }

        .sub-title-header {
            font-size: 28px;
        }

        .logo-img {
            width: 120px;
        }
    }

    @media (max-width: 418px) {
        .title-header {
            font-size: 30px;
        }

        .sub-title-header {
            font-size: 24px;
        }

        .logo-img {
            width: 100px;
        }

        .btn-hover-effect {
            width: 80%;
        }
    }

    /* ////////// header ////////// */

    /* ////////// footer ////////// */
    .footer-bg {
        background-image: url("{{ asset('footer/แถบล่าง.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 90px;
    }

    .title-footer {
        font-size: 32px;
        font-weight: bold;
    }

    .footer-location {
        position: relative;
        /* เพื่อเป็น reference ให้รูป absolute */
        background-color: rgba(255, 255, 255, 0.7);
        padding: 0.2rem 0.9rem 0.2rem 2.8rem;
        /* เติม top padding เผื่อรูปอยู่ด้านบน */
        border-radius: 20px;
        font-weight: bold;
    }

    .footer-location img {
        position: absolute;
        top: -10px;
        /* ปรับตำแหน่งบนตามต้องการ */
        left: -10px;
        /* ปรับตำแหน่งซ้ายตามต้องการ */
        width: 50px;
        /* ขนาดรูป */
        height: auto;
    }

    /* ////////// footer ////////// */
</style>

<body class="d-flex flex-column min-vh-100">
     @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ $message }}',
            });
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ $message }}',
            });
        </script>
    @endif
    <!-- Header -->
    <header class="header-bg pt-2 pb-4">
        <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center">
            <a href="#"
                class="d-flex justify-content-center align-items-center text-decoration-none text-dark gap-2">
                <img src="{{ asset('header/โลโก้.png') }}" alt="logo" class="img-fluid logo-img">
                <div class="d-flex flex-column justify-content-center align-items-start" style="line-height: 1;">
                    <div class="title-header">เทศบาลตำบลแสนภูดาษ</div>
                    <div class="sub-title-header">ตำบลแสนภูดาษ อำเภอบ้านโพธิ์ จังหวัดฉะเชิงเทรา</div>
                </div>
            </a>
            <div class="d-flex flex-column justify-content-center align-items-center mt-3 mt-lg-0">
                {{-- <div class="d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ route('LoginPage') }}" class="text-center"><img src="{{ asset('header/เข้าสู่ระบบ.png') }}" alt="login"
                            class="img-fluid btn-hover-effect"></a>
                    <a href="{{ route('RegisterPage') }}" class="text-center"><img src="{{ asset('header/สมัครสมาชิก.png') }}" alt="register"
                            class="img-fluid btn-hover-effect"></a>
                    <a href="#" class="text-center"><img src="{{ asset('header/ออกจากระบบ.png') }}" alt="logout"
                            class="img-fluid btn-hover-effect"></a>
                </div> --}}
                <div class="d-flex justify-content-center align-items-center gap-2">
                    @guest
                        <a href="{{ route('LoginPage') }}" class="text-center">
                            <img src="{{ asset('header/เข้าสู่ระบบ.png') }}" alt="login"
                                class="img-fluid btn-hover-effect">
                        </a>
                        <a href="{{ route('RegisterPage') }}" class="text-center">
                            <img src="{{ asset('header/สมัครสมาชิก.png') }}" alt="register"
                                class="img-fluid btn-hover-effect">
                        </a>
                    @endguest

                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="text-center">
                            @csrf
                            <button type="submit" style="border: none; background: none; padding: 0;">
                                <img src="{{ asset('header/ออกจากระบบ.png') }}" alt="logout"
                                    class="img-fluid btn-hover-effect">
                            </button>
                        </form>
                    @endauth
                </div>
                <div class="text-warn mt-2 text-center">
                    คำแนะนำสมัครสมาชิกเพื่อติดตามสถานะการดำเนินการ
                </div>
            </div>
        </div>
    </header>


    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-bg pt-2 pb-4">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <div class="title-footer">เทศบาลตำบลแสนภูดาษ</div>
            <div class="d-flex flex-column-reverse flex-md-row justify-content-center align-items-center gap-3">
                <div class="footer-location">
                    <img src="{{ asset('footer/logoโลเคชั่นส่วนท้าย.png') }}" alt="home">
                    103 หมู่ 3 ตำบลแสนภูดาษ อำเภอบ้านโพธิ์ จังหวัดฉะเชิงเทรา 24140
                </div>
                <div class="footer-location">
                    <img src="{{ asset('footer/logo โทรส่วนท้าย.png') }}" alt="phone">
                    โทรศัพท์ 0 3857 7157
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Dashbord</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="layout-menu-fixed">
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ $message }}',
            })
        </script>
    @endif
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">ระบบ Eservice</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"
            title="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                @auth
                    <!-- เมนูสำหรับผู้ใช้ที่ล็อกอินแล้ว -->
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    ออกจากระบบ<i class="bi bi-door-closed-fill ms-3"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                @else
                    <!-- เมนูสำหรับผู้ที่ยังไม่ได้ล็อกอิน -->
                    <a class="nav-link btn btn-primary" href="{{ route('LoginPage') }}">เข้าสู่ระบบ</a>
                @endauth
            </li>
        </ul>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">เมนู</div>
                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#ops1"
                            aria-expanded="false" aria-controls="ops1">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            คำร้องทั่วไป
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="ops1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('GeneralRequestsFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('GeneralRequestsShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#ops2"
                            aria-expanded="false" aria-controls="ops2">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบยืนยันเบี้ยยังชีพผู้สูงอายุ
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="ops2" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('ElderlyAllowanceFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('ElderlyAllowanceShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#ops3"
                            aria-expanded="false" aria-controls="ops3">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="ops3" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('DisabilityFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('TableDisabilityUsersPages') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#ops4"
                            aria-expanded="false" aria-controls="ops4">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบคำขอรับการสงเคราะห์ <br> (ผู้ป่วยเอดส์)
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="ops4" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('ReceiveAssistanceFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('TableReceiveAssistanceUsersPages') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#change_in_use"
                            aria-expanded="false" aria-controls="change_in_use">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            (ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="change_in_use" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('ChangeInUseFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('ChangeInUseShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#license_tax"
                            aria-expanded="false" aria-controls="license_tax">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            (ภ.ป.๑) แนบแสดงรายการ ภาษีป้าย
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="license_tax" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('LicenseTaxFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('LicenseTaxShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#recruiting_children1" aria-expanded="false"
                            aria-controls="recruiting_children1">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="recruiting_children1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('ChildApplyPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('TableChildApplyUsersPages') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#pay_tax_build_and_room" aria-expanded="false"
                            aria-controls="pay_tax_build_and_room">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="pay_tax_build_and_room" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('PayTaxBuildAndRoomFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('PayTaxBuildAndRoomShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#treasury_department1" aria-expanded="false"
                            aria-controls="treasury_department1">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="treasury_department1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('LandBuildingTaxAppealPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('LandBuildingTaxAppealShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#treasury_department2" aria-expanded="false"
                            aria-controls="treasury_department2">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="treasury_department2" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('LandTaxRefundRequestPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('LandTaxRefundRequestShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#option1"
                            aria-expanded="false" aria-controls="option1">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบคำขอรับการประเมินค่าธรรมเนียมการกำจัดสิ่งปฏิกูลและมูลฝอย
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="option1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('GarbageCollectionForm') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('GarbageCollectionShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#public_health2"
                            aria-expanded="false" aria-controls="public_health2">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบคำร้องใบอนุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="public_health2" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('HealthHazardApplicationFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('HealthHazardApplicationShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#public_health1"
                            aria-expanded="false" aria-controls="public_health1">
                            <div class="sb-nav-link-icon">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            แบบคำร้องใบอนุญาตสะสมอาหาร
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="public_health1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('FoodStorageLicenseFormPage') }}">ฟอร์ม</a>
                                <a class="nav-link"
                                    href="{{ route('FoodStorageLicenseShowDetails') }}">ประวัติการส่งฟอร์ม</a>
                            </nav>
                        </div>
                    </div>
                </div>
                {{-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> --}}
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 main-content">
                    <br>
                    @yield('pages_content')
                </div>
                <br>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; บริษัท SOS สงวนสิทธิ์ 2025</div>
                        {{-- <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>

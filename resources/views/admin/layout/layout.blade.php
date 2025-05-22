<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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

<body>
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
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span style="margin-right: 15px;">{{ Auth::user()->name }}</span> <i
                        class="fas fa-user fa-fw ms-1"></i>
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
            </li>
        </ul>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="overflow-y: auto; max-height: calc(100vh - 100px);">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">เมนู</div>
                        <a class="nav-link" href="{{ route('GeneralRequestsAdminShowData') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            คำร้องทั่วไป
                        </a>
                        <a class="nav-link" href="{{ route('ElderlyAllowanceAdminShowData') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            แบบยืนยันเบี้ยยังชีพผู้สูงอายุ
                        </a>
                        <a class="nav-link" href="{{ route('DisabilityAdminShowData') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
                        </a>
                        <a class="nav-link" href="{{ route('TableReceiveAssistanceAdminPages') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            แบบคำขอรับการสงเคราะห์ <br> (ผู้ป่วยเอดส์)
                        </a>
                        <a class="nav-link" href="{{ route('ChangeInUseAdminPages') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            (ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง
                        </a>
                        <a class="nav-link" href="{{ route('LicenseTaxAdminPages') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            (ภ.ป.๑) แนบแสดงรายการ ภาษีป้าย
                        </a>
                        <a class="nav-link" href="{{ route('TableChildApplyAdminPages') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก
                        </a>
                        <a class="nav-link" href="{{ route('PayTaxBuildAndRoomAdminPages') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด
                        </a>
                        <a class="nav-link" href="{{ route('LandBuildingTaxAppealAdminShowData') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน
                        </a>
                        <a class="nav-link" href="{{ route('LandTaxRefundRequestAdminShowData') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-clipboard"></i></div>
                            คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง
                        </a>
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
                <div class="container-fluid px-4">
                    <div class="mt-4 text-center"></div>
                    @yield('admin_content')
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

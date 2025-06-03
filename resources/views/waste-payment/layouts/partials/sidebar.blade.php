<!-- Sidebar -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <i class="fa-solid fa-database" style="font-size: 25px;"></i>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="font-size: 24px;">ระบบค่าขยะ</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->is('admin/waste_payment*') ? 'active' : '' }}">
            <a href="{{ route('AdminWastePayment') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manage</span></li>
        <li class="menu-item {{ request()->is('admin/trash_can_installation*') ? 'active' : '' }}">
            <a href="{{ route('TrashCanInstallationPage') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-location-plus'></i>
                <div data-i18n="Analytics">ตำแหน่งที่ติดตั้งถังขยะ</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/trash_installer*') ? 'active' : '' }}">
            <a href="{{ route('TrashInstallerPage') }}" class="menu-link">
                <i class='menu-icon tf-icons bx  bx-trash'  ></i>
                <div data-i18n="Analytics">ผู้ใช้บริการติดตั้งถังขยะ</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Report</span></li>
        <li class="menu-item {{ request()->is('admin/verify_payment*') ? 'active' : '' }}">
            <a href="{{ route('VerifyPaymentPage') }}" class="menu-link">
                <i class='menu-icon tf-icons bx  bx-credit-card-alt'></i>
                <div data-i18n="Analytics">ตรวจสอบการชำระเงิน</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/payment_history*') ? 'active' : '' }}">
            <a href="{{ route('PaymentHistoryPage') }}" class="menu-link">
                <i class='menu-icon tf-icons bx  bx-history'></i>
                <div data-i18n="Analytics">ประวัติการชำระเงิน</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/non_payment*') ? 'active' : '' }}">
            <a href="{{ route('NonPaymentPage') }}" class="menu-link">
                <i class='menu-icon tf-icons bx  bx-no-entry'></i>
                <div data-i18n="Analytics">บิลที่รอการชำระเงิน</div>
            </a>
        </li>

    </ul>
</aside>
<!-- / Sidebar -->

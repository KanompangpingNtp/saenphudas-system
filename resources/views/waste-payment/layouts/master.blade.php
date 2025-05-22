<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    @stack('styles') {{-- เผื่อมี CSS เพิ่มเฉพาะหน้า --}}

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body class="layout-menu-fixed">
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('waste-payment.layouts.partials.sidebar') <!-- เมนูซ้าย -->

        <div class="layout-page">
          @include('waste-payment.layouts.partials.header') <!-- Navbar -->

          <div class="content-wrapper">
            <div class="container-xxl container-p-y">
              @yield('content')
            </div>

            @include('waste-payment.layouts.partials.footer') <!-- Footer -->
          </div>
        </div>
      </div>
    </div>

    @include('waste-payment.layouts.partials.scripts') <!-- JS -->
  </body>
</html>

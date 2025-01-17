<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    @stack('title')
    {{-- Font --}}
    <link href="{{ asset('css/font/open-sans.css') }}" rel="stylesheet" />
    {{-- CSS --}}
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.min.css') }}" rel="stylesheet" />
    <style>
        /* body {
            padding-top: 66px;
        } */
    </style>
    @stack('styles')
</head>
@if (Request::is('admin/*'))
    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-dark position-absolute w-100"></div>
        {{-- Sidenav --}}
        @include('admin.component.sidenav')
        {{-- End Sidenav --}}
        <main class="main-content position-relative border-radius-lg ">
            {{-- Navbar --}}
            @include('admin.component.navbar')
            {{-- End Navbar --}}
            {{-- Content --}}
            @yield('content')
            {{-- End Content --}}
        </main>
@elseif (Request::is('dokter/*'))
    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-dark position-absolute w-100"></div>
        {{-- Sidenav --}}
        @include('dokter.component.sidenav')
        {{-- End Sidenav --}}
        <main class="main-content position-relative border-radius-lg ">
            {{-- Navbar --}}
            @include('dokter.component.navbar')
            {{-- End Navbar --}}
            {{-- Content --}}
            @yield('content')
            {{-- End Content --}}
        </main>
@else
        {{-- Only Content --}}
        @include('frontend.component.navbar')

        <body class="d-flex flex-column min-vh-100">
            @yield('content')
@endif
<!--   Core JS Files   -->
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
{{-- <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script> --}}
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/plugins/font-awesome.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2@11.js') }}"></script>
<script src="{{ asset('js/javascript.js') }}"></script>
@include('component.sweetalert')
@stack('scripts')
@if (Request::is('admin/*') || Request::is('dokter/*'))
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endif
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
</body>

</html>

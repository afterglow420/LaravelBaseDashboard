<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Primary Meta Tags -->
    <title>Admin Dashboard Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard" />
    <meta name="author" content="Themesberg" />
    <meta name="description"
        content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />

    <!-- Links -->
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard" />

    <!-- Volt CSS -->
    <link type="text/css" href="{{ URL::to('css/volt.css') }}" rel="stylesheet" />

    <!-- Scripts -->

    <!-- Core -->
    <script src="{{ URL::to('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ URL::to('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ URL::to('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ URL::to('vendor/nouislider/distribute/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ URL::to('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ URL::to('vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Notyf -->
    <script src="{{ URL::to('vendor/notyf/notyf.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ URL::to('vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="{{ URL::to('assets/js/volt.js') }}"></script>

    @stack('scripts')
</head>

<body>

    @if (in_array(request()->segment(1), ['dashboard']))
        <!-- Sidenav -->
        @include('Layouts.sidenav')

        <main class="content">

            {{ $slot }}

            <!-- Footer -->
            @include('Layouts.footer')

        </main>
    @else
        
        {{ $slot }}

    @endif

</body>

</html>

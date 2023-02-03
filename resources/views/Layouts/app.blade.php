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

    <!-- Fontawesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" type="text/css"
        rel="stylesheet" />

    <!-- dataTables CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/r-2.4.0/rr-1.3.1/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.css" />
        
    <!-- Sweet Alert -->
    <link type="text/css" href="{{ URL::to('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{ URL::to('vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Scripts -->

    <!-- Core -->
    <script src="{{ URL::to('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ URL::to('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- Vendor JS -->
    <script src="{{ URL::to('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ URL::to('vendor/nouislider/dist/nouislider.min.js') }}"></script>

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

    <!-- dataTables Package -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/r-2.4.0/rr-1.3.1/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.js">
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ URL::to('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ URL::to('assets/js/volt.js') }}"></script>

    @stack('scripts')
</head>

<body>

    @if (in_array(request()->segment(1), ['dashboard', 'datatable']))
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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Wieldy - A fully responsive, HTML5 based admin template">
    <meta name="keywords"
        content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- /meta tags -->
    <title>Wieldy - @yield('title', 'Admin Dashboard')</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- /site favicon -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="dt-sidebar--fixed dt-header--fixed">

    <!-- Root -->
    <div class="dt-root">
        <!-- Header -->
        @include('includes.header')
        <!-- /header -->

        <!-- Site Main -->
        <main class="dt-main">
            <!-- Sidebar -->
            <x-sidebar />
            <!-- /sidebar -->

            <!-- Site Content Wrapper -->
            <div class="dt-content-wrapper">

                <!-- Site Content -->
                @yield('content')
                <!-- /site content -->

                <!-- Footer -->
                @include('includes.footer')
                <!-- /footer -->

            </div>
            <!-- /site content wrapper -->

            <!-- Theme Chooser -->
            <div class="dt-customizer-toggle">
                <a href="javascript:void(0)" data-toggle="customizer"> <i class="icon icon-spin icon-setting"></i> </a>
            </div>
            <!-- /theme chooser -->

            <!-- Customizer Sidebar -->
            <x-right-sidebar />
            <!-- /customizer sidebar -->

        </main>
    </div>
    <!-- /root -->

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Perfect Scrollbar jQuery -->
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <!-- /perfect scrollbar jQuery -->
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard-crypto.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard-crypto.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        let _token = $('meta[name="csrf-token"]').attr('content');
    </script>
    @stack('scripts')
</body>

</html>

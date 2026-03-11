<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>BABVIP - {{ isset($data['pageTitle']) ? $data['pageTitle'] : config('app.name', 'BABVIP CMS') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ isset($data['pageDescription']) ? $data['pageDescription'] : '' }}">
    <meta content="BabVip CMS ADMIN" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}">

    <!-- plugin css -->
    <link href="{{ asset('admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{asset('admin/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <script src="{{asset('admin/libs/jquery/jquery.min.js') }}"></script>
</head>

<body data-topbar="dark">
    <!-- <body data-layout="horizontal"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- header topbar -->
        @include('applicant.body.header-top')
        <!-- header topbar -->
        <!-- sidebar -->
        @include('applicant.body.sidebar')

        <!-- sidebar  -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                @if (session('success'))
                <div class="alert alert-success alert-messages">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-error alert-messages">
                    {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </div>
            <!-- End Page-content -->
            <!-- footer -->
            @include('applicant.body.footer')
            <!-- footer -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- rightsidebar -->
    @include('applicant.body.right-sidebar')
    <!-- rightsidebar -->
    <!-- JAVASCRIPT -->
    <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{asset('admin/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{asset('admin/libs/pace-js/pace.min.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Plugins js-->
    <script src="{{asset('admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{asset('admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{asset('admin/js/pages/allchart.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{asset('admin/js/pages/dashboard.init.js') }}"></script>
    <script src="{{asset('admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{asset('admin/js/app.js') }}"></script>
    <script src="{{asset('admin/js/custom.js') }}"></script>

</body>

</html>
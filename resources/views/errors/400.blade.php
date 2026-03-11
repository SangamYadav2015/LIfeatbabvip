<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> BABVIP GROUP 400 Internal Server Error </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="BABVIP GROUP 400 Internal Server Error" name="description" />
    <meta content="BabVIp GROUP" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('admin/images/favicon.ico')}}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ URL::asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5 pt-5">
                        <h1 class="error-title mt-5"><span>400!</span></h1>
                        <h4 class="text-uppercase mt-5">Page Not Found</h4>
                        <p class="font-size-15 mx-auto text-muted w-50 mt-4"></p>
                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ url('/')}}">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
</body>
<!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('/admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{asset('admin/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{asset('admin/libs/pace-js/pace.min.js') }}"></script>
    <!-- apexcharts -->
    <!-- dashboard init -->

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
<style>
input[switch]+label {
    width: 77px;
}
input[switch]+label:before{
    left: 20px;
    color: #fff;
}
input[switch]:checked+label:after{
    left: 55px;
    color: #fff;
}
input[switch]+label{
    background-color: red;
}
</style>
</head>

<body data-topbar="dark">
    <!-- <body data-layout="horizontal"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- header topbar -->
        @include('admin.layout.header-top')
        <!-- header topbar -->
        <!-- sidebar -->
        @include('admin.layout.sidebar')

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
            @include('admin.layout.footer')
            <!-- footer -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- rightsidebar -->
    @include('admin.layout.right-sidebar')
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
    <script src="{{asset('admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{asset('admin/js/app.js') }}"></script>
    <script src="{{asset('admin/js/custom.js') }}"></script>

    <!-- <script src="{{asset('admin/js/pages/dashboard.init.js') }}"></script> -->
<?php 
if ($_SERVER['REQUEST_URI'] === '/admin/dashboard') {
?>
<script>
  function getChartColorsArray(r) {
    r = $(r).attr("data-colors");
    return (r = JSON.parse(r)).map(function (r) {
        r = r.replace(" ", "");
        if (-1 == r.indexOf("--")) return r;
        r = getComputedStyle(document.documentElement).getPropertyValue(r);
        return r || void 0;
    });
}
var barchartColors = getChartColorsArray("#mini-chart1"),
    options = {
        series: [<?php echo $inActivePages ;?> , <?php echo $activePages ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive Pages", "Active Pages"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-chart1"), options);
chart.render(), ChartColorChange(chart, "#mini-chart1");


var barchartColors = getChartColorsArray("#mini-chart2"),
    options = {
        series: [<?php echo $inActivePages ;?> , <?php echo $activePages ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive Pages", "Active Pages"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-chart2"), options);
chart.render(), ChartColorChange(chart, "#mini-chart2");


var barchartColors = getChartColorsArray("#mini-chart3"),
    options = {
        series: [<?php echo $inActivePages ;?> , <?php echo $activePages ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive Pages", "Active Pages"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-chart3"), options);
chart.render(), ChartColorChange(chart, "#mini-chart3");




var barchartColors = getChartColorsArray("#mini-chartuser1"),
    options = {
        series: [<?php echo $inActiveUser ;?> , <?php echo $activeUser ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive User", "Active User"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-chartuser1"), options);
chart.render(), ChartColorChange(chart, "#mini-chartuser1");


var barchartColors = getChartColorsArray("#mini-chartuser2"),
    options = {
        series: [<?php echo $inActiveUser ;?> , <?php echo $activeUser ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive User", "Active User"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-chartuser2"), options);
chart.render(), ChartColorChange(chart, "#mini-chartuser2");


var barchartColors = getChartColorsArray("#mini-chartuser3"),
    options = {
        series: [<?php echo $inActiveUser ;?> , <?php echo $activeUser ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive User", "Active User"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-chartuser3"), options);
chart.render(), ChartColorChange(chart, "#mini-chartuser3");


var barchartColors = getChartColorsArray("#mini-news1"),
    options = {
        series: [<?php echo $activeNews ;?> , <?php echo $inActiveNews ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive News", "Active News"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-news1"), options);

chart.render(), ChartColorChange(chart, "#mini-news1");

var barchartColors = getChartColorsArray("#mini-news2"),
    options = {
        series: [<?php echo $activeNews ;?> , <?php echo $inActiveNews ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive News", "Active News"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-news2"), options);
chart.render(), ChartColorChange(chart, "#mini-news2");

var barchartColors = getChartColorsArray("#mini-news3"),
    options = {
        series: [<?php echo $activeNews ;?> , <?php echo $inActiveNews ;?>],  // Series data
        chart: { type: "donut", height: 110 },
        colors: barchartColors,
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        labels: ["Inactive News", "Active News"] 
    };
var chart = new ApexCharts(document.querySelector("#mini-news3"), options);
chart.render(), ChartColorChange(chart, "#mini-news3");


options = {
    series: [
        { name: "Profit", data: [12.45, 16.2, 8.9, 11.42, 12.6, 18.1, 18.2, 14.16, 11.1, 8.09, 16.34, 12.88] },
        // { name: "Loss", data: [-11.45, -15.42, -7.9, -12.42, -12.6, -18.1, -18.2, -14.16, -11.1, -7.09, -15.34, -11.88] },
    ],
    chart: { type: "bar", height: 400, stacked: !0, toolbar: { show: !1 } },
    plotOptions: { bar: { columnWidth: "20%" } },
    colors: (barchartColors = getChartColorsArray("#market-overview")),
    fill: { opacity: 1 },
    dataLabels: { enabled: !1 },
    legend: { show: !1 },
    yaxis: {
        labels: {
            formatter: function (r) {
                return r.toFixed(0) + "%";
            },
        },
    },
    xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], labels: { rotate: -90 } },
};
(chart = new ApexCharts(document.querySelector("#market-overview"), options)).render(), ChartColorChange(chart, "#market-overview");
var vectormapColors = getChartColorsArray("#sales-by-locations");


$("#sales-by-locations").vectorMap({
    map: "world_mill_en",
    normalizeFunction: "polynomial",
    hoverOpacity: 0.7,
    hoverColor: !1,
    regionStyle: { initial: { fill: "#e9e9ef" } },
    markerStyle: { initial: { r: 9, fill: vectormapColors, "fill-opacity": 0.9, stroke: "#fff", "stroke-width": 7, "stroke-opacity": 0.4 }, hover: { stroke: "#fff", "fill-opacity": 1, "stroke-width": 1.5 } },
    backgroundColor: "transparent",
    markers: [
        { latLng: [41.9, 12.45], name: "USA" },
        { latLng: [12.05, -61.75], name: "Russia" },
        { latLng: [1.3, 103.8], name: "Australia" },
    ],
});
</script>
<?php } ?>
</body>

</html>
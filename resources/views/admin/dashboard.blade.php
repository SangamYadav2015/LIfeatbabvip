@extends('admin.layout.app')

@section('content')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Welcome </li>

                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                   <!-- for pages role -->
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                    <a href="{{ route('admin.pageList') }}">Total Pages</a>
                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $totalPages }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-success-subtle text-success">{{ $totalPages }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Total</span>
                                                </div>
                                            </div>
        
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-chart1" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                            <a href="{{ route('admin.pageList') }}">
                                               Active Pages 
                                            </a>
                                            </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $activePages }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-success-subtle text-success">{{ $activePages }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Active</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-chart2" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->


                            
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                <a href="{{ route('admin.pageList') }}">
                                                    Inactive Pages
                                                    </a>

                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $inActivePages }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-success-subtle text-success">{{ $inActivePages }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Inactive</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-chart3" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->
        
                           
                        </div><!-- end row-->
                   <!-- for pages role -->

                   <!-- for user role -->
                   <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                <a href="{{ route('admin.userList') }}">Total User</a>

                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $totalUser }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-warning-subtle text-warning">{{ $totalUser }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Total</span>
                                                </div>
                                            </div>
        
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-chartuser1" data-colors='["--bs-primary", "--bs-warning"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                <a href="{{ route('admin.userList') }}">Active User</a>
                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $activeUser }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-warning-subtle text-warning">{{ $activeUser }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Active</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-chartuser2" data-colors='["--bs-warning", "--bs-warning"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->


                            
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate"> <a href="{{ route('admin.userList') }}">Inactive User
                                                </a>
                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $inActiveUser }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-warning-subtle text-warning">{{ $inActiveUser }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Inactive</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-chartuser3" data-colors='["--bs-warning", "--bs-warning"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->
        
                           
                        </div><!-- end row-->
                   <!-- for user role -->




                   <!-- for Blogs -->
                   <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                <a href="{{ route('admin.blogList') }}">Total News
                                                    </a>
                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $totalNews }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-primary-subtle text-primary">{{ $totalNews }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Total</span>
                                                </div>
                                            </div>
        
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-news1" data-colors='["--bs-primary", "--bs-primary"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                <a href="{{ route('admin.blogList') }}">Active News</a>
                                            </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $activeNews }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-primary-subtle text-primary">{{ $activeNews }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Total</span>
                                                </div>
                                            </div>
        
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-news2" data-colors='["--bs-primary", "--bs-primary"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                    
                                </div><!-- end card -->
                            </div><!-- end col -->


                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->

                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">
                                                <a href="{{ route('admin.blogList') }}">Inactive News
                                                    </a>
                                                </span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="{{ $inActiveNews }}">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-primary-subtle text-primary">{{ $inActiveNews }}</span>
                                                    <span class="ms-1 text-muted font-size-13">Total</span>
                                                </div>
                                            </div>
        
                                            <div class="flex-shrink-0 text-end dash-widget">
                                                <div id="mini-news3" data-colors='["--bs-primary", "--bs-primary"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                
                           
                        </div><!-- end row-->
                   <!-- for Blogs -->

                        <!-- <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center mb-4">
                                            <h5 class="card-title me-2">Market Overview</h5>
                                            <div class="ms-auto">
                                                <div>
                                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                                        ALL
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        1M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        6M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        1Y
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-xl-8">
                                                <div>
                                                    <div id="market-overview" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="p-4">
                                                    <div class="mt-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm m-auto">
                                                                <span class="avatar-title rounded-circle bg-light text-dark font-size-13">
                                                                    1
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <span class="font-size-14">Mobile Phones</span>
                                                            </div>
        
                                                            <div class="flex-shrink-0">
                                                                <span class="badge rounded-pill bg-success-subtle text-success  font-size-12 fw-medium">+5.4%</span>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm m-auto">
                                                                <span class="avatar-title rounded-circle bg-light text-dark font-size-13">
                                                                    2
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <span class="font-size-14">Smart Watch</span>
                                                            </div>
        
                                                            <div class="flex-shrink-0">
                                                                <span class="badge rounded-pill bg-success-subtle text-success  font-size-12 fw-medium">+6.8%</span>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm m-auto">
                                                                <span class="avatar-title rounded-circle bg-light text-dark font-size-13">
                                                                    3
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <span class="font-size-14">Protable Acoustics</span>
                                                            </div>
        
                                                            <div class="flex-shrink-0">
                                                                <span class="badge rounded-pill bg-danger-subtle text-danger  font-size-12 fw-medium">-4.9%</span>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm m-auto">
                                                                <span class="avatar-title rounded-circle bg-light text-dark font-size-13">
                                                                    4
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <span class="font-size-14">Smart Speakers</span>
                                                            </div>
        
                                                            <div class="flex-shrink-0">
                                                                <span class="badge rounded-pill bg-success-subtle text-success  font-size-12 fw-medium">+3.5%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm m-auto">
                                                                <span class="avatar-title rounded-circle bg-light text-dark font-size-13">
                                                                    5
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <span class="font-size-14">Camcorders</span>
                                                            </div>
        
                                                            <div class="flex-shrink-0">
                                                                <span class="badge rounded-pill bg-danger-subtle text-danger  font-size-12 fw-medium">-0.3%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 pt-2">
                                                        <a href="" class="btn btn-primary w-100">See All Balances <i
                                                                class="mdi mdi-arrow-right ms-1"></i></a>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
        
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center mb-4">
                                            <h5 class="card-title me-2">Sales by Locations</h5>
                                            <div class="ms-auto">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted font-size-12">Sort By:</span> <span class="fw-medium">World<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#">USA</a>
                                                        <a class="dropdown-item" href="#">Russia</a>
                                                        <a class="dropdown-item" href="#">Australia</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="sales-by-locations" data-colors='["--bs-success"]' style="height: 253px"></div>

                                        <div class="px-2 py-2">
                                            <p class="mb-1">USA <span class="float-end">75%</span></p>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                    style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75">
                                                </div>
                                            </div>

                                            <p class="mt-3 mb-1">Russia <span class="float-end">55%</span></p>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                    style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="55">
                                                </div>
                                            </div>

                                            <p class="mt-3 mb-1">Australia <span class="float-end">85%</span></p>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                    style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="85">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- end row-->
<div class="row">
    <!-- Total Applicants -->
    <div class="col-xl-4 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">
                            <a href="{{ route('admin.userList') }}">Total Applicants</a>
                        </span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="{{ $totalApplicants }}">0</span>
                        </h4>
                        <div class="text-nowrap">
                            <span class="badge bg-warning-subtle text-warning">{{ $totalApplicants }}</span>
                            <span class="ms-1 text-muted font-size-13">Total</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
<!-- Total Post Jobs -->
<div class="col-xl-4 col-md-6">
    <div class="card card-h-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <span class="text-muted mb-3 lh-1 d-block text-truncate">
                            <a href="#">Total Posted Job</a>
                        </span>
                    <h4 class="mb-3">
                        <span class="counter-value" data-target="{{ $totalPostJobs }}">0</span>
                    </h4>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">{{ $totalPostJobs }}</span>
                        <span class="ms-1 text-muted font-size-13">Total</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Active Applicants -->
    

    <!-- Inactive Applicants -->
   
</div>




                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Logs</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">All Logs<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                        
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" href="{{ route('admin.logsList') }}">View All</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body px-0">
                                        <div class="px-3" data-simplebar style="max-height: 386px;">
                                        @foreach ($logs as $item) 
                                        <div class="d-flex align-items-center pb-4">
                                               
                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-15 mb-1"><a href="" class="text-dark">{{ $item->level }}</a></h5>
                                                    <span class="text-muted">{{ date('d/M/Y', strtotime($item->created_at)) }}</span>
                                                </div>
                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded font-size-24 text-dark"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.viewlogs', ['num' => $item->id]) }}">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->


                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Subscriber List</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">All Subscriber<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                        
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" href="{{ route('admin.subscriberList') }}">View All</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body px-0">
                                        <div class="px-3" data-simplebar style="max-height: 386px;">
                                        @foreach ($subscriberEnqueries as $item) 
                                        <div class="d-flex align-items-center pb-4">
                                               
                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-15 mb-1"><a href="" class="text-dark">{{ $item->email }}</a></h5>
                                                    <span class="text-muted">{{ date('d/M/Y', strtotime($item->created_at)) }}</span>
                                                </div>
                                                <div class="flex-shrink-0 text-end">
                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded font-size-24 text-dark"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.subscriberList', ['num' => $item->id]) }}">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">All Contact Enquiry</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded font-size-18 text-dark"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.enqueryList') }}">View All</a>
                                               
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- end card header -->

                                    <div class="card-body px-0 pt-2">
                                            <div class="table-responsive px-3" data-simplebar style="max-height: 395px;">
                                                <table class="table align-middle table-nowrap">
                                                    <tbody>
                                                    @php $i = 1; @endphp
                                @foreach ($contactEnqueries as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->first_name.' '.   $item->last_name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->phone}}</td>
                                    <td>{{ $item->message}}</td>


                                                          

                                                                                        
                                </tr>
                                @php $i++; @endphp
                                @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">All Maintenance Enquiry</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded font-size-18 text-dark"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.maintinanceEnqueryList') }}">View All</a>
                                               
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- end card header -->

                                    <div class="card-body px-0 pt-2">
                                            <div class="table-responsive px-3" data-simplebar style="max-height: 395px;">
                                                <table class="table align-middle table-nowrap">
                                                    <tbody>
                                                    @php $i = 1; @endphp
                                @foreach ($maintinanceEnqueries as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->first_name.' '.   $item->last_name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->phone}}</td>
                                    <td>{{ $item->message}}</td>


                                                          

                                                                                        
                                </tr>
                                @php $i++; @endphp
                                @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <!-- end col -->
                        </div><!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
@endsection



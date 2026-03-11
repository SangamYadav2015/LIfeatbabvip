@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Contact Enquiry List</a></li>
                        <li class="breadcrumb-item active">Welcome </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                 <div class="card-header">
                <h4 class="card-title">Search Here</h4>
                <form class="needs-validation" action="{{ route('admin.enqueryList') }}" method="get" novalidate="" autocomplete="off" id="searchForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Search keyword By Email" value="@if(isset($_GET['email'])){{ $_GET['email'] }}@endif">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Search keyword By Name" value="@if(isset($_GET['name'])){{ $_GET['name'] }}@endif">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Search keyword By Phone Number" value="@if(isset($_GET['phone'])){{ $_GET['phone'] }}@endif">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" type="submit">Search</button>
                            @if(request()->has('email') || request()->has('name') || request()->has('phone'))
                            <button class="btn btn-warning" type="button" id="reset" value="Reset">Clear</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
                <div class="card-header">
                    <h4 class="card-title">Contact Enquiry List
                        <a href="{{ route('admin.enqueryListExport') }}"><button class="btn btn-primary" type="button" style="float:right">Export Data CSV</button>
                    </a>
                    </h4>

                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($contactEnqueries) > 0)
                                @php $i = 1; @endphp
                                @foreach ($contactEnqueries as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->first_name.' '.   $item->last_name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->phone}}</td>
                                    <td>{{ $item->message}}</td>
                                    <td>{{ date('d M Y g:i a', strtotime($item->created_at)) }}</td>
                                 
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">No Records Found</td>
                                </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <!-- Pagignation start -->
                    <nav aria-label="Page navigation example" class="{{ count($contactEnqueries) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($contactEnqueries->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $contactEnqueries->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $contactEnqueries->currentPage() - 5);
                            $end = min($contactEnqueries->lastPage(), $contactEnqueries->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($contactEnqueries->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $contactEnqueries->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($contactEnqueries->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $contactEnqueries->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $contactEnqueries->total() }} Showing {{ $contactEnqueries->count() }} records per page</p>
                    </nav>
                    <!-- Pagignation end -->

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->

@endsection
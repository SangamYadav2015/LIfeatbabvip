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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invalid login Attempts</a></li>
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
                    <h4 class="card-title">Invalid login Attempts</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Ip Address</th>
                                    <th>Atetmpt At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($attemptData) > 0)
                                @php $i = 1; @endphp
                                @foreach ($attemptData as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->user ? $item->user->name : 'User Not Exist' }}</td>
                                    <td>{{ $item->ip_address}}</td>
                                    <td>{{ date('d M Y g:i:a',strtotime($item->created_at)) }}</td>
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
                    <nav aria-label="Page navigation example" class="{{ count($attemptData) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($attemptData->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $attemptData->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $attemptData->currentPage() - 5);
                            $end = min($attemptData->lastPage(), $attemptData->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($attemptData->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $attemptData->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($attemptData->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $attemptData->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $attemptData->total() }} Showing {{ $attemptData->count() }} records per page</p>
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
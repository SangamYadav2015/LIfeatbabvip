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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Subscriber List</a></li>
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
                    <h4 class="card-title">Subscriber List</h4>

                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($subscribers) > 0)
                                @php $i = 1; @endphp
                                @foreach ($subscribers as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->status === 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ date('d M Y g:i:a', strtotime($item->created_at)) }}</td>

                                    
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
                    <nav aria-label="Page navigation example" class="{{ count($subscribers) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($subscribers->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $subscribers->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $subscribers->currentPage() - 5);
                            $end = min($subscribers->lastPage(), $subscribers->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($subscribers->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $subscribers->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($subscribers->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $subscribers->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $subscribers->total() }} Showing {{ $subscribers->count() }} records per page</p>
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
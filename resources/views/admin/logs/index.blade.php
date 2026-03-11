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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages List</a></li>
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
                    <h4 class="card-title">Pages List</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Level</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($logs) > 0)
                                @php $i = 1; @endphp
                                @foreach ($logs as $item)
                                @php
                                 $pageData=  decodeData($item->page_data);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->level }}</td>
                                    <td> {{ Str::limit($item->message, 50) }}</td>

                                    <td>{{ $item->status }}</td>
                                    <td>
                    <select class="form-control changeStatus {{ $item->status === 'New' ? 'bg-primary' : '' }} {{ $item->status === 'Progress' ? 'bg-warning' : '' }} {{ $item->status === 'Resolved' ? 'bg-success' : '' }}" name="status" data-section-id="{{ $item->id }}" style="width: auto;color: #fff;">
                            <option value="">Change Status</option>
                            <option value="New" {{ $item->status === 'New' ? 'Selected' : '' }}>New</option>
                            <option value="Progress" {{ $item->status === 'Progress' ? 'Selected' : '' }}>Progress</option>
                            <option value="Resolved" {{ $item->status === 'Resolved' ? 'Selected' : '' }}>Resolved</option>
                        </select>
                    </td>

                                    <td>
                                        <a href="{{ route('admin.viewlogs', ['num' => $item->id]) }}"><i data-feather="eye"></i>View</a>

                                        <!-- <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{  route('admin.deletePage', ['num' => $item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> -->
                                    </td>
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
                    <nav aria-label="Page navigation example" class="{{ count($logs) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($logs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $logs->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $logs->currentPage() - 5);
                            $end = min($logs->lastPage(), $logs->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($logs->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $logs->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($logs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $logs->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $logs->total() }} Showing {{ $logs->count() }} records per page</p>
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
<script>
    function successsweetalert(message) {
        Swal.fire({
            title: "Good job!",
            text: message,
            icon: "success"
        });
    }
    $(".changeStatus").each(function() {
        $(this).change(function() {
            var id = $(this).data('section-id');
            var status = $(this).val();
            $.ajax({
                url: '{{ route("admin.updateLogStatus") }}',
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200) {
                        successsweetalert(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Location Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li><a class="btn btn-primary" href="{{route('locations.create')}}">Add Location</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Location List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Location Name</th>
                                    <th>Location Image</th>
                                    <th>Short Description</th>
                                    <th>Location Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($locations) > 0)
                                @php $i = 1; @endphp
                                @foreach ($locations as $location)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $location->location_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/uploads/' . $location->location_image) }}" class="img-thumbnail" style="width: 100px;">
                                    </td>
                                    <td>{{ $location->short_description }}</td>
                                    <td>{{ $location->location_slug }}</td>
                                    <td>
                                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-info">Edit</a>                                        <a href="{{ route('locations.destroy', $location->id) }}" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $location->id }}');">
    <i data-feather="trash-2"></i> Delete
</a>
<form id="delete-form-{{ $location->id }}" action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
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
                    <!-- Pagination start -->
                    <nav aria-label="Page navigation example" class="{{ count($locations) > 0 ? '' : 'd-none' }}">
                        <ul class="pagination">
                            @if ($locations->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $locations->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif

                            @php
                            $start = max(1, $locations->currentPage() - 5);
                            $end = min($locations->lastPage(), $locations->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ ($locations->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $locations->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($locations->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $locations->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                            @endif
                        </ul>
                        <p>Total Records: {{ $locations->total() }} Showing {{ $locations->count() }} records per page</p>
                    </nav>
                    <!-- Pagination end -->
                </div>
                <!-- End card body -->
            </div>
            <!-- End card -->
        </div>
        <!-- End col -->
    </div>

</div>
<!-- Container-fluid -->
<script>
    function deleteAlert(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection

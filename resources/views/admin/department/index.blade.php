@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li><a class="btn btn-primary" href="{{ route('admin.departments.add') }}">Add Department</a></li>
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
                    <h4 class="card-title">Department List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department Name --> Roles</th>
                                    <th>Department Description</th>
                                    <th>Department Image</th>
                                    <th>Status</th> <!-- Updated Status Column -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($departments) > 0)
                                @php $i = 1; @endphp
                                @foreach ($departments as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>
                                         {{ $item->Department_name }}
                                         <ul>
                                             @foreach($item->userRole as $role)
                                                 <li>{{ $item->Department_name .'--->'.$role->role_title }}</li> 
                                             @endforeach
                                         </ul>
                                    </td>
                                    <td>{{ $item->short_description }}</td>
                                    <td>
                        @if($item->department_image)
                            <img src="{{ asset('storage/' . $item->department_image) }}" alt="{{ $item->Department_name }}" style="width: 100px; height: auto;">
                        @else
                            <p>No image available</p>
                        @endif
                    </td>                                    <td>
                                        <input type="checkbox" class="changeStatus" id="changeStatus-{{ $item->id }}" switch="success" data-section-id="{{ $item->id }}" {{ $item->status == 'active' ? 'checked' : '' }}>
                                        <label for="changeStatus-{{ $item->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.editDepartment', ['num' => $item->id]) }}" class="btn btn-info">Edit</a>
                                        <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.deletePage', ['num' => $item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">No Records Found</td> <!-- Updated colspan to 6 -->
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination start -->
                    <nav aria-label="Page navigation example" class="{{ count($departments) > 0 ? '' : 'd-none' }}">
                        <ul class="pagination">
                            @if ($departments->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $departments->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif

                            @php
                            $start = max(1, $departments->currentPage() - 5);
                            $end = min($departments->lastPage(), $departments->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ ($departments->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $departments->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($departments->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $departments->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                            @endif
                        </ul>
                        <p>Total Records: {{ $departments->total() }} Showing {{ $departments->count() }} records per page</p>
                    </nav>
                    <!-- Pagination end -->

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

    // Handle status change
    document.querySelectorAll('.changeStatus').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const departmentId = this.dataset.sectionId;
            const newStatus = this.checked ? 'active' : 'inactive';

            // AJAX request to update the status in the database
            fetch(`/admin/departments/${departmentId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                // Handle success or failure
                if (data.success) {
                    Swal.fire('Success!', 'Status updated successfully.', 'success');
                } else {
                    Swal.fire('Error!', 'Failed to update status.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred.', 'error');
            });
        });
    });
</script>

@endsection

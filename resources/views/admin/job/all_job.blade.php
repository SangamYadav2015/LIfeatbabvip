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
                    <li><a class="btn btn-primary" href="{{ route('admin.addjob') }}">Create Jobs</a></li>   
                    <li>
    <a class="btn btn-warning" id="toggleImport">Import Post Jobs</a> <!-- Toggle button for import -->
</li>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Post Jobs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('post-jobs.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">CSV File</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div  class="text-left" style="margin-top: 15px;">
                        <a href="{{ asset('admin/sample-job-csv.csv') }}" class="btn btn-info"  download>
                            Download Sample CSV
                        </a>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggleImport').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default anchor behavior
        $('#importModal').modal('show'); // Show the import modal
    });
</script>
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
                    <h4 class="card-title">Job List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Designation</th>
                                    <th>Job Description</th>
                                    <th>Salary</th>
                                   
                                    <th>Salary Status</th>
                                    <th>Posted On</th>

                                    <th>Change Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($jobs) > 0)
                                    @php $i = 1; @endphp
                                    @foreach ($jobs as $job)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->company->company_name }}</td>
                                        <td>{{ $job->location ? $job->location->location_name : 'N/A' }}</td>
                                        <td>{{ $job->type }}</td>
                                        <td>{{ $job->designation }}</td>
<td>{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 50, '...') }}</td>

                                        <td>INR{{ number_format($job->minimum_salary) }} - INR{{ number_format($job->maximum_salary) }}</td> <!-- Display Salary Range -->
                                       
                                        <td>{{ $job->salary_disclosed ? 'Yes' : 'Not disclosed' }}</td>
<td>{{ $job->created_at->format('d M Y') }}</td>

                                        <td>
                                            <input type="checkbox" class="changeStatus" id="changeStatus-{{ $job->id }}" switch="success" data-section-id="{{ $job->id }}" {{ $job->status == 'active' ? 'checked' : '' }}>
                                            <label for="changeStatus-{{ $job->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('admin.editjob', ['num'=> $job->id]) }}" ><i data-feather="edit"></i>Edit</a> |

                                            <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $job->id }}');">
                                                <i data-feather="trash-2"></i>Delete
                                            </a>
                                            <form id="delete-form-{{ $job->id }}" action="{{ route('admin.deletejob', ['num' => $job->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="13">No Records Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination start -->
                    <nav aria-label="Page navigation example" class="{{ count($jobs) > 0 ? '' : 'd-none' }}">
                        <ul class="pagination">
                            @if ($jobs->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jobs->previousPageUrl() }}" rel="prev">Previous</a>
                                </li>
                            @endif

                            @php
                            $start = max(1, $jobs->currentPage() - 5);
                            $end = min($jobs->lastPage(), $jobs->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++)
                                <li class="page-item {{ ($jobs->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $jobs->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($jobs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jobs->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                        <p>Total Records: {{ $jobs->total() }} Showing {{ $jobs->count() }} records per page</p>
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
    function successsweetalert(message) {
        Swal.fire({
            title: "Good job!",
            text: message,
            icon: "success"
        });
    }

    $(".changeStatus").each(function() {
        $(this).change(function() {
            var jobId = $(this).data('section-id');
            var status = this.checked ? 'active' : 'inactive';
            $.ajax({
                url: '{{ route("admin.updatejobstatus") }}',
                type: 'POST',
                data: {
                    id: jobId,
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200) {
                        successsweetalert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

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

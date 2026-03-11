

@extends('admin.layout.app')
@section('content')


<div class="container-fluid">

    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Applicant List</a></li>
                        <li class="breadcrumb-item active">All Applicants</li>
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
                    <h4 class="card-title">Applicant List</h4>
                </div>
 <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">

         <thead>
            <tr>
                <th>#</th>
                <th>Applicant ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Job Applied</th>
                 <th>Action</th>
               </tr>
            </thead>
            <tbody>
 @if(count($applicants) > 0)
                @php $i = 1; @endphp
                @foreach ($applicants as $applicant)
                <tr>
                    <th scope="row">{{ $i }}</th>

                    <td>{{ $applicant->id }}</td>
                    <td>{{ $applicant->first_name }}</td>
                    <td>{{ $applicant->email }}</td>
                    
                    <td>{{ $applicant->job_applications_count }}</td>
                    
                   <td>
    <input type="checkbox" class="changeApplicantStatus" 
       id="changeStatus-{{ $applicant->id }}" 
       data-applicant-id="{{ $applicant->id }}" 
       switch="success" 
       {{ $applicant->status == 'active' ? 'checked' : '' }}>

<label for="changeStatus-{{ $applicant->id }}" 
       data-on-label="Active" 
       data-off-label="Inactive"></label>
</td>

                     <td>
        <form action="{{ route('admin.applicant.destroy', $applicant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this applicant?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
                   </tr>
                                @php $i++; @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7">No Records Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="{{ count($applicants) > 0 ? '' : 'd-none' }}">
                        <ul class="pagination">
                            @if ($applicants->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $applicants->previousPageUrl() }}">Previous</a>
                            </li>
                            @endif

                            @php
                                $start = max(1, $applicants->currentPage() - 5);
                                $end = min($applicants->lastPage(), $applicants->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ $applicants->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $applicants->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($applicants->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $applicants->nextPageUrl() }}">Next</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                            @endif
                        </ul>
                        <p>Total Records: {{ $applicants->total() }} Showing {{ $applicants->count() }} per page</p>
                    </nav>
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function successsweetalert(message) {
        Swal.fire({
            title: "Success",
            text: message,
            icon: "success",
            timer: 2000,
            showConfirmButton: false
        });
    }

    $(document).ready(function () {
        $(".changeApplicantStatus").change(function () {
            var applicantId = $(this).data('applicant-id');
            var status = $(this).is(':checked') ? 'active' : 'inactive';

            $.ajax({
                url: '{{ route("admin.applicant.updateStatus") }}',
                type: 'POST',
                data: {
                    applicant_id: applicantId,
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 200) {
                        successsweetalert(response.message);
                    } else {
                        Swal.fire("Warning", "Unexpected status code", "warning");
                    }
                },
                error: function (xhr) {
                    Swal.fire("Error", "Failed to update status", "error");
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>








@endsection

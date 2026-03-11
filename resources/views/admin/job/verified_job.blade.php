@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->first_name }} Welcome! To {{ Auth::user()->designation }} Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li>
                            <a class="btn btn-primary" href="{{ route('admin.addjob') }}">Create Jobs</a>
                        </li>
                        <li>
                            <a class="btn btn-warning" id="toggleImport">Import Post Jobs</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Verified Applicants</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Applicant ID</th>
                                    <th>Name</th>
                                    <th>Job Title</th>
                                    <th>Action</th>
                                   
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
    @if(count($verifiedApplicants) > 0)
     @php $i = 1; @endphp
        @foreach ($verifiedApplicants as $applicant)
        <tr id="applicant-{{ $applicant['applicant_id'] }}">
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $applicant['applicant_id'] }}</td>
            <td>{{ $applicant['first_name'] ?? '' }}</td>

            <td>{{ $applicant['title'] }}</td>
            <td>
                <a href="{{ route('applicant.show', $applicant['applicant_id']) }}" class="btn btn-info waves-effect waves-light">View</a>
            </td>
            
            <td>
                <!-- Dropdown to change status -->
              <form action="{{ route('admin.updateApplicantStatus') }}" method="POST">
    @csrf
<input type="hidden" name="job_application_id" value="{{ $applicant['job_application_id'] }}">
<select name="status" class="form-control">
    <option value="applied" {{ $applicant['status'] == 'applied' ? 'selected' : '' }}>Applied</option>
    <option value="screened" {{ $applicant['status'] == 'screened' ? 'selected' : '' }}>Screened</option>
    <option value="rejected" {{ $applicant['status'] == 'rejected' ? 'selected' : '' }}>Rejected</option>
    <option value="Shortlisted" {{ $applicant['status'] == 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
    <option value="Interview schedule" {{ $applicant['status'] == 'Interview schedule' ? 'selected' : '' }}>Interview Schedule</option>
    <option value="Background verification" {{ $applicant['status'] == 'Background verification' ? 'selected' : '' }}>Background Verification</option>
    <option value="hired" {{ $applicant['status'] == 'hired' ? 'selected' : '' }}>Hired</option>
</select>

    <button type="submit" class="btn btn-primary">Update Status</button>
</form>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">No Records Found</td>
        </tr>
    @endif
</tbody>
                        </table>
                    </div>
                    <!-- Pagination if needed -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- container-fluid -->

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Listen for form submission
    $('form.status-update-form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        var actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function (response) {
                alert("Status updated successfully!");
                // Reload the page to reflect changes
                location.reload();
            },
            error: function (xhr, status, error) {
                alert("Something went wrong while updating the status.");
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
<style>
    /* Customize progress bar colors */
.progress-bar {
    background-color: #ccc;
}
.progress-bar[style*="width: 20%"] {
    background-color: #007bff; /* Applied (Blue) */
}
.progress-bar[style*="width: 40%"] {
    background-color: #ffc107; /* To Be Screened (Yellow) */
}
.progress-bar[style*="width: 60%"] {
    background-color: #28a745; /* Screened (Green) */
}
.progress-bar[style*="width: 80%"] {
    background-color: #17a2b8; /* Hired (Teal) */
}
.progress-bar[style*="width: 100%"] {
    background-color: #dc3545; /* Rejected (Red) */
}

</style>
@endsection

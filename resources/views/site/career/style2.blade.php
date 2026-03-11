@php
  $decodeData = decodeData($page_data);
  $jobData = getalljob();
@endphp

<section id="open-positions" class="open-jobs ptb-120">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-4 col-md-12">
                <div class="section-heading">
                    <h4 class="h5 text-primary">Our Jobs</h4>
                    <h2>Current Available Positions at Quiety</h2>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <p>Phosfluorescently transitiships with technically sound paradigms with cutting-edge initiatives.</p>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div id="job-filters" class="mb-4">
            <select id="location" name="location" class="form-select mb-3">
                <option value="">Select Location</option>
                @foreach ($jobData as $itemRow)
                    <option value="{{ $itemRow->location->id }}">{{ $itemRow->location->location_name }}</option>
                @endforeach
            </select>

            <select id="type" name="type" class="form-select mb-3">
                <option value="">Select Job Type</option>
                @foreach ($jobData as $itemRow)
                    <option value="{{ $itemRow->type }}">{{ $itemRow->type }}</option>
                @endforeach
            </select>

            <select id="department" name="department" class="form-select mb-3">
                <option value="">Select Department</option>
                @foreach ($jobData as $itemRow)
                <option value="{{ $itemRow->department->id }}">{{ $itemRow->department->Department_name }}</option>
                @endforeach            </select>
        </div>

        <div class="row justify-content-center" id="job-listings">
            @foreach($jobData as $itemRow)
                <div class="col-lg-4 col-md-12 mt-4 job-item"
                     data-location="{{ $itemRow->location->id }}"
                     data-type="{{ $itemRow->type }}"
                     data-department="{{ $itemRow->department_id }}">
                    <div class="text-decoration-none mt-4 single-open-job p-5 bg-dark text-white d-block rounded-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="job-time h-6 mb-2"><i class="fas fa-briefcase me-2"></i> <strong>{{  $itemRow->type }}</strong></span>
                            <span class="badge px-3 py-2 bg-custom-light rounded-pill small">{{  $itemRow->type }}</span>
                        </div>
                        <h3 class="h5">{{  $itemRow->title }}</h3>
                        <ul class="job-info-list list-inline list-unstyled text-muted">
                            <li class="list-inline-item"><span class="fas fa-house me-1"></span> {{  $itemRow->designation }}</li>
                            <li class="list-inline-item"><span class="fas fa-location-pin me-1"></span> {{  $itemRow->location->location_name ?? 'Location not specified' }}</li>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <span class="fas fa-wallet me-1"></span>
                                    Minimum Salary: {{ $itemRow->minimum_salary }} L.P
                                </li>
                                <li class="list-inline-item">
                                    <span class="fas fa-wallet me-1"></span>
                                    Maximum Salary: {{ $itemRow->maximum_salary }} L.P
                                </li>
                            </ul>
                        </ul>
                        @if (Auth::guard('applicant')->check())
                            <form action="{{ route('job.application.store', $itemRow->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="applicant_id" value="{{ Auth::guard('applicant')->id() }}">
                                <button type="submit" class="btn btn-secondary pt-0 pb-0  mt-2">Apply</button>
                            </form>
                        @else
                            <a href="{{ route('applicant.login') }}" class="btn btn-secondary  mt-2">Apply</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#job-filters select').on('change', function() {
        var locationId = $('#location').val();
        var jobType = $('#type').val();
        var departmentId = $('#department').val(); // If needed

        $('.job-item').show(); // Show all jobs initially

        $('.job-item').filter(function() {
            var jobLocation = $(this).data('location');
            var jobTypeMatch = !jobType || $(this).data('type') === jobType;
            var departmentMatch = !departmentId || $(this).data('department') === departmentId;

            // Filter by location
            var locationMatch = !locationId || jobLocation == locationId;

            return !(locationMatch && jobTypeMatch && departmentMatch);
        }).hide(); // Hide jobs that do not match
    });
});
</script>

@foreach($jobs as $itemRow)
    <div class="col-lg-4 col-md-12 mt-4" style="padding-top: 20px;">
        <div class="text-decoration-none single-open-job p-5 bg-dark text-white d-block rounded-custom">
            <div class="d-flex justify-content-between align-items-center">
                <span class="job-time h-6 mb-2"><i class="fas fa-briefcase me-2"></i> <strong>{{ $itemRow->type }}</strong></span>
                <span class="badge px-3 py-2 bg-custom-light rounded-pill small">{{ $itemRow->type }}</span>
            </div>
            <h3 class="h5">{{ $itemRow->title }}</h3>
            <ul class="job-info-list list-inline list-unstyled text-muted">
                <li class="list-inline-item"><span class="fas fa-house me-1"></span> {{ $itemRow->designation }}</li>
                <li class="list-inline-item"><span class="fas fa-location-pin me-1"></span> {{ $itemRow->location->location_name ?? 'Location not specified' }}</li>
                <li class="list-inline-item"><span class="fas fa-wallet me-1"></span> Minimum Salary: {{ $itemRow->minimum_salary }} L.P</li>
                <li class="list-inline-item"><span class="fas fa-wallet me-1"></span> Maximum Salary: {{ $itemRow->maximum_salary }} L.P</li>
            </ul>
            <a href="{{ route('job.application.store', $itemRow->id) }}" class="btn btn-secondary pt-0 pb-0">Apply</a>
        </div>
    </div>
@endforeach
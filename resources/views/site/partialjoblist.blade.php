@extends('site.layout.app')

@section('content')
<div class="row justify-content-center">
    @foreach($jobs as $itemRow)
        <div class="col-lg-12 col-md-12 mt-4">
            <div class="text-decoration-none mt-4 mt-xl-0 mt-lg-0 single-open-job p-5 bg-dark text-white d-block rounded-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="job-time h-6 mb-2"><i class="fas fa-briefcase me-2"></i> <strong>{{  $itemRow->type }}</strong></span>
                    <span class="badge px-3 py-2 bg-custom-light rounded-pill small">Developer</span>
                </div>
                <a href="{{ route('jobs.details', ['slug' => $itemRow->job_slug]) }}">
                    <h3 style="font-size: 1rem;">{{ $itemRow->title }}</h3>
                </a>
                <ul class="job-info-list list-inline list-unstyled text-muted">
                    <li class="list-inline-item"><span class="fas fa-house me-1"></span> Google</li>
                    <li class="list-inline-item"><span class="fas fa-location-pin me-1"></span> {{ $itemRow->location->location_name ?? 'Location not specified' }}</li>
                    <li class="list-inline-item"><span class="fas fa-wallet me-1"></span>{{ $itemRow->salary }} L.P</li>
                </ul>
                @if (Auth::guard('applicant')->check())
                    <form action="{{ route('job.application.store', $itemRow->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="applicant_id" value="{{ Auth::guard('applicant')->id() }}">
                        <button type="submit" class="btn btn-secondary pt-0 pb-0 mt-2">Apply </button>
                    </form>
                @else
                    <a href="{{ route('applicant.login') }}" class="btn btn-secondary pt-0 pb-0 mt-2">Apply</a>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
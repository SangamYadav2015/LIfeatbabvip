@extends('site.layout.app')

@section('content')

<section class="page-header position-relative overflow-hidden ptb-120 bg-dark" style="background: url('assets/img/page-header-bg.svg')no-repeat bottom left">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-8 col-12">
                        <div class="company-info-wrap">
                            <div class="company-logo p-4 bg-white shadow rounded-custom me-4 mt-2">
                                <div class="logo">
                                    <img src="{{ asset('site/assets/img/brand-logo/logo3.png') }}" alt="company logo" class="img-fluid">
                                </div>
                            </div>
                            <div class="company-overview">
                                <h1 class="display-5 fw-bold">{{ $job->title }}</h1>

                                <h6>About The Company</h6>
                                <ul class="list-unstyled list-inline mb-0 mt-3">
                                    <li class="list-inline-item me-4"><i class="fas fa-house me-2"></i> Google</li>
                                    <li class="list-inline-item me-4">

                                        <div class="star-rating">
                                            <i class="far fa-smile me-2"></i>
                                            <span class="fas fa-star small text-warning"></span>
                                            <span class="fas fa-star small text-warning"></span>
                                            <span class="fas fa-star small text-warning"></span>
                                            <span class="fas fa-star small text-warning"></span>
                                            <span class="fas fa-star small text-warning"></span>
                                        </div>
                                    </li>
                                    <li class="list-inline-item me-4"><i class="fas fa-location-arrow me-2"></i>
                                    {{ $job->location->location_name ?? 'Location not specified' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="annual-salary-wrap rounded-custom bg-white">
                        @if($job->salary_disclosed)
    <h6>Annual Salary</h6>
    @if($job->minimum_salary && $job->maximum_salary)
        <span class="h5 fw-semi-bold text-dark mb-0">
            ${{ number_format($job->minimum_salary, 2) }} – ${{ number_format($job->maximum_salary, 2) }}
        </span>
    @elseif($job->salary)
        <span class="h5 fw-semi-bold text-dark mb-0">
            ${{ number_format($job->salary, 2) }}
        </span>
    @else
        <span class="text-muted">Not specified</span>
    @endif
@endif

                        </div>
                    </div>
                </div>

                <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light right-5"></div>
            </div>
        </section>
    <section class="job-detail-section ptb-120">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8">
                    <div class="job-detail-content bg-light p-5 rounded-custom">
                        <!-- Job Title and Company -->
                        <h2 class="mb-4">{{ $job->title }}</h2>
                        <div class="d-flex align-items-center mb-4">
                            <span class="job-company me-3">
                                <strong>Company:</strong> {{ $job->company->company_name ?? 'Unknown' }}
                            </span>
                            <span class="job-location me-3">
                                <i class="fas fa-map-marker-alt"></i> 
                                {{ $job->location->location_name ?? 'Location not specified' }}
                            </span>
                            <span class="job-type badge bg-primary">{{ $job->type }}</span>
                        </div>

                        <!-- Job Description -->
                        <div class="job-description mb-4">
                            <h4>Job Description</h4>
                            <p>{!! $job->description !!}</p>
                        </div>

                        <!-- Skills Required -->
                        @if(!empty($job->skill))
                            <div class="job-skills mb-4">
                                <h4>Skills Required</h4>
                                <ul>
                                    @foreach(explode(',', $job->skill) as $skill)
                                        <li>{{ $skill }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Job Benefits -->
                        @if(!empty($job->benefits))
                            <div class="job-benefits mb-4">
                                <h4>Benefits</h4>
                                <ul>
                                    @foreach(explode(',', $job->benefits) as $benefit)
                                        <li>{{ $benefit }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Experience -->
                       <!-- <div class="job-experience mb-4">
                            <h4>Experience Required</h4>
                            <p>{{ $job->experience }}year</p>
                        </div>--->

                        <!-- Salary -->
                        @if($job->salary_disclosed)
    <div class="job-salary mb-4">
        <h6 class="mb-1">Salary</h6>
        @if($job->minimum_salary && $job->maximum_salary)
            <p class="small text-dark mb-0">
                ${{ number_format($job->minimum_salary, 2) }} – ${{ number_format($job->maximum_salary, 2) }}L.P.A
            </p>
        @elseif($job->salary)
            <p class="small text-dark mb-0">
                ${{ number_format($job->salary, 2) }}L.P.A
            </p>
        @else
            <p class="small text-muted mb-0">Not specified</p>
        @endif
    </div>
@endif


                        <!-- Job Image (if available) -->
                        @if(!empty($job->job_image))
                            <div class="job-image mb-4">
                                <img src="{{ asset('uploads/jobs/' . $job->job_image) }}" alt="{{ $job->title }}" class="img-fluid rounded">
                            </div>
                        @endif

                        <!-- Apply Button -->
                        <div class="apply-button mt-4">
                        @if(Auth::guard('applicant')->check())
                    <form action="{{ route('apply.job', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Apply Now</button>
                    </form>
                @else
                    <a href="{{ route('applicant.login') }}" class="btn btn-secondary">Login to Apply</a>
                @endif           
                    </div>
                    </div>
                </div>

                <!-- Related Jobs -->
                <div class="col-lg-4">
                    <div class="related-jobs bg-dark text-white p-4 rounded-custom">
                        <h4>Related Jobs</h4>
                        @if($relatedJobs->isNotEmpty())
                            @foreach($relatedJobs as $relatedJob)
                                <div class="related-job-item mb-3">
                                    <h5><a href="{{ route('job.details', $relatedJob->job_slug) }}" class="text-white">{{ $relatedJob->title }}</a></h5>
                                    <p>{{ $relatedJob->company->name ?? 'Unknown Company' }}</p>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $relatedJob->location->location_name ?? 'Location not specified' }}</p>
                                </div>
                            @endforeach
                        @else
                            <p>No related jobs available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

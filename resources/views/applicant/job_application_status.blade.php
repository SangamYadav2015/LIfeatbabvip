@extends('applicant.body.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Application Status</h3>
        <h5 class="text-muted">Candidate: {{ $applicant->full_name }}</h5>
        <p class="lead">Position: <strong>{{ $jobApplication->job->title }}</strong></p>
    </div>

    @php
        $steps = [
            ['label' => 'Applied', 'icon' => 'fas fa-file-alt', 'value' => 10],
            ['label' => 'Pending', 'icon' => 'fas fa-hourglass-half', 'value' => 20],
            ['label' => 'Screened', 'icon' => 'fas fa-check-circle', 'value' => 50],
            ['label' => 'Shortlisted', 'icon' => 'fas fa-star', 'value' => 60],
            ['label' => 'Interview Scheduled', 'icon' => 'fas fa-calendar-check', 'value' => 70],
            ['label' => 'Background Verification', 'icon' => 'fas fa-id-card', 'value' => 85],
            ['label' => 'Hired', 'icon' => 'fas fa-user-check', 'value' => 100],
        ];
    @endphp

    <div class="timeline-wrapper mb-4">
        <div class="progress-container position-relative">
            <div class="progress-bar-line bg-light"></div>
            <div class="steps d-flex justify-content-between">
                @foreach($steps as $step)
                    <div class="step text-center flex-fill position-relative">
                        <div class="circle {{ $progress >= $step['value'] ? 'completed' : '' }}">
                            <i class="{{ $step['icon'] }}"></i>
                        </div>
                        <div class="step-label mt-2 small {{ $progress >= $step['value'] ? 'text-success fw-bold' : 'text-muted' }}">
                            {{ $step['label'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        @if($status === 'hired')
            <div class="alert alert-success">
                <i class="fas fa-thumbs-up fa-lg me-2"></i> Congratulations! You have been <strong>Hired</strong>.
            </div>
        @elseif($status === 'rejected')
            <div class="alert alert-danger">
                <i class="fas fa-times-circle fa-lg me-2"></i> Sorry, you have been <strong>Rejected</strong>.
            </div>
        @else
            <div class="alert alert-warning">
                <i class="fas fa-clock fa-lg me-2"></i> Your application is <strong>In Progress</strong>.
            </div>
        @endif
    </div>
</div>

<style>
.timeline-wrapper {
    overflow-x: auto;
    padding: 10px 0;
}
.progress-container {
    position: relative;
}
.progress-bar-line {
    position: absolute;
    top: 24px;
    left: 0;
    right: 0;
    height: 4px;
    background-color: #dee2e6;
    z-index: 0;
}
.steps .step {
    min-width: 100px;
}
.circle {
    width: 48px;
    height: 48px;
    line-height: 48px;
    border-radius: 50%;
    background-color: #f1f1f1;
    border: 2px solid #dee2e6;
    color: #6c757d;
    font-size: 20px;
    margin: 0 auto;
    transition: all 0.3s ease;
}
.circle.completed {
    background-color: #198754;
    color: #fff;
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2);
}
.step-label {
    margin-top: 8px;
    font-size: 13px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection

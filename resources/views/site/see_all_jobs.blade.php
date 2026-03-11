@extends('site.layout.app')

@section('content')
<div class="container">
<h1 class="text-center mt-4" style="font-size:60px;color:blue;">Find your dream job</h1>
    <!-- Search Bar -->
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <form method="GET" action="{{ route('jobs.filter') }}" id="search-bar-form">
                <div class="input-group">
                    <input type="text" name="title" id="search-title" class="form-control" placeholder="Search for job titles, companies, etc." value="{{ request('title') }}" style="border-color: blue; box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section id="open-positions" class="open-jobs ptb-120">
   
    <div class="container">
        <div class="row align-items-center justify-content-between">
           
        </div>

        <!-- Job Search Form -->
        <form id="job-search-form" method="GET" action="{{ route('jobs.filter') }}">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Job Title" value="{{ request('title') }}" style="border-color: blue; box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);">
                </div>

             

                <div class="col-md-4">
                    <select name="location_id" id="location_id" class="form-control" style="border-color: blue; box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                </div>

               

                <div class="col-md-4">
                    <select name="type" id="type" class="form-control" style="border-color: blue; box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);">
                        <option value="">Select Job Type</option>
                        <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                        <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    </select>
                </div>
            </div>
        </form>

        <!-- Job List Section -->
        <div id="job-list" class="row justify-content-center">
            @foreach( $jobs as $itemRow)
                <div class="col-lg-4 col-md-12 mt-4">
                    <div class="text-decoration-none mt-4 mt-xl-0 mt-lg-0 single-open-job p-5 bg-dark text-white d-block rounded-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="job-time h-6 mb-2"><i class="fas fa-briefcase me-2"></i> <strong>{{  $itemRow->type }}</strong></span>
                            <span style="margin-left:10px;font-size:12px;">{{  $itemRow->designation}}</span>
                        </div>
                       
                        <a href="{{ route('jobs.details', ['slug' => $itemRow->job_slug]) }}">
                            <h3 style="font-size: 1rem;">{{ $itemRow->title }}</h3>
                        </a>
                        <ul class="job-info-list list-inline list-unstyled text-muted">
                            <li class="list-inline-item"><span class="fas fa-house me-1"></span> Google</li>
                            <li class="list-inline-item"><span class="fas fa-location-pin me-1"></span> {{  $itemRow->location->location_name ?? 'Location not specified' }}</li>
                            <li class="list-inline-item">
    <span class="fas fa-wallet me-1"></span>
    @if($itemRow->minimum_salary && $itemRow->maximum_salary)
        {{ $itemRow->minimum_salary }}k - {{ $itemRow->maximum_salary }} L.P
    @elseif($itemRow->minimum_salary)
        {{ $itemRow->minimum_salary }}k
    @elseif($itemRow->maximum_salary)
        {{ $itemRow->maximum_salary }} L.P
    @else
        Not Specified
    @endif
</li>
                        </ul>
                        <div class="d-flex">
                        <!-- Wishlist Button -->
                        @if(Auth::guard('applicant')->check())
                            @php
                                // Check if the job is already in the wishlist
                                $isInWishlist = \App\Models\Wishlist::where('applicant_id', Auth::guard('applicant')->id())
                                                                      ->where('job_id', $itemRow->id)
                                                                      ->exists();
                            @endphp

                            @if($isInWishlist)
                                <!-- If job is in wishlist, show Remove from Wishlist button -->
                                <form action="{{ route('wishlist.remove', $itemRow->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger mt-2">
                <i class="fas fa-heart"></i> <!-- Empty heart icon for add -->
            </button>                                    </form>
            
                            @else
                                <!-- If job is not in wishlist, show Add to Wishlist button -->
                                <form action="{{ route('wishlist.add', $itemRow->id) }}" method="POST">
                                    @csrf
                                    <a href="{{ route('applicant.login') }}" class="btn btn-secondary pt-0 pb-0 mt-2">
        <i class="fas fa-heart"></i> 
    </a>
                                    </form>
                            @endif
                        @else
                            <a href="{{ route('applicant.login') }}" class="btn btn-secondary pt-0 pb-0 mt-2">Wishlist</a>
                        @endif

                        @if (Auth::guard('applicant')->check())
                            <form action="{{ route('job.application.store', $itemRow->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="applicant_id" value="{{ Auth::guard('applicant')->id() }}">
                                <button type="submit" class="btn btn-secondary pt-0 pb-0 mt-2" style="margin-left:41px">Apply </button>
                            </form>
                        @else
                            <a href="{{ route('applicant.login') }}" class="btn btn-secondary pt-0 pb-0 mt-2" style="margin-left:41px">Apply</a>
                        @endif
                        </div>
                    </div>
                </div>

              
            @endforeach

            <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4{{ count($jobs) > 0 ? '' : 'd-none' }}" >
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
                        </ul><br>
                    </nav>
        </div>

        
    </div>
    <div class="container align-items-center mt-4">
        
    
                </div>
    

    <!-- AJAX Script -->
    <script>
        $(document).ready(function() {
            // Trigger AJAX when any input field changes
            $('#job-search-form input, #job-search-form select').on('change', function() {
                let formData = $('#job-search-form').serialize();  // Get all form data

                $.ajax({
                    url: $('#job-search-form').attr('action'),  // Use the form's action URL
                    method: 'GET',  // Use GET method
                    data: formData,  // Send the serialized data
                    success: function(response) {
                        $('#job-list').html(response.jobsHTML); // Replace the job list with the updated one
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred while filtering jobs:", error);
                    }
                });
            });
        });
    </script>

</section>

@endsection

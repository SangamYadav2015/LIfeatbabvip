@extends('applicant.body.app')

@section('content')
<div class="marquee-container">
                            <marquee behavior="scroll" direction="left" class="notification-marquee" style="font-size: 14px;">
                                Please complete and update your profile to access all features!
                            </marquee>
                        </div>
<div class="page-content">
     
    <div class="container-fluid">
   
        <!-- start page title -->
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ Auth::guard('applicant')->user()->name }} Welcome! To Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                        <div class="container-fluid">
  
                      
    <!-- Button to toggle notifications visibility -->
    <button id="viewNotificationsBtn" class="btn btn-success mb-3">View Notifications</button>
    <a href="{{url('/')}}"  class="btn btn-primary mb-3">Click here for go Homepage</></a>


    <!-- Notifications Container -->
    <div id="notificationsContainer" class="d-none">
        @if($notifications->isNotEmpty())
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item">

                        <div>{!! $notification->data['message'] !!}</div> <!-- Render the HTML content of the offer letter -->
                        <a href="{{ route('notification.show', ['id' => $notification->id]) }}" class="btn btn-primary">View Notification</a>

                        <small>{{ $notification->created_at->diffForHumans() }}</small>

                    </li>
                @endforeach
            </ul>
        @else
            <p>No notifications available.</p>
        @endif
    </div>
</div>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
       


        <div class="row">
    @if($applications->isEmpty())
        <div class="col-xl-12">
            <p>No job applications submitted yet.</p>
        </div>
    @else
        @foreach($applications as $application)
            <div class="col-xl-3 col-md-6">
                <!-- card for job application -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Job Title</span>
                                <h4 class="mb-3">{{ $application->postJob->title }}</h4>
                                <div class="text-nowrap">
                                    <span class="badge bg-info-subtle text-info">
                                        Applied On: {{ $application->created_at->format('d M, Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex-shrink-0 text-end dash-widget">
                                <!-- You can add a mini-chart here if needed -->
                               <!-- <div id="mini-chart1" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>-->
                            </div>
                        </div>
                        <div class="mt-3">
                           <!-- <a class="btn btn-primary" href="{{ route('verification.form', ['jobId' => $application->job_id, 'applicantId' => $applicantId, 'step' => 1]) }}">
                                Start Verification
                            </a>--->

                            <a class="btn btn-transparent" href="{{ route('applicant.jobApplicationStatus', ['applicantId' => $applicantId, 'jobId' => $application->job_id]) }}">View</a>
                              
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        @endforeach
    @endif
</div><!-- end row -->

       


<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JavaScript to toggle notification visibility -->
<script>
    $(document).ready(function() {
        // Initially hide the notifications container
        $('#notificationsContainer').addClass('d-none');

        // When the "View Notifications" button is clicked
        $('#viewNotificationsBtn').click(function() {
            // Toggle the visibility of the notifications
            $('#notificationsContainer').toggleClass('d-none');
            
            // Optionally change button text when toggled
            if ($('#notificationsContainer').hasClass('d-none')) {
                $(this).text('View Notifications');
            } else {
                $(this).text('Hide Notifications');
            }
        });
    });
</script>

<style>
  .btn-transparent {
    background-color: transparent;
    border: 2px solid #28a745; /* Green border */
    color: #28a745; /* Green text color */
    font-weight: bold;
  }
  
  .btn-transparent:hover {
    background-color: #28a745; /* Green background on hover */
    color: white; /* White text on hover */
  }

  .notification-marquee {
    font-size: 10px;
    color: #fff;
    background-color: rgb(25 129 235); /* Yellow background */
    padding: 5px;
    border-radius: 5px;
  }
</style>    

</div>
@endsection

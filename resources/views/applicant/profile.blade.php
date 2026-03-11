@extends('applicant.body.app') <!-- Assuming you have a layout file -->

@section('content')

@if (!$isProfileComplete)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Profile Incomplete',
                    text: 'Please complete your profile first.',
                    icon: 'warning',
                    confirmButtonText: 'Got it'
                });
            });
        </script>
    @endif
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
<div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="profile-user"></div>
                            </div>
                        </div>

                        <div class="row">
                           <div class="profile-content">
                               <div class="row align-items-end">
                                    <div class="col-sm">
                                        <div class="d-flex align-items-end mt-3 mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xxl me-3">
                                                <img src="{{ $passportImage && $passportImage->passport_size_photographs ? asset('storage/' . $passportImage->passport_size_photographs) : asset('assets/images/users/avatar-3.jpg') }}" 
                                 alt="Profile Image" 
                                 class="img-fluid rounded-circle d-block img-thumbnail">
                                     <h5 class="font-size-16 mt-1">{{ $applicant->first_name }}</h5>

                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                               <!-- Inside your profile content -->
<div>

    <!-- Circular Profile Completion -->
    <div class="d-flex align-items-center mt-2">
        <div class="circular-progress">
            <span>{{ $profileCompletion }}%</span>
        </div>
        <div class="ms-3 text-muted small">Profile Completion</div>
    </div>
</div>

<!-- Scoped styles -->
<style>
.circular-progress {
    margin-top:20px;
    position: relative;
    width: 70px;
    height: 70px;
    background: conic-gradient(
       #1c84ee {{ $profileCompletion * 3.6 }}deg,
        #e5e5e5 {{ $profileCompletion * 3.6 }}deg
    );
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.circular-progress::before {
    content: '';
    position: absolute;
    width: 52px;
    height: 52px;
    background-color: #fff;
    border-radius: 50%;
}
.circular-progress span {
    position: relative;
    font-weight: 600;
    color: green;
    font-size: 0.9rem;
}
</style>

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
    <!-- Profile Image Upload Form -->
    <form action="{{ route('update.profile.image', $applicant->id) }}" method="POST" enctype="multipart/form-data" class="me-3">
        @csrf
        @method('PUT')

        <!-- Input field for image upload -->
        <div class="form-group">
            <input type="file" name="passport_size_photographs" class="form-control" accept="image/*">
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mt-2">Update Image</button>
         <a href="{{ route('applicant.editProfile', ['applicantId' => $applicant->id]) }}" class="btn btn-success mt-2">
        Edit Profile
    </a>
    </form>

    <!-- Edit Profile Button aligned to right -->
    
</div>


                    
                                            </div>
                                            
                                        </div>
                                    </div>
                                  
                               </div>
                           </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                               <div class="card bg-transparent shadow-none">
                                   <div class="card-body">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-2" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">welcome to Babvip Career</a>
                                            </li>
                                             
                                        </ul>
                                        
                                      
                                   </div>
                               </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Personal Information:</h5>
                                            </div>

                                            <div class="card-body">
                                                <div>
                                                <div class="row">
    <!-- Heading Section -->
   
    
    <!-- Form Content Section -->
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <!-- Full Name -->
                <div class="col-md-3">
                    <label for="full_name" class="sky-blue-text">First Name</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="full_name" 
                    value="{{ $personalInformation->full_name ?? $applicant->first_name }}" disabled>
                                    </div>
                                    
                                     <div class="col-md-3">
                    <label for="full_name" class="sky-blue-text">Middle Name</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="full_name" 
                    value="{{ $personalInformation->middle_name ?? $applicant->middle_name }}" disabled>
                                    </div>

 <div class="col-md-3">
                    <label for="full_name" class="sky-blue-text">Last Name</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="full_name" 
                    value="{{ $personalInformation->last_name ?? $applicant->last_name }}" disabled>
                                    </div>
                <!-- Date of Birth -->
                <div class="col-md-3">
                    <label for="dob" class="sky-blue-text">Date of Birth</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="dob" value="{{ $applicant->personalInformation->date_of_birth ?? '' }}" disabled>
                    </div>
            </div>

            <div class="row">
                <!-- Address -->
                <div class="col-md-3">
                    <label for="address" class="sky-blue-text">Country</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="address" value="{{ $personalInformation->country ?? $applicant->country }}" disabled>
                    </div>
                    
                     <div class="col-md-3">
                    <label for="address" class="sky-blue-text">State</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="address" value="{{ $personalInformation->state ?? $applicant->state }}" disabled>
                    </div>
                     <div class="col-md-3">
                    <label for="address" class="sky-blue-text">City</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="address" value="{{ $personalInformation->city ?? $applicant->city }}" disabled>
                    </div>

                <!-- Email -->
                <div class="col-md-3">
                    <label for="email" class="sky-blue-text">Email</label>
                    <input type="email"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="email" value="{{ $personalInformation->email ?? $applicant->email }}" disabled>
                    </div>
            </div>

            <div class="row">
                
                  <div class="col-md-3">
                    <label for="phone" class="sky-blue-text">Gender</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="gender" value="{{$personalInformation->gender ?? $applicant->gender }}" disabled>
                    </div>
                <div class="col-md-3">
                    <label for="phone" class="sky-blue-text">Phone Number</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="phone" value="{{$personalInformation->phone ?? $applicant->phone }}" disabled>
                    </div>

                <!-- House No -->
                <div class="col-md-3">
                    <label for="house_no" class="sky-blue-text">Current Address</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="house_no" value="{{$personalInformation->current_address ?? $applicant->current_address }}" disabled>
                    </div>
                    
                     <div class="col-md-3">
                    <label for="house_no" class="sky-blue-text">Permanent Address</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="house_no" value="{{$personalInformation->permanent_address ?? $applicant->permanent_address }}" disabled>
                    </div>
            </div>

            <div class="row">
                <!-- Area -->
                              <div class="col-md-3">
                    <label for="house_no" class="sky-blue-text">House No.,Building,Apartment</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="zip" value="{{ $applicant->personalInformation->house_no ?? '' }}" disabled>
                    </div>
                      <div class="col-md-3">
                    <label for="house_no" class="sky-blue-text">Land Mark</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="landmark" value="{{ $applicant->personalInformation->landmark ?? '' }}" disabled>
                    </div>
                      <div class="col-md-3">
                    <label for="house_no" class="sky-blue-text">Area</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="area" value="{{ $applicant->personalInformation->area ?? '' }}" disabled>
                    </div>

                <!-- ZIP Code -->
                <div class="col-md-3">
                    <label for="zip" class="sky-blue-text">ZIP Code</label>
                    <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="zip" value="{{ $applicant->personalInformation->zip ?? '' }}" disabled>
                    </div>
            </div>

           
        </div>
    </div>
</div>



                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    
                                                    <hr style="border: 0; height: 2px; background-color: #ff6347; border-style: dotted;">
                                                    <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Education Information:</h5>
                                            </div>

                                            <div class="card-body">
                                                <div>
                                                    <div class="row">
    <!-- Sidebar Column for Heading -->
   
    <!-- Content Column for Details -->
    <div class="col-md-12">
        <div class="text-muted">
            <div class="profile-section">

   
    @if($applicant->educationInformation)
        <!-- 10th Class Dropdown -->
        <div class="accordion" id="educationAccordion">
    <!-- 10th Class Information -->
    <div class="card">
        <div class="card-header" id="headingTen">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                    10th Class Information
                </button>
            </h5>
        </div>
        <div id="collapseTen" class="collapse show" aria-labelledby="headingTen" data-parent="#educationAccordion">
            <div class="card-body">
                <div class="row">
                
                    <div class="col-md-4">
                        <label for="tenth_passout_year" class="sky-blue-text">10th Passout Year</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="tenth_passout_year" value="{{ $applicant->educationInformation->tenth_passout_year ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="tenth_school" class="sky-blue-text">10th School</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="tenth_school" value="{{ $applicant->educationInformation->tenth_school ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="tenth_board_name" class="sky-blue-text">10th Board Name</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="tenth_board_name" value="{{ $applicant->educationInformation->tenth_board_name ?? 'Not Available' }}" disabled>
                    </div>
                
                
                    <div class="col-md-4">
                        <label for="tenth_percentage" class="sky-blue-text">10th Percentage</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="tenth_percentage" value="{{ $applicant->educationInformation->tenth_percentage ?? 'Not Available' }}" disabled>
                    </div>
               
            </div>
        </div>
    </div>

    <!-- 12th Class Information -->
    <div class="card">
        <div class="card-header" id="headingTwelve">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    12th Class Information
                </button>
            </h5>
        </div>
        <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#educationAccordion">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="twelfth_passout_year" class="sky-blue-text">12th Passout Year</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="twelfth_passout_year" value="{{ $applicant->educationInformation->twelfth_passout_year ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="twelfth_school" class="sky-blue-text">12th School</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="twelfth_school" value="{{ $applicant->educationInformation->twelfth_school ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="twelfth_board_name" class="sky-blue-text">12th Board Name</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="twelfth_board_name" value="{{ $applicant->educationInformation->twelfth_board_name ?? 'Not Available' }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="twelfth_percentage" class="sky-blue-text">12th Percentage</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="twelfth_percentage" value="{{ $applicant->educationInformation->twelfth_percentage ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="twelfth_stream" class="sky-blue-text">12th Stream</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="twelfth_stream" value="{{ $applicant->educationInformation->twelfth_stream ?? 'Not Available' }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Degree Information -->
    <div class="card">
        <div class="card-header" id="headingDegree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseDegree" aria-expanded="false" aria-controls="collapseDegree">
                    Degree Information
                </button>
            </h5>
        </div>
        <div id="collapseDegree" class="collapse" aria-labelledby="headingDegree" data-parent="#educationAccordion">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="degree_level" class="sky-blue-text">Degree Level</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="degree_level" value="{{ $applicant->educationInformation->degree_level ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="degree_specialization" class="sky-blue-text">Degree Specialization</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="degree_specialization" value="{{ $applicant->educationInformation->degree_specialization ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="degree_percentage" class="sky-blue-text">Degree Percentage</label>
                        <input type="text"                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="degree_percentage" value="{{ $applicant->educationInformation->degree_percentage ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="institution_name" class="sky-blue-text">Institution name</label>
                        <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="institution_name" value="{{ $applicant->educationInformation->institution_name ?? 'Not Available' }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Masters Information -->
    <div class="card">
        <div class="card-header" id="headingMasters">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseMasters" aria-expanded="false" aria-controls="collapseMasters">
                    Masters Information (Optional)
                </button>
            </h5>
        </div>
        <div id="collapseMasters" class="collapse" aria-labelledby="headingMasters" data-parent="#educationAccordion">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="masters_year" class="sky-blue-text">Masters Year</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="masters_year" value="{{ $applicant->educationInformation->masters_year ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="university_name" class="sky-blue-text">University Name</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="university_name" value="{{ $applicant->educationInformation->university_name ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="masters_specialization" class="sky-blue-text">Masters Specialization</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="masters_specialization" value="{{ $applicant->educationInformation->masters_specialization ?? 'Not Available' }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="masters_percentage" class="sky-blue-text">Masters Percentage</label>
                        <input type="text"                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="masters_percentage" value="{{ $applicant->educationInformation->masters_percentage ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="college" class="sky-blue-text">College</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="college" value="{{ $applicant->educationInformation->college ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="skills_relevant" class="sky-blue-text">Relevant Skills</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="skills_relevant" value="{{ $applicant->educationInformation->skills_relevant ?? 'Not Available' }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 


    @else
        <p>No education information available.</p>
    @endif
</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                

                                                


    <hr style="border: 0; height: 2px; background-color: #ff6347; border-style: dotted;">  
    <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Work Experience:</h5>
                                            </div>

                                            <div class="card-body">
                                                <div> 


<!-- Form Content Section -->
<div class="col-md-12" style="padding-bottom: 20px;">
    <div class="container">
        @if($applicant->workExperience->isEmpty())
            <p>No work experience available.</p>
        @else
            @foreach ($applicant->workExperience as $work)
                <div class="row">
                    <!-- Company Name -->
                    <div class="col-md-6">
                        <label for="company_name" class="sky-blue-text">Company Name</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="company_name" value="{{ $work->company_name ?? 'Not Available' }}" disabled>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-6">
                        <label for="start_date" class="sky-blue-text">Start Date</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="start_date" value="{{ $work->start_employment_dates ?? 'Not Available' }}" disabled>
                    </div>
                </div>

                <div class="row">
                    <!-- End Date -->
                    <div class="col-md-6">
                        <label for="end_date" class="sky-blue-text">End Date</label>
                        <input type="text"                 class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
 id="end_date" value="{{ $work->end_employment_dates ?? 'Not Available' }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="currently_working" class="sky-blue-text">Currently Working?</label>
                        <select id="currently_working"  class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" onchange="toggleEndDate(this)">
                            <option value="1" {{ $work->current_working ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$work->current_working ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Button to toggle the collapsible form -->
      

        <!-- Collapsible form to add more work experience -->
        <div id="add-work-experience-form" class="collapse mt-3">
    <form method="POST" action="{{ route('applicant.storeWorkExperience') }}">
        @csrf
        <div id="work-experience-container">
            <!-- Initial Work Experience input fields -->
            <div class="work-experience-item">
                <div class="form-group">
                    <label for="company_name_0">Company Name</label>
                    <input type="text" name="work_experience[0][company_name]" id="company_name_0" class="form-control" placeholder="Enter company name" required>
                </div>

                <div class="form-group">
                    <label for="start_date_0">Start Date</label>
                    <input type="date" name="work_experience[0][start_date]" id="start_date_0" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="end_employment_dates_0">End Date</label>
                    <input type="date" name="work_experience[0][end_employment_dates]" id="end_employment_dates_0" class="form-control">
                </div>

                <div class="form-group">
    <label for="currently_working_0">Currently Working?</label>
    <select name="work_experience[0][current_working]" id="currently_working_0" class="form-control" onchange="toggleEndDate(this)">
        <option value="0" selected>No</option>
        <option value="1">Yes</option>
    </select>
</div>
            </div>
        </div>

        <!-- Button to add more work experience input fields -->
        <button type="button" id="add-more-form-btn" class="btn btn-secondary mt-3">Add More</button>

        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>

    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<hr style="border: 0; height: 2px; background-color: #ff6347; border-style: dotted;">
<div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Documents:</h5>
                                            </div>

                                            <div class="card-body">
                                                <div>


<!-- Form Content Section -->
<div class="col-md-12" style="padding-bottom: 20px;">
    <div class="container">
        @if($applicant->documents->isEmpty())
            <p>No documents available.</p>
        @else
            <!-- Accordion Wrapper -->
            <div class="accordion" id="documentsAccordion">
                @foreach ($applicant->documents as $document)
                    <!-- Accordion Item for Document -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $loop->index }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                <a href="{{ asset('storage/' . $document->file_path) }}" class="btn btn-info btn-sm" target="_blank">Click Here to see all Documents</a>
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#documentsAccordion">
                            <div class="accordion-body">
                                <!-- Document Details -->

                                <!-- Grid for Additional Document Fields (4 columns) -->
                                <div class="row g-3" style=" font-size: 0.85rem;font-weight: 400;color: #555; ">
                                    @foreach([
                                        ['name' => 'Resume', 'field' => 'Resume'],
                                        ['name' => 'Aadhar Card Front', 'field' => 'aadhar_card_front'],
                                        ['name' => 'Aadhar Card Back', 'field' => 'aadhar_card_back'],
                                        ['name' => 'Pan Card', 'field' => 'pan_card'],
                                        ['name' => 'Passport Size Photograph', 'field' => 'passport_size_photographs']
                                    ] as $doc)
                                        <div class="col-md-3 mb-4"> <!-- Create 4 equal columns with spacing -->
                                            <div class="document-item">
                                                <strong>{{ $doc['name'] }}:</strong>
                                                @if ($document->{$doc['field']})
                                                    <a href="{{ asset('storage/' . $document->{$doc['field']}) }}" class="btn btn-info btn-sm" target="_blank">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span>Not Available</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

</div>
</div>
</div>
</div>
</div>


<!---div class="d-flex justify-content-center mt-4">
    <a href="{{ route('applicant.editProfile', ['applicantId' => $applicant->id]) }}" 
       class="btn btn-success" 
       style="margin-bottom: 20px; padding-left: 20px;">
       Edit Profile
    </a>
</div>---->



                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end tab pane -->

                                    
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end col -->

                           
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

   
<style>
    /* Make the labels sky blue */
.sky-blue-text {
    color: #1c84ee; /* Sky blue color */
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
}

/* Transparent input fields with sky blue borders */
.transparent-input {
    background-color: transparent;
    border: 1px solid #87CEEB; /* Sky blue border */
    color: #333;
    font-size: 14px;
    padding: 8px;
    width: 100%;
}

/* Focus effect for inputs with sky blue border */
.transparent-input:focus {
    outline: none;
    border: 1px solid #4682B4; /* Darker blue when focused */
}

/* Disabled state (lighter background and gray text) */
.transparent-input:disabled {
    background-color: #f5f5f5;
    color: #777;
}

</style>

<script>
    // Function to toggle the end date input field based on the "Currently Working" status
    function toggleEndDate(selectElement) {
        const endDateInput = selectElement.closest('.work-experience-item').querySelector('input[id^="end_employment_dates"]');
        
        // Disable end_employment_dates if currently working (1), otherwise enable it
        if (selectElement.value === "1") {  // if 'Yes' (1)
            endDateInput.disabled = true;
        } else {  // if 'No' (0)
            endDateInput.disabled = false;
        }
    }

    // Add new work experience fields dynamically when "Add More" button is clicked
    document.getElementById('add-more-form-btn').addEventListener('click', function() {
        const container = document.getElementById('work-experience-container');
        const index = container.children.length;

        const newWorkExperienceItem = document.createElement('div');
        newWorkExperienceItem.classList.add('work-experience-item');

        // Add new fields for company name, start date, end date, and currently working
        newWorkExperienceItem.innerHTML = `
            <div class="form-group">
                <label for="company_name_${index}">Company Name</label>
                <input type="text" name="work_experience[${index}][company_name]" id="company_name_${index}" class="form-control" placeholder="Enter company name" required>
            </div>

            <div class="form-group">
                <label for="start_date_${index}">Start Date</label>
                <input type="date" name="work_experience[${index}][start_date]" id="start_date_${index}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_employment_dates_${index}">End Date</label>
                <input type="date" name="work_experience[${index}][end_employment_dates]" id="end_employment_dates_${index}" class="form-control">
            </div>

            <div class="form-group">
                <label for="currently_working_${index}">Currently Working?</label>
                <select name="work_experience[${index}][current_working]" id="currently_working_${index}" class="form-control" onchange="toggleEndDate(this)">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        `;

        // Append new work experience item to the container
        container.appendChild(newWorkExperienceItem);
    });
</script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- For Bootstrap 4.x (slim version) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> <!-- For Bootstrap 4.x & 5.x -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- For Bootstrap 4.x -->

@endsection

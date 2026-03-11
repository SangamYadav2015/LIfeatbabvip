@extends('applicant.body.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Wizard with Progressbar</h4>
            </div>
            <div class="card-body">
                <div id="progrss-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a href="#progress-seller-details" class="nav-link @if($step == 1) active @endif" data-toggle="tab" data-step="1">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Personal Information">
                                    <i class="bx bx-list-ul"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#progress-company-document" class="nav-link @if($step == 2) active @endif" data-toggle="tab" data-step="2">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Education Information">
                                    <i class="bx bx-book-bookmark"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#progress-bank-detail" class="nav-link @if($step == 3) active @endif" data-toggle="tab" data-step="3">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Work Experience">
                                    <i class="bx bxs-bank"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#progress-documents" class="nav-link @if($step == 4) active @endif" data-toggle="tab" data-step="4">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Documents">
                                    <i class="bx bxs-file"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#progress-benefits" class="nav-link @if($step == 5) active @endif" data-toggle="tab" data-step="5">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Benefits">
                                    <i class="bx bxs-file"></i>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div id="bar" class="progress mt-4">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: {{ ($step - 1) * 33 }}%;"></div>
                    </div>

                    <div class="tab-content twitter-bs-wizard-tab-content">
                        <div class="tab-pane @if($step == 1) active @endif" id="progress-seller-details">
                            <div class="text-center mb-4">
                                <h5>Personal Information</h5>
                                <p class="card-title-desc">Fill all information below</p>
                            </div>
                            <form method="POST" action="{{ route('verification.store') }}" class="step-form">
    @csrf
    <input type="hidden" name="step" value="1">
    <input type="hidden" name="job_id" value="{{ $jobId }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" class="form-control" id="full_name" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="date_of_birth">DOB</label>
                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" class="form-control" id="phone" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="house_no">Flat/House No./Building/Apartment</label>
                <input type="number" name="house_no" class="form-control" id="house_no" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="area">Area/Street/Colony/Sector/Village</label>
                <input type="text" name="area" class="form-control" id="area" required>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" id="city" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="state">State</label>
                <input type="text" name="state" class="form-control" id="state" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="zip">Zip Code</label>
                <input type="number" name="zip" class="form-control" id="zip" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" id="country" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
            </div>
        </div>
    </div>
    <ul class="pager wizard twitter-bs-wizard-pager-link">
        <li class="next">
            <button type="submit" class="btn btn-primary">Next <i class="bx bx-chevron-right ms-1"></i></button>
        </li>
    </ul>
</form>

                        </div>

                        <div class="tab-pane @if($step == 2) active @endif" id="progress-company-document">
    <div class="text-center mb-4">
        
        <h5>Education Information</h5>
        <p class="card-title-desc">Fill all information below</p>
    </div>
    <form method="POST" action="{{ route('verification.store') }}" class="step-form">
        @csrf
        <input type="hidden" name="step" value="2">
        <input type="hidden" name="job_id" value="{{ $jobId }}">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="highest_education">Highest Education</label>
                    <input type="text" name="highest_education" class="form-control" id="highest_education" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="institution_name">Institution Name</label>
                    <input type="text" name="institution_name" class="form-control" id="institution_name" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="degree_earned">Degree Earned</label>
                    <input type="text" name="degree_earned" class="form-control" id="degree_earned" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="graduation_year">Graduation Year</label>
                    <input type="text" name="graduation_year" class="form-control" id="graduation_year" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="tenth_passout_year">10th Passout Year</label>
                    <input type="text" name="tenth_passout_year" class="form-control" id="tenth_passout_year" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="tenth_school">10th School Name</label>
                    <input type="text" name="tenth_school" class="form-control" id="tenth_school" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="tenth_board_name">10th Board Name</label>
                    <input type="text" name="tenth_board_name" class="form-control" id="tenth_board_name" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="tenth_percentage">10th Percentage</label>
                    <input type="number" name="tenth_percentage" class="form-control" id="tenth_percentage" required min="0" max="100" step="0.01">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="twelfth_passout_year">12th Passout Year</label>
                    <input type="text" name="twelfth_passout_year" class="form-control" id="twelfth_passout_year" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="twelfth_school">12th School Name</label>
                    <input type="text" name="twelfth_school" class="form-control" id="twelfth_school" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="twelfth_board_name">12th Board Name</label>
                    <input type="text" name="twelfth_board_name" class="form-control" id="twelfth_board_name" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="twelfth_percentage">12th Percentage</label>
                    <input type="number" name="twelfth_percentage" class="form-control" id="twelfth_percentage" required min="0" max="100" step="0.01">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="twelfth_stream">12th Stream</label>
                    <input type="text" name="twelfth_stream" class="form-control" id="twelfth_stream" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="degree_level">Degree Level</label>
                    <input type="text" name="degree_level" class="form-control" id="degree_level" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="degree_specialization">Degree Specialization</label>
                    <input type="text" name="degree_specialization" class="form-control" id="degree_specialization" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="degree_percentage">Degree Percentage</label>
                    <input type="number" name="degree_percentage" class="form-control" id="degree_percentage" required min="0" max="100" step="0.01">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="masters_year">Master's Year</label>
                    <input type="text" name="masters_year" class="form-control" id="masters_year">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="university_name">University Name</label>
                    <input type="text" name="university_name" class="form-control" id="university_name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="masters_specialization">Master's Specialization</label>
                    <input type="text" name="masters_specialization" class="form-control" id="masters_specialization">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="masters_percentage">Master's Percentage</label>
                    <input type="number" name="masters_percentage" class="form-control" id="masters_percentage" min="0" max="100" step="0.01">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="college">College</label>
                    <input type="text" name="college" class="form-control" id="college">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="skills_relevant">Relevant Skills</label>
                    <input type="text" name="skills_relevant" class="form-control" id="skills_relevant">
                </div>
            </div>
        </div>
        <ul class="pager wizard twitter-bs-wizard-pager-link">
            <li class="previous"><button type="button" class="btn btn-primary previous-step"> <i class="bx bx-chevron-left me-1"></i> Previous</button></li>
            <li class="next"><button type="submit" class="btn btn-primary">Next <i class="bx bx-chevron-right ms-1"></i></button></li>
        </ul>
    </form>
</div>


                        <div class="tab-pane @if($step == 3) active @endif" id="progress-bank-detail">
                            <div class="text-center mb-4">
                                <h5>Work Experience</h5>
                                <p class="card-title-desc">Fill all information below</p>
                            </div>
                            <form method="POST" action="{{ route('verification.store') }}" class="step-form">
                                @csrf
                                <input type="hidden" name="step" value="3">
                                <input type="hidden" name="job_id" value="{{ $jobId }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" name="company_name" class="form-control" id="company_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="start_employment_date">Start Employment Date</label>
                                            <input type="date" name="start_employment_dates" class="form-control" id="start_employment_dates" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="end_employment_date">End Employment Date</label>
                                            <input type="date" name="end_employment_dates" class="form-control" id="end_employment_dates">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="current_working_status">Current Working Status</label>
                                            <input type="checkbox" name="current_working" id="current_working" class="form-check-input" value="1">
                                            <input type="hidden" name="current_working" value="0"> <!-- Hidden input to send 0 if not checked -->                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="position_responsibilities">Position/Responsibilities</label>
                                            <textarea name="position" id="position" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><button type="button" class="btn btn-primary previous-step"> <i class="bx bx-chevron-left me-1"></i> Previous</button></li>
                                    <li class="next"><button type="submit" class="btn btn-primary">Next <i class="bx bx-chevron-right ms-1"></i></button></li>
                                </ul>
                            </form>
                        </div>

                        <div class="tab-pane @if($step == 4) active @endif" id="progress-documents">
                            <div class="text-center mb-4">
                                <h5>Documents</h5>
                                <p class="card-title-desc">Upload necessary documents</p>
                            </div>
                            <form method="POST" action="{{ route('verification.store') }}" class="step-form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="step" value="4">
    <input type="hidden" name="job_id" value="{{ $jobId }}">

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="tenth_class_marksheet">10th Class Marksheet</label>
                <input type="file" name="tenth_class_marksheet" class="form-control" id="tenth_class_marksheet">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="twelfth_class_marksheet">12th Class Marksheet</label>
                <input type="file" name="twelfth_class_marksheet" class="form-control" id="twelfth_class_marksheet">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="graduation_marksheet">Graduation Marksheet</label>
                <input type="file" name="graduation_marksheet" class="form-control" id="graduation_marksheet">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="post_graduation_marksheet">Post Graduation Marksheet</label>
                <input type="file" name="post_graduation_marksheet" class="form-control" id="post_graduation_marksheet">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="blood_group_certificate">Blood Group Certificate</label>
                <input type="file" name="blood_group_certificate" class="form-control" id="blood_group_certificate">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="passport_size_photographs">Passport Size Photographs</label>
                <input type="file" name="passport_size_photographs" class="form-control" id="passport_size_photographs">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="aadhar_card">Aadhar Card</label>
                <input type="file" name="aadhar_card" class="form-control" id="aadhar_card">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="voter_id_card">Voter ID Card</label>
                <input type="file" name="voter_id_card" class="form-control" id="voter_id_card">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="pan_card">PAN Card</label>
                <input type="file" name="pan_card" class="form-control" id="pan_card">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="covid_vaccine_certificate">COVID Vaccine Certificate</label>
                <input type="file" name="covid_vaccine_certificate" class="form-control" id="covid_vaccine_certificate">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="bank_account_details">Bank Account Details</label>
                <input type="file" name="bank_account_details" class="form-control" id="bank_account_details">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="last_three_salary_slip">Last Three Salary Slip</label>
                <input type="file" name="last_three_salary_slip[]" class="form-control" id="last_three_salary_slip" multiple>
                <small class="form-text text-muted">Upload salary slips for the last three months.</small>            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="experience_letters">Experience Letters</label>
                <input type="file" name="experience_letters[]" class="form-control" id="experience_letters" multiple>
                <small class="form-text text-muted">Upload experience letters for your last three companies if Experienced.</small>            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="relieving_letter">Relieving Letter</label>
                <input type="file" name="relieving_letter" class="form-control" id="relieving_letter">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="resignation_letter">Resignation Letter</label>
                <input type="file" name="resignation_letter" class="form-control" id="resignation_letter">
            </div>
        </div>
    </div>

    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><button type="button" class="btn btn-primary previous-step"> <i class="bx bx-chevron-left me-1"></i> Previous</button></li>
                                    <li class="next"><button type="submit" class="btn btn-primary">Next <i class="bx bx-chevron-right ms-1"></i></button></li>
                                </ul>
</form>

                        </div>

                        <!-- Step 5: Benefits and Compensation -->
<div class="tab-pane @if($step == 5) active @endif" id="progress-benefits">
    <div class="text-center mb-4">
        <h5>Benefits and Compensation</h5>
        <p class="card-title-desc">Provide your compensation and benefits details</p>
    </div>
    <form method="POST" action="{{ route('verification.store') }}" class="step-form">
        @csrf
        <input type="hidden" name="step" value="5">
        <input type="hidden" name="job_id" value="{{ $jobId }}">

        <!-- Compensation Details -->
        <div class="row">
            <!-- Annual Gross Compensation -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="annualgrosscompensation">Annual Gross Compensation</label>
                    <input type="text" name="annualgrosscompensation" class="form-control" id="annualgrosscompensation" placeholder="Annual Gross Compensation">
                </div>
            </div>
            <!-- Fixed Salary -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="fixedSalary">Fixed Salary</label>
                    <input type="text" name="fixedSalary" class="form-control" id="fixedSalary" placeholder="Fixed Salary">
                </div>
            </div>
            <!-- Variable Pay -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="variablePay">Variable Pay</label>
                    <input type="text" name="variablePay" class="form-control" id="variablePay" placeholder="Variable Pay">
                </div>
            </div>
            <!-- Other Benefits -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="otherbenefits">Other Benefits</label>
                    <input type="text" name="otherbenefits" class="form-control" id="otherbenefits" placeholder="Other Benefits">
                </div>
            </div>
            <!-- Next Revision Date -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="nextrevisiondate">Next Revision Date</label>
                    <input type="date" name="nextrevisiondate" class="form-control" id="nextrevisiondate">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const steps = document.querySelectorAll('.nav-link');
        const forms = document.querySelectorAll('.step-form');
        const progressBar = document.getElementById('bar').firstElementChild;

        steps.forEach((step, index) => {
            step.addEventListener('click', function() {
                updateProgress(index + 1);
            });
        });

        document.querySelectorAll('.previous-step').forEach((btn, index) => {
            btn.addEventListener('click', function() {
                const currentStep = index + 1; // current step index
                updateProgress(currentStep - 1);
                forms[currentStep - 1].classList.remove('active');
                steps[currentStep - 1].classList.remove('active');
                steps[currentStep - 2].classList.add('active');
                forms[currentStep - 2].classList.add('active');
            });
        });

        function updateProgress(step) {
            const totalSteps = steps.length;
            const progressPercent = (step / totalSteps) * 100;
            progressBar.style.width = progressPercent + '%';

            // Switch active tab based on step
            steps.forEach((s, index) => {
                s.classList.toggle('active', index + 1 === step);
            });
            forms.forEach((form, index) => {
                form.classList.toggle('active', index + 1 === step);
            });
        }
    });
</script>
@endsection

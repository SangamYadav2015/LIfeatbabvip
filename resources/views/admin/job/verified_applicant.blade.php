@extends('admin.layout.app')

@section('content')





                        <!--<div class="row">-->
                        <!--    <div class="col-lg-12">-->
                        <!--       <div class="card bg-transparent shadow-none">-->
                        <!--           <div class="card-body">-->
                        <!--                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-2" id="pills-tab" role="tablist">-->
                                            <!--<li class="nav-item">-->
                                            <!--    <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">welcome to Babvip Career</a>-->
                                            <!--</li>-->
                                            
                        <!--                </ul>-->
                        <!--           </div>-->
                        <!--       </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="tab-content">
            <div class="tab-pane active" id="overview" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Personal Information:</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $applicant->first_name }}</td>

                                    </tr> 
                                    <tr>
                                        <th>Middle Name</th>
                                        <td>{{ $applicant->middle_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $applicant->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{ $applicant->gender ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ $applicant->date_of_birth ?? 'Not Available' }}</td>
                                    </tr>
                     
                                    <tr>
                                        <th>Phone Number</th>
                                        <td>{{ $applicant->phone ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $applicant->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>House No</th>
                                        <td>{{ $applicant->house_no ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Landmark</th>
                                        <td>{{ $applicant->landmark ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td>{{ $applicant->area ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Current Address</th>
                                        <td>{{ $applicant->current_address ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Permenant Address</th>
                                        <td>{{ $applicant->permanent_address ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $applicant->city ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{ $applicant->state ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>ZIP Code</th>
                                        <td>{{ $applicant->zip ?? 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $applicant->country ?? 'Not Available' }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Education Information:</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            @if($applicant->educationInformation)
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Level</th>
                                                <th>Passout Year</th>
                                                <th>School / University</th>
                                                <th>Board / Specialization</th>
                                                <th>Percentage</th>
                                                <th>Stream</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- 10th Class Information -->
                                            <tr>
                                                <td>10th Class</td>
                                                <td>{{ $applicant->educationInformation->tenth_passout_year ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->tenth_school ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->tenth_board_name ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->tenth_percentage ?? 'Not Available' }}</td>
                                                <td>-</td>
                                            </tr>

                                            <!-- 12th Class Information -->
                                            <tr>
                                                <td>12th Class</td>
                                                <td>{{ $applicant->educationInformation->twelfth_passout_year ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->twelfth_school ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->twelfth_board_name ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->twelfth_percentage ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->twelfth_stream ?? 'Not Available' }}</td>
                                            </tr>
                                                 <!-- Diploma Information -->
                                            <tr>
                                                <td>Diploma</td>
                                                <!--<td>-</td>-->
                                                <!--<td>-</td>-->
                                                <td>{{ $applicant->educationInformation->diploma_name ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->diploma_specialization ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->diploma_percentage ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->diploma_institution ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->diploma_passout_year ?? 'Not Available' }}</td>
                                            </tr>
                                            <!-- Degree Information -->
                                            <tr>
                                                <td>Degree</td>
                                                <!--<td>-</td>-->
                                                <!--<td>-</td>-->
                                                <td>{{ $applicant->educationInformation->degree_level ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->degree_specialization ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->degree_percentage ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->degree_institution ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->degree_passout_year ?? 'Not Available' }}</td>
                                            </tr>

                                            <!-- Masters Information -->
                                            <tr>
                                                <td>Masters (Optional)</td>
                                                <td>{{ $applicant->educationInformation->masters_year ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->university_name ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->masters_specialization ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->masters_percentage ?? 'Not Available' }}</td>
                                                <td>{{ $applicant->educationInformation->skills_relevant ?? 'Not Available' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
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

<hr style="border: 0; height: 2px; background-color: #ff6347; border-style: dotted;">

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="tab-content">
            <div class="tab-pane active" id="overview" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Benefits:</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($applicant->benefits->isEmpty())
                                <p>No benefits available.</p>
                            @else
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Benefit Type</th>
                                            <th>Benefit Details</th>
                                            <th>Variable Pay</th>
                                            <th>Other Benefits</th>
                                            <th>Next Revision Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applicant->benefits as $benefit)
                                            <tr>
                                                <td>{{ $benefit->annualgrosscompensation ?? 'Not Available' }}</td>
                                                <td>{{ $benefit->fixedSalary ?? 'Not Available' }}</td>
                                                <td>{{ $benefit->variablePay ?? 'Not Available' }}</td>
                                                <td>{{ $benefit->otherbenefits ?? 'Not Available' }}</td>
                                                <td>{{ $benefit->nextrevisiondate ? \Carbon\Carbon::parse($benefit->nextrevisiondate)->format('d-m-Y') : 'Not Available' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Work Experience:</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($applicant->workExperience->isEmpty())
                                <p>No work experience available.</p>
                            @else
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Designation</th>
                                            <th>Employeement Type</th>
                                            <th>Company Name</th>
                                            <th>Currently Working</th>
                                            <th>Start Month</th>
                                            <th>Start Year</th>
                                            <th>End Month</th>
                                            <th>End Year</th>
                                            <th>Location</th>
                                            <th>Saraly CTC</th>
                                            <th>Skills</th>
                                            <th>Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applicant->workExperience as $work)
                                            <tr>
                                                <td>{{ $work->designation ?? 'Not Available' }}</td>
                                                <td>{{ $work->employment_type ?? 'Not Available' }}</td>
                                                <td>{{ $work->company_name ?? 'Not Available' }}</td>
                                                <td>{{ $work->current_working ?? 'Not Available' }}</td>
                                                <td>{{ $work->start_month ?? 'Not Available' }}</td>
                                                <td>{{ $work->start_year ?? 'Not Available' }}</td>
                                                <td>{{ $work->end_month ?? 'Not Available' }}</td>
                                                <td>{{ $work->end_year ?? 'Not Available' }}</td>
                                                <td>{{ $work->location ?? 'Not Available' }}</td>
                                                <td>{{ $work->salary_ctc ?? 'Not Available' }}</td>
                                                <td>{{ $work->skills ?? 'Not Available' }}</td>
                                                <td>{{ $work->position ?? 'Not Available' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Faq Question & Answer:</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                             @if($applicant->faqResponses->isEmpty())
    <p>No FAQ responses available.</p>
@else
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
    <tr>
        <th>Applicant Name</th>
        <th colspan="2">FAQ Questions & Answers</th>
    </tr>
</thead>

        <tbody>
           @foreach ($applicant->faqResponses as $response)
    <tr>
        <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
        <td colspan="2">
            @php
                // Decode the JSON string into a PHP array (in case casting didn't work)
                $answers = is_array($response->responses) ? $response->responses : json_decode($response->responses, true);
            @endphp

            @if(is_array($answers))
                @foreach ($answers as $index => $data)
                    <div style="margin-bottom: 10px;">
                        <strong>Q{{ $index }}:</strong> {{ $data['question'] ?? '-' }}<br>
                        <strong>Answer:</strong> {{ $data['answer'] ?? '-' }}
                    </div>
                @endforeach
            @else
                <span>No valid responses found.</span>
            @endif
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
@endif

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
        <div class="row g-3" style=" font-size: 0.85rem;font-weight: 400;color: #555; " >
    @foreach([
        ['name' => 'Resume', 'field' => 'Resume'],
        ['name' => 'Twelth Class Marksheet', 'field' => 'twelfth_class_marksheet'],
        ['name' => 'Graduation Marks', 'field' => 'graduation_marksheet'],
        ['name' => 'Post Graduation Marks', 'field' => 'post_graduation_marksheet'],
        ['name' => 'Blood Group Certificate', 'field' => 'blood_group_certificate'],
        ['name' => 'Passport Size Photograph', 'field' => 'passport_size_photographs'],
        ['name' => 'Aadhar Card', 'field' => 'aadhar_card'],
        ['name' => 'Voter ID Card', 'field' => 'voter_id_card'],
        ['name' => 'Pan Card', 'field' => 'pan_card'],
        ['name' => 'Covid Vaccine Certificate', 'field' => 'covid_vaccine_certificate'],
        ['name' => 'Bank Account Details', 'field' => 'bank_account_details'],
        ['name' => 'Experience Letters', 'field' => 'experience_letters'],
        ['name' => 'Resignation Letter', 'field' => 'resignation_letter'],
        ['name' => 'Relieving Letter', 'field' => 'relieving_letter']
    ] as $doc)
        <div class="col-md-3 mb-4"> <!-- Create 4 equal columns with spacing -->
            <div class="document-item">
                <strong>{{ $doc['name'] }}:</strong>
                @if ($document->{$doc['field']})
                    @if ($doc['field'] === 'last_three_salary_slip')
                        <!-- Check if the field is 'last_three_salary_slip' which contains multiple files -->
                        @foreach($document->{$doc['field']} as $salarySlip)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $salarySlip) }}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fas fa-download"></i> Download Salary Slip
                                </a>
                            </div>
                        @endforeach
                    @else
                        <a href="{{ asset('storage/' . $document->{$doc['field']}) }}" class="btn btn-info btn-sm" target="_blank">
                            <i class="fas fa-download"></i>
                        </a>
                    @endif
                @else
                    <span>Not Available</span>
                @endif
            </div>
        </div>
    @endforeach
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
</div>
</div>






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

    /* Custom styling for table */
.table {
    font-size: 14px;
    text-align: center;
    border-radius: 5px;
}

.table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.table td {
    vertical-align: middle;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.card-header {
    font-size: 1.25rem;
    padding: 1rem;
    font-weight: 600;
}


</style>

<script>
    // Add new work experience fields dynamically when "Add More" button is clicked
    document.getElementById('add-more-form-btn').addEventListener('click', function() {
        const container = document.getElementById('work-experience-container');
        const index = container.children.length;
        
        const newWorkExperienceItem = document.createElement('div');
        newWorkExperienceItem.classList.add('work-experience-item');
        
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
                <label for="end_date_${index}">End Date</label>
                <input type="date" name="work_experience[${index}][end_date]" id="end_date_${index}" class="form-control">
            </div>
        `;
        
        container.appendChild(newWorkExperienceItem);
    });
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- For Bootstrap 4.x (slim version) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> <!-- For Bootstrap 4.x & 5.x -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- For Bootstrap 4.x -->

@endsection



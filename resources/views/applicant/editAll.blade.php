@extends('applicant.body.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Step Indicator with Proper Center-to-Center Connecting Line -->
<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .form-control {
        border: 1px solid #0d6efd;
        transition: all 0.3s ease;
    }
    .card {
        border: none;
        box-shadow: 0 0 25px rgba(13, 110, 253, 0.1);
    }
    .form-label {
        font-weight: 500;
        color: #0d6efd;
    }
    .btn-success {
        background-color: #198754;
        border: none;
    }
    
    
</style>
<div class="mb-4 position-relative px-3" style="height: 80px;">
    @php
        $steps = [
            1 => 'Personal Info',
            2 => 'Education',
            3 => 'Experience',
            4 => 'Documents',
            5 => 'Declarations' // ✅ Step 5 added
        ];
        $totalSteps = count($steps);
    @endphp

    <!-- Full connecting line -->
    <div style="
        position: absolute;
        top: 20px;
        left: 10%;
        right: 10%;
        height: 4px;
        background-color: #dee2e6;
        z-index: 0;"></div>

    <!-- Progress line -->
    <div style="
        position: absolute;
        top: 20px;
        left: 10%;
        width: {{ ($step - 1) / ($totalSteps - 1) * 80 }}%;
        height: 4px;
        background-color: #28a745;
        z-index: 1;
        transition: width 0.3s;"></div>

    <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
        @foreach ($steps as $num => $label)
            <div class="text-center" style="width: {{ 100 / $totalSteps }}%;">
                <!-- Step Circle -->
                <div class="rounded-circle mx-auto mb-2"
                    style="width: 40px; height: 40px;
                           line-height: 40px;
                           background-color:
                               {{ $step > $num ? '#28a745' : ($step == $num ? '#0d6efd' : '#dee2e6') }};
                           color: white;
                           font-weight: bold;
                           z-index: 2;
                           position: relative;">
                    {{ $num }}
                </div>
                <!-- Label -->
                <div style="font-size: 14px;
                            color: {{ $step == $num ? '#000' : '#6c757d' }};">
                    {{ $label }}
                </div>
            </div>
        @endforeach
    </div>
</div>


<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($step == 1)
<div class="container my-5">
    <div class="card rounded-4">
        <div class="card-header bg-primary text-white py-3 px-4 rounded-top-4">
            <h4 class="mb-0">Personal Information</h4>
        </div>
        <div class="card-body px-4 py-5">

            <form action="{{ route('applicant.personal.update', $applicant->id) }}" method="POST">
                @csrf

                {{-- Name Fields --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $personal->first_name ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name', $personal->middle_name ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $personal->last_name ?? '') }}" class="form-control" required>
                    </div>
                </div>

                {{-- DOB & Gender --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $personal->date_of_birth ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $personal->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $personal->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $personal->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                {{-- Contact --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $personal->phone ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $personal->email ?? '') }}" class="form-control" required>
                    </div>
                </div>

                {{-- Address Line 1 --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">House No</label>
                        <input type="text" name="house_no" value="{{ old('house_no', $personal->house_no ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Landmark</label>
                        <input type="text" name="landmark" value="{{ old('landmark', $personal->landmark ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Area</label>
                        <input type="text" name="area" value="{{ old('area', $personal->area ?? '') }}" class="form-control">
                    </div>
                </div>

                {{-- Address Line 2 --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Current Address</label>
                        <input type="text" name="current_address" value="{{ old('current_address', $personal->current_address ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Permanent Address</label>
                        <input type="text" name="permanent_address" value="{{ old('permanent_address', $personal->permanent_address ?? '') }}" class="form-control" required>
                    </div>
                </div>

                {{-- Location --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" value="{{ old('city', $personal->city ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">State</label>
                        <input type="text" name="state" value="{{ old('state', $personal->state ?? '') }}" class="form-control" required>
                    </div>
                </div>

                {{-- Country/Zip --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Zip</label>
                        <input type="text" name="zip" value="{{ old('zip', $personal->zip ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" value="{{ old('country', $personal->country ?? '') }}" class="form-control" required>
                    </div>
                </div>

                {{-- Button --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Save and Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

            @elseif($step == 2)
         @php
    $selectedLevel = old('education_level', $education->education_level ?? '');
@endphp

<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white py-3 px-4 rounded-top-4">
            <h4 class="mb-0">Educational Information</h4>
        </div>

        <div class="card-body px-4 py-5">
            <form action="{{ route('applicant.education.update', $applicant->id) }}" method="POST">
                @csrf

                

                <div class="row g-4">
                    {{-- 10th Section (Always shown) --}}
                    <div class="col-12"><h5>10th Or Equivalent  Information</h5></div>
                    <div class="col-md-6">
                        <label class="form-label">10th Passout Year</label>
                        <input type="text" name="tenth_passout_year" value="{{ old('tenth_passout_year', $education->tenth_passout_year ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">10th School</label>
                        <input type="text" name="tenth_school" value="{{ old('tenth_school', $education->tenth_school ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">10th Board</label>
                        <input type="text" name="tenth_board_name" value="{{ old('tenth_board_name', $education->tenth_board_name ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">10th Percentage</label>
                        <input type="text" name="tenth_percentage" value="{{ old('tenth_percentage', $education->tenth_percentage ?? '') }}" class="form-control" required>
                    </div>
<hr>
                    {{-- 12th Section (Always shown) --}}
                    <div class="col-12 mt-4"><h5>12th Or Equivalent Information</h5></div>
                    <div class="col-md-6">
                        <label class="form-label">12th Passout Year</label>
                        <input type="text" name="twelfth_passout_year" value="{{ old('twelfth_passout_year', $education->twelfth_passout_year ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">12th School</label>
                        <input type="text" name="twelfth_school" value="{{ old('twelfth_school', $education->twelfth_school ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">12th Board</label>
                        <input type="text" name="twelfth_board_name" value="{{ old('twelfth_board_name', $education->twelfth_board_name ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">12th Percentage</label>
                        <input type="text" name="twelfth_percentage" value="{{ old('twelfth_percentage', $education->twelfth_percentage ?? '') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">12th Stream</label>
                        <input type="text" name="twelfth_stream" value="{{ old('twelfth_stream', $education->twelfth_stream ?? '') }}" class="form-control">
                    </div>
                    <hr>
{{-- Level Selector --}}
                <div class="mb-4">
                    <label class="form-label">Highest Qualification</label>
                    <select name="highest_education" class="form-select" id="educationLevelSelect" required>
                        <option value="">-- Select Qualification --</option>
                        <option value="diploma" {{ $selectedLevel == 'diploma' ? 'selected' : '' }}>Diploma</option>
                        <option value="bachelor" {{ $selectedLevel == 'bachelor' ? 'selected' : '' }}>Bachelor's</option>
                        <option value="master" {{ $selectedLevel == 'master' ? 'selected' : '' }}>Master's</option>
                    </select>
                </div>
                    {{-- Diploma Section --}}
                  <div class="diploma-section d-none row">
    <div class="col-12 mt-4">
        <h5>Diploma</h5>
    </div>

    <div class="col-md-6">
        <label class="form-label">Diploma Name</label>
        <input type="text" name="diploma_name" value="{{ old('diploma_name', $education->diploma_name ?? '') }}" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label">Diploma Specialization</label>
        <input type="text" name="diploma_specialization" value="{{ old('diploma_specialization', $education->diploma_specialization ?? '') }}" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label">Diploma Percentage</label>
        <input type="number" step="0.01" max="100" name="diploma_percentage" value="{{ old('diploma_percentage', $education->diploma_percentage ?? '') }}" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label">Diploma Institution</label>
        <input type="text" name="diploma_institution" value="{{ old('diploma_institution', $education->diploma_institution ?? '') }}" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label">Diploma Passout Year</label>
        <input type="number" name="diploma_passout_year" value="{{ old('diploma_passout_year', $education->diploma_passout_year ?? '') }}" class="form-control" maxlength="4" min="1900" max="{{ date('Y') }}">
    </div>

    <div class="col-md-6 mt-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="has_diploma" value="1" id="has_diploma"
                {{ old('has_diploma', $education->has_diploma ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="has_diploma">
                I have completed a diploma
            </label>
        </div>
    </div>
</div>


                    {{-- Bachelor Section --}}
                    <div class="bachelor-section d-none">
                        <div class="col-12 mt-4"><h5>Bachelor's Degree</h5></div>
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Graduation</label>
                            <input type="text" name="degree_level" value="{{ old('degree_level', $education->degree_level ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Graduation_Specialization</label>
                            <input type="text" name="degree_specialization" value="{{ old('degree_specialization', $education->degree_specialization ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Graduation_Percentage</label>
                            <input type="text" name="degree_percentage" value="{{ old('degree_percentage', $education->degree_percentage ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Graduation_institution</label>
                            <input type="text" name="degree_institution" value="{{ old('degree_institution', $education->degree_institution ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Graduation_passout_year</label>
                            <input type="text" name="degree_passout_year" value="{{ old('degree_passout_year', $education->degree_passout_year ?? '') }}" class="form-control">
                        </div>
                        
                    </div>
                    </div>

                    {{-- Master Section --}}
                    <div class="master-section d-none">
                        <div class="col-12 mt-4"><h5>Master's Degree</h5></div>
                        <div class="col-md-6">
                            <label class="form-label">University</label>
                            <input type="text" name="university_name" value="{{ old('university_name', $education->university_name ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Passout Year</label>
                            <input type="text" name="masters_year" value="{{ old('masters_year', $education->masters_year ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Specialization</label>
                            <input type="text" name="masters_specialization" value="{{ old('masters_specialization', $education->masters_specialization ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Percentage</label>
                            <input type="text" name="masters_percentage" value="{{ old('masters_percentage', $education->masters_percentage ?? '') }}" class="form-control">
                        </div>
                    </div>

                    {{-- Skills --}}
                   
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-success px-4">Save and Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript to handle conditional sections --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('educationLevelSelect');
        const diploma = document.querySelector('.diploma-section');
        const bachelor = document.querySelector('.bachelor-section');
        const master = document.querySelector('.master-section');

        function toggleSections() {
            const value = select.value;
            diploma.classList.toggle('d-none', value !== 'diploma');
            bachelor.classList.toggle('d-none', value !== 'bachelor');
            master.classList.toggle('d-none', value !== 'master');
        }

        select.addEventListener('change', toggleSections);
        toggleSections(); // run on load
    });
</script>

@elseif($step == 3)
<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white py-3 px-4 rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Work Experience</h4>
        </div>

        <div class="card-body px-4 py-5">
            <form action="{{ route('applicant.work.update', $applicant->id) }}" method="POST">
                @csrf

                {{-- Work Experience Container --}}
                <div id="work-experience-container">
                    
                    {{-- First Work Experience Block --}}
                    <div class="work-experience-item border rounded p-3 mb-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" value="{{ old('designation', $work->designation ?? '') }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Employment Type</label>
                                <select name="employment_type" class="form-control">
                                    <option value="Full Time" {{ old('employment_type', $work->employment_type ?? '') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="Remote" {{ old('employment_type', $work->employment_type ?? '') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                    <option value="Hybrid" {{ old('employment_type', $work->employment_type ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" value="{{ old('company_name', $work->company_name ?? '') }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" value="{{ old('location', $work->location ?? '') }}" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Start Month</label>
                                <select name="start_month" class="form-control">
                                    @foreach(['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec'] as $num => $month)
                                        <option value="{{ $num }}" {{ old('start_month', $work->start_month ?? '') == $num ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Start Year</label>
                                <input type="number" name="start_year" value="{{ old('start_year', $work->start_year ?? '') }}" class="form-control" min="1950" max="{{ date('Y') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Month</label>
                                <select name="end_month" id="end_month" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach(['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec'] as $num => $month)
                                        <option value="{{ $num }}" {{ old('end_month', $work->end_month ?? '') == $num ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Year</label>
                                <input type="number" name="end_year" id="end_year" value="{{ old('end_year', $work->end_year ?? '') }}" class="form-control" min="1950" max="{{ date('Y') }}">
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="current_working" id="current_working_checkbox" value="1" class="form-check-input" {{ old('current_working', $work->current_working ?? false) ? 'checked' : '' }} onchange="toggleEndDate()">
                                    <label class="form-check-label">I am currently working in this role</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Salary in CTC</label>
                                <input type="text" name="salary_ctc" value="{{ old('salary_ctc', $work->salary_ctc ?? '') }}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Add Skills</label>
                                <div id="skills-container-0">
                                    <input type="text" name="work_experience[0][skills][]" class="form-control mb-2" placeholder="Enter a skill">
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addSkill(0)">Add Skill</button>
                            </div>
                        <script>
                            let skillCount = {{ count(old('skills', $skills ?? [])) > 0 ? count(old('skills', $skills ?? [])) : 1 }};
                        
                            function addSkill() {
                                const container = document.getElementById('skills-container');
                                const input = document.createElement('input');
                                input.type = 'text';
                                input.name = 'skills[]';
                                input.className = 'form-control mb-2';
                                input.placeholder = 'Enter a skill';
                                container.appendChild(input);
                        
                                skillCount++;
                            }
                        </script>
                            <div class="col-md-4">
                                <label class="form-label">Position</label>
                                <input type="text" name="position" value="{{ old('position', $work->position ?? '') }}" class="form-control" placeholder="e.g., Sales Executive">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Responsibilities</label>
                                <textarea name="responsibilities" rows="4" class="form-control">{{ old('responsibilities', $work->responsibilities ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div> {{-- end #work-experience-container --}}

                {{-- Add More Button --}}
                <button type="button" id="add-more-form-btn" class="btn btn-primary mt-3">+ Add More Work Experience</button>
            

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">Save and Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    function toggleEndDate() {
        const isChecked = document.getElementById('current_working_checkbox').checked;
        document.getElementById('end_month').disabled = isChecked;
        document.getElementById('end_year').disabled = isChecked;
    }
    window.addEventListener('DOMContentLoaded', toggleEndDate);

    // Add More Work Experience
    document.getElementById('add-more-form-btn').addEventListener('click', function () {
        const container = document.getElementById('work-experience-container');
        const index = container.children.length;

        const newWorkExperienceItem = document.createElement('div');
        newWorkExperienceItem.classList.add('work-experience-item', 'border', 'rounded', 'p-3', 'mb-4');

        newWorkExperienceItem.innerHTML = `
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Designation</label>
                    <input type="text" name="work_experience[${index}][designation]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Employment Type</label>
                    <select name="work_experience[${index}][employment_type]" class="form-control">
                        <option value="Full Time">Full Time</option>
                        <option value="Remote">Remote</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Company Name</label>
                    <input type="text" name="work_experience[${index}][company_name]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Location</label>
                    <input type="text" name="work_experience[${index}][location]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Start Date</label>
                    <input type="month" name="work_experience[${index}][start_date]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>End Date</label>
                    <input type="month" name="work_experience[${index}][end_date]" id="end_date_${index}" class="form-control">
                </div>
                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" name="work_experience[${index}][current_working]" value="1" id="currently_working_${index}" onchange="toggleDynamicEndDate(${index})">
                    <label class="form-check-label">I am currently working in this role</label>
                </div>
                <div class="col-md-4">
                    <label>Salary in CTC</label>
                    <input type="text" name="work_experience[${index}][salary_ctc]" class="form-control">
                </div>
                 <div class="col-md-4">
                    <label class="form-label">Add Skills</label>
                    <div id="skills-container-${index}">
                        <input type="text" name="work_experience[${index}][skills][]" class="form-control mb-2" placeholder="Enter a skill">
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addSkill(${index})">Add Skill</button>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">Position</label>
                    <input type="text" name="work_experience[${index}][position]" class="form-control" placeholder="e.g., Sales Executive">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Responsibilities</label>
                    <textarea name="work_experience[${index}][responsibilities]" rows="4" class="form-control"></textarea>
                </div>
                 <!-- Remove Button -->
        <div class="col-12 text-end">
            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeWorkExperience(this)">Remove</button>
        </div>
            </div>
        `;

        container.appendChild(newWorkExperienceItem);
    });

    function toggleDynamicEndDate(index) {
        const checkbox = document.getElementById(`currently_working_${index}`);
        const endDateInput = document.getElementById(`end_date_${index}`);
        if (checkbox && endDateInput) {
            endDateInput.disabled = checkbox.checked;
        }
    }
    function addSkill(index) {
    const container = document.getElementById(`skills-container-${index}`);
    const input = document.createElement('input');
    input.type = 'text';
    input.name = `work_experience[${index}][skills][]`;
    input.className = 'form-control mb-2';
    input.placeholder = 'Enter a skill';
    container.appendChild(input);
}
function removeWorkExperience(button) {
    const workItem = button.closest('.work-experience-item');
    if (workItem) {
        workItem.remove();
    }
}

</script>






            @elseif($step == 4)
                <div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white py-3 px-4 rounded-top-4">
            <h4 class="mb-0">Document Upload</h4>
        </div>

        <div class="card-body px-4 py-5">
            <form action="{{ route('applicant.documents.update', $applicant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Aadhar Card</label>
                        <input type="file" name="aadhar_card" class="form-control" style="border: 1px solid black;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Resume</label>
                        <input type="file" name="Resume" class="form-control" style="border: 1px solid black;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Aadhar Card Front</label>
                        <input type="file" name="aadhar_card_front" class="form-control" style="border: 1px solid black;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Aadhar Card Back</label>
                        <input type="file" name="aadhar_card_back" class="form-control" style="border: 1px solid black;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Passport Size Photographs</label>
                        <input type="file" name="passport_size_photographs" class="form-control" style="border: 1px solid black;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">PAN Card</label>
                        <input type="file" name="pan_card" class="form-control" style="border: 1px solid black;">
                    </div>
                    <div class="col-md-6">
    <label class="form-label">Do you have a Passport?</label>
    <select name="passport" id="passport" class="form-control" style="border: 1px solid black;">
        <option value="">Select</option>
        <option value="Yes" {{ old('passport', $documents->passport ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ old('passport', $documents->passport ?? '') == 'No' ? 'selected' : '' }}>No</option>
    </select>
</div>

<div class="col-md-6" id="passport_file_wrapper" style="display: none;">
    <label class="form-label">Passport File</label>
    <input type="file" name="passport_file" class="form-control" style="border: 1px solid black;">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passportSelect = document.getElementById('passport');
        const passportFileWrapper = document.getElementById('passport_file_wrapper');

        function togglePassportFile() {
            passportFileWrapper.style.display = passportSelect.value === 'Yes' ? 'block' : 'none';
        }

        passportSelect.addEventListener('change', togglePassportFile);
        togglePassportFile(); // Run on page load
    });
</script>

                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-success px-4">Submit Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

@elseif($step == 5)
<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white py-3 px-4 rounded-top-4">
            <h4 class="mb-0">FAQ Responses</h4>
        </div>

        <div class="card-body px-4 py-5">
            <form action="{{ route('applicant.faq.update', $applicant->id) }}" method="POST">
                @csrf

@foreach ($faqs as $faq)
    <label class="form-label">{{ $faq['question'] }}</label>
    <select name="answer[{{ $faq['id'] }}]" class="form-control">
        <option value="yes" {{ old("answer.{$faq['id']}") == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ old("answer.{$faq['id']}") == 'no' ? 'selected' : '' }}>No</option>
    </select>
@endforeach

                <div class="text-end mt-4">
                    <button class="btn btn-success px-4">Submit Answers</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


            
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> <!-- For Bootstrap 4.x & 5.x -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- For Bootstrap 4.x -->
@endsection

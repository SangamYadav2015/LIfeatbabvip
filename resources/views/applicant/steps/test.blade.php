<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="profile-user"></div>
        </div>
    </div>

    <!-- Profile Content Section -->
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
                                                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-16 mb-1">{{ $applicant->name }}</h5>
                               <!-- <p class="text-muted font-size-13 mb-2 pb-2">Full Stack Developer</p>-->
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex align-items-start justify-content-end gap-2 mb-2">
                        <div>
                            <button type="button" class="btn btn-success"><i class="me-1"></i> Message</button>
                        </div>
                        <div>
                            <div class="dropdown">
                                <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded font-size-20"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Profile Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-transparent shadow-none">
                <div class="card-body">
                    <form action="{{ route('applicant.updateProfile', ['applicantId' => $applicant->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Heading Section -->
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

                            <!-- Form Content Section -->
                         <div class="col-md-12">
    <div class="container">
        <div class="row">
            <!-- First Name -->
            <div class="col-md-4">
                <label for="first_name" class="sky-blue-text">First Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="first_name" name="first_name"
                       value="{{ old('first_name', $applicant->personalInformation->first_name ?? '') }}" required>
            </div>

            <!-- Middle Name -->
            <div class="col-md-4">
                <label for="middle_name" class="sky-blue-text">Middle Name</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="middle_name" name="middle_name"
                       value="{{ old('middle_name', $applicant->personalInformation->middle_name ?? '') }}">
            </div>

            <!-- Last Name -->
            <div class="col-md-4">
                <label for="last_name" class="sky-blue-text">Last Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="last_name" name="last_name"
                       value="{{ old('last_name', $applicant->personalInformation->last_name ?? '') }}" required>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Date of Birth -->
            <div class="col-md-6">
                <label for="date_of_birth" class="sky-blue-text">Date of Birth<span class="text-danger">*</span></label>
                <input type="date" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="date_of_birth" name="date_of_birth"
                       value="{{ old('date_of_birth', $applicant->personalInformation?->date_of_birth ? \Carbon\Carbon::parse($applicant->personalInformation->date_of_birth)->format('Y-m-d') : '') }}"
                       required>
            </div>

            <!-- Gender -->
            <div class="col-md-6">
                <label for="gender" class="sky-blue-text">Gender</label>
                <select id="gender" name="gender" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $applicant->personalInformation->gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $applicant->personalInformation->gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $applicant->personalInformation->gender ?? '') === 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="sky-blue-text">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="email" name="email"
                       value="{{ old('email', $applicant->personalInformation->email ?? '') }}" required>
            </div>

            <!-- Phone -->
            <div class="col-md-6">
                <label for="phone" class="sky-blue-text">Phone<span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="phone" name="phone"
                       value="{{ old('phone', $applicant->personalInformation->phone ?? '') }}" required>
            </div>
        </div>

        <div class="row mt-3">
            <!-- House No -->
            <div class="col-md-4">
                <label for="house_no" class="sky-blue-text">House No</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="house_no" name="house_no"
                       value="{{ old('house_no', $applicant->personalInformation->house_no ?? '') }}">
            </div>

            <!-- Landmark -->
            <div class="col-md-4">
                <label for="landmark" class="sky-blue-text">Landmark</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="landmark" name="landmark"
                       value="{{ old('landmark', $applicant->personalInformation->landmark ?? '') }}">
            </div>

            <!-- Area -->
            <div class="col-md-4">
                <label for="area" class="sky-blue-text">Area</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="area" name="area"
                       value="{{ old('area', $applicant->personalInformation->area ?? '') }}">
            </div>
        </div>

        <div class="row mt-3">
            <!-- Current Address -->
            <div class="col-md-6">
                <label for="current_address" class="sky-blue-text">Current Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="current_address" name="current_address"
                       value="{{ old('current_address', $applicant->personalInformation->current_address ?? '') }}" required>
            </div>

            <!-- Permanent Address -->
            <div class="col-md-6">
                <label for="permanent_address" class="sky-blue-text">Permanent Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="permanent_address" name="permanent_address"
                       value="{{ old('permanent_address', $applicant->personalInformation->permanent_address ?? '') }}" required>
            </div>
        </div>

        <div class="row mt-3">
            <!-- City -->
            <div class="col-md-4">
                <label for="city" class="sky-blue-text">City</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="city" name="city"
                       value="{{ old('city', $applicant->personalInformation->city ?? '') }}">
            </div>

            <!-- State -->
            <div class="col-md-4">
                <label for="state" class="sky-blue-text">State</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="state" name="state"
                       value="{{ old('state', $applicant->personalInformation->state ?? '') }}">
            </div>

            <!-- ZIP Code -->
            <div class="col-md-4">
                <label for="zip" class="sky-blue-text">ZIP Code</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="zip" name="zip"
                       value="{{ old('zip', $applicant->personalInformation->zip ?? '') }}">
            </div>
        </div>

        <div class="row mt-3">
            <!-- Country -->
            <div class="col-md-6">
                <label for="country" class="sky-blue-text">Country</label>
                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                       id="country" name="country"
                       value="{{ old('country', $applicant->personalInformation->country ?? '') }}">
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
                        


                        <!-- Education Information Section -->
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
    <div class="col-md-12">
        <div class="text-muted">
            <div class="profile-section">
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
    <!-- Highest Education -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="highest_education" class="form-label text-primary fw-semibold">Highest Education <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="highest_education" 
                name="highest_education" 
                placeholder="Enter your highest qualification"
                value="{{ old('highest_education', $applicant->educationInformation->highest_education ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 10th Passout Year -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="tenth_passout_year" class="form-label text-primary fw-semibold">10th Passout Year <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="tenth_passout_year" 
                name="tenth_passout_year" 
                placeholder="e.g. 2015"
                value="{{ old('tenth_passout_year', $applicant->educationInformation->tenth_passout_year ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 10th School -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="tenth_school" class="form-label text-primary fw-semibold">10th School <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="tenth_school" 
                name="tenth_school" 
                placeholder="School name"
                value="{{ old('tenth_school', $applicant->educationInformation->tenth_school ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 10th Board Name -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="tenth_board_name" class="form-label text-primary fw-semibold">10th Board Name <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="tenth_board_name" 
                name="tenth_board_name" 
                placeholder="Board name (e.g. CBSE, ICSE)"
                value="{{ old('tenth_board_name', $applicant->educationInformation->tenth_board_name ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 10th Percentage -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="tenth_percentage" class="form-label text-primary fw-semibold">10th Percentage <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="tenth_percentage" 
                name="tenth_percentage" 
                placeholder="e.g. 89.5"
                value="{{ old('tenth_percentage', $applicant->educationInformation->tenth_percentage ?? '') }}" 
                required
            >
        </div>
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
    <!-- 12th Passout Year -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="twelfth_passout_year" class="form-label text-primary fw-semibold">12th Passout Year <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="twelfth_passout_year" 
                name="twelfth_passout_year" 
                placeholder="e.g. 2017"
                value="{{ old('twelfth_passout_year', $applicant->educationInformation->twelfth_passout_year ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 12th School -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="twelfth_school" class="form-label text-primary fw-semibold">12th School <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="twelfth_school" 
                name="twelfth_school" 
                placeholder="School name"
                value="{{ old('twelfth_school', $applicant->educationInformation->twelfth_school ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 12th Board Name -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="twelfth_board_name" class="form-label text-primary fw-semibold">12th Board Name <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="twelfth_board_name" 
                name="twelfth_board_name" 
                placeholder="Board name (e.g. CBSE, ISC)"
                value="{{ old('twelfth_board_name', $applicant->educationInformation->twelfth_board_name ?? '') }}" 
                required
            >
        </div>
    </div>
</div>

<div class="row">
    <!-- 12th Percentage -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="twelfth_percentage" class="form-label text-primary fw-semibold">12th Percentage <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="twelfth_percentage" 
                name="twelfth_percentage" 
                placeholder="e.g. 91.6"
                value="{{ old('twelfth_percentage', $applicant->educationInformation->twelfth_percentage ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- 12th Stream -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="twelfth_stream" class="form-label text-primary fw-semibold">12th Stream <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle" 
                id="twelfth_stream" 
                name="twelfth_stream" 
                placeholder="e.g. Science, Commerce, Arts"
                value="{{ old('twelfth_stream', $applicant->educationInformation->twelfth_stream ?? '') }}" 
                required
            >
        </div>
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
    <!-- Degree Level -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="degree_level" class="form-label text-primary fw-semibold">Degree Level <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                id="degree_level" 
                name="degree_level" 
                placeholder="e.g. Bachelor's, B.Tech, B.Sc"
                value="{{ old('degree_level', $applicant->educationInformation->degree_level ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- Institution Name -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="institution_name" class="form-label text-primary fw-semibold">Institution Name <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                id="institution_name" 
                name="institution_name" 
                placeholder="University or College Name"
                value="{{ old('institution_name', $applicant->educationInformation->institution_name ?? '') }}" 
                required
            >
        </div>
    </div>

    <!-- Degree Specialization -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="degree_specialization" class="form-label text-primary fw-semibold">Degree Specialization <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                id="degree_specialization" 
                name="degree_specialization" 
                placeholder="e.g. Computer Science, Mechanical"
                value="{{ old('degree_specialization', $applicant->educationInformation->degree_specialization ?? '') }}" 
                required
            >
        </div>
    </div>
</div>

<div class="row">
    <!-- Degree Percentage -->
    <div class="col-md-4 mb-4">
        <div class="form-group position-relative">
            <label for="degree_percentage" class="form-label text-primary fw-semibold">Degree Percentage <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"
                id="degree_percentage" 
                name="degree_percentage" 
                placeholder="e.g. 88.5"
                value="{{ old('degree_percentage', $applicant->educationInformation->degree_percentage ?? '') }}" 
                required
            >
        </div>
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
                <!-- Masters Year -->
                <div class="col-md-4 mb-4">
                    <label for="masters_year" class="form-label text-primary fw-semibold">Master's Year</label>
                    <input 
                        type="text" 
                        class="form-control shadow-sm rounded-pill px-4 py-2 border border-secondary-subtle"
                        id="masters_year" 
                        name="masters_year" 
                        placeholder="e.g. 2022"
                        value="{{ old('masters_year', optional($applicant->educationInformation)->masters_year) }}"
                    >
                </div>

                <!-- University Name -->
                <div class="col-md-4 mb-4">
                    <label for="university_name" class="form-label text-primary fw-semibold">University Name</label>
                    <input 
                        type="text" 
                        class="form-control shadow-sm rounded-pill px-4 py-2 border border-secondary-subtle"
                        id="university_name" 
                        name="university_name" 
                        placeholder="e.g. ABC University"
                        value="{{ old('university_name', optional($applicant->educationInformation)->university_name) }}"
                    >
                </div>

                <!-- Masters Specialization -->
                <div class="col-md-4 mb-4">
                    <label for="masters_specialization" class="form-label text-primary fw-semibold">Master's Specialization</label>
                    <input 
                        type="text" 
                        class="form-control shadow-sm rounded-pill px-4 py-2 border border-secondary-subtle"
                        id="masters_specialization" 
                        name="masters_specialization" 
                        placeholder="e.g. Data Science"
                        value="{{ old('masters_specialization', optional($applicant->educationInformation)->masters_specialization) }}"
                    >
                </div>
            </div>

            <div class="row">
                <!-- Masters Percentage -->
                <div class="col-md-4 mb-4">
                    <label for="masters_percentage" class="form-label text-primary fw-semibold">Master's Percentage</label>
                    <input 
                        type="text" 
                        class="form-control shadow-sm rounded-pill px-4 py-2 border border-secondary-subtle"
                        id="masters_percentage" 
                        name="masters_percentage" 
                        placeholder="e.g. 82.3"
                        value="{{ old('masters_percentage', optional($applicant->educationInformation)->masters_percentage) }}"
                    >
                </div>

                <!-- College -->
                <div class="col-md-4 mb-4">
                    <label for="college" class="form-label text-primary fw-semibold">College</label>
                    <input 
                        type="text" 
                        class="form-control shadow-sm rounded-pill px-4 py-2 border border-secondary-subtle"
                        id="college" 
                        name="college" 
                        placeholder="College Name"
                        value="{{ old('college', optional($applicant->educationInformation)->college) }}"
                    >
                </div>

                <!-- Relevant Skills -->
                <div class="col-md-4 mb-4">
                    <label for="skills_relevant" class="form-label text-primary fw-semibold">Relevant Skills</label>
                    <input 
                        type="text" 
                        class="form-control shadow-sm rounded-pill px-4 py-2 border border-secondary-subtle"
                        id="skills_relevant" 
                        name="skills_relevant" 
                        placeholder="e.g. Python, SQL, Leadership"
                        value="{{ old('skills_relevant', optional($applicant->educationInformation)->skills_relevant) }}"
                    >
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
                        <h5 class="card-title mb-0">Current Compensation and Benefits:</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <!-- Form Content Section -->
                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <div class="container">
                                    @if($applicant->benefits->isEmpty())
                                        <!-- No benefits available, show blank fields -->
                                        <div class="row">
                                            <!-- Annual Gross Compensation -->
                                            <div class="col-md-6">
                                                <label for="annualgrosscompensation" class="sky-blue-text">Annual Gross Compensation</label>
                                                <input type="text" class="form-control shadow-sm rounded-pill px-4 py-2 border border-primary-subtle"  id="annualgrosscompensation" name="annualgrosscompensation" value="{{ old('annualgrosscompensation', '') }}">
                                            </div>

                                            <!-- Fixed Salary -->
                                            <div class="col-md-6">
                                                <label for="fixedSalary" class="sky-blue-text">Fixed Salary</label>
                                                <input type="text" class="transparent-input" id="fixedSalary" name="fixedSalary" value="{{ old('fixedSalary', '') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Variable Pay -->
                                            <div class="col-md-6">
                                                <label for="variablePay" class="sky-blue-text">Variable Pay</label>
                                                <input type="text" class="transparent-input" id="variablePay" name="variablePay" value="{{ old('variablePay', '') }}">
                                            </div>

                                            <!-- Other Benefits -->
                                            <div class="col-md-6">
                                                <label for="otherbenefits" class="sky-blue-text">Other Benefits</label>
                                                <input type="text" class="transparent-input" id="otherbenefits" name="otherbenefits" value="{{ old('otherbenefits', '') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Next Revision Date -->
                                            <div class="col-md-6">
                                                <label for="nextrevisiondate" class="sky-blue-text">Next Revision Date</label>
                                                <input type="date" class="transparent-input" id="nextrevisiondate" name="nextrevisiondate" value="{{ old('nextrevisiondate', '') }}">
                                            </div>
                                        </div>
                                    @else
                                        <!-- Existing benefits, show the data -->
                                        @foreach ($applicant->benefits as $benefit)
                                            <div class="row">
                                                <!-- Annual Gross Compensation -->
                                                <div class="col-md-6">
                                                    <label for="annualgrosscompensation" class="sky-blue-text">Annual Gross Compensation</label>
                                                    <input type="text" class="transparent-input" id="annualgrosscompensation" name="annualgrosscompensation" value="{{ old('annualgrosscompensation', $benefit->annualgrosscompensation ?? '') }}">
                                                </div>

                                                <!-- Fixed Salary -->
                                                <div class="col-md-6">
                                                    <label for="fixedSalary" class="sky-blue-text">Fixed Salary</label>
                                                    <input type="text" class="transparent-input" id="fixedSalary" name="fixedSalary" value="{{ old('fixedSalary', $benefit->fixedSalary ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Variable Pay -->
                                                <div class="col-md-6">
                                                    <label for="variablePay" class="sky-blue-text">Variable Pay</label>
                                                    <input type="text" class="transparent-input" id="variablePay" name="variablePay" value="{{ old('variablePay', $benefit->variablePay ?? '') }}">
                                                </div>

                                                <!-- Other Benefits -->
                                                <div class="col-md-6">
                                                    <label for="otherbenefits" class="sky-blue-text">Other Benefits</label>
                                                    <input type="text" class="transparent-input" id="otherbenefits" name="otherbenefits" value="{{ old('otherbenefits', $benefit->otherbenefits ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Next Revision Date -->
                                                <div class="col-md-6">
                                                    <label for="nextrevisiondate" class="sky-blue-text">Next Revision Date</label>
                                                    <input type="date" class="transparent-input" id="nextrevisiondate" name="nextrevisiondate" value="{{ old('nextrevisiondate', $benefit->nextrevisiondate ? \Carbon\Carbon::parse($benefit->nextrevisiondate)->format('d-m-Y') : '') }}">
                                                </div>
                                            </div>
                                        @endforeach
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


<div class="accordion" id="documentsAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingDocuments">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocuments" aria-expanded="true" aria-controls="collapseDocuments">
                Documents Upload
            </button>
        </h2>
        <div id="collapseDocuments" class="accordion-collapse collapse show" aria-labelledby="headingDocuments" data-bs-parent="#documentsAccordion">
            <div class="accordion-body">
                <!-- File Inputs for Document Uploads -->
                <div class="row mb-4">
                    @foreach(['Resume', 'aadhar_card_front', 'aadhar_card_back', 'pan_card','passport_size_photographs'] as $doc)
                        <div class="col-md-4">
                            <label for="{{ $doc }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $doc)) }}</label>
                            <input type="file" class="form-control" name="{{ $doc }}" id="{{ $doc }}" accept=".pdf,.jpg,.jpeg,.png">
                            
                            @if($applicant->documents && $applicant->documents->first() && $applicant->documents->first()->$doc)
                                <!-- Display Existing Document Name -->
                                <p style="display: none;">Uploaded: {{ basename($applicant->documents->first()->$doc) }}</p>
                                @else
                                <p>No document uploaded yet.</p>
                            @endif
                            
                            @error($doc)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Special handling for multi-file uploads like salary slip or experience letters -->
               

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>






<hr style="border: 0; height: 2px; background-color: #ff6347; border-style: dotted;">   




                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<style>
    /* Make the labels sky blue */
.sky-blue-text {
    color: #1c84ee; /* Sky blue color */
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
    padding-top: 10px;
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
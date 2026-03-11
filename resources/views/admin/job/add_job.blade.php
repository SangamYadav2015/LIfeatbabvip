@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add Job</a></li>
                        <li class="breadcrumb-item active">Welcome </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Job</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill Job Data</h4>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.jobstore')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="company_id">Select Company</label>
                                                    <select class="form-control" name="company_id" id="company_id" required>
                                                        <option value="">Select Company</option>
                                                        @foreach ($company as $companies)
                                                            <option value="{{ $companies->id }}">{{ $companies->company_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Company!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="department_id">Select Department</label>
                                                    <select name="department_id" id="department_id" class="form-control" required>
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">{{ $department->Department_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Department!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Job Title</label>
                                                    <input
    type="text"
    class="form-control"
    name="title"
    id="title"
    required
    placeholder="Job Title"
    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
/>
                                                    <div class="invalid-feedback">
                                                        Please Enter Job Title!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="statuscat">Status</label>
                                                    <select class="form-control" id="statuscat" name="status" required>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                        <option value="pending">Pending</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Status.
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="location_id">Location</label>
                                                    <select name="location_id" id="location_id" class="form-control" required>
                                                        <option value="">Select Country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->location_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please enter your location!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="type">Job Type</label>
                                                    <select class="form-control" name="type" id="type" required>
                                                        <option value="" disabled selected>Select Job Type</option>
                                                        <option value="full-time">Full Time</option>
                                                        <option value="part-time">Part Time</option>
                                                        <option value="contract">Contract</option>
                                                        <option value="temporary">Temporary</option>
                                                        <option value="internship">Internship</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a job type.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
    <label for="salary_disclosed">Disclose Salary?</label>
    <input type="hidden" name="salary_disclosed" value="0"> <!-- Default value -->
    <input type="checkbox" name="salary_disclosed" value="1" id="salary_disclosed"> <!-- Checked value -->
</div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="minimum_salary">Minimum Salary</label>
                                                    <input type="number" class="form-control" name="minimum_salary" id="minimum_salary" placeholder="Enter Minimum Salary" step="0.01">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid minimum salary.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="maximum_salary">Maximum Salary</label>
                                                    <input type="number" class="form-control" name="maximum_salary" id="maximum_salary" placeholder="Enter Maximum Salary" step="0.01">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid maximum salary.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="designation">Designation</label>
<input
    type="text"
    class="form-control"
    name="designation"
    id="designation"
    required
    placeholder="Enter Designation"
    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
/>
                                                    <div class="invalid-feedback">
                                                        Please enter a designation!
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>

                                      
                                      

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="description">Description</label>
                                                    <textarea class="form-control ckeditor-classic" id="description" name="description" required placeholder="Description"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Job Description.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                      

                                        <button class="btn btn-primary" type="submit">Submit Data</button>
                                    </form>
                                </div>
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->

<script src="{{ asset('admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script>
    ClassicEditor.create(document.querySelector(".ckeditor-classic"))
        .then(function (e) {
            e.ui.view.editable.element.style.height = "200px";
        })
        .catch(function (e) {
            console.error(e);
        });
</script>

<script src="{{ asset('admin/js/pages/form-validation.init.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.image-check').on('change', function () {
            var fileInput = this;
            var $parentDiv = $(fileInput).closest('.mb-3'); // Find the closest parent div

            if (fileInput.files && fileInput.files[0]) {
                var img = new Image();
                var file = fileInput.files[0];
                
                var imgFixWidth = parseInt($(fileInput).attr('data-width'));
                var imgFixHeight = parseInt($(fileInput).attr('data-height'));
                var objectUrl = URL.createObjectURL(file);
                
                img.onload = function () {
                    var width = this.width;
                    var height = this.height;
                    
                    if (width === imgFixWidth && height === imgFixHeight) {
                        $parentDiv.find(".img-alert").html('<span class="text-success">Image dimensions are correct.</span>');
                    } else {
                        $parentDiv.find(".img-alert").html('<span class="text-danger">Image dimensions are not correct.</span>');
                        fileInput.value = '';
                    }
                    
                    URL.revokeObjectURL(objectUrl);
                };
                
                img.src = objectUrl;
            }
        });
    });
</script>
@endsection

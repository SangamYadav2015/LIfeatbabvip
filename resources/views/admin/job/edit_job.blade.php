@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome! To {{ Auth::user()->designation }} Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Job</a></li>
                        <li class="breadcrumb-item active">Welcome</li>
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
                    <h4 class="card-title">Edit Job</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill Job Data</h4>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.updatejob', ['num' => $job->id]) }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="title">Job Title</label>
                                                    <input type="text" class="form-control" name="title" id="title" required placeholder="Job Title" value="{{ old('title', $job->title) }}">
                                                    <div class="invalid-feedback">Please Enter Job Title!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="location_id">Select Location</label>
                                                    <select class="form-control" name="location_id" id="location_id" required>
                                                        <option value="">Select Location</option>
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}" {{ $job->location_id === $location->id ? 'selected' : '' }}>
                                                                {{ $location->location_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please Select Location!</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="company_id">Select Company</label>
                                                    <select class="form-control" name="company_id" id="company_id" required>
                                                        <option value="">Select Company</option>
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}" {{ $job->company_id === $company->id ? 'selected' : '' }}>
                                                                {{ $company->company_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please Select Company!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="type">Job Type</label>
                                                    <input type="text" class="form-control" name="type" id="type" required placeholder="Job Type" value="{{ old('type', $job->type) }}">
                                                    <div class="invalid-feedback">Please Enter Job Type!</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="salary">Salary</label>
                                                    <input type="number" step="0.01" class="form-control" name="salary" id="salary" placeholder="Job Salary" value="{{ old('salary', $job->salary) }}">
                                                    <div class="invalid-feedback">Please Enter Job Salary!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="experience">Designation</label>
                                                    <input type="text" class="form-control" name="designation" id="designation" placeholder="designation" value="{{ old('designation', $job->designation) }}">
                                                    <div class="invalid-feedback">Please Enter Designation!</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="job_image">Job Image</label><span class="text-small text-danger">( Image size must be 650 x 400 px )</span>
                                                    <input type="file" class="form-control image-check" name="job_image" id="job_image" data-height="400" data-width="650">
                                                    <input type="hidden" value="{{ $job->job_image }}" name="job_image_old">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">Please Select Job Image!</div>
                                                    @if ($job->job_image)
                                                        <a href="{{ asset('storage/uploads/' . $job->job_image) }}" target="_blank">View Current Image</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="description">Job Description</label>
                                                    <textarea class="form-control ckeditor-classic" id="description" name="description" required placeholder="Job Description">{{ old('description', $job->description) }}</textarea>
                                                    <div class="invalid-feedback">Please Enter Job Description!</div>
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

<script>
    $(document).ready(function () {
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

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add Location</a></li>
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
                    <h4 class="card-title">Add Location</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('locations.store') }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="location_name">Location Name</label>
                                    <input type="text" class="form-control" name="location_name" id="location_name" required placeholder="Enter Location Name">
                                    <div class="invalid-feedback">
                                        Please enter a location name!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="location_slug">Location Slug</label>
                                    <input type="text" class="form-control" name="location_slug" id="location_slug" required placeholder="Enter Location Slug">
                                    <div class="invalid-feedback">
                                        Please enter a location slug!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="location_image">Location Image</label>
                                    <input type="file" class="form-control image-check" name="location_image" id="location_image" required>
                                    <div class="img-alert"></div>
                                    <div class="invalid-feedback">
                                        Please select an image!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="short_description">Short Description</label>
                                    <textarea class="form-control" id="short_description" name="short_description" placeholder="Enter Short Description" required></textarea>
                                    <div class="invalid-feedback">
                                        Please enter a short description!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit Data</button>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->

<script src="{{ asset('admin/js/pages/form-validation.init.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.image-check').on('change', function () {
            var fileInput = this;
            var $parentDiv = $(fileInput).closest('.mb-3'); // Find the closest parent div

            if (fileInput.files && fileInput.files[0]) {
                var img = new Image();
                var file = fileInput.files[0];
                var objectUrl = URL.createObjectURL(file);

                img.onload = function () {
                    // Optionally, you can check image dimensions here
                    // For example:
                    // if (this.width !== expectedWidth || this.height !== expectedHeight) {
                    //     $parentDiv.find(".img-alert").html('<span class="text-danger">Image dimensions are not correct.</span>');
                    //     fileInput.value = '';
                    // } else {
                    //     $parentDiv.find(".img-alert").html('<span class="text-success">Image dimensions are correct.</span>');
                    // }

                    URL.revokeObjectURL(objectUrl);
                };

                img.src = objectUrl;
            }
        });
    });
</script>

@endsection

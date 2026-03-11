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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add Team Member</a></li>
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
                    <h4 class="card-title">Add Team Member</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill Team Member Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
<div class="card-body">
<form class="needs-validation" action="{{ route('admin.storeTeam')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
@csrf

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">First Name</label>
<input type="text"
class="form-control"
name="name"
required
onkeypress="return /^[A-Za-z\s]$/.test(event.key)"
onpaste="return false;">
</div>
</div>

<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Last Name</label>
<input type="text"
class="form-control"
name="lastname"
required
onkeypress="return /^[A-Za-z\s]$/.test(event.key)"
onpaste="return false;">
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Designation</label>
<input type="text"
class="form-control"
name="designation"
required
onkeypress="return /^[A-Za-z\s]$/.test(event.key)"
onpaste="return false;">
</div>
</div>

<div class="col-md-6">
<div class="mb-3">
<label class="form-label">LinkedIn Profile</label>
<input type="text" class="form-control" name="linkedin_url">
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Facebook Profile</label>
<input type="text" class="form-control" name="facebook_url">
</div>
</div>

<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Instagram Profile</label>
<input type="text" class="form-control" name="instagram_url">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label class="form-label">About Member</label>
<textarea class="form-control" name="about"></textarea>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label class="form-label">Team Member Image</label>
<span class="text-danger">(600 × 600 px)</span>
<input type="file" class="form-control" name="team_image" required>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">Status</label>
<select class="form-control" name="status" required>
<option value="active">Active</option>
<option value="inactive">Inactive</option>
</select>
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

<script src="{{asset('admin/js/pages/form-validation.init.js') }}"></script>
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
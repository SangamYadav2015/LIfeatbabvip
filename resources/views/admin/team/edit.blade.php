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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Team Member</a></li>
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
                    <h4 class="card-title">Edit Team Member</h4>

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
                                <form class="needs-validation" action="{{ route('admin.updateTeam',['num'=> $teamRecord->id])}}" method="post" novalidate  autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">First Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" required value="{{ $teamRecord->designation}}">
                                                </div>
                                            </div>
                                        

                                        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="lastname">Enter Last Name</label>
                                                    <input type="text" class="form-control" name="lastname" id="name" required value="{{ $teamRecord->lastname}}">                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="designation">Enter Designation</label>
                                                    <input type="text" class="form-control" name="designation" id="designation" required value="{{ $teamRecord->designation}}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Designation!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="linkedin_url">Enter Linkedin Profile </label>
                                                    <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" value="{{ $teamRecord->linkedin_url}}">
                                                   
                                                    <div class="invalid-feedback">
                                                        Please Enter Lindedin Link!
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="facebook_url">Facebook Profile</label>
                                                    <input type="text" class="form-control" name="facebook_url" id="facebook_url" value="{{ $teamRecord->facebook_url}}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Facebook Page Url!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="instagram_url">Instagram Profile </label>
                                                    <input type="text" class="form-control" name="instagram_url" id="instagram_url" value="{{ $teamRecord->instagram_url}}">
                                                   
                                                    <div class="invalid-feedback">
                                                        Please Enter Instagram Link!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="about">Enter About Member</label>
                                                    <textarea class="form-control" id="about" name="about">{{ $teamRecord->about}}</textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter something about Member.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Enter Team Member Image</label>
                                                    <span class="text-small text-danger">( Image size must be 600 x
                                                    600 px )</span>
                                                    <input type="file" class="form-control image-check" name="team_image" id="meta_title" data-height="600" data-width="600">
                                                    <input type="hidden" name="team_old_image" value="{{ $teamRecord->team_image}}" required>
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Enter Member Image.
                                                    </div>
                                                    <a href="{{ asset('storage/uploads/'.$teamRecord->team_image) }}" target="_blank">view image</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-control" id="statusa" name="status" required>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Status.
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
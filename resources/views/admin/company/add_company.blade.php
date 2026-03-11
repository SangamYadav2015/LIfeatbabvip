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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add News</a></li>
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
                    <h4 class="card-title">Add News</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill News Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.companystore')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                       
                                      

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="company_name">Company Title</label>
                                                    <input type="text"  class="form-control" name="company_name" id="blog_title" required placeholder="Enter company  Title">
                                                    <div class="invalid-feedback">
                                                        Please Enter News Title!
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
<script src="{{asset('admin//libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
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
ClassicEditor.create(document.querySelector(".ckeditor-classic1"))
    .then(function (e) {
        e.ui.view.editable.element.style.height = "200px";
    })
    .catch(function (e) {
        console.error(e);
    });
    </script>
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
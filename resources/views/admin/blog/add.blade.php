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
                                    <form class="needs-validation" action="{{ route('admin.blogStore')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="category_id">Select Category</label>
                                                    <select  class="form-control" name="blog_category" id="blog_category" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($blogCategory as $category )
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                        @endforeach
                                                         </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Category!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_title">News Title</label>
                                                    <input type="text"  class="form-control" name="blog_title" id="blog_title" required placeholder="News Title">
                                                    <div class="invalid-feedback">
                                                        Please Enter News Title!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="statuscat">Status</label>
                                                    <select class="form-control" id="statuscat" name="status" required>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
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
                                                    <label class="form-label" for="blog_image">Choose News Image 1</label><span
                                                            class="text-small text-danger">( Image size must be 650 x
                                                            400 px )</span>
                                                    <input type="file"  class="form-control image-check" name="blog_image1" id="blog_image1" required data-height="400"
                                                    data-width="650">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Select Image!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image1_alt">News Image 1 Alt</label>
                                                    <input type="text"  class="form-control" name="image1_alt" id="image1_alt" placeholder="News Title">
                                                    <div class="invalid-feedback">
                                                        Please Enter News Image 1 Alt!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_image2">Choose News Image 2</label><span
                                                            class="text-small text-danger">( Image size must be 1059 x
                                                            453 px )</span>
                                                    <input type="file"  class="form-control image-check" name="blog_image2" id="blog_image2" required data-height="453"
                                                    data-width="1059">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Select Image 2!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image2_alt">News Image 1 Alt</label>
                                                    <input type="text"  class="form-control" name="image2_alt" id="image2_alt" placeholder="News Title">
                                                    <div class="invalid-feedback">
                                                        Please Enter News Image 2 Alt!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_image3">Choose News Image 3</label><span
                                                            class="text-small text-danger">( Image size must be 1059 x
                                                            453 px )</span>
                                                    <input type="file"  class="form-control image-check" name="blog_image3" id="blog_image3" required data-height="453"
                                                    data-width="1059">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Select Image 3!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="image3_alt">News Image 1 Alt</label>
                                                    <input type="text"  class="form-control" name="image3_alt" id="image3_alt" placeholder="News Title">
                                                    <div class="invalid-feedback">
                                                        Please Enter News Image 2 Alt!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_short_details1">News Short Description 1</label>
                                                    <textarea class="form-control" id="blog_short_details1" name="blog_short_details1" required placeholder="News Short Description" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter News Short Description.
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_short_details2">News Short Description 2</label>
                                                    <textarea class="form-control" id="blog_short_details2" name="blog_short_details2" required placeholder="News Short Description 2" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter News Short Description 2.
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_details1">News Description 1</label>
                                                    <textarea class="form-control ckeditor-classic" id="blog_details1" name="blog_details1" placeholder="News Description" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter News Description 1.
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="blog_details2">News Description 2</label>
                                                    <textarea class="form-control ckeditor-classic1" id="blog_details2" name="blog_details2" placeholder="News Description 2" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter News Description 2.
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
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Career Settings</a></li>
                        <li class="breadcrumb-item active">Add Career Setting</li>
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
                    <h4 class="card-title">Add Career Setting</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('admin.carrerstore') }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" required placeholder="Title">
                                    <div class="invalid-feedback">Please enter the title!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="subtitle">Subtitle</label>
                                    <input type="text" class="form-control" name="subtitle" id="subtitle" required placeholder="Subtitle">
                                    <div class="invalid-feedback">Please enter the subtitle!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required placeholder="Name">
                                    <div class="invalid-feedback">Please enter the name!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="designation">Designation</label>
                                    <input type="text" class="form-control" name="designation" id="designation" required placeholder="Designation">
                                    <div class="invalid-feedback">Please enter the designation!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="icon_image">Icon Image (Multi Image)</label>
                                    <input type="file" class="form-control" name="icon_image[]" id="icon_image" accept="image/*" multiple>
                                    <div class="invalid-feedback">Please select icon images!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="base_heading">Base Heading</label>
                                    <input type="text" class="form-control" name="base_heading" id="base_heading" required placeholder="Base Heading">
                                    <div class="invalid-feedback">Please enter the base heading!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="base_icon">Base Icon (Multi Image)</label>
                                    <input type="file" class="form-control" name="base_icon[]" id="base_icon" accept="image/*" multiple>
                                    <div class="invalid-feedback">Please select base icon images!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="base_icon">Logo</label>
                                    <input type="file" class="form-control" name="logo" id="logo">
                                    <div class="invalid-feedback">Please select logo images!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="right_heading">Right Heading</label>
                                    <input type="text" class="form-control" name="right_heading" id="right_heading" required placeholder="Right Heading">
                                    <div class="invalid-feedback">Please enter the right heading!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="right_sub_heading">Right Sub Heading</label>
                                    <input type="text" class="form-control" name="right_sub_heading" id="right_sub_heading" placeholder="Right Sub Heading">
                                    <div class="invalid-feedback">Please enter the right sub-heading!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">Please select status!</div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
            var $parentDiv = $(fileInput).closest('.mb-3'); 

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

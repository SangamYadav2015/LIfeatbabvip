@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add Terms and Conditions</a></li>
                        <li class="breadcrumb-item active">Welcome</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Terms and Conditions</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <form class="needs-validation" action="{{ route('admin.terms.store') }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="title">Terms Title</label>
                                            <input type="text" class="form-control" name="title" id="title" required placeholder="Enter terms title">
                                            <div class="invalid-feedback">
                                                Please enter the title of the terms and conditions!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Content (Text Editor) -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="content">Terms Content</label>
                                            <textarea class="form-control ckeditor-classic" id="content" name="content" required placeholder="Enter terms and conditions content"></textarea>
                                            <div class="invalid-feedback">
                                                Please enter the content for the terms and conditions!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               

                                <!-- Submit Button -->
                                <button class="btn btn-primary" type="submit">Submit Data</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End card body -->
            </div>
            <!-- End card -->
        </div>
        <!-- End col -->
    </div>

</div>
<!-- Container-fluid -->

<script src="{{ asset('admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script>
    ClassicEditor.create(document.querySelector(".ckeditor-classic"))
        .then(function(editor) {
            editor.ui.view.editable.element.style.height = "200px";
        })
        .catch(function(error) {
            console.error(error);
        });
</script>
@endsection

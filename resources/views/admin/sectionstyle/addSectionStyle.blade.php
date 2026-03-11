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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Section Style</a></li>
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
                        <h4 class="card-title">Add Section Style</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Fill Section Style Data</h4>
                                        <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" action="{{ route('admin.storeSectionStyleName')}}" method="post" novalidate  autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="section_id">First name</label>
                                                        <select class="form-control" id="section_id" name="section_id" required>
                                                            <option value="">Select Section</option>
                                                            @foreach ($sectionData as $secion)
                                                            <option value="{{ $secion->id }}">{{ $secion->section_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please Select Section First!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="section_style_name">Section Style Name</label>
                                                        <select class="form-control" name="section_style_name" id="section_style_name" required>
                                                        <option value="">Select Section Style</option>
                                                          @for ($i = 1; $i <= 42; $i++)
                                                            @php
                                                            $style="Style $i" ;
                                                            @endphp
                                                            <option value="{{ $style }}" >{{ $style }}</option>
                                                            @endfor
                                                        </select>
                                                        <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">Selected section style already exists.</small>
                                                        <div class="invalid-feedback">
                                                            Please Select Section Style Name!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="mb-3 col-md-6">
                                                        <label class="form-label col-md-12" for="preview_image">Preview Image</label>
                                                         <input type="file" class="form-control image-check" id="preview_image" name="preview_image">
                                                   </div>
                                                 </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="fileData">Html Form Data</label>
                                                        <textarea id="fileData" name="fileData" class="form-control"></textarea>
                                                        <div class="invalid-feedback">
                                                            Please Enter Form HTML.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="mb-3">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-control" id="statusa" name="status" required>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
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
<!-- <script src="{{asset('admin//libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script>
ClassicEditor.create(document.querySelector(".ckeditor-classic"))
    .then(function (e) {
        e.ui.view.editable.element.style.height = "200px";
    })
    .catch(function (e) {
        console.error(e);
    });
    </script> -->
<script>
    $(document).ready(function() {
        $('#section_style_name, #section_id').on('change', function() {
            var sectionStyleName = $(this).val();
            var sectionId = $('#section_id').val();
            $.ajax({
                url: '{{ route("admin.checkSectionStyleName") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    section_style_name: sectionStyleName,
                    section_id: sectionId,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#section_style_name').val('');
                    } else {
                        $('#nameExistsMessage').hide();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
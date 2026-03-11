@extends('admin.layout.app')
<style>
    /* CSS for loader */
    .loader {
        border: 4px solid rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        border-top: 4px solid #3498db;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        /* Initially hidden */
        z-index: 100000000000000000000000000;
        background: #615252;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@section('content')
<div id="loader" class="loader"></div>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add {{ $pageData->menu->title }} Page Section </a></li>
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
                    <h4 class="card-title">Add {{ $pageData->menu->title }} Page Section</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill {{ $pageData->menu->title }} Page Section Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.pageSectionStore', ['id' => $id ?? '']) }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data" id="add-page-section">
                                        @csrf
                                        <textarea name="html_content" id="html_content" placeholder="HTML Content" required style="display:none !important;"></textarea>
                                        <input type="hidden" value="{{ $pageData->id }}" name="page_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="section_id">Select Section</label>
                                                    <select class="form-control" id="section_id" name="section_id" required>
                                                        <option value="">Select Parent Menu</option>
                                                        @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Section!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="section_style_id">Select Section Style</label>
                                                    <select class="form-control" id="section_style_id" name="section_style_id" required>
                                                        <option value="">Select Section Style</option>
                                                    </select>
                                                    <div id="section-style-message"></div>

                                                    <div id="preview-image" style="display: none;">
                                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="previewImage()"><i class="fa fa-eye"></i>Preview style</a>

                                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen" id="modal-img-preview" style="display: none;">hidebuttonmodal</button>
                                                    </div>

                                                    <div class="invalid-feedback">
                                                        Please Select Section Style!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dynamic-style-form"></div>
                                        <div class="row">
                                            <div class="col-md-6">
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

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Sorting ID</label>
                                                    <input type="text" class="form-control" id="sort_id" name="sort_id" required readonly value="{{ $sortingId }}">

                                                    <div class="invalid-feedback">
                                                        Please Select Status.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="button" id="submitFrm">Submit Data</button>
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
<div id="exampleModalFullscreen" class="modal fade" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFullscreenLabel">Section Style Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="image-previewsection">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="{{asset('admin/js/pages/form-validation.init.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#section_id').on('change', function() {
            var sectionId = $(this).val();
            $.ajax({
                url: '{{ route("admin.dynamicSectionStyle") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    section_id: sectionId,
                },
                success: function(response) {
                    // JSON response is automatically parsed if dataType is 'json'
                    if (response.message) {
                        $('#section-style-message').html('<span class="text-danger text-bold" style="color:red">' + response.message + '</span>');
                    } else {
                        var stylesHtml = '<option value="">Select Section Style</option>';
                        $.each(response, function(index, style) {
                            stylesHtml += '<option value="' + style.style_id + '">' + style.style_name + '</option>';
                        });
                        $('#section_style_id').html(stylesHtml); // Update options
                        $('#section-style-message').empty(); // Clear any error message
                    }
                },
                error: function(xhr) {
                    $('#section_style_id').html('<option value="">Select Section Style</option>'); // Clear existing options
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#section_id, #section_style_id').on('change', function() {
            var sectionId = $("#section_id").val();
            var sectionStyleId = $("#section_style_id").val();
            $("#preview-image").hide();
            if (sectionId !== '' && sectionStyleId !== '') {
                $('#submitFrm').attr('disabled', true)

                $('#loader').show();
                $.ajax({
                    url: '{{ route("admin.secionDynamicForm") }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        section_id: sectionId,
                        section_style_id: sectionStyleId,
                    },
                    success: function(response) {
                        if (response.message) {
                            $("#dynamic-style-form").html('<h3 style="color:red;">' + response.message + '</h3>');
                        } else {
                            $("#dynamic-style-form").html(response.file_content);
                            $("#preview-image").show();
                            $('#submitFrm').attr('disabled', false)
                        }
                        $('#loader').hide();

                    },
                    error: function(xhr) {
                        $('#dynamic-style-form').html('<h3 style="color:red;"> Error Form Loading</h3>');
                        $('#loader').hide();

                    }
                });
            }

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#submitFrm').on('click', function() {
            var form = document.getElementById('add-page-section');
            var $div = $('#dynamic-style-form');

            $div.find('input, textarea, select').each(function() {
                var $element = $(this);

                if ($element.is('input[type="text"]') || $element.is('textarea') || $element.is('input[type="number"]')) {
                    $element.attr('value', $element.val());
                }

                if ($element.is('input[type="radio"]')) {
                    $element.prop('checked', $element.is(':checked'));
                }

                if ($element.is('select')) {
                    $element.find('option').each(function() {
                        var $option = $(this);
                        if ($option.is(':selected')) {
                            $option.attr('selected', 'selected');
                        } else {
                            $option.removeAttr('selected');
                        }
                    });
                }
            });

            var divHtml = $div.html();
            $('#html_content').val(divHtml);
            // $(this).prop('disabled', true);

            if (form.checkValidity()) {
                form.submit();
            } else {
                form.classList.add('was-validated');
            }
        });
    });
</script>
<script>
    function previewImage() {
        var sectionId = $("#section_id").val();
        var sectionStyleId = $("#section_style_id").val();

        if (sectionId !== '' && sectionStyleId !== '') {

            $('#loader').show();
            $.ajax({
                url: '{{ route("admin.styleImagePreview") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    section_id: sectionId,
                    section_style_id: sectionStyleId,
                },
                success: function(response) {
                    if (response.message) {
                        $("#image-previewsection").html("<h3>" + response.message + "</h3>");
                        $("#modal-img-preview").trigger('click');

                    } else {

                        var imageUrl = "{{ asset('storage/uploads/style-preview/') }}/" + response.image_preview;
                        $("#image-previewsection").html("<img src='" + imageUrl + "' style='width:100%'> <p class='mt-2 text-center'><a class='btn btn-primary' href='" + imageUrl + "' target='_blank'>Open new tab</a></p>");
                        $("#modal-img-preview").trigger('click');
                    }
                    $('#loader').hide();

                },
                error: function(xhr) {
                    $('#loader').hide();

                }
            });
        }

    }
</script>

@endsection
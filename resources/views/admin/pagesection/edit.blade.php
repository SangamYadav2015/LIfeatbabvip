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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit {{ $pageData->menu->title }} Page Section </a></li>
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
                    <h4 class="card-title">Edit {{ $pageData->menu->title }} Page Section</h4>

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
                                    <form class="needs-validation" action="{{ route('admin.pageSectionStore', [$SectionDataPage->id])}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data" id="add-page-section">
                                        @csrf
                                        <!-- for set edit old value check with json data if yo adding new section and new form kindly also update here the code-->
                                        @php
                                        $bannerBGImageOld = checkBannerBGImage($SectionDataPage->page_section_data);
                                        $bannerImageOld = checkBannerImage($SectionDataPage->page_section_data);
                                        $bannerImage1Old = checkBanner1Image($SectionDataPage->page_section_data);
                                        $bannerImage2Old = checkBanner2Image($SectionDataPage->page_section_data);
                                        $bannerImage3Old = checkBanner3Image($SectionDataPage->page_section_data);
                                        $topCLientOld = checkTopClientImage($SectionDataPage->page_section_data);
                                        $clientReviewOld = checkClientReview($SectionDataPage->page_section_data);
                                        $imageOld = getPageDataDecode($SectionDataPage->page_section_data, 'image');
                                        $serviceImageIconOld = getPageDataDecode($SectionDataPage->page_section_data, 'service_data');
                                        $stepDataOld = getPageDataDecode($SectionDataPage->page_section_data, 'step_data');
                                        $stepDataOld = getPageDataDecode($SectionDataPage->page_section_data, 'step_data');
                                        $leftIconDataOld = getPageDataDecode($SectionDataPage->page_section_data, 'left_icon');
                                        $rightIconDataOld = getPageDataDecode($SectionDataPage->page_section_data, 'right_icon');
                                        $tabDataOld = getPageDataDecode($SectionDataPage->page_section_data, 'tab_data');
                                        $imageOldStyleservice = getPageDataDecode($SectionDataPage->page_section_data, 'icon_image');
                                        $image1Old = getPageDataDecode($SectionDataPage->page_section_data, 'image1');
                                        $image2Old = getPageDataDecode($SectionDataPage->page_section_data, 'image2');
                                        $image3Old = getPageDataDecode($SectionDataPage->page_section_data, 'image3');
                                        $image4Old = getPageDataDecode($SectionDataPage->page_section_data, 'image4');
                                        $image5Old = getPageDataDecode($SectionDataPage->page_section_data, 'image5');
                                        $sectionID = getPageDataDecode($SectionDataPage->page_section_data, 'section_id');
                                        $content = getPageDataDecode($SectionDataPage->page_section_data, 'content');

                                        @endphp

                                        @if( $imageOldStyleservice !== null)
                                        <input type="hidden" name="icon_image_old" value="{{ $imageOldStyleservice }}">
                                        @endif
                                        @if( $bannerBGImageOld !== null)
                                        <input type="hidden" name="banner_bg_image_old" value="{{ $bannerBGImageOld }}">
                                        @endif


                                        @if( $bannerImageOld !== null)
                                        <input type="hidden" name="banner_image_old" value="{{ $bannerImageOld }}">
                                        @endif

                                        @if( $bannerImage1Old !== null)
                                        <input type="hidden" name="banner_image1_old" value="{{ $bannerImage1Old }}">
                                        @endif

                                        @if( $bannerImage2Old !== null)
                                        <input type="hidden" name="banner_image2_old" value="{{ $bannerImage2Old }}">
                                        @endif

                                        @if( $bannerImage3Old !== null)
                                        <input type="hidden" name="banner_image3_old" value="{{ $bannerImage3Old }}">
                                        @endif

                                        @if($topCLientOld)

                                        @foreach ($topCLientOld as $topdata)
                                        <input type="hidden" name="top_client_image_old[]" value="{{ $topdata['top_client_image'] }}">
                                        @endforeach
                                        @endif

                                        @if($clientReviewOld !== null)
                                        @foreach ($clientReviewOld as $item)
                                        <input type="hidden" name="client_review_image_old[]" value="{{ $item['image'] }}">
                                        @if(isset($item['step_image']))
                                        <input type="hidden" name="step_image_old[]" value="{{ $item['step_image'] }}">
                                        @endif
                                        @endforeach
                                        @endif

                                        @if($imageOld !== null)
                                        <input type="hidden" name="image_old" value="{{ $imageOld }}">
                                        @endif

                                        @if($serviceImageIconOld !== null)
                                        @foreach ($serviceImageIconOld as $item)
                                        <input type="hidden" name="service_image_icon_old[]" value="{{ $item['service_image_icon'] }}">

                                         @if( $item['step_image_icon'])
                                        <input type="hidden" name="step_image_icon_old[]" value="{{ $item['step_image_icon_old'] }}">
                                        @endif
                                        @endforeach
                                        @endif

                                        @if($stepDataOld !== null)
                                        @foreach ($stepDataOld as $item)
                                        @if(isset($item['step_image']))
                                        <input type="hidden" name="step_image_old[]" value="{{ $item['step_image'] }}">
                                        @endif
                                          @if(isset($item['step_image_icon']))
                                        <input type="hidden" name="step_image_icon_old[]" value="{{ $item['step_image_icon'] }}">
                                        @endif
                                        @endforeach
                                        @endif

                                        @if($tabDataOld !== null)
                                        @foreach ($tabDataOld as $item)
                                        @if(isset($item['tab_image']))
                                        <input type="hidden" name="tab_image_old[]" value="{{ $item['tab_image'] }}">
                                        @endif

                                        @if(isset($item['step_image_icon']))
                                        <input type="hidden" name="step_image_icon_old[]" value="{{ $item['step_image_icon'] }}">
                                        @endif
                                        @endforeach
                                        @endif

                                        @if( $image1Old !== null)
                                        <input type="hidden" name="image1_old" value="{{ $image1Old }}">
                                        @endif
                                        @if( $image2Old !== null)
                                        <input type="hidden" name="image2_old" value="{{ $image2Old }}">
                                        @endif
                                        @if( $image3Old !== null)
                                        <input type="hidden" name="image3_old" value="{{ $image3Old }}">
                                        @endif

                                        @if( $image4Old !== null)
                                        <input type="hidden" name="image4_old" value="{{ $image4Old }}">
                                        @endif
                                        @if( $image5Old !== null)
                                        <input type="hidden" name="image5_old" value="{{ $image5Old }}">
                                        @endif


                                        @if($rightIconDataOld)

                                        @foreach ($rightIconDataOld as $rightIcon)
                                        <input type="hidden" name="right_image_icon_old[]" value="{{ $rightIcon['right_image_icon'] }}">
                                        @endforeach
                                        @endif

                                        @if($leftIconDataOld)

                                        @foreach ($leftIconDataOld as $leftIcon)
                                        <input type="hidden" name="left_image_icon_old[]" value="{{ $leftIcon['left_image_icon'] }}">
                                        @endforeach
                                        @endif
                                        <!-- for set edit old value check with json data if yo adding new section and new form kindly also update here the code-->

                                        <textarea name="html_content" id="html_content" placeholder="HTML Content" required value="{{ $SectionDataPage->html_content }}" style="display:none !important;">{{ $SectionDataPage->html_content }}</textarea>
                                        <input type="hidden" value="{{ $pageData->id }}" name="page_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="section_id">Select Section</label>
                                                    <select class="form-control" id="section_id" name="section_id" required>
                                                        <option value="">Select Parent Menu</option>
                                                        @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}" {{ $section->id === $SectionDataPage->section_id ? 'selected' : ''}}>{{ $section->section_name }}</option>
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
                                                    <div id="preview-image">
                                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="previewImage()"><i class="fa fa-eye"></i>Preview style</a>

                                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen" id="modal-img-preview" style="display: none;">hidebuttonmodal</button>
                                                    </div>
                                                    <div id="section-style-message"></div>
                                                    <div class="invalid-feedback">
                                                        Please Select Section Style!
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div id="dynamic-style-form">{!! $SectionDataPage->html_content !!} </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-control" id="statusa" name="status" required>
                                                        <option value="1" {{ $SectionDataPage->status === 'active' ? 'selected' : ''}}>Active</option>
                                                        <option value="0" {{ $SectionDataPage->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Status.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Sorting ID</label>
                                                    <input type="text" class="form-control" id="sort_id" name="sort_id" required readonly value="{{ $SectionDataPage->sort_id }}">

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
                        var sectionStyleId = "{{ $SectionDataPage->section_style_id }}"; // Get the section_style_id from Blade

                        var stylesHtml = '<option value="">Select Section Style</option>';
                        $.each(response, function(index, style) {
                            var selectedItem = '';
                            if (style.style_id == sectionStyleId) {
                                selectedItem = 'selected';
                            }
                            stylesHtml += '<option value="' + style.style_id + '" ' + selectedItem + '>' + style.style_name + '</option>';
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
        $('#section_id').trigger('change');

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
    $(document).ready(function() {
        $('textarea').each(function(index) {
            $(this).val($(this).attr('value'));
        });
        $('.img-alert').html('');
        $('.image-check').removeAttr('required');
    })
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
                        $("#image-previewsection").html("<img src='" + imageUrl + "' style='width:100%'> <p class='mt-2 text-center'><a href='" + imageUrl + "' target='_blank' class='btn btn-primary'>Open new tab</a></p>");
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
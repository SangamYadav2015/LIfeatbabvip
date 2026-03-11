@extends('admin.layout.app')
@php
$decodeData=[];
@endphp
@section('content')
@if(!empty($blogSetting))
@php
$decodeData =decodeData($blogSetting->setting_data);
@endphp
@endif
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">News Setting</a></li>
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
                    <h4 class="card-title">Manage News Setting</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <form class="needs-validation" action="{{ route('admin.saveBlogSetting') }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="setting_type" value="news_setting">
                                <input type="hidden" name="news_logo_old" value="{{ !empty($blogSetting) ? $decodeData['news_logo'] : '' }}">
                                <input type="hidden" name="section1_bg_old" value="{{ !empty($blogSetting)? $decodeData['section1_bg'] : '' }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Fill news Setting Data</h4>
                                        <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="news_logo">News Logo</label>
                                                    <span class="text-small text-danger">( Image size must be 600 x
                                                    600 px )</span>
                                                    <input type="file" class="form-control image-check" name="news_logo" id="news_logo"  data-height="600" data-width="600">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose News Logo !
                                                    </div>
                                                    @if(!empty($blogSetting) && $decodeData['news_logo'] !== null)
                                                    <a href="{{  asset('storage/uploads/'.$decodeData['news_logo']) }}" target="_blank">view image</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="news_logo_alt">News Logo Alt Tag</label>
                                                    <input type="text" class="form-control" name="news_logo_alt" id="news_logo_alt" value="{{ !empty($blogSetting)?  $decodeData['news_logo_alt']: '' }}" placeholder="news Logo Alt Tag">
                                                    <div class="invalid-feedback">
                                                        Please Enter News Logo Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ !empty($blogSetting)? $decodeData['name'] : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="designation">Designation</label>
                                                    <input type="text" id="name" name="designation" class="form-control" placeholder="Designation" value="{{ !empty($blogSetting)? $decodeData['designation'] : '' }}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Designation !
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                               <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="description">Description</label>
                                                    <textarea class="form-control" name="description" id="description">{{ !empty($blogSetting)? $decodeData['description'] : '' }}</textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter News Description !
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                       

                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">News Section 1</h4>
                                                <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section1_title">Section 1 Title</label>
                                                            <input type="text" class="form-control" name="section1_title" id="section1_title" placeholder="Section 1 Title" value="{{ !empty($blogSetting)? $decodeData['section1_title'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 Title !
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section1_subtitle">Section 1 Subtitle</label>
                                                            <input type="text" class="form-control" name="section1_subtitle" id="section1_subtitle" placeholder="Section 1 Subtitle" value="{{ !empty($blogSetting)? $decodeData['section1_subtitle'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 Subtitle !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section1_bg">Section 1 BG Image</label>
                                                            <span class="text-small text-danger">( Image size must be 1440 x 376 px )</span>

                                                            <input type="file" class="form-control image-check" name="section1_bg" id="section1_bg" data-height="376" data-width="1440">
                                                            <div class="img-alert"></div>
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 BG Image !
                                                            </div>
                                                 @if(!empty($blogSetting) && $decodeData['section1_bg'] !== null)
                                                    <a href="{{  asset('storage/uploads/'.$decodeData['section1_bg']) }}" target="_blank">view image</a>
                                                    @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section1_tagline">Section 1 Tagline</label>
                                                            <input type="text" class="form-control" name="section1_tagline" id="section1_tagline" placeholder="Section 1 Tagline" value="{{ !empty($blogSetting)? $decodeData['section1_tagline'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 Tagline !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section1_description">Section 1 Description</label>
                                                            <textarea class="form-control" name="section1_description" id="section1_description" placeholder="Section 1 Description" >{{ !empty($blogSetting)? $decodeData['section1_description'] : '' }}</textarea>
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 Tagline !
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">News Section 2</h4>
                                                <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section2_title">Section 2 Title</label>
                                                            <input type="text" class="form-control" name="section2_title" id="section2_title" placeholder="Section 2 Title" value="{{ !empty($blogSetting)? $decodeData['section2_title'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 2 Title !
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section2_subtitle">Section 2 Subtitle</label>
                                                            <input type="text" class="form-control" name="section2_subtitle" id="section2_subtitle" placeholder="Section 2 Subtitle" value="{{ !empty($blogSetting)? $decodeData['section2_subtitle'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 2 Subtitle !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                 <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section2_button_text">Section 2 Button Text</label>
                                                            <input type="text" class="form-control" name="section2_button_text" id="section2_button_text" placeholder="Section 2  Button Text" value="{{ !empty($blogSetting)? $decodeData['section2_button_text'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 2  Button Text !
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section2_button_url">Section 2 Button Url</label>
                                                            <input type="text" class="form-control" name="section2_button_url" id="section2_button_url" placeholder="Section 2 Button URL" value="{{ !empty($blogSetting)? $decodeData['section2_button_url'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 Tagline !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">News Section 3</h4>
                                                <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_title">Section 3 Title</label>
                                                            <input type="text" class="form-control" name="section3_title" id="section3_title" placeholder="Section 3 Title" value="{{ !empty($blogSetting)? $decodeData['section3_title'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 3 Title !
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_subtitle">Section 3 Subtitle</label>
                                                            <input type="text" class="form-control" name="section3_subtitle" id="section3_subtitle" placeholder="Section 3 Subtitle" value="{{ !empty($blogSetting)? $decodeData['section3_subtitle'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 3 Subtitle !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                 <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_button_text">Section 3 Button Text</label>
                                                            <input type="text" class="form-control" name="section3_button_text" id="section3_button_text" placeholder="Section 3  Button Text" value="{{ !empty($blogSetting)? $decodeData['section3_button_text'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 2  Button Text !
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_button_url">Section 3 Button Url</label>
                                                            <input type="text" class="form-control" name="section3_button_url" id="section3_button_url" placeholder="Section 3 Button URL" value="{{ !empty($blogSetting)? $decodeData['section3_button_url'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 1 Tagline !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                 <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_video_button_text">Section 3 Video Button Text</label>
                                                            <input type="text" class="form-control" name="section3_video_button_text" id="section3_video_button_text" placeholder="Section 3 Video Button Text" value="{{ !empty($blogSetting)? $decodeData['section3_video_button_text'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 3 Video Button Text !
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_video_button_url">Section 3 Video Button URL</label>
                                                            <input type="text" class="form-control" name="section3_video_button_url" id="section3_video_button_url" placeholder="Section 3 Video Button URL" value="{{ !empty($blogSetting)? $decodeData['section3_video_button_url'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 3 Video Button URL !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_tagline">Section 3 Tagline</label>
                                                            <input type="text" class="form-control" name="section3_tagline" id="section3_tagline" placeholder="Section 3 Tagline" value="{{ !empty($blogSetting)? $decodeData['section3_tagline'] : '' }}">
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 3 Tagline !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="section3_description">Section 3 Description</label>
                                                            <textarea type="text" class="form-control" name="section3_description" id="section3_description" placeholder="Section 3 Description">{{ !empty($blogSetting)? $decodeData['section3_description'] : '' }}</textarea>
                                                            <div class="invalid-feedback">
                                                                Please Enter Section 3 Description !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <button class="btn btn-primary" type="submit">Submit Data</button>

                                            </div>
                                        </div>
                            </form>

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
@extends('admin.layout.app')

@section('content')
@if(!empty($footerSetting))
@php
$decodeData =decodeData($footerSetting->setting_data);
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Footer Setting</a></li>
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
                    <h4 class="card-title">Manage Footer Setting</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <form class="needs-validation" action="{{ route('admin.saveFooterSetting')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="setting_type" value="footer_setting">
                                <input type="hidden" name="footer_logo_old" value="{{ !empty($footerSetting)? $decodeData['footer_logo'] : '' }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Fill Footer Setting Data</h4>
                                        <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="footer_logo">Footer Logo</label>
                                                    <span class="text-small text-danger">( Image size must be 120 x
                                                    60 px )</span>
                                                    <input type="file" class="form-control image-check" name="footer_logo" id="footer_logo" data-height="60" data-width="120">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Footer Logo !
                                                    </div>
                                                    @if(!empty($footerSetting) && $decodeData['footer_logo'])
                                                    <a href="{{  asset('storage/uploads/'.$decodeData['footer_logo']) }}" target="_blank">view footer logo</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="footer_logo_alt">Footer Logo Alt Tag</label>
                                                    <input type="text" class="form-control" name="footer_logo_alt" id="footer_logo_alt" value="{{ !empty($footerSetting)?  $decodeData['footer_logo_alt']: '' }}" placeholder="Footer Logo Alt Tag">
                                                    <div class="invalid-feedback">
                                                        Please Enter Site Logo Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="rating_title">Footer Rating Title</label>
                                                    <input type="text" id="footer_tag_line" name="rating_title" class="form-control" placeholder="Rating Title" value="{{ !empty($footerSetting)? $decodeData['rating_title'] : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="rating">Footer Rating</label>
                                                    <select class="form-control" name="rating" id="rating">
                                                        <option value="1" {{ !empty($footerSetting) && $decodeData['rating'] =='1' ? 'selected' : '' }}>1</option>
                                                        <option value="2" {{ !empty($footerSetting) && $decodeData['rating'] =='2' ? 'selected' : '' }}>2</option>
                                                        <option value="3" {{ !empty($footerSetting) && $decodeData['rating'] =='3' ? 'selected' : '' }}>3</option>
                                                        <option value="4" {{ !empty($footerSetting) && $decodeData['rating'] =='4' ? 'selected' : '' }}>4</option>
                                                        <option value="5" {{ !empty($footerSetting) && $decodeData['rating'] =='5' ? 'selected' : '' }}>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                               <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="footer_type">Footer Type</label>
                                                    <select class="form-control" name="footer_type" id="footer_type">
                                                        <option value="light" {{ !empty($footerSetting) && $decodeData['footer_type'] =='light' ? 'selected' : '' }}>Light</option>
                                                        <option value="dark" {{ !empty($footerSetting) && $decodeData['footer_type'] =='dark' ? 'selected' : '' }}>Dark</option>
                                                        </select>
                                                    <div class="invalid-feedback">
                                                        Please Enter Site URL !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="footer_tag_line">Footer Tag Line</label>
                                                    <input type="text" id="footer_tag_line" name="footer_tag_line" class="form-control" placeholder="Footer Tag Line" value="{{ !empty($footerSetting)? $decodeData['footer_tag_line'] : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="footer_description">Footer Section Description</label>
                                                    <textarea  id="footer_description" name="footer_description" class="form-control" placeholder="Footer Section Description">{{ !empty($footerSetting)? $decodeData['footer_description'] : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                 <button class="btn btn-primary" type="submit">Submit Data</button>
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
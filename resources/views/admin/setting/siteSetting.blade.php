@extends('admin.layout.app')

@section('content')
@if(!empty($siteSetting))
@php
$decodeData =decodeData($siteSetting->setting_data);
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Site Setting</a></li>
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
                    <h4 class="card-title">Manage Site Setting</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <form class="needs-validation" action="{{ route('admin.saveSiteSetting')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="setting_type" value="site_setting">
                                <input type="hidden" name="site_logo_old" value="{{ !empty($siteSetting)? $decodeData['site_logo'] : '' }}">
                                <input type="hidden" name="site_favicon_old" value="{{ !empty($siteSetting)? $decodeData['site_favicon'] : '' }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Fill Site Setting Data</h4>
                                        <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                    </div>
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="site_url">Site Url</label>
                                                    <input type="text" class="form-control" name="site_url" id="site_url" required readonly value="{{ config('app.url') }}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Site URL !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="page_is_home">Default Home Page</label>
                                                    <select class="form-control" id="page_is_home" name="page_is_home" required>
                                                        <option value="0">Select Default Home Page</option>
                                                       @foreach($pageList as $page )
                                                        <option value="{{ $page->id }}" {{ !empty($siteSetting) && ($decodeData['page_is_home'] == $page->id) ? 'selected' : '' }}>{{ $page->menu->title }}</option>
                                                        @endforeach
                                                      
                                                    </select>
                                                    <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">Menu page already exists.</small>
                                                    <div class="invalid-feedback">
                                                        Please Select Default Home Page!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="navigation_type">Navigation Type</label>
                                                    <select class="form-control" name="navigation_type" id="navigation_type">
                                                        <option value="light" {{ !empty($siteSetting) && $decodeData['navigation_type'] == 'light' ? 'selected' : '' }}>Light</option>
                                                        <option value="dark" {{ !empty($siteSetting) && $decodeData['navigation_type'] == 'dark' ? 'selected' : '' }}>Dark</option>
                                                        </select>
                                                    <div class="invalid-feedback">
                                                        Please Enter Site URL !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="site_favicon">Site Favicon Icon</label>
                                                    <span class="text-small text-danger">( Image size must be 80 x
                                                    80 px )</span>
                                                    <input type="file" class="form-control image-check" name="site_favicon" id="site_favicon" data-height="80" data-width="80">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Site Favicon Icon !
                                                    </div>
                                                    @if(!empty($siteSetting) && $decodeData['site_favicon'])
                                                    <a href="{{  asset('storage/uploads/'.$decodeData['site_favicon']) }}" target="_blank">view fav icon</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="site_logo">Site Logo</label>
                                                    <span class="text-small text-danger">( Image size must be 120 x
                                                    60 px )</span>
                                                    <input type="file" class="form-control image-check" name="site_logo" id="site_logo" data-height="60" data-width="120">
                                                    <div class="img-alert"></div>
                                                    <div class="invalid-feedback">
                                                        Please Choose Site Logo !
                                                    </div>
                                                    @if(!empty($siteSetting) && $decodeData['site_logo'])
                                                    <a href="{{  asset('storage/uploads/'.$decodeData['site_logo']) }}" target="_blank">view site logo</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="site_logo_alt">Site Logo Alt Tag</label>
                                                    <input type="text" class="form-control" name="site_logo_alt" id="site_logo_alt" value="{{ !empty($siteSetting)?  $decodeData['site_logo_alt']: '' }}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Site Logo Alt Tag!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="header_script">Header Script</label>
                                                    <textarea id="header_script" name="header_script" class="form-control" placeholder="Header Script (External script with script tag)">{{ !empty($siteSetting)? $decodeData['header_script'] : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="footer_script">Footer Script</label>
                                                    <textarea id="footer_script" name="footer_script" class="form-control" placeholder="Footer Script (External script with script tag)">{{ !empty($siteSetting)? $decodeData['footer_script'] : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Social Media Link</h4>
                                            <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="facebook_page_url">Facebook Page Url</label>
                                                        <input type="text" class="form-control" name="facebook_page_url" id="facebook_page_url" placeholder="Facebook Page Url" value="{{ !empty($siteSetting)? $decodeData['facebook_page_url'] : '' }}">
                                                        <div class="invalid-feedback">
                                                            Please Enter Facebook Page Url !
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="instagram_page_url">Instagram Page Url</label>
                                                        <input type="text" class="form-control" name="instagram_page_url" id="instagram_page_url" placeholder="Instagram Page Url" value="{{ !empty($siteSetting)? $decodeData['instagram_page_url'] : '' }}">
                                                        <div class="invalid-feedback">
                                                            Please Enter Instagram Page Url!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="linkdin_page_url">Linkdin Page Url</label>
                                                        <input type="text" class="form-control" name="linkdin_page_url" id="linkdin_page_url" placeholder="Linkdin Page Url" value="{{ !empty($siteSetting)? $decodeData['linkdin_page_url'] : '' }}">
                                                        <div class="invalid-feedback">
                                                            Please Enter Linkdin Page Url !
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>



                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Admin Login Setting</h4>
                                            <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="facebook_page_url">Admin Number of Login Attempt</label>
                                                        <input type="number" class="form-control" name="admin_number_of_login_attempt" id="admin_number_of_login_attempt"  value="{{ !empty($siteSetting) && isset($decodeData['admin_number_of_login_attempt'])?  $decodeData['admin_number_of_login_attempt'] : '' }}">
                                                       
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="instagram_page_url">Admin Login Attempt Duration(In Minute)</label>
                                                        <input type="number" class="form-control" name="admin_duration_login_attempt" id="admin_duration_login_attempt"  value="{{ !empty($siteSetting) && isset($decodeData['admin_duration_login_attempt'])?  $decodeData['admin_duration_login_attempt'] : '' }}">
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"> -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="linkdin_page_url">Admin Attempt Email Alert</label>
                                                        <input type="email" class="form-control" name="admin_attempt_email_alert" id="admin_attempt_email_alert" placeholder="Admin Attempt Email Alert" value="{{ !empty($siteSetting) && isset($decodeData['admin_attempt_email_alert'])?  $decodeData['admin_attempt_email_alert'] : '' }}">
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
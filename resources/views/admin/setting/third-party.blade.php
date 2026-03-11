@extends('admin.layout.app')

@section('content')
@if(!empty($thirdParty))
@php
$decodeData =decodeData($thirdParty->setting_data);
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Third Party Setting</a></li>
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
                    <h4 class="card-title">Manage Third Party Setting</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <form class="needs-validation" action="{{ route('admin.saveSetting')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="setting_type" value="third_party">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Fill Google key's Data</h4>
                                        <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                    </div>
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="captcha_key">Google Recaptcha key (Recaptcha Version 3)</label>
                                                    <input type="text" class="form-control" name="captcha_key" id="captcha_key"   value="{{ !empty($thirdParty) && $decodeData['captcha_key'] !== null ?  $decodeData['captcha_key']: '' }}" placeholder="Enter Google Recaptcha key !">
                                                    <div class="invalid-feedback">
                                                        Please Enter Recaptcha key !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="captcha_secret">Google Recaptcha Secret</label>
                                                    <input type="text" class="form-control" name="captcha_secret" id="captcha_secret" value="{{ !empty($thirdParty) && $decodeData['captcha_secret'] !== null ?  $decodeData['captcha_secret']: '' }}" placeholder="Enter Google Recaptcha Secret !">
                                                    <div class="invalid-feedback">
                                                        Please Enter Google Recaptcha Secret !
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="captcha_key">Google Auth key</label>
                                                    <input type="text" class="form-control" name="auth_key" id="auth_key" value="{{ !empty($thirdParty) && $decodeData['auth_key'] !== null ?  $decodeData['captcha_key']: '' }}" placeholder="Enter Google Auth key !">
                                                    <div class="invalid-feedback">
                                                        Please Enter Auth key !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="captcha_secret">Google Auth Secret</label>
                                                    <input type="text" class="form-control" name="auth_secret" id="auth_secret" value="{{ !empty($thirdParty) && $decodeData['auth_secret'] !== null ?  $decodeData['auth_secret']: '' }}" placeholder="Enter Google Recaptcha Secret !">
                                                    <div class="invalid-feedback">
                                                        Please Enter Google Auth Secret !
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit Data</button>
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

@endsection
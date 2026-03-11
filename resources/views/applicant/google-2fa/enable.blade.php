@extends('applicant.body.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Applicant Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Department List</a></li>
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
                    <h4 class="card-title">Google Two Step Authentication</h4>
                </div>
                <div class="card-body">
                       @if(Auth::guard('applicant')->user()->google2fa_enabled == false)
                    <div class="container">
                        <h2>Enable Two-Factor Authentication</h2>
                        <p>Scan the QR code below with your Google Authenticator app and enter the generated code to verify.</p>
                        <div class="row">
                            <div class="col-md-6">
                                {!! $QR_Image !!}
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('applicant.verify2fa') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="token">Enter Authenticator Code</label>
                                        <input type="text" name="token" id="token" class="form-control" required placeholder="Enter Authenticator Code">
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Enable 2FA</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="container">
                        <h2>Disable Two-Factor Authentication</h2>
                        <p>Disable your Google Authenticator app and enter the generated code to verify.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('applicant.disable2fa') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="token">2FA Token</label>
                                        <input type="text" name="token" id="token" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger mt-3">Disable 2FA</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>


<!-- container-fluid -->

@endsection
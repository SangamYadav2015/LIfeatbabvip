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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
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
                    <h4 class="card-title">Profile</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill User Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.updatePassword')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="current_password">Current Password</label>
                                                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter Password">
                                                    <small id="current_password_match" class="invalid-feedback" style="display: none;">Invalid Current Password (Not Match).</small>
                                                    <div class="invalid-feedback">
                                                        Please Enter Password!
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                                    <small id="passwordmatch" class="invalid-feedback" style="display: none;">Password Not Match.</small>
                                                    <div class="invalid-feedback">
                                                        Please Enter Password!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="cpassword">Confirm Password</label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Password">
                                                    <small id="cpasswordmatch" class="invalid-feedback" style="display: none;">Password Not Match.</small>
                                                    <div class="invalid-feedback">
                                                        Please Enter Password!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <button class="btn btn-primary" type="submit">Update Profile</button>
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
 <script>
    $(document).ready(function() {
        $('#current_password').on('change', function() {
            var currentPassword = $(this).val();
            $.ajax({
                url: '{{ route("admin.checkCurrentPassword") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    current_password: currentPassword,
                },
                success: function(response) {
                    if (response == 0) {
                        $('#current_password_match').hide();

                    } else {
                        $('#current_password_match').show();
                        $('#current_password').val('');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#cpassword').on('change', function() {
            var password = $('#password').val();
        var confirmPassword = $('#cpassword').val();

        if (confirmPassword === '') {
            $('#cpasswordmatch').text('Confirm Password cannot be blank.').show(); // Show the 'blank' error message
            $('#cpassword').addClass('is-invalid'); // Add 'is-invalid' class to Confirm Password field
        } else if (password !== confirmPassword) {
            $('#cpasswordmatch').text('Password does not match.').show(); // Show the 'Password Not Match' error message
            $('#cpassword').addClass('is-invalid'); // Add 'is-invalid' class to both fields
            $('#cpassword').val(''); // Add 'is-invalid' class to both fields
        } else {
            $('#cpasswordmatch').hide(); // Hide the error message
            $('#password, #cpassword').removeClass('is-invalid'); // Remove the 'is-invalid' class
        }
    });
});
</script>


@endsection
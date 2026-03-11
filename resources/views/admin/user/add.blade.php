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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add User</a></li>
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
                    <h4 class="card-title">Add User</h4>

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
                                    <form class="needs-validation" action="{{ route('admin.userStore')}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                         
                                        <div class="row">
                                        <div class="col-md-6">
                                                <label class="form-label" for="department_id">Select Department</label>
                                                <select class="form-control" required name="department_id" id="department_id">
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $department )
                                                    <option value="{{ $department->id }}">{{ $department->Department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="designation">Select Role</label>
                                                <select class="form-control" required name="designation" id="designation">
                                                    <option value="">Select Role</option>
                                                </select>
                                                <span id="style-message"></span>
                                            </div>
                                            </div>
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">Full Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" required placeholder="Enter Full Name">
                                                    <div class="invalid-feedback">
                                                        Please Enter Full Name!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email">Email ID</label>
                                                    <input type="email" class="form-control" name="email" id="email" required placeholder="Enter Email ID">
                                                    <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">Email ID already exists.</small>
                                                    <div class="invalid-feedback">
                                                        Please Enter Email ID!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="phone_number">Phone number</label>
                                                    <input type="text" class="form-control" name="phone_number" id="phone_number" required placeholder="Enter Phone number">
                                                    <div class="invalid-feedback">
                                                        Please Enter Phone number!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" required placeholder="Enter Password">
                                                    <small id="passwordmatch" class="invalid-feedback" style="display: none;">Password Not Match.</small>
                                                    <div class="invalid-feedback">
                                                        Please Enter Password!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="cpassword">Confirm Password</label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" required placeholder="Enter Password">
                                                    <small id="cpasswordmatch" class="invalid-feedback" style="display: none;">Password Not Match.</small>
                                                    <div class="invalid-feedback">
                                                        Please Enter Password!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="profile_image">User Image</label>
                                                    <input type="file" class="form-control" name="profile_image" id="profile_image" >
                                                    <div class="invalid-feedback">
                                                        Please Choose User Image!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="statusc">Select Status</label>
                                                    <select class="form-control" name="status" id="statusc" >
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                        </select>
                                                    <div class="invalid-feedback">
                                                        Please Choose User Image!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                    <div class="invalid-feedback">
                                                        Please Enter Address!
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
<script>
    $(document).ready(function() {
        $('#email').on('change', function() {
            var email = $(this).val();
            $.ajax({
                url: '{{ route("admin.checkEmail") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    email: email,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#email').val('');
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


<script>
    $(document).ready(function() {
        $('#department_id').on('change', function() {
            var departmentId = $(this).val();
            $.ajax({
                url: '{{ route("admin.getDynamicRole") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    department_id: departmentId,
                },
                success: function(response) {
                    // JSON response is automatically parsed if dataType is 'json'
                    if (response.message) {
                        $('#style-message').html('<span class="text-danger text-bold" style="color:red">' + response.message + '</span>');
                    } else {
                        var roleHtml = '<option value="">Select Section Style</option>';
                        $.each(response, function(index, role) {
                            roleHtml += '<option value="' + role.id + '">' + role.role_title + '</option>';
                        });
                        $('#designation').html(roleHtml); // Update options
                        $('#style-message').empty(); // Clear any error message
                    }
                },
                error: function(xhr) {
                    $('#designation').html('<option value="">Select Role</option>'); // Clear existing options
                }
            });
        });
    });
</script>
@endsection
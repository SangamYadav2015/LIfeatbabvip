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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add User Role</a></li>
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
                    <h4 class="card-title">Add User Role</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill User Role Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.roleStore')}}" method="post" novalidate autocomplete="off">
                                        @csrf
                                       
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="role_title">Select Department</label>
                                                    <select  class="form-control" name="department_id" id="department_id" required >
                                                        <option value="">Select Department</option>
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                    Select Department!
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="role_title">Role Name</label>
                                                    <input type="text" class="form-control" name="role_title" id="role_title" required placeholder="Enter Role Name">
                                                    <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">News category already exists.</small>

                                                    <div class="invalid-feedback">
                                                        Please Enter Role Name!
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                            <label class="form-label" for="statuscat">Select Role</label>
                                            <div class="row">
                                                <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_menu" name="role[]" value="manage_menu">
                                                        <label class="form-check-label" for="manage_menu">
                                                            Manage Menu
                                                        </label>
                                                    </div>
                                                    </div>
                                                    <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_section" name="role[]" value="manage_section">
                                                        <label class="form-check-label" for="manage_section">
                                                            Manage Section
                                                        </label>
                                                    </div>
                                                   </div>
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_section_style" name="role[]" value="manage_section_style">
                                                        <label class="form-check-label" for="manage_section_style">
                                                            Manage Section Style
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_pages" name="role[]" value="manage_pages">
                                                        <label class="form-check-label" for="manage_pages">
                                                            Manage Pages
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_user" name="role[]" value="manage_user">
                                                        <label class="form-check-label" for="manage_user">
                                                            Manage User
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_logs" name="role[]" value="manage_logs">
                                                        <label class="form-check-label" for="manage_logs">
                                                            Manage Logs
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_news" name="role[]" value="manage_news">
                                                        <label class="form-check-label" for="manage_news">
                                                            Manage News
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_help" name="role[]" value="manage_help">
                                                        <label class="form-check-label" for="manage_help">
                                                            Manage Help
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_news" name="role[]" value="manage_team">
                                                        <label class="form-check-label" for="manage_team">
                                                            Manage Team
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_enquery" name="role[]" value="manage_enquery">
                                                        <label class="form-check-label" for="manage_enquery">
                                                            Manage Enquery
                                                        </label>
                                                    </div>
                                                   </div>
                                                   
                                                    <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_career" name="role[]" value="manage_career">
                                                        <label class="form-check-label" for="manage_career">
                                                            Manage Career
                                                        </label>
                                                    </div>
                                                   </div>
                                                    <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_location" name="role[]" value="manage_location">
                                                        <label class="form-check-label" for="manage_location">
                                                            Manage Location
                                                        </label>
                                                    </div>
                                                   </div>
                                                   
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_terms" name="role[]" value="manage_terms">
                                                        <label class="form-check-label" for="manage_terms">
                                                            Manage Terms
                                                        </label>
                                                    </div>
                                                   </div>
                                                   
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="setting" name="role[]" value="setting">
                                                        <label class="form-check-label" for="setting">
                                                            Setting
                                                        </label>
                                                    </div>
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
        $('#role_title, #department_id').on('change', function() {
 if($("#role_title").val() !== '' && $("#department_id").val())
            var role_title = $("#role_title").val();
            var department_id = $("#department_id").val();
            $.ajax({
                url: '{{ route("admin.checkRole") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    role_title: role_title,
                    department_id: department_id,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#role_title').val('');
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
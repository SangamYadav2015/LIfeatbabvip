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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit User Role</a></li>
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
                    <h4 class="card-title">Edit User Role</h4>

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
                                    <form class="needs-validation" action="{{ route('admin.updateRole', ['num'=> $roleData->id])}}" method="post" novalidate autocomplete="off">
                                        @csrf
                                       
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="role_title">Select Department</label>
                                                    <select  class="form-control" name="department_id" id="department_id" required >
                                                        <option value="">Select Department</option>
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" {{ $department->id === $roleData->department_id ? 'selected' : ''}}>{{ $department->Department_name }}</option>
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
                                                    <input type="text" class="form-control" name="role_title" id="role_title" required placeholder="Enter Role Name" value="{{ $roleData->role_title }}">
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
                                                        <input class="form-check-input" type="checkbox" id="manage_menu" name="role[]" value="manage_menu"  {{ in_array('manage_menu', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_menu">
                                                            Manage Menu
                                                        </label>
                                                    </div>
                                                    </div>
                                                    <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_section" name="role[]" value="manage_section" {{ in_array('manage_section', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_section" >
                                                            Manage Section
                                                        </label>
                                                    </div>
                                                   </div>
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_section_style" name="role[]" value="manage_section_style" {{ in_array('manage_section_style', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_section_style">
                                                            Manage Section Style
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_pages" name="role[]" value="manage_pages" {{ in_array('manage_pages', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_pages" >
                                                            Manage Pages
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_user" name="role[]" value="manage_user" {{ in_array('manage_user', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_user">
                                                            Manage User
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_logs" name="role[]" value="manage_logs" {{ in_array('manage_logs', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_logs">
                                                            Manage Logs
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_news" name="role[]" value="manage_news" {{ in_array('manage_news', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_news">
                                                            Manage News
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_help" name="role[]" value="manage_help" {{ in_array('manage_help', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_help" >
                                                            Manage Help
                                                        </label>
                                                    </div>
                                                   </div>

                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_news" name="role[]" value="manage_team" {{ in_array('manage_team', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_team">
                                                            Manage Team
                                                        </label>
                                                    </div>
                                                   </div>
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_enquery" name="role[]" value="manage_enquery" {{ in_array('manage_enquery', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_enquery">
                                                            Manage Enquery
                                                        </label>
                                                    </div>
                                                   </div>
                                                   
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_career" name="role[]" value="manage_career" {{ in_array('manage_career', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_career">
                                                            Manage Career
                                                        </label>
                                                    </div>
                                                   </div>
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_location" name="role[]" value="manage_location" {{ in_array('manage_location', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_location">
                                                            Manage Location
                                                        </label>
                                                    </div>
                                                   </div>
                                                   
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="manage_terms" name="role[]" value="manage_terms" {{ in_array('manage_terms', $roleData->role) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="manage_terms">
                                                            Manage Terms&Condition
                                                        </label>
                                                    </div>
                                                   </div>
                                                   
                                                   <div class="mb-3 col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="setting" name="role[]" value="setting" {{ in_array('setting', $roleData->role) ? 'checked' : '' }}>
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
        $('#category_name').on('change', function() {
            var categoryName = $(this).val();
            $.ajax({
                url: '{{ route("admin.checkRole") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    category_name: categoryName,
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
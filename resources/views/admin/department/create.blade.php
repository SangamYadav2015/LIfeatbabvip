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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add Department</a></li>
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
                    <h4 class="card-title">Add Department</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill Department Data</h4>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('department.store') }}" method="post" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="department_name">Department Name</label>
                                                    <input type="text" class="form-control" name="Department_name" id="department_name" required placeholder="Enter Department Name">
                                                    <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">Department name already exists.</small>
                                                    <div class="invalid-feedback">
                                                        Please enter Department Name!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="department_image">Department Image</label>
                                                    <input type="file" class="form-control" name="department_image" id="department_image">
                                                    <div class="invalid-feedback">
                                                        Please upload Department Image!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="short_description">Short Description</label>
                                                    <textarea class="form-control" name="short_description" id="short_description" rows="3" required placeholder="Enter Short Description"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter Short Description!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select Status.
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
        $('#department_name').on('change', function() {
            var departmentName = $(this).val();
            $.ajax({
                url: '{{ route("admin.checkDepartmentName") }}', // Add a route for checking department name
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    department_name: departmentName,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#department_name').val('');
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

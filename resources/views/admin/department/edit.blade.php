@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome! To {{ Auth::user()->designation }} Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit User Role</a></li>
                        <li class="breadcrumb-item active">Welcome</li>
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
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.updateDepartment', ['num' => $department->id]) }}" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="department_name">Department Name</label>
                                                    <input type="text" class="form-control" name="Department_name" id="department_name" required placeholder="Enter Department Name" value="{{ $department->Department_name }}">
                                                    <div class="invalid-feedback">
                                                        Please enter department name!
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="short_description">Short Description</label>
                                                    <textarea class="form-control" name="short_description" id="short_description" required placeholder="Enter Short Description">{{ $department->short_description }}</textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter a short description!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="department_image">Department Image</label>
                                                    <input type="file" class="form-control" name="department_image" id="department_image">
                                                    <input type="hidden" name="department_image_old" value="{{ $department->department_image }}">
                                                    <div class="invalid-feedback">
                                                        Please upload a department image!
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

<script src="{{ asset('admin/js/pages/form-validation.init.js') }}"></script>

@endsection

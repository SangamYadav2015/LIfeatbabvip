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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Location</a></li>
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
                    <h4 class="card-title">Edit Location</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('locations.update', ['id' => $location->id]) }}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="location_name">Location Name</label>
                            <input type="text" class="form-control" name="location_name" id="location_name" required placeholder="Location Name" value="{{ old('location_name', $location->location_name) }}">
                            <div class="invalid-feedback">
                                Please enter a location name!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="location_slug">Location Slug</label>
                            <input type="text" class="form-control" name="location_slug" id="location_slug" required placeholder="Location Slug" value="{{ old('location_slug', $location->location_slug) }}">
                            <div class="invalid-feedback">
                                Please enter a location slug!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="short_description">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" placeholder="Short Description">{{ old('short_description', $location->short_description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="location_image">Location Image</label>
                            <span class="text-small text-danger">( Image size must be appropriate )</span>
                            <input type="file" class="form-control" name="location_image" id="location_image">
                            <input type="hidden" value="{{ $location->location_image }}" name="location_image_old">
                            <div class="img-alert"></div>
                            @if ($location->location_image)
                                <a href="{{ asset('storage/uploads/' . $location->location_image) }}" target="_blank">View Current Image</a>
                            @endif
                        </div>

                        <button class="btn btn-primary" type="submit">Update Location</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->
@endsection

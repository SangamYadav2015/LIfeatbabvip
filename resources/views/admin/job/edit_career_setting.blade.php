@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <h4>Edit Career Setting</h4>

    <form action="{{ route('admin.careerSettings.update', ['id' => $careerSetting->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
       

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $careerSetting->title) }}" class="form-control" required>
        </div>

        <!-- Subtitle -->
        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $careerSetting->subtitle) }}" class="form-control" required>
        </div>

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $careerSetting->name) }}" class="form-control" required>
        </div>

        <!-- Designation -->
        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" name="designation" id="designation" value="{{ old('designation', $careerSetting->designation) }}" class="form-control" required>
        </div>

        <!-- Icon Images (multiple) -->
        <div class="mb-3">
            <label for="icon_image" class="form-label">Icon Images</label>
            <input type="file" name="icon_image[]" id="icon_image" multiple class="form-control">
            @if($careerSetting->icon_image)
                <div class="mt-2">
                    <img src="{{ asset('images/icon_images/' . $careerSetting->icon_image) }}" width="50" alt="Icon Image">
                </div>
            @endif
        </div>

        <!-- Logo (single file) -->
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control">
            @if($careerSetting->logo)
                <div class="mt-2">
                    <img src="{{ asset('images/logos/' . $careerSetting->logo) }}" width="100" alt="Logo">
                </div>
            @endif
        </div>

        <!-- Base Icons (multiple) -->
        <div class="mb-3">
            <label for="base_icon" class="form-label">Base Icons</label>
            <input type="file" name="base_icon[]" id="base_icon" multiple class="form-control">
            @if($careerSetting->base_icon)
                <div class="mt-2">
                    <img src="{{ asset('images/base_icons/' . $careerSetting->base_icon) }}" width="50" alt="Base Icon">
                </div>
            @endif
        </div>

        <!-- Base Heading -->
        <div class="mb-3">
            <label for="base_heading" class="form-label">Base Heading</label>
            <input type="text" name="base_heading" id="base_heading" value="{{ old('base_heading', $careerSetting->base_heading) }}" class="form-control" required>
        </div>

        <!-- Right Heading -->
        <div class="mb-3">
            <label for="right_heading" class="form-label">Right Heading</label>
            <input type="text" name="right_heading" id="right_heading" value="{{ old('right_heading', $careerSetting->right_heading) }}" class="form-control" required>
        </div>

        <!-- Right Sub Heading -->
        <div class="mb-3">
            <label for="right_sub_heading" class="form-label">Right Sub Heading</label>
            <input type="text" name="right_sub_heading" id="right_sub_heading" value="{{ old('right_sub_heading', $careerSetting->right_sub_heading) }}" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="active" {{ old('status', $careerSetting->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $careerSetting->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Career Setting</button>
    </form>
</div>
@endsection

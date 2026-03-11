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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Privacy Policy</a></li>
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
                    <h4 class="card-title">Edit Privacy Policy</h4>

                </div>
              

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                            <form class="needs-validation" action="{{ route('admin.updatePrivacyPolicyLog', ['num'=> $privacy->id ])}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="category_id">Select Category</label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach ($privacyCategory as $category )
                                                <option value="{{ $category->id }}" {{ $privacy->category_id  === $category->id ? 'selected' : ''}}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select Category!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="statuscat">Status</label>
                                            <select class="form-control" id="statuscat" name="status" required>
                                                <option value="active"  {{ $privacy->status  === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $privacy->status  === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select Status.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="description">Content</label>
                                                <textarea class="form-control ckeditor-classic" id="description" name="description" placeholder="Content" required>{{ $privacy->description }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please Enter News Content.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                <button class="btn btn-primary" type="submit">Submit Data</button>
                </form>

            </div>


        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col -->
</div>

</div>
</div>
<!-- container-fluid -->
<script src="{{asset('admin//libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script>
    ClassicEditor.create(document.querySelector(".ckeditor-classic"))
        .then(function(e) {
            e.ui.view.editable.element.style.height = "200px";
        })
        .catch(function(e) {
            console.error(e);
        });
</script>
@endsection
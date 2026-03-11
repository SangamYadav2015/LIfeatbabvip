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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit News Category</a></li>
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
                    <h4 class="card-title">Edit News Category</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill News Category Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.updateBlogCategory', ['num' => $categoryData->id])}}" method="post" novalidate autocomplete="off">
                                        @csrf
                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="category_name">Category Name</label>
                                                    <input type="text" class="form-control" name="category_name" id="category_name" required placeholder="Enter Category Name" value="{{ $categoryData->category_name }}">
                                                    <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">News category already exists.</small>

                                                    <div class="invalid-feedback">
                                                        Please Enter Category Name!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="statuscat">Status</label>
                                                    <select class="form-control" id="statuscat" name="status" required>
                                                        <option value="1" {{ $categoryData->category_name === 1 ? 'selected' : ''}}>Active</option>
                                                        <option value="0" {{ $categoryData->category_name === 0 ? 'selected' : ''}}>Inactive</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Status.
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
                url: '{{ route("admin.checknewsCategory") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    category_name: categoryName,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#category_name').val('');
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
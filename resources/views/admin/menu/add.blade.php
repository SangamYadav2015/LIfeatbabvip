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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Section Style</a></li>
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
                        <h4 class="card-title">Add Section Style</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Fill Section Style Data</h4>
                                        <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" action="{{ route('admin.storeMenu')}}" method="post" novalidate  autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="section_id">Select Parent Menu</label>
                                                        <select class="form-control" id="parent_id" name="parent_id">
                                                              <option value="">Select Parent Menu</option>
                                                                @foreach($menuData as $menu)
                                                                    @if ($menu->parent_id === null)
                                                                        {{ displayMenuOption($menu) }}
                                                                    @endif
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="section_style_name">Enter Menu Name</label>
                                                        <input type="text" class="form-control" name="title" id="title" required>
                                                        <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">Menu already exists.</small>
                                                        <div class="invalid-feedback">
                                                            Please Enter Menu Name!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="section_style_name">Enter Menu URL</label>
                                                        <input type="text" class="form-control" name="menu_slug" id="menu_slug">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="mb-3 col-md-4" id="menu_parent">
                                                        <label class="form-label col-md-12" for="is_horizontal">Is Horizontal</label>
                                                         <input type="checkbox" class="" id="is_horizontal" switch="success" name="is_horizontal" value="1">
                                                        <label for="is_horizontal" data-on-label="Yes" data-off-label="No"></label>
                                                   </div>

                                                   <div class="mb-3 col-md-4">
                                                        <label class="form-label col-md-12" for="fileData">Show Header</label>
                                                         <input type="checkbox" class="" id="showHeader" switch="success" name="show_header" value="1">
                                                        <label for="showHeader" data-on-label="Yes" data-off-label="No"></label>
                                                   </div>

                                                   <div class="mb-3 col-md-4">
                                                        <label class="form-label col-md-12" for="fileData">Show Footer</label>
                                                         <input type="checkbox" class="" id="showfooter" switch="success" name="show_footer" value="1">
                                                        <label for="showfooter" data-on-label="Yes" data-off-label="No"></label>
                                                   </div>
                                            </div>

                                            <div class="row" id="menu_child" style="display: none;">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label col-md-12" for="menu_image">Menu Image<span class="text-small text-danger">( Image size must be 220 x 150 px )</span></label>
                                                        <input type="file" class="form-control image-check" id="menu_image" name="menu_image" data-width="220" data-height="150">                                                         <div class="img-alert"></div>
                                                   </div>
                                                
                                                   <div class="mb-3 col-md-6">
                                                        <label class="form-label col-md-12" for="menu_description">Menu Short Summary</label>
                                                         <input type="text" class="form-control" id="menu_description"  name="menu_description" placeholder="Enter Menu Short Summary">
                                                   </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-control" id="statusa" name="status" required>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please Select Status.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <label class="form-label" for="status">Sorting ID</label>
                                                    <input type="text" class="form-control" id="sort_id" name="sort_id" required readonly value="{{ $menuSortinID }}">
                                                         
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
        $('#title').on('change', function() {
            var menuTitle = $(this).val();
            $.ajax({
                url: '{{ route("admin.menuNameExistance") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    menu_title: menuTitle,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#title').val('');
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


    $("#parent_id").change(function() {
            var parentId = $(this).val();
            $.get("{{ route('admin.menuChildSortNumber')}}", {
                parent_id: parentId
            }, function(data, status) {
                $("#sort_id").val(data.sortId);
            });

            if(parentId){
                $("#menu_child").show();
                $("#menu_parent").hide();
                $("#menu_image").attr('required', true);
                $("#menu_description").attr('required', true);

            }else{
                $("#menu_child").hide();
                $("#menu_parent").show();
                $("#menu_image").attr('required', false);
                $("#menu_description").attr('required', false);
            }

        })
</script>
<script>
        $(document).ready(function() {
        $('.image-check').on('change', function () {
            var fileInput = this;
            var $parentDiv = $(fileInput).closest('.mb-3'); // Find the closest parent div

            if (fileInput.files && fileInput.files[0]) {
                var img = new Image();
                var file = fileInput.files[0];
                
                var imgFixWidth = parseInt($(fileInput).attr('data-width'));
                var imgFixHeight = parseInt($(fileInput).attr('data-height'));
                var objectUrl = URL.createObjectURL(file);
                
                img.onload = function () {
                    var width = this.width;
                    var height = this.height;
                    
                    if (width === imgFixWidth && height === imgFixHeight) {
                        $parentDiv.find(".img-alert").html('<span class="text-success">Image dimensions are correct.</span>');
                    } else {
                        $parentDiv.find(".img-alert").html('<span class="text-danger">Image dimensions are not correct.</span>');
                        fileInput.value = '';
                    }
                    
                    URL.revokeObjectURL(objectUrl);
                };
                
                img.src = objectUrl;
            }
        });
    });

 </script>
@endsection
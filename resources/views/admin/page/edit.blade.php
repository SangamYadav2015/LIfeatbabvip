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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Page</a></li>
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
                    <h4 class="card-title">Edit Page</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fill Page Data</h4>
                                    <!-- <p class="card-title-desc">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p> -->
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" action="{{ route('admin.updatePage', ['num' => $pageData->id])}}" method="post" novalidate autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        @php
                                      $pageDatadecode=  decodeData($pageData->page_data);
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="section_id">Select Menu</label>
                                                    <select class="form-control" id="menu_id" name="menu_id" required>
                                                        <option value="">Select Parent Menu</option>
                                                        @foreach($menuData as $menu)
                                                        @if ($menu->parent_id === null)
                                                        {{ displayMenuOption($menu, '', 0, $pageData->menu_id) }}
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    <small id="nameExistsMessage" class="invalid-feedback" style="display: none;">Menu page already exists.</small>
                                                    <div class="invalid-feedback">
                                                        Please Select Page Menu!
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="section_style_name">Page Slug</label>
                                                    <input type="text" class="form-control" name="page_slug" id="page_slug" required value="{{ $pageDatadecode['page_slug'] }}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Page Slug!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="section_style_name">Page Meta Title</label>
                                                    <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter Page Meta Title" value="{{ $pageDatadecode['meta_title'] }}">
                                                    <div class="invalid-feedback">
                                                        Please Enter Meta Title!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="meta_description" >Page Meta Description</label>
                                                    <textarea class="form-control" id="meta_description" name="meta_description" placeholder="Enter Page Meta Description">{{ $pageDatadecode['meta_description'] }}</textarea>
                                                    <div class="invalid-feedback">
                                                        Please Enter Meta Description.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="page_head_script">Page Header Script</label>
                                                    <textarea class="form-control" id="page_head_script" name="page_head_script" placeholder="Enter Page Header Script">{{ isset($pageDatadecode['page_head_script']) ? $pageDatadecode['page_head_script'] : '' }}</textarea>
                                                   
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="page_body_script">Page Body Script</label>
                                                    <textarea class="form-control" id="page_body_script" name="page_body_script" placeholder="Enter Page Body Script">{{ isset($pageDatadecode['page_body_script']) ? $pageDatadecode['page_body_script'] : '' }}</textarea>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-control" id="statusa" name="status" required>
                                                        <option value="active" {{ $pageData->status === 'active' ? 'selected' : ''}}>Active</option>
                                                        <option value="inactive" {{ $pageData->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please Select Status.
                                                    </div>
                                                </div>
                                            </div>   
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">OG Fraph Image</label>
                                                    <input type="file" class="form-control" id="og_graph_image" name="og_graph_image">
                                                    <input type="hidden" class="form-control" id="og_graph_image_old" name="og_graph_image_old" value="{{ isset($pageDatadecode['og_graph_image']) ? $pageDatadecode['og_graph_image'] : '' }}">
                                                    @if(isset($pageDatadecode['og_graph_image']) && $pageDatadecode['og_graph_image'] !=='')
                                                    <a href="{{ asset('storage/uploads/'.$pageDatadecode['og_graph_image'])}}" target="_blank">view image</a>
                                                    @endif
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
        $('#menu_id').on('change', function() {
            var menuId = $(this).val();
            $.ajax({
                url: '{{ route("admin.checkPageMenu") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    menu_id: menuId,
                },
                success: function(response) {
                    if (response.exists) {
                        $('#nameExistsMessage').show();
                        $('#menu_id').val('');
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


    $("#menu_id").change(function() {
        var menu_id = $(this).val();
        var selectedOptionText = $(this).find('option:selected').attr('item-data');
        var newText = selectedOptionText.replace(/[\s!@#$%^&*()_+={}\[\]:;"'<>,.?/\\|`~]/g, '-').toLowerCase();
        $("#page_slug").val(newText);
        $("#meta_title").val(selectedOptionText);
        $("#meta_description").val(selectedOptionText);
    })
</script>
@endsection
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">News List</a></li>
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
                    <h4 class="card-title">Search Here</h4>
                    <form class="needs-validation" action="{{ route('admin.blogList') }}" method="get" novalidate="" autocomplete="off" id="searchForm">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <select class="form-select" name="category_id" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($blogCategory as $item)
                                        <option value="{{ $item->id }}" {{ request('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="search" id="search" placeholder="Search keyword By Blog Title" value="@if(isset($_GET['search'])){{ $_GET['search'] }}@endif">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" type="submit">Search</button>
                                @if(request()->has('search') || request()->has('category_id'))
                                <button class="btn btn-warning" type="button" id="reset" value="Reset">Clear</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header">
                    <h4 class="card-title">News List</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($blogs) > 0)
                                @php $i = 1; @endphp
                                @foreach ($blogs as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td><img src="{{ asset('storage/uploads/'.$item->blog_image1) }}" class="img-thumbnail" style="width: 100px;"></td>
                                    <td>{{ $item->category->category_name }}</td>
                                    <td>{{ $item->blog_title }}</td>
                                    <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <input type="checkbox" class="changeStatus" id="changeStatus-{{ $item->id }}" switch="success" data-section-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                        <label for="changeStatus-{{ $item->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                                    </td>
                                     <td>{{ date('d M Y g:i:a', strtotime($item->created_at)) }}</td>

                                    <td>
                                        <a href="{{ route('admin.editBlog', ['num' => $item->id]) }}"><i data-feather="edit"></i>Edit</a> |

                                        <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.deleteBlog', ['num' => $item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">No Records Found</td>
                                </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <!-- Pagignation start -->
                    <nav aria-label="Page navigation example" class="{{ count($blogs) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($blogs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $blogs->currentPage() - 5);
                            $end = min($blogs->lastPage(), $blogs->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($blogs->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($blogs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $blogs->total() }} Showing {{ $blogs->count() }} records per page</p>
                    </nav>
                    <!-- Pagignation end -->

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->
<script>
    function successsweetalert(message) {
        Swal.fire({
            title: "Good job!",
            text: message,
            icon: "success"
        });
    }
    $(".changeStatus").each(function() {
        $(this).change(function() {
            var blogId = $(this).data('section-id');
            var status = this.checked ? 1 : 0;
            $.ajax({
                url: '{{ route("admin.updateBlogStatus") }}',
                type: 'POST',
                data: {
                    id: blogId,
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200) {
                        successsweetalert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
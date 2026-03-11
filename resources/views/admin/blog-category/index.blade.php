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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">News Category List</a></li>
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
                    <h4 class="card-title">News Category List
                        <a href="{{ route('admin.addBlogCategory') }}"><button class="btn btn-primary" type="button" style="float:right">Add News Category</button>
                    </a>
                    </h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($blogCategory) > 0)
                                @php $i = 1; @endphp
                                @foreach ($blogCategory as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <input type="checkbox" class="changeStatus" id="changeStatus-{{ $item->id }}" switch="success" data-section-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                        <label for="changeStatus-{{ $item->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.editBlogCategory', ['num' => $item->id]) }}"><i data-feather="edit"></i>Edit</a> |

                                        <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.deleteBlogCategory', ['num' => $item->id]) }}" method="POST" style="display: none;">
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
                    <nav aria-label="Page navigation example" class="{{ count($blogCategory) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($blogCategory->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogCategory->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $blogCategory->currentPage() - 5);
                            $end = min($blogCategory->lastPage(), $blogCategory->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($blogCategory->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $blogCategory->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($blogCategory->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $blogCategory->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $blogCategory->total() }} Showing {{ $blogCategory->count() }} records per page</p>
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
            var categoryId = $(this).data('section-id');
            var status = this.checked ? 1 : 0;
            $.ajax({
                url: '{{ route("admin.updateBlogCategoryStatus") }}',
                type: 'POST',
                data: {
                    category_id: categoryId,
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
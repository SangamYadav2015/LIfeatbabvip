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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages List</a></li>
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
                    <h4 class="card-title">Pages List</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Page Menu</th>
                                    <th>Page Slug</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Page Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($pages) > 0)
                                @php $i = 1; @endphp
                                @foreach ($pages as $item)
                                @php
                                 $pageData=  decodeData($item->page_data);
                                $parentMenuTitle='';
                                @endphp
                                @if($item->menu->parent_id !== null && getParentMenu($item->menu->parent_id) !== 0)
                                @php
                                $parentMenuTitle = getParentMenu($item->menu->parent_id)."-->";
                                @endphp
                                @endif
                          
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $parentMenuTitle }}{{ $item->menu->title }}</td>
                                    <td><a href="{{ url($pageData['page_slug']) }}" target="_blank">{{ $pageData['page_slug'] }} </a></td>
                                    <td>{{ strtoupper($item->status) }}</td>
                                    <td>
                                        <input type="checkbox" class="changeStatus" id="changeStatus-{{ $item->id }}" switch="success" data-section-id="{{ $item->id }}" {{ $item->status == 'active' ? 'checked' : '' }}>
                                        <label for="changeStatus-{{ $item->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                                    </td>
                                    <td>   <a href="{{ route('admin.PageSectionList', ['num' => $item->id]) }}"> <i data-feather="plus-square"></i></a></td>

                                    <td>
                                        <a href="{{ route('admin.editPage', ['num' => $item->id]) }}"><i data-feather="edit"></i>Edit</a>

                                        <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete</a>
                                        <form id="delete-form-{{ $item->id }}" action="{{  route('admin.deletePage', ['num' => $item->id]) }}" method="POST" style="display: none;">
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
                    <nav aria-label="Page navigation example" class="{{ count($pages) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($pages->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $pages->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $pages->currentPage() - 5);
                            $end = min($pages->lastPage(), $pages->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($pages->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $pages->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($pages->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pages->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $pages->total() }} Showing {{ $pages->count() }} records per page</p>
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
            var id = $(this).data('section-id');
            var status = this.checked ? 'active' : 'inactive';
            $.ajax({
                url: '{{ route("admin.pageChangeStatus") }}',
                type: 'POST',
                data: {
                    id: id,
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
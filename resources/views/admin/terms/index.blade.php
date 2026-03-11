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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Terms and Conditions</a></li>
                        <li class="breadcrumb-item active">List</li>
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
                    <h4 class="card-title">Terms and Conditions List</h4>
                    <a href="{{ route('admin.terms.create') }}" class="btn btn-primary float-end">Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($termsData) > 0)
                                @php $i = 1; @endphp
                                @foreach ($termsData as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{(strip_tags( $item->title))}}</td>
                                    <td>{{ Str::limit(strip_tags($item->content), 50) }}</td>
                                    <td>
                                        <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');"><i data-feather="trash-2"></i>Delete</a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.terms.delete', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">No Records Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination start -->
                    <nav aria-label="Page navigation example" class="{{ count($termsData) > 0 ? '' : 'd-none' }}">
                        <ul class="pagination">
                            @if ($termsData->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $termsData->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $termsData->currentPage() - 5);
                            $end = min($termsData->lastPage(), $termsData->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ ($termsData->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $termsData->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($termsData->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $termsData->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                            @endif
                        </ul>
                        <p>Total Records: {{ $termsData->total() }} Showing {{ $termsData->count() }} records per page</p>
                    </nav>
                    <!-- Pagination end -->

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
    function deleteAlert(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection

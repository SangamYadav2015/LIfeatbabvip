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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User Role List</a></li>
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
                    <h4 class="card-title">User Role List
                        <a href="{{ route('admin.addRole') }}"><button class="btn btn-primary" type="button" style="float:right">Add User Role</button>
                    </a>
                    </h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department</th>
                                    <th>Role Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($userRole) > 0)
                                @php $i = 1; @endphp
                                @foreach ($userRole as $item)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $item->department->Department_name }}</td>
                                    <td>{{ $item->role_title }}</td>
                                    <td>
                                        <a href="{{ route('admin.editRole', ['num' => $item->id]) }}"><i data-feather="edit"></i>Edit</a> |

                                        <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.deleteRole', ['num' => $item->id]) }}" method="POST" style="display: none;">
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
                    <nav aria-label="Page navigation example" class="{{ count($userRole) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($userRole->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $userRole->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $userRole->currentPage() - 5);
                            $end = min($userRole->lastPage(), $userRole->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($userRole->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $userRole->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($userRole->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $userRole->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $userRole->total() }} Showing {{ $userRole->count() }} records per page</p>
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

@endsection
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
                       
                     <li><a class="btn btn-primary" href="{{route('admin.addcompany')}}">Create Company</></a></li>   
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
                    <h4 class="card-title">Company List</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                  
                                    <th>Company Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($companies) > 0)

                                @foreach($companies as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key+1 }} </th>
                                   
                                    <td>{{ $item->company_name }} </td>
                                    <td> <a href="{{ route('admin.editcompany',['num'=> $item->id]) }}"  value="Save Changes" type="submit"><i data-feather="edit"></i>Edit</a> |
                                    <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.deletecompany', ['num' => $item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
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
                   <nav aria-label="Page navigation example" class="{{ count( $companies) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ( $companies->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{  $companies->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1,  $companies->currentPage() - 5);
                            $end = min( $companies->lastPage(),  $companies->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ( $companies->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{  $companies->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ( $companies->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{  $companies->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{  $companies->total() }} Showing {{  $companies->count() }} records per page</p>
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
    $(".changeSectionStatus").each(function() {
        $(this).change(function() {
            var sectionStyleId = $(this).data('section-id');
            alert(sectionStyleId);
            var status = this.checked ? 1 : 0;
            $.ajax({
                url: '{{ route("admin.updateSectionStyleStatus") }}',
                type: 'POST',
                data: {
                    section_style_id: sectionStyleId,
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
@extends('admin.layout.app')

@section('content')
<div class="container-fluid ">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Faq List</a></li>
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
                    <h4 class="card-title">Faq List</h4>

                </div>
        <div class="card-body">
                    <div class="table-responsive">
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Change Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->question }}</td>
                            <td>
                                <input type="checkbox" class="changeStatus" id="changeStatus-{{ $item->id }}" switch="success" data-section-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                <label for="changeStatus-{{ $item->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                            </td>
                            <td>
                                <a href="{{ route('admin.faq.edit', $item->id) }}"><i data-feather="edit"></i>Edit</a> |

                                <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                    <i data-feather="trash-2"></i>Delete
                                </a>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.faq.delete', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No FAQs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
            <!--Pagination Start-->
             <nav aria-label="Page navigation example" class="{{ count($faqs) > 0 ? '' : 'd-none' }} ">
                        <ul class="pagination">
                            @if ($faqs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $faqs->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $faqs->currentPage() - 5);
                            $end = min($faqs->lastPage(), $faqs->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($faqs->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $faqs->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($faqs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $faqs->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <p>Total Records: {{ $faqs->total() }} Showing {{ $faqs->count() }} records per page</p>
                    </nav>
            <!--Pagination End-->
            
            </div>
        </div>
        </div>
        </div>
        </div>
</div>
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
                url: '{{ route("admin.updateFaqStatus") }}',
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

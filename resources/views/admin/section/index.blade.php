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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Section List</a></li>
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
                        <h4 class="card-title">Section List</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Section Name</th>
                                        <th>Status</th>
                                        <th>Change Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i= 1;
                                    @endphp
                                    @foreach ($sectionData as $section)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $section->section_name }}</td>
                                        <td>{{ $section->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <input type="checkbox" class="changeSectionStatus" id="changeStatus-{{ $section->id }}" switch="success" data-section-id="{{ $section->id }}" {{ $section->status == 1 ? 'checked' : '' }}>
                                            <label for="changeStatus-{{ $section->id }}" data-on-label="Active" data-off-label="Inactive" value="{{ $section->id }}"></label>
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagignation start -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($sectionData->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $sectionData->previousPageUrl() }}" rel="prev">Previous</a>
                                </li>
                                @endif
                                @php
                                $start = max(1, $sectionData->currentPage() - 5);
                                $end = min($sectionData->lastPage(), $sectionData->currentPage() + 5);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($sectionData->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $sectionData->url($i) }}">{{ $i }}</a>
                                    </li>
                                    @endfor
                                    @if ($sectionData->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sectionData->nextPageUrl() }}" rel="next">Next</a>
                                    </li>
                                    @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Next</span>
                                    </li>
                                    @endif
                            </ul>
                            <p>Total Records: {{ $sectionData->total() }} Showing {{ $sectionData->count() }} records per page</p>
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
            var sectionId = $(this).data('section-id');
            var status = this.checked ? 1 : 0;
            $.ajax({
                url: '{{ route("admin.updateSectionStatus") }}',
                type: 'POST',
                data: {
                    section_id: sectionId,
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
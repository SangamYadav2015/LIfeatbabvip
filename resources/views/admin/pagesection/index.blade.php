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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pageData->menu->title }} Pages Sections </a></li>
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
                    <h4 class="card-title">{{ $pageData->menu->title }} Pages Sections
                        <a href="{{ route('admin.addPageSection',['num'=> $pageData->id]) }}"><button class="btn btn-primary" type="button" style="float:right">Add Page Section</button></a>
                    </h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Page</th>
                                    <th>Section Name</th>
                                    <th>Section Style</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                            <tbody id="sortabletr">
                                @foreach ($pageSectionData as $item)
                                <tr data-item-id="{{ $item->id }}">
                                    <th>{{ $i }}</th>
                                    <td>{{ $item->page->menu->title}}</td>
                                    <td>{{ $item->section->section_name }}</td>
                                    <td>{{ $item->sectionStyle->section_style_name }}</td>
                                    <td>{{ $item->status == 'active' ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <input type="checkbox" class="changeStatus" id="changeStatus-{{ $item->id }}" switch="success" data-section-id="{{ $item->id }}" {{ $item->status == 'active' ? 'checked' : '' }}>
                                            <label for="changeStatus-{{ $item->id }}" data-on-label="Active" data-off-label="Inactive" value="{{ $item->id }}"></label>
                                        </td>
                                    <td><a href="{{ route('admin.editPageSection', ['num' => $item->id]) }}"><i data-feather="edit"></i>Edit</a>
                                    <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert('{{ $item->id }}');">
                                            <i data-feather="trash-2"></i>Delete
                                        </a>
                                        <form id="delete-form-{{ $item->id }}" action="{{  route('admin.deletePageSection', ['num' => $item->id, 'id' => $item->page_id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $i++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<style>
        #sortabletr tr {
            cursor: move;
        }
    </style>

<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
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
                url: '{{ route("admin.pageSectionChangeStatus") }}',
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
<script>
        $(document).ready(function() {
            $("#sortabletr").sortable({
                update: function(event, ui) {
                    console.log("Table sortable updated");
                    saveSubinformationSorting();
                }
            }).disableSelection(); // Prevents text selection during dragging
        });

        function saveSubinformationSorting() {
            var sortInformation = [];

            $("#sortabletr > tr").each(function() {
                sortInformation.push($(this).data("item-id"));
            });

            console.log(sortInformation);

            $.ajax({
             url: "{{ route('admin.savePageSectionSorting')}}",
                method: 'POST',
                data: {
                    sortInformation: sortInformation
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                    console.log("Order updated successfully.");
                },
                error: function(xhr, status, error) {
                    console.error("Failed to update order: " + error);
                }
            });
        }

    </script>
@endsection
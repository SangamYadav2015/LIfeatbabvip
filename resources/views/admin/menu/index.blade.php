@extends('admin.layout.app')

@section('content')
<style>
    .buttonstle{
        padding: 4px 21px;
    color: #fff;
    font-weight: bold;
    border-radius: 14px;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu List</a></li>
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
                    <h4 class="card-title">Menu List</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Is Header</th>
                                    <th>Is Footer</th>
                                    <th>Sorting Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuData as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key+1 }} </th>
                                    <td> @if ($item->childrenRecursive->isNotEmpty())
                                        {{ displayMenu($item) }}
                                        @else
                                       <li> {{ $item->title }} </li>
                                        @endif
                                    </td>
                                    <td>
                                    @if($item->show_header === 1)
                                    <span class='bg-success buttonstle'>Yes</span>
                                    @else
                                    <span class="bg-danger buttonstle">No</span>
                                    @endif
                                 </td>
                                    <td>
                                    @if($item->show_footer === 1)
                                    <span class='bg-success buttonstle'>Yes</span>
                                    @else
                                    <span class="bg-danger buttonstle">No</span>
                                    @endif
                                   </td>
                                    <td>{{ $item->sort_id }}</td>

                                    <td> <a href="{{ route('admin.editMenu',['num'=> $item->id]) }}" class="btn btn-info waves-effect waves-light" value="Save Changes" type="submit">Edit</a>
                                        <a href="" class="btn btn-danger waves-effect waves-light" value="Save Changes" type="submit" onclick="event.preventDefault(); deleteAlertMenu('{{ $item->id }}');">Delete</a>
                                        <form id="delete-form-{{  $item->id }}" action="{{ route('admin.deleteMenu',['num' => $item->id ])}}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
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
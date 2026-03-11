@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $data['pageTitle'] }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ $data['pageDescription'] }}</li>
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
                    <h4 class="card-title">Career Settings List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Icon Image</th>
                                    <th>Logo</th>
                                    <th>Base Heading</th>
                                    <th>Base Icon</th>
                                    <th>Right Heading</th>
                                    <th>Right Sub Heading</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($careerSettings->count() > 0)
                                    @php $i = 1; @endphp
                                    @foreach ($careerSettings as $setting)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $setting->title }}</td>
                                        <td>{{ $setting->subtitle }}</td>
                                        <td>{{ $setting->name }}</td>
                                        <td>{{ $setting->designation }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$setting->icon_image) }}" alt="Icon Image" width="50">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" width="50">
                                        </td>
                                        <td>{{ $setting->base_heading }}</td>
                                        <td>
                                            @if($setting->base_icon)
                                                <img src="{{ asset('storage/'.$setting->base_icon) }}" alt="Base Icon" width="30">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $setting->right_heading }}</td>
                                        <td>{{ $setting->right_sub_heading }}</td>
                                        <td>{{ $setting->status }}</td>
                                        <td>{{ $setting->created_at }}</td>
                                        <td>{{ $setting->updated_at }}</td>
                                        <td>
<a href="{{ route('admin.careerSettings.edit', ['id' => $setting->id]) }}" class="btn btn-info waves-effect waves-light">Edit</a>
                                            <a href="#" class="text-danger" onclick="event.preventDefault(); deleteCareerSetting('{{ $setting->id }}');">
                                                <i data-feather="trash-2"></i> Delete
                                            </a>
                                            <form action="{{ route('career.settings.delete', $setting->id) }}" id="delete-form-{{ $setting->id }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="15">No Career Settings Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination start -->
                   
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
    function deleteCareerSetting(id) {
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

@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-logs-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-log"><a href="javascript: void(0);">Logs View</a></li>
                        <li class="breadcrumb-log active">Welcome </li>
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
                    <h4 class="card-title">Logs View
                    <select class="form-control changeStatus {{ $log->status === 'New' ? 'bg-primary' : '' }} {{ $log->status === 'Progress' ? 'bg-warning' : '' }} {{ $log->status === 'Resolved' ? 'bg-success' : '' }}" name="status" data-section-id="{{ $log->id }}" style="width: auto;color: #fff;float: right;">
                            <option value="">Change Status</option>
                            <option value="New" {{ $log->status === 'New' ? 'Selected' : '' }}>New</option>
                            <option value="Progress" {{ $log->status === 'Progress' ? 'Selected' : '' }}>Progress</option>
                            <option value="Resolved" {{ $log->status === 'Resolved' ? 'Selected' : '' }}>Resolved</option>
                        </select>
                    </h4>
                    <a href="{{ route('admin.logsList') }}">Back to Logs</a>
                </div>
                <div class="card-body">
                    <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                        <div style="margin-bottom: 10px;">
                            <strong>Level:</strong> {{ $log->level }}
                        </div>
                        <div style="margin-bottom: 10px;">
                            <strong>Message:</strong>
                            <pre style="background-color: #f7f7f7; padding: 10px; border-radius: 5px; white-space: pre-wrap;">{{ $log->message }}</pre>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <strong>Context:</strong>
                            <pre style="background-color: #f7f7f7; padding: 10px; border-radius: 5px; white-space: pre-wrap;">{{ $log->context }}</pre>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <strong>Date:</strong> {{ $log->created_at }}
                        </div>
                        <div>
                            <strong>Stack Trace:</strong>
                            <ul>
                                @php
                                $extractedData = extractPageNameAndLineNumber($log->message);
                                // Print the results
                                foreach ($extractedData as $data) {
                                echo "File: " . $data['file'] . "\n";
                                echo "Line: " . $data['line'] . "\n";
                                }
                                @endphp
                            </ul>

                            <a href="{{ route('admin.logsList') }}">Back to Logs</a>

                        </div>
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
    $(".changeStatus").each(function() {
        $(this).change(function() {
            var id = $(this).data('section-id');
            var status = $(this).val();
            $.ajax({
                url: '{{ route("admin.updateLogStatus") }}',
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
                          setTimeout(function() {
                            location.reload();
                        }, 2000);
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
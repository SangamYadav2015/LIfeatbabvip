@extends('admin.layout.app')

@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">
                    {{ Auth::user()->name }} Welcome! To {{ Auth::user()->designation }} Dashboard
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Interview Schedule</a></li>
                        <li class="breadcrumb-item active">Availability Slots</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">

            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Interview Availability List</h4>
                </div>

                <div class="card-body">

                    {{-- Show message if all slots are taken --}}
                    @if ($availabilities->isEmpty())
                        <div class="alert alert-warning text-center">
                            All selected slots for this month have already been taken by other applicants. 
                            <strong>Please select another date-time.</strong>
                        </div>
                    @endif

                    @php
                        $grouped = $availabilities->groupBy('email');
                        $serial = ($availabilities->currentPage() - 1) * $availabilities->perPage() + 1;
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>Email</th>
                                    <th>Slot</th>
                                    <th>Availability Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Submitted At</th>
                                    <th>Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($grouped as $email => $slots)
                                    @foreach ($slots as $i => $slot)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $slot->name }}</td>
                                            <td>{{ $slot->email }}</td>
                                            <td>Slot {{ $i + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($slot->availability_date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($slot->available_from)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($slot->available_to)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($slot->created_at)->format('d M Y h:i A') }}</td>
                                            <td>
                                                <a href="https://calendly.com/bvde12202015" target="_blank" class="btn btn-sm btn-success">
                                                    Schedule
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No availability records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Interview Pagination" class="{{ $availabilities->count() > 0 ? '' : 'd-none' }}">
                        <ul class="pagination mt-3">
                            {{-- Previous Page --}}
                            <li class="page-item {{ $availabilities->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $availabilities->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>

                            {{-- Page Numbers --}}
                            @php
                                $start = max(1, $availabilities->currentPage() - 3);
                                $end = min($availabilities->lastPage(), $availabilities->currentPage() + 3);
                            @endphp
                            @for ($i = $start; $i <= $end; $i++)
                                <li class="page-item {{ $availabilities->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $availabilities->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Next Page --}}
                            <li class="page-item {{ $availabilities->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $availabilities->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                        <p>Total Records: {{ $availabilities->total() }} | Showing {{ $availabilities->count() }} per page</p>
                    </nav>
                    <!-- End Pagination -->

                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
</div>
@endsection

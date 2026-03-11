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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add FAQ</a></li>
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
                    <h4 class="card-title">Add FAQ</h4>

                </div>
        
                <div class="card-body">
                    <form action="{{ route('admin.faq.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add FAQ</button>
                        <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

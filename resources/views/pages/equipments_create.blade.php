@extends('admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="{{ route('admin.equipment.store') }}" class="col-lg-6">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="options">Options</label>
                    <input type="text" name="options" id="options" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection

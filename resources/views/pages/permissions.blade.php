@extends('admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role => $permissions)
                    <tr>
                        <td>{{ $role }}</td>
                        <td>{{ $permissions }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
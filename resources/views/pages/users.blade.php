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
                        <th>Firs Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->nickname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>@foreach ($user->roles as $role) {{ $role->name }} @endforeach</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
@extends('master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2>Users List </h2>
                    @can('create', App\Models\User::class)
                    <a class="btn btn-primary" href="{{ route('users.create') }}">Create User</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
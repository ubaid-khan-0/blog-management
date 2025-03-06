@extends('master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2>Create User </h2><a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label>Name:</label>
                                <input class="form-control" type="text" name="name" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>Email:</label>
                                <input class="form-control" type="email" name="email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 mt-4">
                                <label>Password:</label>
                                <input class="form-control" type="password" name="password" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 mt-4">
                                <label>Roles:</label>
                                <div>
                                    @foreach($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role{{ $role->id }}">
                                        <label class="form-check-label" for="role{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary mt-4" type="submit">Create</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
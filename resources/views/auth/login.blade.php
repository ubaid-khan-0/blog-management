@extends('master')
@section('content')

<main class="login-form">

    <div class="cotainer">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form action="{{ route('login.post') }}" method="post">
                            @csrf

                            <div class="form-group row">

                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">

                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    @error('email')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">

                                    <input type="password" id="password" class="form-control" name="password" required>
                                    @error('password')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary"> Login </button>

                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection
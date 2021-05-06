@extends('backend.auth.auth_master')
@section('auth_title','Admin Panel | Login')
@section('auth_content')
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="login-form-head">
                    <h4>Sign In</h4>
                    <p>Hello there, Sign in and start managing your Admin Dashboard</p>
                </div>
                <br>
                @include('backend.layouts.partial.message')
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" id="email" name="email" required>
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" id="password" name="password" required>
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember">
                                <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                    </div>

                    <div class="submit-btn-area">
                        <a class="btn btn-primary mt-2" href="{{ route('admin.normal_users.create') }}">Sign Up <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
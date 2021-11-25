@extends('auth.layouts.master_login_register')
@section('login_registration')
    Login
@endsection
@section('login-registration')
<div class="container">
    <div class="login-box ptb--100">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-form-head">
                <h4>Sign In</h4>
                <p>Hello there, Sign in and start managing Lunch Management System</p>
            </div>
            <div class="login-form-body">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row mb-4 rmber-area">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>
                <div class="submit-btn-area">
                    <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                </div>
                <div class="form-footer text-center mt-5">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

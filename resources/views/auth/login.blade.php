@php
    if(isset($_COOKIE['login_username']) && isset($_COOKIE['login_password']))
    {
        $login_username = $_COOKIE['login_username'];
        $login_password = $_COOKIE['login_password'];
        $is_remember = "checked='checked'";
    }else{
        $login_username = '';
        $login_password = '';
        $is_remember = '';
    }
@endphp
@extends('auth.layouts.master_login_register')
@section('login_registration')
    Login
@endsection
@section('login-registration')
<div class="container">
    <div class="login-box">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-form-head">
                <img src="{{ asset('public/frontend/assets/images/8.png') }}" alt="" width="50px" height="50px">
            </div>
            <div class="login-form-body">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username" autofocus value="{{ $login_username }}">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="{{ $login_password }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row mb-4 rmber-area">
                    <div class="col-6">
                        <div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline" name="remember_me" {{ $is_remember }}>
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
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

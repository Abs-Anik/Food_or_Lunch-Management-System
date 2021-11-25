@extends('auth.layouts.master_login_register')
@section('login_registration')
    Reset Password
@endsection

@section('login-registration')
<div class="container">
    <div class="login-box ptb--100">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="login-form-head">
                <h4>Reset Password</h4>
                <p>Hey! Reset Your Password and comeback again</p>
            </div>
            <div class="login-form-body">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="submit-btn-area mt-5">
                    <button id="form_submit" type="submit">Reset <i class="ti-arrow-right"></i></button>
                </div>

                <div class="form-footer text-center mt-5">
                    <p class="text-muted">Back to login Page? <a href="{{ route('login') }}">Back</a></p>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection

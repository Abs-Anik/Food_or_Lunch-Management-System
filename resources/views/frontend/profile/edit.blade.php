@extends('frontend.layouts.master')
@section('title')
Edit Profile
@endsection

@section('user-main')
<div class="row p-2">
    <div class="col-md-12 mt-5">
        <div class="card pd-20 pd-sm-40">
            <div class="d-sm-flex justify-content-between align-items-center mb-3">
                <h4 class="header-title mb-0 p-4">Manage Profile</h4>
            </div>
            <form action="{{ route('user.profile.update', $user->id) }}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                <div class="card-body">
                    <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="first_name" class="form-control-label">First Name: </label>
                        <input id="first_name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ $user->first_name }}" placeholder="Enter First Name" data-parsley-error-message="Please give user first name" required autocomplete="first_name" autofocus>
                        @error('first_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="last_name" class="form-control-label">Last Name: </label>
                        <input id="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ $user->last_name }}" placeholder="Enter Last Name" data-parsley-error-message="Please give user last name" required autocomplete="last_name" autofocus>
                        @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="username" class="form-control-label">User Name: </label>
                        <input id="username" class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ $user->username }}" placeholder="Enter User Name" data-parsley-error-message="Please give user username" required autocomplete="username" autofocus>
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="email" class="form-control-label">Email: </label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $user->email }}" placeholder="Enter User Email" data-parsley-error-message="Please give user email" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="enrollment" class="form-control-label">Enrollment: </label>
                        <input id="enrollment" class="form-control @error('enrollment') is-invalid @enderror" type="text" name="enrollment" value="{{ $user->enrollment }}" placeholder="Enter User Enrollment" data-parsley-error-message="Please give user enrollment" required autocomplete="enrollment" autofocus>
                        @error('enrollment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="designation" class="form-control-label">Designation: </label>
                        <input id="designation" class="form-control @error('designation') is-invalid @enderror" type="text" name="designation" value="{{ $user->designation }}" placeholder="Enter User designation" data-parsley-error-message="Please give user designation" required autocomplete="designation" autofocus>
                        @error('designation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="phone" class="form-control-label">Phone: </label>
                        <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ $user->phone }}" placeholder="Enter User Phone Number" data-parsley-error-message="Please give user phone" required autocomplete="phone" autofocus>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><!-- col-4 -->
                    @if (!empty($user->image))
                    <div class="form-group col-md-12">
                        <label for="image">Profile Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror dropify" name="image" data-default-file="{{ asset('public/backend/assets/images/profile/user_profile/'.$user->image) }}">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @else
                    <div class="form-group col-md-12">
                        <label for="image">Profile Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror dropify" name="image" data-default-file="{{ asset('public/backend/assets/images/profile/avatar.jpg') }}">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    </div><!-- row -->

                    <div class="form-layout-footer">
                    <button type="submit" class="btn btn-info mg-r-5" style="cursor:pointer"><i class="fa fa-check"></i> Update</button>
                    </div><!-- form-layout-footer -->
                </div>
                </div><!-- form-layout -->
            </form>
        </div>
    </div>
</div>
@endsection

@extends('backend.layouts.master')
@section('title')
    Edit Password
@endsection

@section('main-content')
<div class="main-content">
    <!-- header area start -->
    @include('backend.layouts.partials.header')
    <!-- header area end -->
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Manage Password</h4>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    @if (!empty(Auth::user()->image))
                    <img class="avatar user-thumb" src="{{ asset('public/backend/assets/images/profile/user_profile/'.Auth::user()->image)}}" alt="avatar">
                    @else
                    <img class="avatar user-thumb" src="{{ asset('public/backend/assets/images/profile/avatar.jpg')}}" alt="avatar">
                    @endif
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown" style="text-transform: capitalize">{{ Auth::user()->username }} <i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.profile.view') }}">Profile Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <!-- Left col -->
            <section class="col-md-6 offset-md-3 mt-5">
                   <!-- Profile Image -->
                   <div class="card card-primary card-outline">
                     <div class="card-body box-profile">
                        <h4 class="header-title">Edit Password</h4>
                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" id="currentPassword" name="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" placeholder="Enter Current Password">
                                @error('currentPassword')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirm">Confirm Password</label>
                                <input type="password" id="passwordConfirm" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><i class="fa fa-check"></i> Update Password</button>
                        </form>
                     </div>
                     <!-- /.card-body -->
                   </div>
                   <!-- /.card -->
                   <!-- /.card -->
               <!-- /.card -->
               <!-- /.card -->
            </section>
            <!-- /.Left col -->
         </div>
    </div>
</div>
@endsection

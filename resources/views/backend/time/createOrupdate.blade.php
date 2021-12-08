@extends('backend.layouts.master')
@section('title')
    @if (!empty($time))
        Update Time
    @else
        Create Time
    @endif
@endsection

@section('role_permission_css')
<link rel="stylesheet" href="{{ asset('public/backend/assets/css/role_permission.css')}}">
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
                    <h4 class="page-title pull-left">Admin Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard.index') }}">Lunch Management System</a></li>
                        @if (!empty($time))
                            <li><span>Update Time</span></li>
                        @else
                            <li><span>Create Time</span></li>
                        @endif
                    </ul>
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
            <div class="col-md-12 mt-5">
                <div class="card pd-20 pd-sm-40">
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        @if (!empty($time))
                            <h4 class="header-title mb-0 p-4">Update Time</h4>
                        @else
                            <h4 class="header-title mb-0 p-4">Create Time</h4>
                        @endif
                    </div>
                    <form action="{{$time !== null ? route('admin.time.management.update', $time->id) : route('admin.time.management.store')}}" method="POST" id="form">
                        @csrf
                        @method('post')
                        <div class="form-body">
                        <div class="card-body">
                            <div class="row mg-b-25">
                            <div class="col-lg-8">
                                <div class="form-group">
                                <label for="lastTime" class="form-control-label">Time: </label>
                                <input id="lastTime" class="form-control @error('lastTime') is-invalid @enderror" type="text" name="lastTime" value="{{$time !== null ? $time->lastTime : ''}}" placeholder="Enter Enter Time" data-parsley-error-message="Please give time" required autocomplete="lastTime" autofocus>
                                @error('lastTime')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            </div><!-- row -->
                            <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5" style="cursor:pointer"><i class="fa fa-check"></i> {{$time !== null ? 'UPDATE' : 'SAVE'}}</button>
                            </div><!-- form-layout-footer -->
                        </div>
                        </div><!-- form-layout -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection



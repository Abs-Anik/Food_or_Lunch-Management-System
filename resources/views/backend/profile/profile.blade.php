@extends('backend.layouts.master')
@section('title')
    View Profile
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
                    <h4 class="page-title pull-left">View Profile</h4>
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
            <section class="col-md-4 offset-md-4 mt-5">
                   <!-- Profile Image -->
                   <div class="card card-primary card-outline">
                     <div class="card-body box-profile">
                       <div class="text-center">
                           @if(!empty($user->image))
                           <img class="profile-user-img img-fluid img-circle"
                           src="{{asset('public/backend/assets/images/profile/user_profile/'.$user->image)}}"
                           alt="User profile picture" height="150px" width="150px">
                           @else
                           <img class="profile-user-img img-fluid img-circle"
                           src="{{asset('public/backend/assets/images/profile/avatar.jpg')}}"
                           alt="User profile picture" height="150px" width="150px">
                           @endif
                       </div>

                       @if (!empty($user->first_name) && !empty($user->last_name))
                       <h3 class="profile-username text-center mt-2 mb-2"><span style="text-transform: capitalize">{{ $user->first_name }} {{ $user->last_name }}</span></h3>
                       @else
                       <h3 class="text-center">Not Found</h3>
                       @endif
                       <ul class="list-group list-group-unbordered mb-3">
                            @if (!empty($user->username))
                            <li class="list-group-item">
                                <b>User Name</b> <a class="float-right">{{ $user->username }}</a>
                            </li>
                            @else
                            <li class="list-group-item">
                                <b>User Name</b> <a class="float-right">Not Found</a>
                            </li>
                            @endif
                            @if (!empty($user->enrollment))
                            <li class="list-group-item">
                                <b>User Enrollment</b> <a class="float-right">{{ $user->enrollment }}</a>
                            </li>
                            @else
                            <li class="list-group-item">
                                <b>User Enrollment</b> <a class="float-right">Not Found</a>
                            </li>
                            @endif
                            @if (!empty($user->designation))
                            <li class="list-group-item">
                                <b>User Designation</b> <a class="float-right">{{ $user->designation }}</a>
                            </li>
                            @else
                            <li class="list-group-item">
                                <b>User Designation</b> <a class="float-right">Not Found</a>
                            </li>
                            @endif
                           @if (!empty($user->phone))
                           <li class="list-group-item">
                               <b>Mobile No</b> <a class="float-right">{{ $user->phone }}</a>
                             </li>
                           @else
                           <li class="list-group-item">
                               <b>Mobile No</b> <a class="float-right">Not Found</a>
                            </li>
                           @endif
                           @if (!empty($user->email))
                           <li class="list-group-item">
                               <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                             </li>
                           @else
                           <li class="list-group-item">
                               <b>Email</b> <a class="float-right">Not Found</a>
                             </li>
                           @endif
                       </ul>

                       <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                       <a href="{{ route('admin.password.change') }}" class="btn btn-info btn-block"><b>Change Password</b></a>
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

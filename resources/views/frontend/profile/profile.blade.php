@extends('frontend.layouts.master')
@section('title')
View Profile
@endsection

@section('user-main')
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

               <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
               <a href="{{ route('user.password.change') }}" class="btn btn-info btn-block"><b>Change Password</b></a>
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
@endsection

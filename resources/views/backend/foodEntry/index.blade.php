@extends('backend.layouts.master')
@section('title')
Food Entry
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
                  <li><span>Food Entry</span></li>
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
         <!-- Primary table start -->
         <div class="col-12 mt-5">
            <div class="card">
               <div class="card-body">
                  <div class="d-sm-flex justify-content-between align-items-center mb-4">
                     <h4 class="header-title mb-0">Food Entry</h4>
                     {{-- <a href="{{ route('admin.menuList.create') }}"><i class="fa fa-plus-circle"></i> Add New Menu</a> --}}
                  </div>
                  <div class="table-responsive">
                     <table class="table" id="dataTable3">
                        <thead>
                           <tr>
                              <th scope="col">SL</th>
                              <th scope="col">Enrollment</th>
                              <th scope="col">Name</th>
                              <th scope="col">Meal Number</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <form action="{{ route('admin.foodEntryStore') }}" method="POST">
                                        @csrf
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->enrollment }}</td>
                                        <td><span style="text-transform: capitalize">{{ $user->first_name }} {{ $user->last_name }} </span></td>
                                        <td>
                                            <input type="number" name="meal_no" min="1" class="form-control" placeholder="Enter Meal Number" required>
                                            <input type="hidden" name="id" class="form-control" value="{{ $user->id }}">
                                            <input type="hidden" name="designation_id" class="form-control" value="{{ $user->designation_id }}">
                                        </td>
                                        <td><button type="submit" class="btn btn-primary">Entry</button></td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <!-- Primary table end -->
      </div>
   </div>
</div>
@endsection

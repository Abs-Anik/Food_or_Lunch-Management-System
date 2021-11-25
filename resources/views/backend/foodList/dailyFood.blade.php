@extends('backend.layouts.master')
@section('title')
Daily Food List
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
                  <li><span>Daily Food Order List</span></li>
               </ul>
            </div>
         </div>
         <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
               <img class="avatar user-thumb" src="{{ asset('public/backend/assets/images/author/avatar.png')}}" alt="avatar">
               <h4 class="user-name dropdown-toggle" data-toggle="dropdown" style="text-transform: capitalize">{{ Auth::user()->username }} <i class="fa fa-angle-down"></i></h4>
               <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Message</a>
                  <a class="dropdown-item" href="#">Settings</a>
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
                     <h4 class="header-title mb-0">Daily Food Order List</h4>
                     {{-- <a href="{{ route('admin.menuList.create') }}"><i class="fa fa-plus-circle"></i> Add New Menu</a> --}}
                  </div>
                  <div class="table-responsive">
                     <table class="table" id="dataTable3">
                        <thead>
                           <tr>
                              <th scope="col">SL</th>
                              <th scope="col">Enrollment</th>
                              <th scope="col">Meal Number</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($dailyFoodLists as $dailyFoodList)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dailyFoodList->enrollment }}</td>
                                    <td>{{ $dailyFoodList->meal_no }}</td>
                                    <td><span style="text-transform: capitalize">{{ $dailyFoodList->first_name }} {{ $dailyFoodList->last_name }} </span></td>
                                    <td>{{ $dailyFoodList->email }}</td>
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

@extends('backend.layouts.master')
@php
$date = date('F, Y');
@endphp
@section('title')
@if (isset($strDate) && isset($endDate))
Blue Pill Limited Lunch Report From {{ $strDate }} to {{ $endDate }}
@else
Blue Pill Limited Lunch Report For the month of {{ $date }}
@endif
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
                  <li><span>Food Statement</span></li>
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
                     <h4 class="header-title mb-0">Blue Pill Limited</h4>
                     <h4 class="header-title mb-0">Lunch Report</h4>
                     {{-- <a href="{{ route('admin.menuList.create') }}"><i class="fa fa-plus-circle"></i> Add New Menu</a> --}}
                     <form action="{{ route('admin.getMealStatementFilter') }}" method="POST">
                        @csrf
                       <div class="form-row">
                         <div class="col-sm-5 col-12">
                           <input type="date" class="form-control" placeholder="From Date"  name="startDate">
                         </div>
                         <div class="col-sm-5 col-12">
                           <input type="date" class="form-control" placeholder="To Date"  name="endDate">
                         </div>
                         <div class="col-sm-2 col-12">
                           <button type="submit" class="btn btn-outline-primary"><i class="fas fa-filter"></i></button>
                         </div>
                       </div>
                   </form>
                  </div>
                  <div class="table-responsive">
                     <table class="table" id="dataTable3">
                        <thead>
                           <tr>
                              <th scope="col">Enroll ID</th>
                              <th scope="col">Name</th>
                              <th scope="col">Job Type</th>
                              <th scope="col">Total Meal</th>
                              <th scope="col">Unit Price</th>
                              <th scope="col">Amount Paid To Vendor</th>
                              <th scope="col">Base Price</th>
                              <th scope="col">Employee Contribution</th>
                              <th scope="col">Employee Paid</th>
                              <th scope="col">Company Contribution</th>
                              {{-- <th scope="col">Total Price</th> --}}
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemValue as $item)
                                @foreach ($item as $it)
                                    <tr>
                                        <td>{{ $it->enrollment }}</td>
                                        <td><span style="text-transform: capitalize">{{ $it->first_name }} {{ $it->last_name }} </span></td>
                                        <td>{{ $it->designation }}</td>
                                        <td>{{ $it->totalMeal }}</td>
                                        <td>90</td>
                                        <td>{{ $it->totalMeal*90 }}</td>
                                        <td>110</td>
                                        <td>{{ $it->food_price }}</td>
                                        {{-- <td>{{ ceil(($it->food_price/110)*($it->totalMeal*90)) }}</td> --}}
                                        <td>{{ $it->totalMeal*$it->food_price }}</td>
                                        <td>{{ ($it->totalMeal*90)-($it->totalMeal*$it->food_price)  }}</td>
                                        {{-- <td>{{ ($it->totalMeal*90)-ceil(($it->food_price/110)*($it->totalMeal*90))  }}</td> --}}
                                        {{-- <td>{{ $it->totalMeal*$it->food_price }}</td> --}}
                                        {{-- <td>{{ $it->totalPrice }}</td> --}}
                                    </tr>
                                @endforeach
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
@section('scripts')
@endsection

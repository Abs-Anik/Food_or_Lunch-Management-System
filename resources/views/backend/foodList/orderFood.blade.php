@extends('backend.layouts.master')
@section('title')
 Food Order List
@endsection
@section('custom_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                  <li><span> Food Order List</span></li>
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
                  <div class="mb-4">
                     <h4 class="header-title mb-3">Food Order List</h4>
                     {{-- <a href="{{ route('admin.menuList.create') }}"><i class="fa fa-plus-circle"></i> Add New Menu</a> --}}
                     <form>
                        <div class="form-row">
                          <div class="col-sm-3 col-12">
                            <input type="text" class="form-control" placeholder="Enter User Enroll">
                          </div>
                          <div class="col-sm-3 col-12">
                            <input type="text" class="form-control" placeholder="From Date" id="depart">
                          </div>
                          <div class="col-sm-3 col-12">
                            <input type="text" class="form-control" placeholder="To Date" id="return">
                          </div>
                          <div class="col-sm-3 col-12">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-filter"></i></button>
                          </div>
                        </div>
                    </form>
                  </div>
                  <div class="table-responsive">
                     <table class="table" id="dataTable3">
                        <thead>
                           <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Date</th>
                            <th scope="col">Enrollment</th>
                            <th scope="col">Meal Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderFoodLists as $orderFoodList)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $orderFoodList->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $orderFoodList->enrollment }}</td>
                                    <td>{{ $orderFoodList->meal_no }}</td>
                                    <td><span style="text-transform: capitalize">{{ $orderFoodList->first_name }} {{ $orderFoodList->last_name }} </span></td>
                                    <td>{{ $orderFoodList->email }}</td>
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
@section('scripts')
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Javascript -->
<script>
    $(document).ready(function() {

        var minDate = new Date();
        $("#depart").datepicker({
            showAnim: 'drop',
            numberOfMonth: 1,
            minDate: minDate,
            dateFormat: 'yy-mm-dd',
            onClose: function(selectedDate) {
                $("#return").datepicker("option", "minDate", selectedDate);
            }
        });




        $("#return").datepicker({
            showAnim: 'drop',
            numberOfMonth: 2,
            minDate: minDate,
            dateFormat: 'yy-mm-dd',
            onClose: function(selectedDate) {
                $("#depart").datepicker("option", "maxDate", selectedDate);
            }
        });

    });

</script>
@endsection

@extends('backend.layouts.master')
@section('title')
Designation List
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
                  <li><span>Designation List</span></li>
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
                     <h4 class="header-title mb-0">Designation List</h4>
                     <a href="{{ route('admin.designation.create') }}"><i class="fa fa-plus-circle"></i> Add Designation</a>
                  </div>
                  <div class="table-responsive">
                     <table class="table" id="dataTable3">
                        <thead>
                           <tr>
                              <th scope="col">SL</th>
                              <th scope="col">Designation</th>
                              <th scope="col">Food Price</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($designations as $designation)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td><span style="text-transform: capitalize" class="pl-2">{{ $designation->designation }}</span></td>
                              <td><span class="pl-2">{{ $designation->food_price }}</span></td>
                              <td>
                                 <a class="btn btn-xs-custome btn-success edit_customer_group_button" href="#editDesignationModal{{ $designation->id }}" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                                 <form method="POST" action="{{ route('admin.designation.destroy',  $designation->id) }}" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs-custome btn-danger show_confirm" style="cursor:pointer" id="delete"><i class="fa fa-remove"></i> Delete</button>
                                 </form>
                              </td>
                           </tr>
                           <!-- The Edit Modal -->
                           <div class="modal fade" id="editDesignationModal{{ $designation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle"><span style="text-transform: capitalize">Edit Designation</span></h5>
                                    </div>
                                    <div class="modal-body">
                                       <form action="{{ route('admin.designation.update', $designation->id) }}" method="POST" id="form">
                                          @csrf
                                          @method('PUT')
                                          <div class="form-body">
                                             <div class="card-body">
                                                <div class="row mg-b-25">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="designation" class="form-control-label">Designation Name: </label>
                                                         <input id="designation" class="form-control @error('designation') is-invalid @enderror" type="text" name="designation" value="{{ $designation->designation }}" placeholder="Enter Designation Name" data-parsley-error-message="Please give designation name" required autocomplete="designation" autofocus>
                                                         @error('designation')
                                                         <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror
                                                      </div>
                                                   </div>
                                                   <!-- col-4 -->
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="food_price" class="form-control-label">Item Price: </label>
                                                         <input id="food_price" class="form-control @error('food_price') is-invalid @enderror" type="text" name="food_price" value="{{ $designation->food_price }}" placeholder="Enter Food Price" data-parsley-error-message="Please give food price" required autocomplete="food_price" autofocus>
                                                         @error('food_price')
                                                         <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror
                                                      </div>
                                                   </div>
                                                   <!-- col-4 -->
                                                   <!-- col-4 -->
                                                </div>
                                                <!-- row -->
                                                <div class="form-layout-footer">
                                                   <button type="submit" class="btn btn-info mg-r-5" style="cursor:pointer"><i class="fa fa-check"></i> Update</button>
                                                </div>
                                                <!-- form-layout-footer -->
                                             </div>
                                          </div>
                                          <!-- form-layout -->
                                       </form>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
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

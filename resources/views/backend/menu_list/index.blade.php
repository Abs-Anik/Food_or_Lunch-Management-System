@extends('backend.layouts.master')
@section('title')
Menu List
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
                  <li><span>Menu List</span></li>
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
                     <h4 class="header-title mb-0">Menu List</h4>
                     <a href="{{ route('admin.menuList.create') }}"><i class="fa fa-plus-circle"></i> Add New Menu</a>
                  </div>
                  <div class="table-responsive">
                     <table class="table" id="dataTable3">
                        <thead>
                           <tr>
                              <th scope="col">SL</th>
                              <th scope="col">Day</th>
                              <th scope="col">Item Name</th>
                              <th scope="col">Item Price</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($menuLists as $menuList)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td><span style="text-transform: capitalize" class="pl-2">{{ $menuList->itemDay }}</span></td>
                              <td>{{ $menuList->itemName }}</td>
                              <td><span class="pl-2">{{ $menuList->itemPrice }}</span></td>
                              <td>
                                 <a class="btn btn-xs-custome btn-primary edit_customer_group_button" href="#viewLunchModal{{ $menuList->id }}" data-toggle="modal"><i class="fa fa-eye"></i> view</a>
                                 <a class="btn btn-xs-custome btn-success edit_customer_group_button" href="#editLunchModal{{ $menuList->id }}" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                                 <form method="POST" action="{{ route('admin.menuList.destroy',  $menuList->id) }}" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs-custome btn-danger show_confirm" style="cursor:pointer" id="delete"><i class="fa fa-remove"></i> Delete</button>
                                 </form>
                              </td>
                           </tr>
                           <!-- The View Modal -->
                           <div class="modal fade" id="viewLunchModal{{ $menuList->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle"><span style="text-transform: capitalize">Todays Lunch Menu</span></h5>
                                    </div>
                                    <div class="modal-body">
                                       @if (!empty($menuList->itemDay))
                                       <p class="text-bold">Today is <span class="badge badge-warning">{{ $menuList->itemDay }}</span></p>
                                       @else
                                       <p class="text-bold"><span class="badge badge-warning">Day not found</span></p>
                                       @endif
                                       @if (!empty($menuList->itemName))
                                       <p class="text-bold">Todays menu:  <span class="badge badge-warning">{{ $menuList->itemName }}</span></p>
                                       @else
                                       <p class="text-bold"><span class="badge badge-warning">Today's menu not found</span></p>
                                       @endif
                                       @if (!empty($menuList->itemPrice))
                                       <p class="text-bold">Price:  <span class="badge badge-warning">{{ $menuList->itemPrice }} /=</span></p>
                                       @else
                                       <p class="text-bold"><span class="badge badge-warning">price not found</span></p>
                                       @endif
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- The Edit Modal -->
                           <div class="modal fade" id="editLunchModal{{ $menuList->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle"><span style="text-transform: capitalize">Todays Menu Edit</span></h5>
                                    </div>
                                    <div class="modal-body">
                                       <form action="{{ route('admin.menuList.update', $menuList->id) }}" method="POST" id="form">
                                          @csrf
                                          @method('PUT')
                                          <div class="form-body">
                                             <div class="card-body">
                                                <div class="row mg-b-25">
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="itemName" class="form-control-label">Item Name: </label>
                                                         <input id="itemName" class="form-control @error('itemName') is-invalid @enderror" type="text" name="itemName" value="{{ $menuList->itemName }}" placeholder="Enter Item Name" data-parsley-error-message="Please give item name" required autocomplete="itemName" autofocus>
                                                         @error('itemName')
                                                         <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror
                                                      </div>
                                                   </div>
                                                   <!-- col-4 -->
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="itemPrice" class="form-control-label">Item Price: </label>
                                                         <input id="itemPrice" class="form-control @error('itemPrice') is-invalid @enderror" type="text" name="itemPrice" value="{{ $menuList->itemPrice }}" placeholder="Enter Item Price" data-parsley-error-message="Please give item price" required autocomplete="itemPrice" autofocus>
                                                         @error('itemPrice')
                                                         <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror
                                                      </div>
                                                   </div>
                                                   <!-- col-4 -->
                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label class="control-label" for="itemDay">Select a day</label>
                                                         <br>
                                                         <select class="form-control day @error('itemDay') is-invalid @enderror" id="itemDay" name="itemDay" data-parsley-error-message="Please select a day" required>
                                                            <option value="">--Select a Day--</option>
                                                            <option value="saturday" {{ $menuList->itemDay == 'saturday' ? 'selected' : '' }}>Saturday</option>
                                                            <option value="sunday" {{ $menuList->itemDay == 'sunday' ? 'selected' : '' }}>Sunday</option>
                                                            <option value="monday" {{ $menuList->itemDay == 'monday' ? 'selected' : '' }}>Monday</option>
                                                            <option value="tuesday" {{ $menuList->itemDay == 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                            <option value="wednesday" {{ $menuList->itemDay == 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                            <option value="thursday" {{ $menuList->itemDay == 'thursday' ? 'selected' : '' }}>Thursday</option>
                                                         </select>
                                                         @error('itemDay')
                                                         <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror
                                                      </div>
                                                   </div>
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

@extends('backend.layouts.master')
@section('title')
    Create New Menu
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
                        <li><span>Create New Menu</span></li>
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
            <div class="col-md-12 mt-5">
                <div class="card pd-20 pd-sm-40">
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title mb-0 p-4">Create New Menu</h4>
                    </div>
                    <form action="{{ route('admin.menuList.store') }}" method="POST" id="form">
                        @csrf
                        @method('post')
                        <div class="form-body">
                        <div class="card-body">
                            <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="itemName" class="form-control-label">Item Name: </label>
                                <input id="itemName" class="form-control @error('itemName') is-invalid @enderror" type="text" name="itemName" value="{{ old('itemName') }}" placeholder="Enter Item Name" data-parsley-error-message="Please give item name" required autocomplete="itemName" autofocus>
                                @error('itemName')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="itemPrice" class="form-control-label">Item Price: </label>
                                <input id="itemPrice" class="form-control @error('itemPrice') is-invalid @enderror" type="text" name="itemPrice" value="{{ old('itemPrice') }}" placeholder="Enter Item Price" data-parsley-error-message="Please give item price" required autocomplete="itemPrice" autofocus>
                                @error('itemPrice')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label" for="itemDay">Select a day</label>
                                    <br>
                                    <select class="form-control day @error('itemDay') is-invalid @enderror" id="itemDay" name="itemDay" data-parsley-error-message="Please select a day" required>
                                        <option value="">--Select a Day--</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                    </select>
                                    @error('itemDay')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            </div><!-- row -->

                            <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5" style="cursor:pointer"><i class="fa fa-check"></i> Save</button>
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



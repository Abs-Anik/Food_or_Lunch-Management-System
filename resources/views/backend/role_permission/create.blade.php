@extends('backend.layouts.master')
@section('title')
    Role Create
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
                        <li><span>Role & Permission Create</span></li>
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
                        <h4 class="header-title mb-0 p-4">Create New Role</h4>
                    </div>
                    <form action="{{ route('admin.rolePermission.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first">
                        @csrf
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Role Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Role Name" required=""/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label" for="allManagement">Assign Permissions
                                            <span class="optional">(optional)</span>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="allManagement">
                                            <label class="custom-control-label" for="allManagement">
                                                <strong>All</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                @php $i = 1;  @endphp
                                @foreach ($permissions_group as $group)
                                    <!-- Single Menu Roles -->
                                    <div class="row  role-{{ $i }}-managements">
                                        <div class="col-md-3">
                                            <label class="control-label" for="{{ $i }}Management">{{ $group->title }}</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $i }}Management" onclick="checkPrmissions('role-{{ $i }}-managements', this)">
                                                <label class="custom-control-label" for="{{ $i }}Management">
                                                    <strong>All</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 role-{{ $i }}-managements-checkbox">
                                            @php
                                                $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                                                $j = 1;
                                            @endphp
                                            @foreach ($permissions as $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $i }}-{{ $j }}" name="permissions[]"  value="{{ $permission->name }}">
                                                <label class="custom-control-label" for="{{ $i }}-{{ $j }}">{{ $permission->title }}</label>
                                            </div>
                                            @php $j++; @endphp
                                            @endforeach

                                        </div>
                                        <hr>
                                    </div>
                                    <hr>
                                    <!-- Single Menu Roles -->
                                    @php $i++; @endphp
                                @endforeach

                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-actions">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-success" style="cursor: pointer"> <i class="fa fa-check"></i> Save</button>
                                                <a href="{{ route('admin.rolePermission.index') }}" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('backend.layouts.partials.role_permission_script')
@endsection



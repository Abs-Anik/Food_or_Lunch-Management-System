@extends('backend.layouts.master')
@section('title')
    Role View
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
                        <li><span>Role & Permission View</span></li>
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
            <div class="col-md-12 mt-5">
                <div class="card pd-20 pd-sm-40">
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        <h2 class="header-title mb-0 p-4">View Role</h2>
                    </div>
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Role Name </label> <span class="border p-2">{{ $role->name }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label" for="allManagement">Permissions</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="allManagement" {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }} disabled>
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
                                <div class="row role-{{ $i }}-managements">
                                    @php
                                        $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                                        $j = 1;
                                    @endphp

                                    <div class="col-md-3">
                                        <label class="control-label" for="{{ $i }}Management">{{ $group->title }}</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="{{ $i }}Management" onclick="checkPrmissions('role-{{ $i }}-managements', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }} disabled>
                                            <label class="custom-control-label" for="{{ $i }}Management">
                                                <strong>All</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 role-{{ $i }}-managements-checkbox">
                                        @foreach ($permissions as $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="{{ $i }}-{{ $j }}" name="permissions[]"  value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} onclick="checkSinglePrmission('role-{{ $i }}-managements', '{{ $i }}Management', <?php echo count($permissions); ?>)" disabled>
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
                                            <a href="{{ route('admin.rolePermission.edit', $role->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.rolePermission.index') }}" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('backend.layouts.partials.role_permission_script')
@endsection



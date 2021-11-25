@extends('backend.layouts.master')
@section('title')
    Role List
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
                        <li><span>Role & Permission List</span></li>
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
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                            <h2 class="header-title mb-0 pt-4 pb-4 pr-4">Role List</h2>
                            <a href="{{ route('admin.rolePermission.create') }}"><i class="fa fa-plus-circle"></i> Add New Role</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="dataTable3">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                            <a class="btn btn-xs-custome btn-primary edit_customer_group_button" href="{{ route('admin.rolePermission.show', $role->id) }}"><i class="fa fa-eye"></i> View</a>

                                            <a class="btn btn-xs-custome btn-success edit_customer_group_button" href="{{ route('admin.rolePermission.edit', $role->id) }}"><i class="fa fa-edit"></i> Edit</a>

                                            <form method="POST" action="{{ route('admin.rolePermission.destroy', $role->id) }}" style="display:inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-xs-custome btn-danger show_confirm" style="cursor:pointer" id="delete"><i class="fa fa-remove"></i> Delete</button>
                                            </form>

                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

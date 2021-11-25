@php
$user = Auth::guard('web')->user();
@endphp

<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('public/frontend/assets/images/8.png')}}" alt="logo"></a>
            <h4 style="font-size: 18px" class="text-light p-2">Lunch Management System</h4>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    @if ($user->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
                    @endif

                    @if ($user->can('user.view'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users" aria-hidden="true"></i><span>User Management
                            </span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('admin.registration.create') }}"><i class="ti-arrow-right"></i> Add New Admin</a></li>
                            <li><a href="{{ route('admin.registration.index') }}"><i class="ti-arrow-right"></i> Admin List</a></li>
                            <li><a href="{{ route('admin.rolePermission.create') }}"><i class="ti-arrow-right"></i> Assign Role Permission</a></li>
                            <li><a href="{{ route('admin.rolePermission.index') }}"><i class="ti-arrow-right"></i> Role Permission List</a></li>
                        </ul>
                    </li>
                    @endif

                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users" aria-hidden="true"></i><span>Food Menu
                            </span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('admin.menuList.create') }}"><i class="ti-arrow-right"></i> Creat New Food Menu</a></li>
                            <li><a href="{{ route('admin.menuList.index') }}"><i class="ti-arrow-right"></i> Menu List</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users" aria-hidden="true"></i><span>Food Order List
                            </span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('admin.menuList.create') }}"><i class="ti-arrow-right"></i> Daily Order List</a></li>
                            <li><a href="{{ route('admin.menuList.index') }}"><i class="ti-arrow-right"></i> Monthly Order List</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@php
$user = Auth::guard('web')->user();
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('public/frontend/assets/images/8.png')}}" alt="logo"></a>
            <h4 style="font-size: 18px" class="text-light p-2">Lunch Management System</h4>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    @if ($user->can('dashboard.view'))
                    <li class="{{ $route == 'admin.dashboard.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
                    @endif

                    @if ($user->can('setting.view'))
                    <li class="{{ $route == 'admin.foodEntry' ? 'active' : '' }}">
                        <a href="{{ route('admin.foodEntry') }}" aria-expanded="true"><i class="fa fa-plus-circle"></i><span>Food Entry</span></a>
                    </li>
                    @endif

                    @if ($user->can('setting.view'))
                    <li class="{{ $route == 'admin.time.management.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.time.management.create') }}" aria-expanded="true"><i class="fa fa-clock"></i><span>Time Management</span></a>
                    </li>
                    @endif

                    @if ($user->can('admin.view'))
                    <li class="{{(($route == 'admin.designation.create') ? "active" :(($route == 'admin.designation.index') ? "active" : ""))}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="far fa-address-card"></i><span>Designation
                            </span></a>
                        <ul class="collapse">
                            <li class="{{ $route == 'admin.designation.create' ? 'active' : '' }}"><a href="{{ route('admin.designation.create') }}"><i class="ti-arrow-right"></i> Creat New Designation</a></li>
                            <li class="{{ $route == 'admin.designation.index' ? 'active' : '' }}"><a href="{{ route('admin.designation.index') }}"><i class="ti-arrow-right"></i> Designation List</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($user->can('admin.view'))
                    <li class="{{(($route == 'admin.registration.create') ? "active" :(($route == 'admin.registration.index') ? "active" :(($route == 'admin.rolePermission.create') ? "active" :(($route == 'admin.rolePermission.index') ? "active" : ""))))}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users" aria-hidden="true"></i><span>User Management
                            </span></a>
                        <ul class="collapse">
                            <li class="{{ $route == 'admin.registration.create' ? 'active' : '' }}"><a href="{{ route('admin.registration.create') }}"><i class="ti-arrow-right"></i> Add New Admin</a></li>
                            <li class="{{ $route == 'admin.registration.index' ? 'active' : '' }}"><a href="{{ route('admin.registration.index') }}"><i class="ti-arrow-right"></i> Admin List</a></li>
                            <li class="{{ $route == 'admin.rolePermission.create' ? 'active' : '' }}"><a href="{{ route('admin.rolePermission.create') }}"><i class="ti-arrow-right"></i> Assign Role Permission</a></li>
                            <li class="{{ $route == 'admin.rolePermission.index' ? 'active' : '' }}"><a href="{{ route('admin.rolePermission.index') }}"><i class="ti-arrow-right"></i> Role Permission List</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($user->can('setting.view'))
                    <li class="{{(($route == 'admin.menuList.create') ? "active" :(($route == 'admin.menuList.index') ? "active" : ""))}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-hamburger"></i><span>Food Menu
                            </span></a>
                        <ul class="collapse">
                            <li class="{{ $route == 'admin.menuList.create' ? 'active' : '' }}"><a href="{{ route('admin.menuList.create') }}"><i class="ti-arrow-right"></i> Creat New Food Menu</a></li>
                            <li class="{{ $route == 'admin.menuList.index' ? 'active' : '' }}"><a href="{{ route('admin.menuList.index') }}"><i class="ti-arrow-right"></i> Menu List</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($user->can('setting.view'))
                    <li class="{{(($route == 'admin.daily.food') ? "active" :(($route == 'admin.order.food') ? "active" : ""))}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Food Order List
                            </span></a>
                        <ul class="collapse">
                            <li class="{{ $route == 'admin.daily.food' ? 'active' : '' }}"><a href="{{ route('admin.daily.food') }}"><i class="ti-arrow-right"></i> Daily Order List</a></li>
                            <li class="{{ $route == 'admin.order.food' ? 'active' : '' }}"><a href="{{ route('admin.order.food') }}"><i class="ti-arrow-right"></i> Food Order List</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($user->can('setting.view'))
                    <li class="{{(($route == 'admin.mealStatement') ? "active" :(($route == 'admin.getMealStatement') ? "active" : ""))}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><span>Monthly Summery
                        </span></a>
                        <ul class="collapse">
                            <li class="{{ $route == 'admin.mealStatement' ? 'active' : '' }}"><a href="{{ route('admin.mealStatement') }}"><i class="ti-arrow-right"></i> Current Month Report</a></li>
                            <li class="{{ $route == 'admin.getMealStatement' ? 'active' : '' }}"><a href="{{ route('admin.getMealStatement') }}"><i class="ti-arrow-right"></i> Monthly Report</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>

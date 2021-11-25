<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{ route('user.dashboard.index') }}" class="site_title"><img src="{{ asset('public/frontend/assets/images/8.png') }}" alt="" width="50px" height="50px"> Food Corner</a>
      </div>

      <div class="clearfix"></div>

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <ul class="nav side-menu">
            <li><a href="{{ route('user.dashboard.index') }}"><i class="fa fa-home"></i> Dashboard </a>
            </li>
            <li><a><i class="fa fa-cutlery" aria-hidden="true"></i> Food Corner <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{ route('user.take.lunch.create') }}">Daily Lunch</a></li>
                  <li><a href="{{ route('user.daily.lunch.index') }}">Lunch Report</a></li>
                </ul>
              </li>
          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->
    </div>
  </div>

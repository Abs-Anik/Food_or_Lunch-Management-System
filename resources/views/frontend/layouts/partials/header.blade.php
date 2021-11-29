<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 15px;">
            @if (!empty(Auth::user()->image))
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('public/backend/assets/images/profile/user_profile/'.Auth::user()->image)}}" alt="">
                <span style="text-transform: capitalize">{{ Auth::user()->username }}</span>
            </a>
            @else
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('public/backend/assets/images/profile/avatar.jpg')}}" alt="">
                <span style="text-transform: capitalize">{{ Auth::user()->username }}</span>
            </a>
            @endif
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="{{ route('user.profile.view') }}"> Profile Settings</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>

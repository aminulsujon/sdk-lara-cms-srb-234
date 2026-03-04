<div class="app-header header-shadow">
    <div class="app-header__logo">
      <a href="/home">
        <div class="">
          Admin Panel
        </div>
      </a>
      <div class="header__pane ml-auto">
        <div>
          <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="app-header__mobile-menu">
      <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
    </div>
    <div class="app-header__menu">
      <span>
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
          <span class="btn-icon-wrapper">
            <i class="fa fa-ellipsis-v fa-w-6"></i>
          </span>
        </button>
      </span>
    </div>
    <div class="app-header__content">
      <div class="app-header-left">
        <ul class="header-menu nav">
          
          <li class="btn-group nav-item"></li>
          <li class="dropdown nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
          </li>
        </ul>
      </div>
      <div class="app-header-right">
        <div class="header-btn-lg pr-0">
          <div class="widget-content p-0">
            <div class="widget-content-wrapper">
              <div class="widget-content-left">
                <div class="btn-group">
                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                    @if (!empty(Auth::user()->profile_photo))
                       <img width="42" class="rounded-circle" src="{{ Auth::user()->profile_photo }}" alt="">
                    @else
                       <img width="42" class="rounded-circle" src="{{ asset('assets/img/icon/2.png') }}" alt="">
                    @endif                   
                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                  </a>
                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('edit_admin_profile') }}" type="button" tabindex="0" class="dropdown-item">Edit Profile</a>
                    <a href="{{ route('change_password') }}" type="button" tabindex="0" class="dropdown-item">Change Password</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" type="button" tabindex="0" class="dropdown-item">Logout</a>
                  </div>
                </div>
              </div>
              <div class="widget-content-left  ml-3 header-user-info">
                <div class="widget-heading">
                  {{Auth::user()->name}}
                </div>
                @php
                  $user = Auth::user();
                @endphp
                <div class="widget-subheading">
                  @if ($user->role_id==1)
                  CMS Admin
                  @elseif($user->role_id==2)
                  Super Admin
                  @elseif($user->role_id==3)
                  Editor
                  @elseif($user->role_id==4)
                  Content Writter
                  @else
                  Member
                  @endif            
                </div>
              </div>
              <div class="widget-content-right header-user-info ml-3"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
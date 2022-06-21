@if (\Auth::user() &&  \Auth::user()->is_admin  == "")
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
      <h3>ADMIN SERVICES</h3>
      <ul class="nav side-menu">
          <li class="{{ request()->is('Pj/dashboard') ? 'current-page' : ''}}"><a class="{{ request()->is('Pj/dashboard') ? 'current-page' : ''}}"
                  href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
          </li>
          <li class="{{ request()->is('Pj/report') ? 'current-page' : ''}}"><a class="{{ request()->is('Pj/report') ? 'current-page' : ''}}"
            href="{{route('dashboard')}}"><i class="fa fa-home"></i> Laporan</a>
          </li>
      </ul>
  </div>

</div>
    
@else
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
      <h3>ADMIN SERVICES</h3>
      <ul class="nav side-menu">
          <li class="{{ request()->is('Admin/dashboard') ? 'active' : ''}}"><a class="{{ request()->is('Admin/dashboard') ? 'active' : ''}}"
                  href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
          </li>
          <li><a><i class="fa fa-edit"></i> Data master <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li class="{{ request()->is('Admin/Daerah') ? 'current-page' : ''}}"><a href="{{route('daerah')}}">Daerah</a></li>
                <li class="{{ request()->is('Admin/User-manage') ? 'current-page' : ''}}"><a href="{{route('user-manage')}}">User-manage</a></li>
              </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Project <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li class="{{ request()->is('Admin/Project') ? 'current-page' : ''}}"><a href="{{route('project')}}">Project</a></li>
              <li class="{{ request()->is('Admin/User-manage') ? 'current-page' : ''}}"><a href="{{route('user-manage')}}">Laporan</a></li>
            </ul>
        </li>
      </ul>
  </div>

</div>
@endif
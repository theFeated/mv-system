<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark border accordion position-fixed mt-6 pre-scrollable hoverable" id="accordionSidebar" style="z-index: 100;">
   
  <!-- Divider -->
  <!-- <hr class="sidebar-divider my-0"> -->

  <!-- Nav Item - Dashboard -->
  <li class="nav-item d-flex justify-content-center {{ Request::routeIs('dashboard')? 'active' : '' }}">
    <a class="nav-link" href="{{ route('editor.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <!-- <hr class="sidebar-divider d-none d-md-block"> -->

  <li class="nav-item d-flex justify-content-center {{ Request::routeIs('research')? 'active' : '' }}">
      <a class="nav-link" href="{{ route('research') }}">
          <i class="fas fa-book"></i>
          <span>Research</span>
      </a>
  </li>

  <li class="nav-item d-flex justify-content-center {{ Request::routeIs('college')? 'active' : '' }}">
      <a class="nav-link" href="{{ route('college') }}">
          <i class="fas fa-university"></i>
          <span>College</span>
      </a>
  </li> 

  <li class="nav-item d-flex justify-content-center {{ Request::routeIs('researcher')? 'active' : '' }}">
      <a class="nav-link" href="{{ route('researcher') }}">
          <i class="fas fa-user"></i>
          <span>Researcher</span>
      </a>
  </li>

    <!-- Divider -->
  <!-- <hr class="sidebar-divider d-none d-md-block"> -->
  
  <li class="nav-item d-flex justify-content-center {{ Request::routeIs('roles')? 'active' : '' }}">
      <a class="nav-link" href="{{ route('roles') }}">
          <i class="fas fa-user-cog"></i>
          <span>Roles</span>
      </a>
  </li>

  <li class="nav-item d-flex justify-content-center {{ Request::routeIs('agency')? 'active' : '' }}">
      <a class="nav-link" href="{{ route('agency') }}">
        <i class="fas fa-handshake"></i>
        <span>Agency</span>
      </a>
  </li>

  <!-- Divider -->
  <!-- <hr class="sidebar-divider d-none d-md-block"> -->
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="d-flex justify-content-center mt-3">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
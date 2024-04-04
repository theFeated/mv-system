<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion position-fixed mt-6 pre-scrollable " id="accordionSidebar" style="z-index: 100;">
   
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('welcome') }}">
      <i class="fas fa-home"></i>
      <span>Home</span></a>
  </li>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('research') }}">
          <i class="fas fa-book"></i>
          <span>Research</span>
      </a>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="{{ route('college') }}">
          <i class="fas fa-university"></i>
          <span>College</span>
      </a>
  </li> 

  <li class="nav-item">
      <a class="nav-link" href="{{ route('researcher') }}">
          <i class="fas fa-user"></i>
          <span>Researcher</span>
      </a>
  </li>

    <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <li class="nav-item">
      <a class="nav-link" href="{{ route('roles') }}">
          <i class="fas fa-user-cog"></i>
          <span>Roles</span>
      </a>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="{{ route('agency') }}">
        <i class="fas fa-handshake"></i>
        <span>Agency</span>
      </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  
  
</ul>
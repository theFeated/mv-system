<?php
session_start();
$darkModeCookie = isset($_COOKIE['dark_mode']) ? $_COOKIE['dark_mode'] : 'false';

// Update session variable if dark mode cookie is set
if (isset($_COOKIE['dark_mode'])) {
    $_SESSION['dark_mode'] = $_COOKIE['dark_mode'];
}

// Handle dark mode toggle
if (isset($_POST['dark_mode'])) {
    $_SESSION['dark_mode'] = $_POST['dark_mode'];
    setcookie('dark_mode', $_POST['dark_mode'], time() + (86400 * 30), "/"); // Cookie valid for 30 days
}
?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top position-fixed shadow w-100" style="z-index:1000;">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-database"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Research DB System <sup>1</sup></div>
  </a>

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link">
    <i class="fa fa-bars"></i>
  </button>
  
  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="btn btn-link">
      <i id="darkModeIcon" class="<?php echo $darkModeCookie === 'true' ? 'far fa-moon' : 'far fa-sun'; ?>"></i>
    </button>

    <div class="topbar-divider d-none d-sm-block"></div>
  
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">
              {{ auth()->user()->name }}
              <br>
              <small>{{ auth()->user()->level }}</small>
          </span>
          <img src="{{ asset('profile_images/' . auth()->user()->profile_image) }}" alt="Profile Image" class="img-fluid rounded-circle profile-icon mr-2" style="width: 40px; height: 40px;">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="/profile">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  
  </ul>
  
</nav>

<script>
  // Function to toggle dark mode and change icon
  document.getElementById('darkModeToggle').addEventListener('click', function() {
    var darkModeEnabled = document.body.classList.contains('dark-mode');
    if (darkModeEnabled) {
      document.body.classList.remove('dark-mode');
      document.getElementById('darkModeIcon').classList.remove('fa-moon');
      document.getElementById('darkModeIcon').classList.add('fa-sun');
      var darkModeCookie = 'false';
    } else {
      document.body.classList.add('dark-mode');
      document.getElementById('darkModeIcon').classList.remove('fa-sun');
      document.getElementById('darkModeIcon').classList.add('fa-moon');
      var darkModeCookie = 'true';
    }
    // Save the preference in PHP session
    <?php
    $_SESSION['dark_mode'] = $darkModeCookie;
    ?>
    // Update dark mode preference in cookie
    document.cookie = "dark_mode=" + darkModeCookie + "; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/";
  });
</script>

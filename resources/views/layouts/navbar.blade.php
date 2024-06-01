<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top position-fixed shadow w-100 border bg-white" style="z-index:1000;">
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
    <ul class="navbar-nav ml-auto mb-1">
        <!-- Dark Mode Toggle -->
        <?php
            // Set dark mode cookie value
            $darkModeCookie = isset($_COOKIE['dark_mode']) ? $_COOKIE['dark_mode'] : 'false';
        ?>
        <button id="darkModeToggle" class="btn btn-link">
            <i id="darkModeIcon" class="{{ $darkModeCookie === 'true' ? 'far fa-moon' : 'far fa-sun' }}"></i>
        </button>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->name }}
                    <br>
                    <small>{{ auth()->user()->level }}</small>
                </span>
                <img src="{{ asset('profile_images/' . auth()->user()->profile_image) }}" alt="Profile Image"
                    class="img-fluid rounded-circle profile-icon mr-2" style="width: 40px; height: 40px;">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Include the dark mode script -->
<script src="{{ asset('admin_assets/js/dark-mode.js') }}"></script>

<div class="overlay"></div>
<div class="main-container">

  <nav class="navbar navbar-expand navbar-light">
    
    <!-- Left Section (Toggle + Search) -->
    <div class="d-flex align-items-center navbar-left">
      <!-- Sidebar Toggle -->
      <a class="sidebar-toggle"><i class="fas fa-bars"></i></a>
      
      <!-- Search -->
      <form class="d-none d-sm-inline-block ms-2">
        <div class="input-group input-group-navbar">
          <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
          <button class="btn" type="button"><i class="fas fa-search"></i></button>
        </div>
      </form>
    </div>

    <!-- Right Section (Icons + User) -->
    <ul class="navbar-nav ms-auto align-items-center gap-3 navbar-right">
      
      <!-- Language Dropdown -->
      <li class="nav-item dropdown me-2">
        <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown">
          <img src="Assets/dashboard/img/flag/us.png" alt="English">
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
          <a class="dropdown-item" href="#"><img src="Assets/dashboard/img/flag/de.png" class="align-middle me-1"> English</a>
          <a class="dropdown-item" href="#"><img src="Assets/dashboard/img/flag/es.png" class="align-middle me-1"> Spanish</a>
          <a class="dropdown-item" href="#"><img src="Assets/dashboard/img/flag/ru.png" class="align-middle me-1"> Russian</a>
        </div>
      </li>

      <!-- Fullscreen -->
      <li class="nav-item me-2">
        <a class="nav-icon js-fullscreen d-none d-lg-block" href="#"><i class="fas fa-expand"></i></a>
      </li>

      <!-- User Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
          <img src="Assets/dashboard/img/avatar-3.jpg" class="avatar img-fluid rounded" alt="User">
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="<?= BASE_URL ?>/details?id=<?= $user['id'] ?>"><i class="fas fa-user me-2"></i> Profile</a>
          <a class="dropdown-item" href="#"><i class="fas fa-chart-pie me-2"></i> Analytics</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings & Privacy</a>
          <a class="dropdown-item" href="#"><i class="fas fa-question-circle me-2"></i> Help Center</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/practice/public/"><i class="fas fa-sign-out-alt me-2"></i> Log out</a>
        </div>
      </li>
    </ul>

  </nav>

</div>



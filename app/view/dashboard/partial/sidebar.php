<?php
$roleId = $_SESSION['role_id'] ?? null;
$username = $_SESSION['username'] ?? '';
// if (!function_exists('urlIs')) {
//     function urlIs($page) {
//         return basename($_SERVER['PHP_SELF'], ".php") === $page;
//     }
//   }
?>


<div class="content-wrapper">

  <aside id="sidebar" class=" text-white vh-100 p-3">
    <!-- Sidebar Brand -->
    <div class="text-center mb-4">
      <h5 class="fw-bold">Hotel Reservation</h5>
    </div>

    <!-- User Profile Section -->
    <div class="text-center mb-3">
      <img src="Assets/dashboard/img/avatar.jpg" class="rounded-circle img-fluid mb-2" alt="User Avatar" style="width:80px; height:80px;">
      <div class="mb-0">
      <small class="text-secondary mb-0">
        <?php 
          if ($roleId == 1) echo "Super Admin";
          elseif ($roleId == 2) echo "Staff";
          elseif ($roleId == 4) echo "User";
         
        ?>
      </small>
    </div>
    <hr class="border-secondary">

    <!-- Sidebar Navigation -->
    <ul class="nav flex-column">

      <!-- Dashboards Collapse -->
      <?php if ($roleId == 1): ?>
      <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#dashboards" role="button" aria-expanded="false" aria-controls="dashboards">
          <i class="fas fa-sliders-h"></i> Dashboards
        </a>
        <div class="collapse" id="dashboards">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="analytics" class="nav-link text-white <?= urlIs('analytics') ? 'active bg-dark text-white' : '' ?>">Analytics</a>
            </li>
            <li class="nav-item">
              <a href="setting" class="nav-link text-white <?= urlIs('setting') ? 'active bg-dark text-white' : '' ?>">Settings</a>
            </li>
          </ul>
        </div>
      </li>
      <?php endif; ?>

      <!-- Pages Collapse -->
      <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="pages">
          <i class="fas fa-th-large"></i> Pages
        </a>
        <div class="collapse" id="pages">
          <ul class="nav flex-column ms-3">
              <?php if ($roleId == 1): // Super Admin ?>
        <li class="nav-item"><a href="user" class="nav-link text-white <?= urlIs('user') ? 'active bg-dark text-white' : '' ?>">Users</a></li>
        <li class="nav-item"><a href="hotel" class="nav-link text-white <?= urlIs('hotel') ? 'active bg-dark text-white' : '' ?>">Hotels</a></li>
        <li class="nav-item"><a href="rooms" class="nav-link text-white <?= urlIs('rooms') ? 'active bg-dark text-white' : '' ?>">Rooms</a></li>
        <li class="nav-item"><a href="services" class="nav-link text-white <?= urlIs('services') ? 'active bg-dark text-white' : '' ?>">Services</a></li>
        <li class="nav-item"><a href="discount" class="nav-link text-white <?= urlIs('discount') ? 'active bg-dark text-white' : '' ?>">Discounts</a></li>
        <li class="nav-item"><a href="reservation" class="nav-link text-white <?= urlIs('reservation') ? 'active bg-dark text-white' : '' ?>">Reservations</a></li>
        <li class="nav-item"><a href="payment" class="nav-link text-white <?= urlIs('payment') ? 'active bg-dark text-white' : '' ?>">Payments</a></li>



    <?php elseif ($roleId == 2): // Staff ?>
        <li class="nav-item"><a href="reservation" class="nav-link text-white <?= urlIs('reservation') ? 'active bg-dark text-white' : '' ?>">Reservations</a></li>
        <li class="nav-item"><a href="services" class="nav-link text-white <?= urlIs('services') ? 'active bg-dark text-white' : '' ?>">Services</a></li>
        <li class="nav-item"><a href="rooms" class="nav-link text-white <?= urlIs('rooms') ? 'active bg-dark text-white' : '' ?>">Rooms</a></li>
            <?php elseif ($roleId == 4): ?>
              <li class="nav-item"><a href="user" class="nav-link text-white <?= urlIs('user') ? 'active bg-dark text-white' : '' ?>">My Profile</a></li>
              <li class="nav-item"><a href="reservation" class="nav-link text-white <?= urlIs('reservation') ? 'active bg-dark text-white' : '' ?>">My Reservations</a></li>
            <?php else: ?>
              <li class="nav-item"><a href="login" class="nav-link text-white">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </li>

    </ul>
  </aside>

</div>

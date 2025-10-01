
<!-- Content Wrapper -->
<div class="content-wrapper">

  <aside id="sidebar">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand d-flex align-items-center">
      <span class="sidebar-brand-text">
        Hotel-Reservation
      </span>
      <i class="fas fa-cube ms-2"></i>
    </div>

    <!-- User Section -->
    <div class="sidebar-user">
      <div class="d-flex justify-content-center">
        <div class="flex-shrink-0">
          <img src="Assets/dashboard/img/avatar.jpg" class="avatar img-fluid" alt="User Avatar">
        </div>
        <div class="flex-grow-1 ms-2">
          <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
            Charles Hall
          </a>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <ul class="sidebar-nav list-unstyled">
      <li class="sidebar-item">
        <a data-bs-toggle="collapse" href="#dashboards" class="sidebar-link collapsed">
          <i class="fas fa-sliders-h"></i> <span class="align-middle">Dashboards</span>
        </a>
        <div id="dashboards" class="collapse">
          <ul class="sidebar-dropdown list-unstyled">
           
            <li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('analytics') ? 'active bg-dark text-white' : '' ?>" href="analytics">Analytics</a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('setting') ? 'active bg-dark text-white' : '' ?>" href="setting">Settings</a>
</li>
          </ul>
        </div>
      </li>

      <li class="sidebar-item">
        <a data-bs-toggle="collapse" href="#pages" class="sidebar-link collapsed">
          <i class="fas fa-th-large"></i> <span class="align-middle">Pages</span>
        </a>
        <div id="pages" class="collapse">
          <ul class="sidebar-dropdown list-unstyled">
            <li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('user') ? 'active bg-dark text-white' : '' ?>" href="/user">User</a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('hotel') ? 'active bg-dark text-white' : '' ?>" href="/hotel">Hotels</a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('rooms') ? 'active bg-dark text-white' : '' ?>" href="/rooms">Rooms</a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('services') ? 'active bg-dark text-white' : '' ?>" href="/services">Services</a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('discount') ? 'active bg-dark text-white' : '' ?>" href="/discount">Discounts</a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('reservation') ? 'active bg-dark text-white' : '' ?>" href="/reservation">Reservations</a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('payment') ? 'active bg-dark text-white' : '' ?>" href="/payment">Payments</a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link <?= urlIs('details') ? 'active bg-dark text-white' : '' ?>" href="/details">details</a>
</li>
            <!-- <li class="sidebar-item"><a class="sidebar-link" href="user.php">User </a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="hotel.php">Hotels </a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="room.php">Rooms </a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="service.php">Services </a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="discount.php">Discounts </a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="reservation.php">Reservations</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="payment.php">Payments </a></li> -->
          </ul>
        </div>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="#">
          <i class="fas fa-user"></i> <span class="align-middle">Profile</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a data-bs-toggle="collapse" href="#auth" class="sidebar-link collapsed">
          <i class="fas fa-users"></i> <span class="align-middle">Auth</span>
        </a>
        <div id="auth" class="collapse">
          <ul class="sidebar-dropdown list-unstyled">
            <li class="sidebar-item"><a class="sidebar-link" href="#">Sign In</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="#">Sign Up</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </aside>

</div>



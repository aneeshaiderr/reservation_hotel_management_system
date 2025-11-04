<?php
require __DIR__.'/../partial/head.php';
require __DIR__.'/../partial/nav.php';
require __DIR__.'/../partial/sidebar.php';
// Feedback2-- Should be moved into the views folder
?>

<div class="main-content">
  <div class="container">

<div class="d-flex flex-column min-vh-100">

  <!-- Main -->
  <main class="flex-grow-1 container py-5">
    <h1 class="h3 fw-bold text-dark mb-4">Settings</h1>
    <div class="row g-4">

      <!-- Sidebar -->
      <aside class="col-md-3">
        <div class="border rounded p-3 bg-white shadow-sm">
          <ul class="nav flex-column nav-pills">
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="pill" href="#profile">Profile Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " data-bs-toggle="pill" href="#account">Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="pill" href="#password">Password</a>
            </li>
            <li><a href="#" class="d-block px-3 py-2 rounded text-dark text-decoration-none">Privacy and safety</a></li>
            <li><a href="#" class="d-block px-3 py-2 rounded text-dark text-decoration-none">Email notifications</a></li>
            <li><a href="#" class="d-block px-3 py-2 rounded text-dark text-decoration-none">Web notifications</a></li>
            <li><a href="#" class="d-block px-3 py-2 rounded text-dark text-decoration-none">Widgets</a></li>
            <li><a href="#" class="d-block px-3 py-2 rounded text-dark text-decoration-none">Your data</a></li>
          </ul>
        </div>
      </aside>

      <!-- Content -->
      <div class="col-md-9">
        <div class="tab-content">

          <!-- Account Tab -->
          <div class="tab-pane fade show active" id="account">
            <div class="bg-white p-4 rounded shadow-sm border">
              <h2 class="h5 fw-semibold text-dark mb-4">Account Info</h2>
              <form class="row gy-3">
                <div class="col-md-6">
                  <label for="first-name" class="form-label">First Name</label>
                  <input type="text" id="first-name" class="form-control" value="John">
                </div>
                <div class="col-md-6">
                  <label for="last-name" class="form-label">Last Name</label>
                  <input type="text" id="last-name" class="form-control" value="Doe">
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" class="form-control" value="johndoe@email.com">
                </div>
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" id="phone" class="form-control" value="+92 300 1234567">
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Password Tab -->
          <div class="tab-pane fade" id="password">
            <div class="bg-white p-4 rounded shadow-sm border">
              <h2 class="h5 fw-semibold text-dark mb-4">Password</h2>
              <form class="row gy-3">
                <div class="col-12">
                  <label for="current-password" class="form-label">Current password</label>
                  <input type="password" id="current-password" class="form-control">
                </div>
                <div class="col-12">
                  <a href="#" class="small text-primary text-decoration-none">Forgot your password?</a>
                </div>
                <div class="col-12">
                  <label for="new-password" class="form-label">New password</label>
                  <input type="password" id="new-password" class="form-control">
                </div>
                <div class="col-12">
                  <label for="verify-password" class="form-label">Verify password</label>
                  <input type="password" id="verify-password" class="form-control">
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Profile Settings Tab -->
          <div class="tab-pane fade" id="profile">
            <div class="bg-white p-4 rounded border shadow-sm">
              <h2 class="h5 fw-semibold text-dark mb-4">Public info</h2>
              <div class="row g-4">
                <div class="col-md-8">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" value="Username">
                  </div>
                  <div class="mb-3">
                    <label for="biography" class="form-label">Biography</label>
                    <textarea id="biography" rows="4" class="form-control" placeholder="Tell something about yourself"></textarea>
                  </div>
                  <button class="btn btn-primary">Save changes</button>
                </div>
                <div class="col-md-4 text-center">
                  <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjOoHeTFA5cQiqGVrscSCkYy9eSgBxizv7sGcdav3BWn1UG1MPJnPae5X54vfAYXXEqWN1UwoSqNeoaZUCpJO2s5gXoKfpjaw1z7euT-aHL1Sgt4juXumzPb2Ek7cWSinyvmhH1kzpSg2go9KgKsDLwwe3lG2BnaUkt1lXgau_qEs_9wdpMhT0CiO1SP8Vu3r1SMYf1xTkB7Igw-biwhXEDdlqtiBKbHWdlDchzKiVRaGxXfhy8MQhOJ5Et8fZR12Ql4pLhSV6Ng8" 
                       alt="Profile picture" class="rounded-circle mb-3" width="128" height="128">
                  <button class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-1 mx-auto">
                    <span class="material-icons">upload</span> Upload
                  </button>
                  <p class="text-muted small mt-2">For best results, use an image at least 128px by 128px in .jpg format</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>
</div>


  <!-- Footer Include -->
   <?php
 require __DIR__.'/../partial/footer.php';
?>


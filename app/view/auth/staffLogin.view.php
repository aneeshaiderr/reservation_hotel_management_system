

<?php
 require __DIR__ . '/../partial/head.php'; 
?>
<?php


// Agar token already exist nahi karta, to generate karo
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Token variable me store karo
$csrf_token = $_SESSION['csrf_token'];
?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow">
      <div class="card-body p-5">
        <h2 class="text-center mb-4 fw-bold text-warning">Login</h2>

        <form action="staffLogin" method="POST">

          <!-- Email -->
          <div class="mb-3">
            <input type="user_email" id="user_email" name="user_email" class="form-control" placeholder="Enter your email" required>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <?php if(isset($errors['user_email'])):?>
              <div class="text-danger small mt-1"><?= $errors['user_email']?> </div>
            <?php endif; ?>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            <?php if(isset($errors['password'])):?>
              <div class="text-danger small mt-1"><?= $errors['password']?> </div>
            <?php endif; ?>
          </div>

          <!-- Submit -->
          <div class="d-flex">
            <button type="submit" class="btn-bl btn-primary bt-primary fw-bold  w-100 text-white bg-warning pe-4">
              Login
            </button>
          </div>

        </form>
      </div>

      <!-- Footer -->
      <div class="card-footer text-center bg-light py-3">
        <p class="mb-0">
          Don't have an account?
         
          <a href="<?= BASE_URL ?>/staffSignup" class="text-primary fw-semibold">Signup now</a>
        </p>
      </div>
    </div>
  </div>
</div>



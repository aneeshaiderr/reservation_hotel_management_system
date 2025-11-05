
<?php require __DIR__.'/../partial/head.php'; ?>
<?php



if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<div class="alert alert-danger">';
    foreach ($_SESSION['errors'] as $error) {
        echo '<p class="mb-1">' . htmlspecialchars($error) . '</p>';
    }
    echo '</div>';
    unset($_SESSION['errors']);
}

if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <p class="mb-0"><?= htmlspecialchars($_SESSION['success']); ?></p>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>



<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow">
      <div class="card-body p-5">
        <h2 class="text-center mb-4 fw-bold text-primary">Login</h2>

        <form action="login" method="POST">

          <!-- Email -->
          <div class="mb-3">
            <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Enter your email" required>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
            <?php if (isset($errors['user_email'])) { ?>
              <div class="text-danger small mt-1"><?= htmlspecialchars($errors['user_email']); ?> </div>
            <?php } ?>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            <?php if (isset($errors['password'])) { ?>
              <div class="text-danger small mt-1"><?= htmlspecialchars($errors['password']); ?> </div>
            <?php } ?>
          </div>

          <!-- Submit -->
          <div class="d-flex">
            <button type="submit" class="btn-bl btn-primary bt-primary fw-bold w-100 text-white pe-4">
              Login
            </button>
          </div>

        </form>
      </div>

      <!-- Footer -->
      <div class="card-footer text-center bg-light py-3">
        <p class="mb-0">
          Don't have an account?
          <a href="<?= BASE_URL ?>/signup" class="text-primary fw-semibold">Signup now</a>
        </p>
      </div>
    </div>
  </div>
</div>





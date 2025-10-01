

<?php require __DIR__ . '/../partial/head.php'; ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow">
      <div class="card-body p-5">
        <h2 class="text-center mb-4 fw-bold text-primary">Login</h2>

        <form action="login" method="POST">

          <!-- Email -->
          <div class="mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            <?php if(isset($errors['email'])):?>
              <div class="text-danger small mt-1"><?= $errors['email']?> </div>
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
            <button type="submit" class="btn-bl btn-primary bt-primary fw-bold  w-100 text-white  pe-4">
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


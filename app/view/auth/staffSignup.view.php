


 <?php require __DIR__ . '/../partial/head.php'; ?>


<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow">
      <div class="card-body p-4">
          <h2 class="text-center mb-4 fw-bold text-warning">Signup</h2>

          <form action="staffSignup" method="POST">

            <!-- First Name -->
            <div class="mb-3">
              <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter your first name" required>
              <?php if(isset($errors['first_name'])):?>
                <div class="text-danger small mt-1"><?= $errors['first_name']?> </div>
              <?php endif; ?>
            </div>

            <!-- Last Name -->
            <div class="mb-3">
              <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter your last name" required>
              <?php if(isset($errors['last_name'])):?>
                <div class="text-danger small mt-1"><?= $errors['last_name']?> </div>
              <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
              <?php if(isset($errors['email'])):?>
                <div class="text-danger small mt-1"><?= $errors['email']?> </div>
              <?php endif; ?>
            </div>

            <!-- Contact -->
            <div class="mb-3">
              <input type="text" id="contact" name="contact_no" class="form-control" placeholder="Enter your contact number" required>
              <?php if(isset($errors['contact_no'])):?>
                <div class="text-danger small mt-1"><?= $errors['contact_no']?> </div>
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
  <button type="submit" class="btn-bl btn-primary bt-primary fw-bold  w-100 text-white bg-warning  pe-4">Signup</button>
</div>

          </form>
        </div>

        <!-- Footer -->
        <div class="card-footer text-center bg-light py-3">
          <p class="mb-0">Already have an account? <a href="<?= BASE_URL ?>/staffLogin" class="text-primary fw-semibold">Login now</a></p>
        </div>
      </div>
    </div>
  </div>

 


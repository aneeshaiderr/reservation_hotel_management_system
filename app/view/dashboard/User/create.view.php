

<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-2 px-2">
        <h5 class="fw-bold mt-5 text-primary">Create User</h5>

        <form action="<?= url('/user/store') ?>" method="POST">

          <!-- First Name -->
          <div class="mb-3">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" required>
            <?php if (isset($errors['first_name'])) { ?>
              <div class="text-danger small mt-1"><?= $errors['first_name'] ?></div>
            <?php } ?>
          </div>

          <!-- Last Name -->
          <div class="mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" required>
            <?php if (isset($errors['last_name'])) { ?>
              <div class="text-danger small mt-1"><?= $errors['last_name'] ?></div>
            <?php } ?>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="user_email">Email</label>
            <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Enter email" required>
            <?php if (isset($errors['user_email'])) { ?>
              <div class="text-danger small mt-1"><?= $errors['user_email'] ?></div>
            <?php } ?>
          </div>

          <!-- Contact -->
          <div class="mb-3">
            <label for="contact_no">Contact Number</label>
            <input type="text" id="contact_no" name="contact_no" class="form-control" placeholder="Enter contact number" required>
            <?php if (isset($errors['contact_no'])) { ?>
              <div class="text-danger small mt-1"><?= $errors['contact_no'] ?></div>
            <?php } ?>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
            <?php if (isset($errors['password'])) { ?>
              <div class="text-danger small mt-1"><?= $errors['password'] ?></div>
            <?php } ?>
          </div>

          <!-- Submit Button -->
          <div class="d-flex">
            <button type="submit" class="btn btn-primary fw-bold w-100 text-white">Create User</button>
          </div>

        </form>
      </div>
    </main>
  </div>

           

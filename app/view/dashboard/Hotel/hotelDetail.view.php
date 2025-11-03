
<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Hotel</h5>

        <form method="POST" action="<?= url('/hotel') ?>">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="id" value="<?= htmlspecialchars($hotel['id']) ?>">
  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
          <!-- Hotel Name -->
          <div class="mb-4">
            <label for="name">Hotel Name</label>
            <input type="text" id="hotel_name" name="hotel_name"
              value="<?= htmlspecialchars($hotel['hotel_name']) ?>" required
              class="form-control">
          </div>

          <!-- Address -->
          <div class="mb-4">
            <label for="address">Address</label>
            <textarea id="address" name="address" class="form-control" required><?= htmlspecialchars($hotel['address']) ?></textarea>
          </div>

          <!-- Contact -->
          <div class="mb-4">
            <label for="contact_no">Contact No</label>
            <input type="text" id="contact_no" name="contact_no"
              value="<?= htmlspecialchars($hotel['contact_no']) ?>" required
              class="form-control">
          </div>

       

          <!-- Buttons -->
          <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="<?= url('/hotel') ?>">Cancel</a>
            <button type="submit"
              style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;"
              onmouseover="this.style.backgroundColor='#15803d'"
              onmouseout="this.style.backgroundColor='#16a34a'">
              Update
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>







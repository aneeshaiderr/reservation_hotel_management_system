<?php  
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="main-content">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Reservation</h5>

        <form method="POST" action="<?= url('/reservation') ?>">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="id" value="<?= htmlspecialchars($reservation['id']) ?>">

          <!-- User ID -->
     

          <!-- Hotel Code -->
          <div class="mb-4">
            <label for="hotel_code">Hotel Code</label>
            <input type="text" id="hotel_code" name="hotel_code"
              value="<?= htmlspecialchars($reservation['hotel_code']) ?>" required
              class="form-control">
          </div>

          
<!-- Hotel Name -->
  <div class="mb-4">
            <label for="discount_id">Hotel Name</label>
  <select id="hotel_id" name="hotel_id" class="form-control" required>
    <option value="">Select Hotel</option>
    <?php foreach ($hotels as $hotel): ?>
        <option value="<?= $hotel['id'] ?>" 
            <?= $reservation['hotel_id'] == $hotel['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($hotel['hotel_name']) ?>
        </option>
    <?php endforeach; ?>
</select>
</div>
<!-- Discount Name (from discounts table) -->
          <div class="mb-4">
            <label for="discount_id">Discount</label>
            <select id="discount_id" name="discount_id" class="form-control">
              <option value="">Select Discount</option>
              <?php foreach ($discounts as $discount): ?>
                <option value="<?= $discount['id'] ?>" 
                  <?= $reservation['discount_id'] == $discount['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($discount['discount_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Check-in Date -->
          <div class="mb-4">
            <label for="check_in">Check-in </label>
            <input type="date" id="check_in" name="check_in"
              value="<?= htmlspecialchars($reservation['check_in']) ?>" required
              class="form-control">
          </div>

          <!-- Check-out Date -->
          <div class="mb-4">
            <label for="check_out">Check-out </label>
            <input type="date" id="check_out_date" name="check_out"
              value="<?= htmlspecialchars($reservation['check_out']) ?>" required
              class="form-control">
          </div>

          <!-- Status -->
          <div class="mb-4">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
              <option value="active" <?= $reservation['status'] == 'active' ? 'selected' : '' ?>>Active</option>
              <option value="completed" <?= $reservation['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
              <option value="cancelled" <?= $reservation['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="<?= url('/reservation') ?>">Cancel</a>
            <button type="submit"
              style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;"
              onmouseover="this.style.backgroundColor='#15803d'"
              onmouseout="this.style.backgroundColor='#16a34a'">
              Update Reservation
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

<?php require __DIR__ . '../partial/footer.php'; ?>


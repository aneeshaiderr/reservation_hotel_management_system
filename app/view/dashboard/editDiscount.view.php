
<?php  
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="main-content">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Discount</h5>

        <form method="POST" action="<?= url('/discount/update') ?>">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="id" value="<?= htmlspecialchars($discount['id']) ?>">

          <!-- Discount Type -->
          <div class="mb-4">
            <label for="discount_type" class="form-label fw-bold">Discount Type</label>
            <select id="discount_type" name="discount_type" class="form-control" required>
              <option value="">Select Type</option>
              <option value="percentage" <?= $discount['discount_type'] === 'percentage' ? 'selected' : '' ?>>Percentage</option>
              <option value="amount" <?= $discount['discount_type'] === 'amount' ? 'selected' : '' ?>>Amount</option>
            </select>
          </div>
 <!--  Discount Name  -->
          <div class="mb-4">
            <label for="discount_name" class="form-label fw-bold">Discount Name</label>
            <input type="text" id="discount_name" name="discount_name"
              value="<?= htmlspecialchars($discount['discount_name'] ?? '') ?>"
              class="form-control" placeholder="Enter discount name" required>
          </div>
          <!-- Discount Value -->
          <div class="mb-4">
            <label for="value" class="form-label fw-bold">Discount Value</label>
            <input type="number" step="0.01" id="value" name="value"
              value="<?= htmlspecialchars($discount['value']) ?>"
              class="form-control" placeholder="Enter discount value" required>
          </div>

          <!-- Start Date -->
          <div class="mb-4">
            <label for="start_date" class="form-label fw-bold">Start Date</label>
            <input type="date" id="start_date" name="start_date"
              value="<?= htmlspecialchars($discount['start_date']) ?>"
              class="form-control" required>
          </div>

          <!-- End Date -->
          <div class="mb-4">
            <label for="end_date" class="form-label fw-bold">End Date</label>
            <input type="date" id="end_date" name="end_date"
              value="<?= htmlspecialchars($discount['end_date']) ?>"
              class="form-control" required>
          </div>

          <!-- Status -->
          <div class="mb-4">
            <label for="status" class="form-label fw-bold">Status</label>
            <select id="status" name="status" class="form-control" required>
              <option value="active" <?= $discount['status'] === 'active' ? 'selected' : '' ?>>Active</option>
              <option value="expired" <?= $discount['status'] === 'expired' ? 'selected' : '' ?>>Expired</option>
              <option value="pending" <?= $discount['status'] === 'panding' ? 'selected' : '' ?>>Pending</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="<?= url('/discount') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit"
              style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;"
              onmouseover="this.style.backgroundColor='#15803d'"
              onmouseout="this.style.backgroundColor='#16a34a'">
              Update Discount
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

<?php require __DIR__ . '../partial/footer.php'; ?>

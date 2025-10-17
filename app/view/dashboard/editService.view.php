
<?php  
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="main-content">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Service</h5>

        <form method="POST" action="<?= url('/services') ?>">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="id" value="<?= htmlspecialchars($service['id']) ?>">

          <!-- Service Name -->
          <div class="mb-4">
            <label for="service_name" class="form-label fw-bold">Service Name</label>
            <input type="text" id="service_name" name="service_name"
              value="<?= htmlspecialchars($service['service_name']) ?>"
              class="form-control" placeholder="Enter service name" required>
          </div>

          <!-- Price -->
          <div class="mb-4">
            <label for="price" class="form-label fw-bold">Price</label>
            <input type="number" step="0.01" id="price" name="price"
              value="<?= htmlspecialchars($service['price']) ?>"
              class="form-control" placeholder="Enter price" required>
          </div>

          <!-- Status -->
          <div class="mb-4">
            <label for="status" class="form-label fw-bold">Status</label>
            <select id="status" name="status" class="form-control" required>
              <option value="">Select Status</option>
              <option value="Active" <?= $service['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
              <option value="Inactive" <?= $service['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="<?= url('/services') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit"
              style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;"
              onmouseover="this.style.backgroundColor='#15803d'"
              onmouseout="this.style.backgroundColor='#16a34a'">
              Update Service
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

<?php require __DIR__ . '../partial/footer.php'; ?>

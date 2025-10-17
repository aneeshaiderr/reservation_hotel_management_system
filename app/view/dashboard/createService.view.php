<?php
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="main-content">
  <div class="container py-5">
    <h5 class="fw-bold mb-3 ps-2">Add New Service</h5>

    <div class="card card-custom w-100">
      <div class="card-body">
        <form action="<?= BASE_URL ?>/services" method="POST">

          <!-- <div class="mb-3">
            <label for="service_id" class="form-label fw-bold">Service ID</label>
            <input type="text" name="service_id" id="service_id" class="form-control" placeholder="Enter service ID" required>
          </div> -->

          <div class="mb-3">
            <label for="service_name" class="form-label fw-bold">Service Name</label>
            <input type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter service name" required>
          </div>

          <div class="mb-3">
            <label for="price" class="form-label fw-bold">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" step="0.01" required>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label fw-bold">Status</label>
            <select name="status" id="status" class="form-select" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
              <!-- <option value="maintenance">Maintenance</option> -->
            </select>
          </div>

          <div class="d-flex justify-content-between">
            <a href="<?= BASE_URL ?>/services" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-success">Create Service</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '../partial/footer.php'; ?>


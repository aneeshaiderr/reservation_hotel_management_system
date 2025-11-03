
<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="fw-bold mb-0">Create New Hotel</h5>
      
    </div>

    <div class="card card-custom w-100">
      <div class="card-body">
        <form action="<?= url('/hotel/store') ?>" method="POST">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">  
        <div class="mb-3">
            <label class="form-label fw-bold">Hotel Name</label>
            <input type="text" name="hotel_name" class="form-control" placeholder="Enter hotel name" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Contact Number</label>
            <input type="text" name="contact_no" class="form-control" placeholder="Enter contact number" required>
          </div>

          <button type="submit" class="btn btn-success">Save Hotel</button>
          <a href="<?= url('/hotel') ?>" class="btn btn-secondary btn-sm">← Back to List</a>
        </form>
      </div>
    </div>
  </div>





<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <h5 class="fw-bold mb-2 ps-2">Discount</h5>
 <!--  Create Button -->
  <div class="mb-4">
      <a href="<?= url('/discount/createDiscount') ?>" class="btn btn-sm btn-success">
        + Create discount
      </a>
    </div>
    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Discount List</h6>

        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
             <th>ID</th>
              <th>Discount Type</th>
                 <th>Dis_Name</th>
              <th>Value</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
             <?php if (!empty($discounts)): ?>
            <?php foreach ($discounts as $discount): ?>
              <tr>
                  <td><?= htmlspecialchars($discount['id']) ?></td>
                <td><?= htmlspecialchars($discount['discount_type'] ?? '') ?></td>
                 <td><?= htmlspecialchars($discount['discount_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($discount['value'] ?? '') ?></td>
                <td><?= htmlspecialchars($discount['start_date'] ?? '') ?></td>
                <td><?= htmlspecialchars($discount['end_date'] ?? '') ?></td>
                <td>
                  <?php
                    $st = $discount['status'] ?? '';
                    if (strtolower($st) === 'active'): ?>
                      <span class="badge bg-success">Active</span>
                    <?php elseif (strtolower($st) === 'expired'): ?>
                        
                      <span class="badge bg-danger">Expired</span>
                    <?php else: ?>
                      <span class="badge bg-warning text-dark"><?= htmlspecialchars($st ?: 'Unknown') ?></span>
                    <?php endif; ?>
                </td>
             <td>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= BASE_URL ?>/discount/editDiscount?id=<?= $discount['id'] ?>" 
       class="btn btn-sm btn-primary py-1 px-3">
       View
    </a>

    <form action="<?= url('/discount/delete') ?>" 
          method="POST" 
          onsubmit="return confirm('Are you sure you want to delete this discount?');" 
          class="m-0">
      <input type="hidden" name="id" value="<?= $discount['id'] ?>">
      <button type="submit" 
              class="btn btn-sm btn-danger py-1 px-3">
              Delete
      </button>
    </form>
  </div>
</td>
              
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
           
        </table>
      </div>
    </div>
  </div>

                  



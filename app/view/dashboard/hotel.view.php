<?php
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="main-content">
  <div class="container py-5">
    <h5 class="fw-bold mb-2 ps-2">Hotels</h5>
 <!--  Create Button -->
  <div class="mb-4">
      <a href="<?= url('/hotel/create') ?>" class="btn btn-sm btn-success">
        + Create Hotel
      </a>
    </div>
    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Hotel List</h6>

        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Hotel Name</th>
              <th>Address</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($hotels)): ?>
              <?php foreach ($hotels as $hotel): ?>
                <tr>
                  <td><?= htmlspecialchars($hotel['id']) ?></td>
                  <td><?= htmlspecialchars($hotel['hotel_name']) ?></td>
                  <td><?= htmlspecialchars($hotel['address']) ?></td>
                  <td><?= htmlspecialchars($hotel['contact_no']) ?></td>
                  <td class="action-btns d-flex gap-2">
                    <a href="<?= BASE_URL ?>/hotel/hotelDetail?id=<?= $hotel['id'] ?>" class="btn btn-sm btn-primary">View</a>

                    <!--  Delete Button (Soft Delete Form) -->
                    <form action=<?= url('/hotel/delete') ?> method="POST" onsubmit="return confirm('Are you sure you want to delete this hotel?');">
                      <input type="hidden" name="id" value="<?= $hotel['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted">No hotels found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
require __DIR__ . '../partial/footer.php';
?>


<div class="main-content d-flex flex-column min-vh-100">

   <!-- User Heading  -->
  <div class="container py-5">
    <h5 class="fw-bold mb-2 ps-2">Hotels</h5>
 <!--  Create Button -->
  <div class="mb-2">
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
            <?php if (! empty($hotels)) { ?>
              <?php foreach ($hotels as $hotel) { ?>
                <tr>
                  <td><?= htmlspecialchars($hotel['id']) ?></td>
                  <td><?= htmlspecialchars($hotel['hotel_name']) ?></td>
                  <td><?= htmlspecialchars($hotel['address']) ?></td>
                  <td><?= htmlspecialchars($hotel['contact_no']) ?></td>
                 <td>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= BASE_URL ?>/hotel/hotelDetail?id=<?= $hotel['id'] ?>" 
       class="btn btn-sm btn-primary py-1 px-3">
       View
    </a>

    <form action="<?= url('/hotel/delete') ?>" 
          method="POST" 
          onsubmit="return confirm('Are you sure you want to delete this hotel?');" 
          class="m-0">
      <input type="hidden" name="id" value="<?= $hotel['id'] ?>">
      <button type="submit" 
              class="btn btn-sm btn-danger py-1 px-3">
              Delete
      </button>
    </form>
  </div>
</td>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="5" class="text-center text-muted">No hotels found.</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
    </div>
      </div>
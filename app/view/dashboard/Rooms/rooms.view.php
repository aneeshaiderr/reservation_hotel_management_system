

<div class="main-content d-flex flex-column min-vh-100">

   <!-- User Heading  -->
  <div class="container py-5">
    <h5 class="fw-bold mb-2 mt-7 ps-2">Room</h5>
      <!-- Create Room Button -->
                <div class="mb-2">
                    <a href="<?= url('/roomCreate') ?>" 
                       class="btn btn-sm btn-success"
                       style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; text-decoration:none;">
                        + Create Room
                    </a>
                </div>
    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Room</h6>
        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Room ID</th>
              <th>Room Number</th>
              <!-- <th>Hotel Name</th> -->
              <th>Floor</th>
              <th>Room Bed</th>
              <th>Max Guest</th>
              <th>Status</th>
              <th>Action</th> 
            </tr>
          </thead>
          <tbody>
            <?php if (! empty($rooms)) { ?>
              <?php foreach ($rooms as $room) { ?>
                <tr>
                  <td><?= htmlspecialchars($room['id']) ?></td>
                   
                  <td><?= htmlspecialchars($room['room_number']) ?></td>
                  <td><?= htmlspecialchars($room['floor']) ?></td>
                  <td><?= htmlspecialchars($room['beds']) ?></td>
                  <td><?= htmlspecialchars($room['max_guests']) ?></td>
                  <td>
                    <?php if ($room['status'] === 'available') { ?>
                      <span class="badge bg-success">Available</span>
                    <?php } elseif ($room['status'] === 'booked') { ?>
                      <span class="badge bg-danger">Booked</span>
                    <?php } else { ?>
                      <span class="badge bg-warning text-dark">Maintenance</span>
                    <?php } ?>
                  </td>
                  <td>
                    <!--  Action Buttons -->
                    <a href="<?= BASE_URL ?>/roomDetail?id=<?= $room['id'] ?>"
                       class="btn btn-sm btn-success me-2">View</a>
                    
                    <form action="<?= url('/rooms/delete') ?>" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?= $room['id'] ?>">
    <button type="submit" class="btn btn-sm btn-danger"
        onclick="return confirm('Are you sure you want to delete this room?');">
        Delete
    </button>
</form>
                  </td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="7" class="text-center">No rooms found.</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   
            


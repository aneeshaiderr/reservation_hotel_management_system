

<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="fw-bold mb-2 ps-2">Reservations</h5>

    </div>
 <div class="mb-4">
                    <a href="<?= url('/reservation/reservationCreate') ?>" 
                       class="btn btn-sm btn-success"
                       style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; text-decoration:none;">
                        + Create Reservation
                    </a>
                </div>
    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Reservation List</h6>

        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
           
 
  <th>Hotel Code</th>
  <th>Email</th> 
  <th>Hotel Name</th> 
  <th>Room ID</th>
  <th>Dis_name</th>
  <th>Check In</th>
  <th>Check Out</th>
  <th>Status</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php if (!empty($reservations)): ?>
  <?php foreach ($reservations as $res): ?>
    <tr>
     
      <td><?= htmlspecialchars($res['hotel_code']) ?></td>
   <td><?= htmlspecialchars($res['user_email']) ?>
      <td><?= htmlspecialchars($res['hotel_name']) ?></td>
      
      <td><?= htmlspecialchars($res['room_id']) ?></td>
       <td><?= htmlspecialchars($res['discount_name']) ?></td>
      <td><?= htmlspecialchars($res['check_in']) ?></td>
      <td><?= htmlspecialchars($res['check_out']) ?></td>
      <td><?= htmlspecialchars($res['status']) ?></td>
      <td>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= BASE_URL ?>/reservation/editReservation?id=<?= $res['id'] ?>" 
       class="btn btn-sm btn-primary py-1 px-3">
       View
    </a>

    <form action="<?= BASE_URL ?>/reservation/delete" 
          method="POST" 
          onsubmit="return confirm('Are you sure you want to delete this reservation?');" 
          class="m-0">
      <input type="hidden" name="hotel_code" value="<?= $res['hotel_code'] ?>">
      <button type="submit" 
              class="btn btn-sm btn-danger py-1 px-3">
              Delete
      </button>
    </form>
  </div>
</td>

  <?php endforeach; ?>
<?php else: ?>
  <tr>
    <td colspan="10" class="text-center text-muted">No reservations found.</td>
  </tr>
<?php endif; ?>
</tbody>

        </table>
      </div>
 </div>
 </div>
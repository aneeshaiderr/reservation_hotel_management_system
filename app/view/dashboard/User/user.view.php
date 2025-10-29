
<div class="main-content d-flex flex-column min-vh-100">
  <div class="container d-flex justify-content-center align-items-center flex-column min-vh-100">
    <div class="row w-100 justify-content-center">

      <!-- User Details -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center">Current Details</div>
          <div class="card-body">
            <?php if ($user): ?>
              <p><strong>ID:</strong> <?= htmlspecialchars($user['id']) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($user['user_email']) ?></p>
              <p><strong>First-Name:</strong> <?= htmlspecialchars($user['first_name']) ?></p>
              <p><strong>Last-Name:</strong> <?= htmlspecialchars($user['last_name']) ?></p>
              <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
              <p><strong>Contact_No:</strong> <?= htmlspecialchars($user['contact_no']) ?></p>
              <p><strong>Status:</strong> <?= htmlspecialchars($user['status']) ?></p>
            <?php else: ?>
              <p>No user details found.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Reservation Details -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white text-center">My Reservation</div>
          <div class="card-body">
            <?php
            if ($user && isset($user['id'])) {
              if (!empty($currentReservation) && isset($currentReservation['user_id']) && $currentReservation['user_id'] == $user['id']) {
                $now = new DateTime();
                $checkout = new DateTime($currentReservation['check_out']);
                $interval = $now->diff($checkout);
                $timeLeft = $checkout > $now
                  ? $interval->format('%a days, %h hours left')
                  : 'Checked out';
            ?>
                <p><strong>Hotel Name:</strong> <?= htmlspecialchars($currentReservation['hotel_name']) ?></p>
                <p><strong>Hotel Code:</strong> <?= htmlspecialchars($currentReservation['hotel_code']) ?></p>
                <p><strong>Check-in:</strong> <?= htmlspecialchars($currentReservation['check_in']) ?></p>
                <p><strong>Check-out:</strong> <?= htmlspecialchars($currentReservation['check_out']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($currentReservation['status']) ?></p>
                <p><strong>Time Left to Check-out:</strong> <?= htmlspecialchars($timeLeft) ?></p>

                <div class="d-flex gap-2 mt-3">
                  <a href="<?= BASE_URL ?>/userAllDetails?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">View All</a>
                  <a href="<?= BASE_URL ?>/userdetails?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">View</a>
                  <a href="<?= url('/user') ?>" class="btn btn-sm btn-danger">Cancel</a>
                  
                </div>
            <?php
              } else {
                echo "<p>No active reservations found for this user.</p>";
              }
            } else {
              echo "<p>User not found or not logged in.</p>";
            }
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>


<?php
require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';
?>

<div class="main-content">
    <div class="container py-5">
        <h5 class="fw-bold mb-2 ps-2">Create Reservation</h5>

        <div class="card card-custom w-100">
            <div class="card-body">
                <form method="POST" action="<?= url('/reservation') ?>">

                    <!-- Reservation Code -->
                    <div class="mb-3">
                        <label for="code" class="form-label">Hotel Code</label>
                        <input type="text" class="form-control" id="code" name="hotel_code" required>
                    </div>

                    <!-- User Email Dropdown -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User Email</label>
                        <select id="user_id" name="user_id" class="form-control" required>
                            <option value="">Select User</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['user_email']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Hotel Name Dropdown -->
                    <div class="mb-3">
                        <label for="hotel_id" class="form-label">Hotel</label>
                        <select id="hotel_id" name="hotel_id" class="form-control" required>
                            <option value="">Select Hotel</option>
                            <?php foreach ($hotels as $hotel): ?>
                                <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['hotel_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                   <div class="mb-3">
    <label for="room_id" class="form-label">Room ID</label>
    <select id="room_id" name="room_id" class="form-control" required>
        <option value="">Select Room ID</option>
        <?php foreach ($rooms as $room): ?>
            <option value="<?= $room['id'] ?>">
                <?= htmlspecialchars($room['room_id'] ?? 'id #' . $room['id']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

   <!-- ✅ Discount Dropdown -->
                    <div class="mb-3">
                        <label for="discount_id" class="form-label">Discount</label>
                        <select id="discount_id" name="discount_id" class="form-control">
                            <option value="">Select Discount </option>
                            <?php foreach ($discounts as $discount): ?>
                                <option value="<?= $discount['id'] ?>">
                                    <?= htmlspecialchars($discount['discount_name']) ?> - <?= htmlspecialchars($discount['discount_type']) ?> (<?= $discount['value'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Check In / Check Out -->
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check In</label>
                        <input type="date" class="form-control" id="check_in" name="check_in" required>
                    </div>

                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input type="date" class="form-control" id="check_out" name="check_out" required>
                    </div>

                    <!-- Status -->
                   <div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" class="form-control" required>
        <option value="active">Active</option>
        <option value="cancelled">Cancelled</option>
        <option value="completed">Completed</option>
    </select>
</div>

                    <button type="submit" class="btn btn-success">Create Reservation</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '../partial/footer.php';
?>

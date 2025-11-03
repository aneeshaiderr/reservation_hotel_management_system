<div class="main-content d-flex flex-column min-vh-100">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                All Reservations
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hotel Code</th>
                                <th>User ID</th>
                                <th>Hotel ID</th>
                                <th>Hotel Name</th>
                                <th>Room ID</th>
                                <th>Room Number</th>
                                <th>Staff ID</th>
                                <th>Discount ID</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (! empty($reservations) && is_array($reservations)) { ?>
                                <?php foreach ($reservations as $res) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($res['id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['hotel_code'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['user_id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['hotel_id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['hotel_name'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['room_id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['room_number'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['staff_id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['discount_id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['check_in'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['check_out'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($res['status'] ?? '') ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr><td colspan="14" class="text-center">No reservations found.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?= url('/user') ?>" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>


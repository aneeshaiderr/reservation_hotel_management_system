

<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
 
            <div class="mx-auto max-w-4xl py-7 px-7">
              <form method="POST" action="<?= url('/rooms/update') ?>">
    <input type="hidden" name="id" value="<?= (int) $room['id'] ?>">
    
                    <!-- <input type="hidden" name="_method" value="PATCH"> -->
                    <input type="hidden" name="id" value="<?= (int) $room['id'] ?>">

                    <!-- Room Number -->
                    <div class="mb-4">
                        <label for="room_number">Room Number</label>
                        <input type="number" id="room_number" name="room_number"
                               value="<?= (int) $room['room_number'] ?>" required>
                    </div>

                    <!-- Floor -->
                    <div class="mb-4">
                        <label for="floor">Floor</label>
                        <input type="number" id="floor" name="floor"
                               value="<?= (int) $room['floor'] ?>" required>
                    </div>

                    <!-- Room Bed -->
                    <div class="mb-4">
                        <label for="room_bed">Room Bed</label>
                        <input type="number" id="room_bed" name="room_bed"
                               value="<?= (int) $room['beds'] ?>" required>
                    </div>

                    <!-- Max Guest -->
                    <div class="mb-4">
                        <label for="Max_guests">Max Guest</label>
                        <input type="number" id="Max_guests" name="Max_guests"
                               value="<?= (int) $room['max_guests'] ?>" required>
                    </div>

                    <!-- Status -->
     <div class="mb-4">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="available" <?= $room['status'] === 'available' ? 'selected' : '' ?>>Available</option>
            <option value="booked" <?= $room['status'] === 'booked' ? 'selected' : '' ?>>Booked</option>
            <option value="maintenance" <?= $room['status'] === 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
        </select>
    </div>
                    <!-- Buttons: Update only -->
                    <div class="mt-6 flex items-center justify-end gap-x-4">
                        <a href="<?= url('/rooms') ?>">Cancel</a>
                        <button type="submit" 
                            style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;"
                            onmouseover="this.style.backgroundColor='#15803d'" 
                            onmouseout="this.style.backgroundColor='#16a34a'">
                            Update
                        </button>
                    </div>
                    
                </form>
            </div>
        </main>
    </div>




<?php 

require __DIR__ . '../partial/head.php';
require __DIR__ . '../partial/nav.php';
require __DIR__ . '../partial/sidebar.php';

?>
<div class="main-content">
    <div class="container py-5">
<form method="POST" action="<?= url('/user') ?>">
    <!-- First Name -->
    <div class="mb-4">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required>
    </div>

    <!-- Last Name -->
    <div class="mb-4">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required>
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>

    <!-- Contact -->
    <div class="mb-4">
        <label for="contact_no">Contact</label>
        <input type="text" id="contact_no" name="contact_no">
    </div>

    <!-- Address -->
    <div class="mb-4">
        <label for="address">Address</label>
        <textarea id="address" name="address"></textarea>
    </div>

    <!-- Status -->
    <div class="mb-4">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>
<select name="role_id" required>
    <option value="">-- Select Role --</option>
    <option value="1">Admin</option>
    <option value="2">User</option>
</select>

    <!-- Buttons -->
    <div class="mt-6 flex items-center justify-end gap-x-4">
        <a href="<?= url('/user') ?>">Cancel</a>
        <button type="submit"
            style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; border:none;">
            Create
        </button>
    </div>
</form>
</div>

<?php require __DIR__ . '/partial/footer.php'; ?>
</div>

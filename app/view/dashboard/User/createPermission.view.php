
<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
<h2>Assign Permissions to Role</h2>

<form action="<?= url('/permission') ?>" method="POST">

    <!-- Select Role -->
    <div class="mb-3">
        <label class="form-label">Select Role</label>
        <select name="role_id" class="form-control" required>
            <option value="">-- Select Role --</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id'] ?>"><?= htmlspecialchars(ucfirst($role['name'])) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Enter Permissions manually -->
    <div class="mb-3">
        <label class="form-label">Enter Permissions</label>
        <input type="text" name="permissions" class="form-control" placeholder="e.g. view_discount, delete_discount, create_user" required>

    </div>

    <button type="submit" class="btn btn-primary">Assign Permissions</button>
</form>
</div>
</div>

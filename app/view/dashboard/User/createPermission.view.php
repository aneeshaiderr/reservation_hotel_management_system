<h2>Assign Permissions to Role</h2>

<form action="<?= url('/permission') ?>" method="POST">

    <div class="mb-3">
        <label class="form-label">Select Role</label>
        <select name="role_id" class="form-control" required>
            <option value="">-- Select Role --</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id'] ?>"><?= ucfirst($role['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Enter Permissions</label>
        <input type="text" name="permissions" class="form-control" placeholder="Enter permissions separated by comma" required>
        <small class="text-muted">Example: view_discount, delete_discount, create_user</small>
    </div>

    <button type="submit" class="btn btn-primary">Assign Permissions</button>
</form>

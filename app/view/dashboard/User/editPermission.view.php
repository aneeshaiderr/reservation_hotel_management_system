<?php
// Assigned permissions ko comma-separated string me convert karo
$rolePermissions = array_map(function($p) {
    return $p['name'] ?? '';
}, $assignedPermissions ?? []);

$permissionsString = implode(', ', $rolePermissions);
?>

<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <!-- ✅ Permissions Table -->
        <div class="mb-5">
            <h3 class="fw-bold mb-3">All Permissions</h3>

            <table class="table table-bordered w-100">
                <thead style="background-color:#f3f4f6;">
                    <tr>
                        <th style="width:70%">Permission Name</th>
                        <th style="width:30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($permissions)): ?>
                        <?php foreach ($permissions as $perm): ?>
                            <tr>
                                <td><?= htmlspecialchars($perm['name']) ?></td>
                                <td>
                                    <form method="POST"
                                          action="<?= url('/permission/deletePermission') ?>"
                                          style="display:inline;"
                                          onsubmit="return confirm('Are you sure you want to delete this permission?');">
                                        <input type="hidden" name="name" value="<?= htmlspecialchars($perm['name']) ?>">
                                        <button type="submit"
                                                style="background-color:#dc2626; color:white; border:none; padding:6px 12px; border-radius:4px;"
                                                onmouseover="this.style.backgroundColor='#b91c1c'"
                                                onmouseout="this.style.backgroundColor='#dc2626'">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted">No permissions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- ✅ Update Role & Permissions Form -->
        <div class="card p-4 shadow-sm">
            <h4 class="mb-4">Edit Role: <?= htmlspecialchars($role['name'] ?? 'N/A') ?></h4>

            <form action="<?= url('/permission/updatePermission') ?>" method="POST">
                <!-- Hidden field for role ID -->
                <input type="hidden" name="role_id" value="<?= htmlspecialchars($role['id'] ?? '') ?>">

                <!-- Role Name -->
                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="role_name" class="form-control"
                           value="<?= htmlspecialchars($role['name'] ?? '') ?>"
                           placeholder="Enter role name">
                </div>

                <!-- Permissions Input -->
                <div class="mb-3">
                    <label class="form-label">Enter Permissions</label>
                    <input type="text" name="permissions" class="form-control"
                           placeholder="Enter permissions separated by comma"
                           value="<?= htmlspecialchars($permissionsString) ?>">
                    <small class="text-muted">
                        Example: view_discount, delete_discount, create_user
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Role & Permissions
                </button>
            </form>
        </div>

    </div>
</div>

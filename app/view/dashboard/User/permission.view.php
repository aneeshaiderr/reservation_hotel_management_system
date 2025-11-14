<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <h5 class="fw-bold mb-2 ps-2">Roles & Permissions</h5>

    <!-- Create Role Button -->
    <div class="mb-4">
      <a href="<?= url('/permission/createPermission') ?>" class="btn btn-sm btn-success">
        + Create Role
      </a>
    </div>

    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Roles List</h6>

        <table class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th width="60">ID</th>
              <th>Role Name</th>
              <th width="350">Assigned Permissions</th>
              <th width="150">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($roles)) : ?>
              <?php foreach ($roles as $role) : ?>
                <tr>
                  <!-- Role ID -->
                  <td><?= htmlspecialchars($role['id']) ?></td>

                  <!-- Role Name -->
                  <td><?= htmlspecialchars($role['name']) ?></td>

                  <!-- Assigned Permissions -->
                  <td>
                    <?php if (!empty($role['permissions'])): ?>
                      <?php foreach ($role['permissions'] as $perm): ?>
                        <span class="badge bg-info text-dark me-1">
                          <?= htmlspecialchars($perm) ?>
                        </span>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <span class="badge bg-secondary">No Permission</span>
                    <?php endif; ?>
                  </td>

                  <!-- Action Buttons -->
                  <td class="d-flex gap-2">
                    <a href="<?= url('/permission/editPermission?id=' . $role['id']) ?>"
                       class="btn btn-sm btn-primary py-1 px-3">
                      Edit
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center text-muted">No roles found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

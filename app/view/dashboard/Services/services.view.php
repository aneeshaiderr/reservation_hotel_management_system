

<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <h5 class="fw-bold mb-2 ps-2">Service</h5>
<div class="mb-4">
      <a href="<?= url('/createService') ?>" class="btn btn-sm btn-success">
        + Create Services
      </a>
    </div>
    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Service List</h6>

        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Service ID</th>
              <th>Service Name</th>
             
              <th>Price</th>
              
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <?php if (! empty($services)) { ?>
              <?php foreach ($services as $service) { ?>
                <tr>
                  <td><?= htmlspecialchars($service['id']) ?></td>
                  <td><?= htmlspecialchars($service['service_name']) ?></td>
                 
                  <td>$<?= htmlspecialchars($service['price']) ?></td>
                
                  <td>
                    <?php
                      $st = strtolower($service['status']);
                  if ($st === 'active') { ?>
                        <span class="badge bg-success">Active</span>
                      <?php } elseif ($st === 'Inactive') { ?>
                        <span class="badge bg-danger">Inactive</span>
                      <?php } else { ?>
                        <span class="badge bg-warning text-dark"><?= htmlspecialchars($service['status']) ?></span>
                      <?php } ?>
                  </td>

                 <td>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= BASE_URL ?>/services/editService?id=<?= $service['id'] ?>" 
       class="btn btn-sm btn-primary py-1 px-3">
       View
       </a>

       <form action="<?= url('/services/delete') ?>" 
          method="POST" 
          onsubmit="return confirm('Are you sure you want to delete this service?');" 
          class="m-0">
           <input type="hidden" name="id" value="<?= $service['id'] ?>">
          <button type="submit" 
              class="btn btn-sm btn-danger py-1 px-3">
              Delete
               </button>
            </form>
          </div>
           </td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="7" class="text-center text-muted">No services found</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>




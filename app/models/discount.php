<?php
require __DIR__ . '/../partial/head.php';
require __DIR__ . '/../partial/nav.php';
require __DIR__ . '/../partial/sidebar.php';
?>

   <!-- Main Content -->
   <div class="main-content">
        <div class="container py-5">
          <h5 class="fw-bold mb-2 ps-2">Discount</h5>
          <div class="card card-custom w-100">
            <div class="card-body">
              <h6 class="mb-3 fw-bold">Discount</h6>
              <table id="example" class="table table-striped table-bordered align-middle">
                <thead class="table-light">
 
    <tr>
      <th>Discount ID</th>
      <th>Discount Type</th>
      <th>Value</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>1</td>
        <td>Percentage</td>
        <td>10%</td>
        <td>2025-09-01</td>
        <td>2025-09-30</td>
        <td><span class="badge bg-success">Active</span></td>
    </tr>
    <tr>
        <td>2</td>
        <td>Fixed</td>
        <td>500 PKR</td>
        <td>2025-08-15</td>
        <td>2025-09-10</td>
        <td><span class="badge bg-danger">Expired</span></td>
    </tr>
    <tr>
        <td>3</td>
        <td>Percentage</td>
        <td>15%</td>
        <td>2025-09-05</td>
        <td>2025-09-20</td>
        <td><span class="badge bg-success">Active</span></td>
    </tr>
    <tr>
        <td>4</td>
        <td>Fixed</td>
        <td>1000 PKR</td>
        <td>2025-09-10</td>
        <td>2025-10-01</td>
        <td><span class="badge bg-warning text-dark">Upcoming</span></td>
    </tr>
    <tr>
        <td>5</td>
        <td>Percentage</td>
        <td>20%</td>
        <td>2025-08-01</td>
        <td>2025-08-31</td>
        <td><span class="badge bg-danger">Expired</span></td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
 <?php 
 require __DIR__ . '/../partial/footer.php';
  ?>



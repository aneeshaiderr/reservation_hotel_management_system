<?php
require __DIR__ . '/../partial/head.php';
require __DIR__ . '/../partial/nav.php';
require __DIR__ . '/../partial/sidebar.php';
?>

   <!-- Main Content -->
 
 <div class="main-content">
        <div class="container py-5">
          <h5 class="fw-bold mb-2 ps-2">Reservation</h5>
          <div class="card card-custom w-100">
            <div class="card-body">
              <h6 class="mb-3 fw-bold">Reservation</h6>
              <table id="example" class="table table-striped table-bordered align-middle">
                <thead class="table-light">
 
   <tr>
          <th>Reservation ID</th>
          <th>Discount ID</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Hotel ID</th>
          <th>Staff ID</th>
          <th>Service Date</th>
          <th>Guest ID</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>RES-1001</td>
          <td>DISC-10</td>
          <td>2025-09-01</td>
          <td>2025-09-05</td>
          <td>HOT-001</td>
          <td>STF-101</td>
          <td>2025-09-02</td>
          <td>GST-501</td>
        </tr>
        <tr>
          <td>RES-1002</td>
          <td>DISC-15</td>
          <td>2025-09-03</td>
          <td>2025-09-07</td>
          <td>HOT-002</td>
          <td>STF-102</td>
          <td>2025-09-04</td>
          <td>GST-502</td>
        </tr>
        <tr>
          <td>RES-1003</td>
          <td>DISC-05</td>
          <td>2025-09-04</td>
          <td>2025-09-06</td>
          <td>HOT-003</td>
          <td>STF-103</td>
          <td>2025-09-04</td>
          <td>GST-503</td>
        </tr>
        <tr>
          <td>RES-1004</td>
          <td>DISC-20</td>
          <td>2025-09-05</td>
          <td>2025-09-10</td>
          <td>HOT-004</td>
          <td>STF-104</td>
          <td>2025-09-06</td>
          <td>GST-504</td>
        </tr>
        <tr>
          <td>RES-1005</td>
          <td>DISC-12</td>
          <td>2025-09-06</td>
          <td>2025-09-08</td>
          <td>HOT-005</td>
          <td>STF-105</td>
          <td>2025-09-07</td>
          <td>GST-505</td>
        </tr>
      </tbody>
    </table>
  </div>

  </div>
</div>
 <?php 
 require __DIR__ . '/../partial/footer.php';
  ?>





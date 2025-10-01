<?php
require __DIR__ . '/../partial/head.php';
require __DIR__ . '/../partial/nav.php';
require __DIR__ . '/../partial/sidebar.php';
?>

   <!-- Main Content -->
   <div class="main-content">
        <div class="container py-5">
          <h5 class="fw-bold mb-2 ps-2">Payment</h5>
          <div class="card card-custom w-100">
            <div class="card-body">
              <h6 class="mb-3 fw-bold">Payment</h6>
              <table id="example" class="table table-striped table-bordered align-middle">
                <thead class="table-light">
 
   <tr>
          <th>Payment ID</th>
          <th>Reservation ID</th>
          <th>Payment Method</th>
          <th>Discount</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>PAY-1001</td>
          <td>RES-1001</td>
          <td>Credit Card</td>
          <td>10%</td>
          <td><span class="badge bg-success">Paid</span></td>
        </tr>
        <tr>
          <td>PAY-1002</td>
          <td>RES-1002</td>
          <td>Cash</td>
          <td>15%</td>
          <td><span class="badge bg-danger">Pending</span></td>
        </tr>
        <tr>
          <td>PAY-1003</td>
          <td>RES-1003</td>
          <td>Bank Transfer</td>
          <td>5%</td>
          <td><span class="badge bg-success">Paid</span></td>
        </tr>
        <tr>
          <td>PAY-1004</td>
          <td>RES-1004</td>
          <td>Debit Card</td>
          <td>20%</td>
          <td><span class="badge bg-warning text-dark">Failed</span></td>
        </tr>
        <tr>
          <td>PAY-1005</td>
          <td>RES-1005</td>
          <td>UPI</td>
          <td>12%</td>
          <td><span class="badge bg-success">Paid</span></td>
        </tr>
        <tr>
          <td>PAY-1006</td>
          <td>RES-1006</td>
          <td>Credit Card</td>
          <td>0%</td>
          <td><span class="badge bg-success">Refunded</span></td>
        </tr>
        <tr>
          <td>PAY-1007</td>
          <td>RES-1007</td>
          <td>Cash</td>
          <td>8%</td>
          <td><span class="badge bg-success">Paid</span></td>
        </tr>
        <tr>
          <td>PAY-1008</td>
          <td>RES-1008</td>
          <td>Bank Transfer</td>
          <td>5%</td>
          <td><span class="badge bg-success">Pending<span></td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</div>
 <?php 
 require __DIR__ . '/../partial/footer.php';
  ?>





<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
       <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
             <div class="iq-header-title">
                <h4 class="card-title">Fund Request</h4>
             </div>
          </div>
          <div class="iq-card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="font-size: 13px;">
                 <thead>
                    <tr>
                      <th>#</th>
                      <th>UserId</th> 
                      <th>Name</th>
                      <th>Requested Amount</th>
                      <th>Request Date</th>
                      <th>Payment Mode</th>
                      <th>Transaction No/ UTR No</th>
                      <th>Transaction Copy</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>
                    <?php
                $count = 0;
$queryFund = mysqli_query($con, 'SELECT a.*,b.paymentName from user_fund_request a, config_payment_details b WHERE a.payment_id=b.payment_id ORDER BY a.date_time DESC');
while ($valFund = mysqli_fetch_array($queryFund)) {
    ++$count; ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $valFund['user_id']; ?></td>
                      <td><?php echo $valFund['name']; ?></td>
                      <td>$ <?php echo $valFund['requestFund']; ?></td>
                      <td><i class="fa fa-clock-o"></i> <?php echo $valFund['date_time']; ?></td>
                      <td><?php echo $valFund['paymentName']; ?></td>
                      <td><?php echo $valFund['paymentHash']; ?></td>
                      <td><img src="<?php echo $valFund['transactionImage']; ?>" height="150px" width="150px" ></td>
                      <td><?php if ($valFund['status'] == 1) {
                          echo 'Approved';
                      } elseif ($valFund['status'] == 2) {
                          echo 'Rejected';
                      } elseif ($valFund['status'] == 0) {
                          echo 'Pending';
                      }?></td>
                      <td><a href="fundRequestDetails?RqsID=<?php echo $valFund['id']; ?>" class="btn btn-success"> More </a></td>
                    </tr> 
                    <?php } ?>
                 </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>
<script> 
var d = document.getElementById("transfer");
    d.className += " active";
var d = document.getElementById("fundRequest");
    d.className += " active";
</script>
</body>
</html>
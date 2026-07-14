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
                <h4 class="card-title">Daily Growth Details</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>          
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Roi Amount</th>
                        <th>Release Date</th>
                        <th>Purchase Amount</th>
                        <th>Income Percent</th>
                        <th>Release Status</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                  $count = 0;
$queryDetails = mysqli_query($con, "SELECT a.roiAmount,a.dateTime,a.releaseStatus,b.user_id,b.name,c.packageAmount,c.roiPercent from user_invest_income_details a, sub_admin_user_details b, user_invest_income_summary c WHERE a.summaryId='$_GET[summaryId]' AND a.member_id=b.member_id AND a.summaryId=c.summaryId ORDER BY a.dateTime DESC");
while ($valDetails = mysqli_fetch_array($queryDetails)) {
    ++$count; ?>
                      <tr class="gradeX">
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valDetails['user_id']; ?></td>
                        <td><?php echo $valDetails['name']; ?></td>
                        <td> <?php echo $valDetails['roiAmount']; ?></td>
                        <td><i class="fa fa-clock-0"></i> <?php echo $valDetails['dateTime']; ?></td>
                        <td> <?php echo $valDetails['packageAmount']; ?></td>
                        <td><?php echo $valDetails['roiPercent']; ?> <i class="fa fa-percent"></i></td>
                        <td><?php if ($valDetails['releaseStatus'] == 1) {
                            echo 'Released';
                        } else {
                            echo 'Flushed';
                        }?></td>
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
var d = document.getElementById("income");
  d.className += " active";
var d = document.getElementById("partnerIncome");
  d.className += " active";
</script>
</body>
</html>
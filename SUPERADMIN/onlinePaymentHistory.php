<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
if ($_GET) {
    if ($_GET['from_date']) {
        $show_date = $_GET['from_date'];
        $cal_date = date('Y-m-d', strtotime($show_date));
    }
    if ($_GET['to_date']) {
        $show_date1 = $_GET['to_date'];
        $cal_date1 = date('Y-m-d', strtotime($show_date1));
    }
} else {
    $show_date = date('d-m-Y');
    $show_date1 = date('d-m-Y');
    $cal_date = date('Y-m-d');
    $cal_date1 = date('Y-m-d');
} ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 ">
      <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
        </div>
        <div class="iq-card-body">
           <form>
              <div class="form-row">
                <div class="col-3">
                  <input type="text" name="from_date" id="from_date" class="form-control " placeholder="e.g. From Date" required value="<?php echo $show_date; ?>" readonly >
                </div>
                <div class="col-3">
                  <input type="text" name="to_date" id="to_date" class="form-control " placeholder="e.g. To Date" required="" value="<?php echo $show_date1; ?>" readonly >
                </div>
                <div class="col-2">
                  <input class="btn btn-primary" type="submit" value="Search" >
                </div>
              </div>
           </form>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
       <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
             <div class="iq-header-title">
                <h4 class="card-title">Fund Transfer History</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>
                        <th>UserId</th>
                        <th>Name</th>
                        <th>Invest Amount</th>
                        <th>Create Date</th>
                        <th>OrderId</th>
                        <th>Address</th>
                        <th>Pay Currency</th>
                        <th>Pay Amount</th>
                        <th>Pay Status</th>
                      </tr>
                   </thead>
                   <tbody>
                    <?php
                    $count = 0;
$queryInvest = mysqli_query($con, "SELECT a.packagePrice,a.addDate,a.orderId,a.priceAmount,a.payAmount,a.payCurrency,a.payAddress,a.paymentStatus,a.actionType,b.user_id,b.name FROM user_invest_purchase_details a, sub_admin_user_details b WHERE CAST(a.addDate AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.memberId=b.member_id order by a.addDate DESC");
while ($valInvest = mysqli_fetch_assoc($queryInvest)) {
    $paymentStatus = $valInvest['paymentStatus'];
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valInvest['user_id']; ?></td>
                        <td><?php echo $valInvest['name']; ?></td>
                        <td> <?php echo $valInvest['packagePrice']; ?></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($valInvest['addDate'])); ?></td>
                        <td><?php echo $valInvest['orderId']; ?></td>
                        <td><?php echo $valInvest['payAddress']; ?></td>
                        <td><?php echo $valInvest['payCurrency']; ?></td>
                        <td><?php echo $valInvest['payAmount']; ?> <?php echo $valInvest['payCurrency']; ?></td>
                        <td><?php if ($paymentStatus == 'finished') {
                            echo "<span class='badge badge-success'>FINISHED</span>";
                        } elseif ($paymentStatus == 'confirming') {
                            echo "<span class='badge badge-primary'>CONFIRMING</span>";
                        } elseif ($paymentStatus == 'refunded') {
                            echo "<span class='badge badge-danger'>REFUNDED</span>";
                        } elseif ($paymentStatus == 'failed') {
                            echo "<span class='badge badge-danger'>FAILED</span>";
                        } elseif ($paymentStatus == 'partially_paid') {
                            echo "<span class='badge badge-warning'>PARTIAL PAID</span>";
                        } elseif ($paymentStatus == 'sending') {
                            echo "<span class='badge badge-warning'>SENDING</span>";
                        } elseif ($paymentStatus == 'confirmed') {
                            echo "<span class='badge badge-success'>CONFIRMED</span>";
                        } elseif ($paymentStatus == 'waiting') {
                            echo "<span class='badge badge-primary'>WAITING</span>";
                        } elseif ($paymentStatus == 'expired') {
                            echo "<span class='badge badge-danger'>EXPIRED</span>";
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
var d = document.getElementById("transfer");
    d.className += " active";
var d = document.getElementById("onlinePaymentHistory");
    d.className += " active";
</script>
</body>
</html>
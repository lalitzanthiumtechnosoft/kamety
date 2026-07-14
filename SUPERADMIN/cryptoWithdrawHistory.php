<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
date_default_timezone_set('Asia/Kolkata');
$user_id1 = '';
if ($_GET) {
    if ($_GET['user_id']) {
        $user_id1 = $_GET['user_id'];
        $query = "SELECT count(*) from sub_admin_user_details where user_id='$user_id1'";
        $result = mysqli_query($con, $query);
        $val = mysqli_fetch_array($result);
        if ($val[0] == 0) { ?>
          <script>
            alert("Invalid User Id");
            </script>
          <?php
          $user_id1 = $_SESSION['admin_user_id'];
        }
    }
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
    $releaseType = 2;
}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 ">
      <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
        </div>
        <div class="iq-card-body">
           <form>
              <div class="form-row">
                <div class="col-2">
                  <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?php echo $user_id1; ?>" >
                </div>
                <div class="col-2">
                  <input type="text" name="from_date" id="from_date" class="form-control" placeholder="e.g. From Date" required value="<?php echo $show_date; ?>" readonly >
                </div>
                <div class="col-2">
                  <input type="text" name="to_date" id="to_date" class="form-control" placeholder="e.g. To Date" required value="<?php echo $show_date1; ?>" readonly >
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
                <h4 class="card-title">Crypto Withdraw Status</h4>
             </div>
          </div>
          <div class="iq-card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="font-size: 13px;">
                 <thead>
                    <tr>
                      <th>#</th>
                      <th>User Id</th>
                      <th>Name </th>
                      <th>Date</th>
                      <th>Wallet Debit</th>
                      <th>Gross Amount</th>
                      <th>Charge </th>
                      <th>Net Amount </th>
                      <th>Order Id</th>
                      <th>Currency Type</th>
                      <th>Wallet Address</th>
                      <th>Withdraw Status</th>
                      <th>Remark</th>
                      <th>Action Date</th>
                      <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>
                    <?php
                      $query_in = "SELECT member_id from sub_admin_user_details where user_id='$user_id1'";
$result = mysqli_query($con, $query_in);
$val1 = mysqli_fetch_array($result);
$member_id1 = $val1[0];

$query = '';
if ($user_id1 != '') {
    $query = $query." AND a.member_id='$member_id1'";
}
$count = 0;
$queryWithdraw = mysqli_query($con, "SELECT a.*,b.name,b.user_id,c.walletAddress,d.currencyName from user_wallet_withdrawal_crypto a, sub_admin_user_details b, user_wallet_address_details c, config_currency_list d WHERE CAST(a.date_time AS date) BETWEEN '$cal_date' AND '$cal_date1' AND a.payment_id=c.payment_id AND c.currency_id=d.currency_id AND a.member_id=b.member_id ".$query.' order by a.date_time desc');
while ($valWithdraw = mysqli_fetch_array($queryWithdraw)) {
    ++$count; ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $valWithdraw['user_id']; ?></td>
                      <td><?php echo $valWithdraw['name']; ?></td>
                      <td class="text-left"><?php echo $valWithdraw['date_time']; ?></td>
                      <td> <?php echo $valWithdraw['actualWithdraw'] * $valWithdraw['dollarRate']; ?></td>
                      <td><i class="fa fa-dollar"></i> <?php echo $valWithdraw['amount']; ?></td>
                      <td><i class="fa fa-dollar"></i> <?php echo $valWithdraw['withdrawCharge']; ?></td>
                      <td><i class="fa fa-dollar"></i> <?php echo $valWithdraw['netAmount']; ?></td>
                      <td><?php echo $valWithdraw['orderid']; ?></td>
                      <td><?php echo $valWithdraw['currencyName']; ?></td>
                      <td><?php echo $valWithdraw['walletAddress']; ?></td>
                      <td><?php if ($valWithdraw['released'] == 0) {
                          echo 'Processing';
                      } elseif ($valWithdraw['released'] == 1) {
                          echo 'Released';
                      } elseif ($valWithdraw['released'] == 2) {
                          echo 'Rejected';
                      } ?></td>
                      <td><?php echo $valWithdraw['remarks']; ?></td>
                      <td><?php echo $valWithdraw['payment_date']; ?></td>
                      <td><?php if ($valWithdraw['released'] == 0) { ?><a data-id="<?php echo $valWithdraw['id']; ?>" data-toggle="modal" data-target="#cryptoRemark" data-whatever="<?php echo $valWithdraw['id']; ?>" href="javascript:void(0)" class="btn btn-primary btn-xs" > Add </a><?php } ?></td>
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
<div class="modal fade" id="cryptoRemark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="cryptoRemarkDash">
             <!-- Content goes in here -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php include 'include/footer.php'; ?>
<script>
$('#cryptoRemark').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var id = recipient;
  $.ajax({
    type: "POST",
    url: "ajax_calls/cryptoRemarkAjax",
    data: { id: id },
    cache: false,
    success: function (data) {
      console.log(data);
      modal.find('.cryptoRemarkDash').html(data);
    },
    error: function(err) {
      console.log(err);
    }
  });  
})
var d = document.getElementById("payout");
    d.className += " active";
var d = document.getElementById("cryptoWithdrawHistory");
    d.className += " active";
</script>
</body>
</html>
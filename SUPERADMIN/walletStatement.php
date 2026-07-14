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
        $query = "select count(*) from sub_admin_user_details where user_id='$user_id1'";
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
                <div class="col-3">
                  <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?php echo $user_id1; ?>" >
                </div>
                <div class="col-3">
                  <input type="text" name="from_date" id="from_date" class="form-control" placeholder="e.g. From Date" required value="<?php echo $show_date; ?>" readonly >
                </div>
                <div class="col-3">
                  <input type="text" name="to_date" id="to_date" class="form-control" placeholder="e.g. To Date" required value="<?php echo $show_date1; ?>" readonly >
                </div>
                <div class="col-3">
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
                <h4 class="card-title">Wallet Statement</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>User Id</th>
                        <th>Income Type</th>
                        <th>Date</th>
                        <th>Remark</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                        $query = "SELECT member_id from sub_admin_user_details where user_id='$user_id1' ";
$result = mysqli_query($con, $query);
$val1 = mysqli_fetch_array($result);
$member_id = $val1[0];

$query = '';
if ($user_id1 != '') {
    $query = $query." and a.member_id='$member_id'";
}
$count = 0;
$queryStatement = mysqli_query($con, "SELECT b.name,b.user_id,a.date_time,a.amount,a.deb_cr,c.statement_type,c.wallet_remark from user_wallet_statement a, sub_admin_user_details b, config_wallet_statement_type c where a.member_id=b.member_id AND a.wallet_statement_id=c.wallet_statement_id AND CAST(a.date_time AS date) BETWEEN '$cal_date' AND '$cal_date1' ".$query.' order by a.date_time desc');
while ($valStatement = mysqli_fetch_array($queryStatement)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valStatement['name']; ?></td>
                        <td><?php echo $valStatement['user_id']; ?></td>
                        <td><?php echo $valStatement['statement_type']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:d', strtotime($valStatement['date_time'])); ?></td>
                        <td><?php echo $valStatement['wallet_remark']; ?></td>
                        <td><?php if ($valStatement['deb_cr'] == 2) {
                            echo 'Credit';
                        } else {
                            echo 'Debit';
                        } ?></td>
                        <td> <?php echo $valStatement['amount']; ?></td>
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
var d = document.getElementById("wallet");
    d.className += " active";
var d = document.getElementById("walletStatement");
    d.className += " active";
</script>
</body>
</html>
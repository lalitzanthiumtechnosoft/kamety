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
                <input class="form-control" type="text" placeholder="Enter User ID" name="user_id"
                  value="<?php echo $user_id1; ?>">
              </div>
              <div class="col-3">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="e.g. From Date"
                  required value="<?php echo $show_date; ?>" readonly>
              </div>
              <div class="col-3">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="e.g. To Date" required
                  value="<?php echo $show_date1; ?>" readonly>
              </div>
              <div class="col-3">
                <input class="btn btn-primary" type="submit" value="Search">
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
            <h4 class="card-title">Referral Income</h4>
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
                  <th>Generate Amount</th>
                  <th>Generate Date</th>
                  <th>Invest Amount</th>
                  <th>Direct Percent</th>
                  <th>ParentId</th>
                  <th>Parent Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query_in = mysqli_query($con, "SELECT member_id from sub_admin_user_details where user_id='$user_id1'");
                $val_in = mysqli_fetch_assoc($query_in);
                $member_id1 = $val_in[0];

                $query = '';
                if ($user_id1 != '') {
                  $query = $query . " AND a.memberId='$member_id1'";
                }

                $count = 0;
                $queryReferral = mysqli_query($con, "SELECT b.name,b.user_id,a.incomeAmount,a.sponserPercent,a.Amount,a.dateTime,c.user_id AS childID,c.name AS childName FROM user_sponser_income a, sub_admin_user_details b, sub_admin_user_details c WHERE a.memberId=b.member_id AND a.childId=c.member_id AND CAST(a.dateTIme AS date) BETWEEN '$cal_date' AND '$cal_date1' " . $query . ' ORDER BY a.dateTIme DESC');
                while ($valReferral = mysqli_fetch_assoc($queryReferral)) {
                  ++$count; ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $valReferral['user_id']; ?></td>
                    <td><?php echo $valReferral['name']; ?></td>
                    <td><span class="badge badge-success"> <?php echo $valReferral['incomeAmount']; ?></span></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $valReferral['dateTime']; ?></td>
                    <td><span class="badge badge-success"> <?php echo $valReferral['Amount']; ?></span></td>
                    <td><?php echo $valReferral['sponserPercent']; ?> <i class="fa fa-percent"></i></td>
                    <td><?php echo $valReferral['childID']; ?></td>
                    <td><?php echo $valReferral['childName']; ?></td>
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
  var d = document.getElementById("referralIncome");
  d.className += " active";
</script>
</body>

</html>
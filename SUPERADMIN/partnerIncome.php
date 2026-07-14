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
            <h4 class="card-title">Daily Growth</h4>
          </div>
        </div>
        <div class="iq-card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Package Amount</th>
                  <th>Purchase Date</th>
                  <th>Income Percent</th>
                  <th>Income Day</th>
                  <th>Release Amount</th>
                  <th>Release Days</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                function releaseDay($con, $summaryId)
                {
                  $queryDay = mysqli_query($con, "SELECT COUNT(1) FROM user_invest_income_details WHERE summaryId='$summaryId'");
                  $valDay = mysqli_fetch_array($queryDay);
                  $totalDay = $valDay[0];
                  if ($totalDay != '') {
                    echo $totalDay;
                  } else {
                    echo '0';
                  }
                }
                function releaseGrowth($con, $summaryId)
                {
                  $queryGrowth = mysqli_query($con, "SELECT SUM(roiAmount) FROM user_invest_income_details WHERE summaryId='$summaryId'");
                  $valGrowth = mysqli_fetch_array($queryGrowth);
                  $totalGrowth = $valGrowth[0];
                  if ($totalGrowth != '') {
                    echo $totalGrowth;
                  } else {
                    echo '0.00';
                  }
                }
                $queryUser = mysqli_query($con, "SELECT member_id from sub_admin_user_details where user_id='$user_id1'");
                $valUser = mysqli_fetch_array($queryUser);
                $member_id1 = $valUser[0];

                $query = '';
                if ($user_id1 != '') {
                  $query = $query . " AND a.memberId='$member_id1'";
                }

                $queryShare = mysqli_query($con, "SELECT a.summaryId,a.memberId,a.Amount,a.roiPercent,a.investDay,a.dateTime,b.user_id,b.name FROM user_invest_income_summary a, sub_admin_user_details b WHERE CAST(a.dateTime AS date) BETWEEN '$cal_date' AND '$cal_date1' AND a.member_id=b.member_id " . $query . ' ORDER BY a.dateTime DESC');
                $count = 0;
                while ($valShare = mysqli_fetch_assoc($queryShare)) {
                  ++$count; ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $valShare['user_id']; ?></td>
                    <td><?php echo $valShare['name']; ?></td>
                    <td> <?php echo $valShare['Amount']; ?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $valShare['dateTime']; ?></td>
                    <td><?php echo $valShare['roiPercent']; ?> <i class="fa fa-percent"></i></td>
                    <td><?php echo $valShare['investDay']; ?></td>
                    <td> <?php echo releaseGrowth($con, $valShare['summary_id']); ?></td>
                    <td> <?php echo releaseDay($con, $valShare['summary_id']); ?></td>
                    <td><?php if ($valPartner['status'] == 1) {
                      echo "<button class='btn btn-success btn-sm'><b>Running</b></button>";
                    } else {
                      echo "<button class='btn btn-danger btn-sm'><b>Stop</b></button>";
                    } ?></td>
                    <td><a href="partnerIncomeDetails?summaryId=<?php echo $valShare['summaryId']; ?>"
                        class="btn btn-success btn-sm"> More </a></td>
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
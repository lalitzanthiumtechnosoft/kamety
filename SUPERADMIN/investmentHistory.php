<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php';
?>
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
            <h4 class="card-title">Business History</h4>
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
                  <th>Investment Amount</th>
                  <th>Purchase Date</th>
                  <th>Purchase By</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
                $queryActive = mysqli_query($con, "SELECT a.dateTime,a.Amount,b.user_id,b.name,c.user_id AS activerId,c.name AS activerName FROM user_invest_history a, sub_admin_user_details b, sub_admin_user_details c WHERE CAST(a.dateTime AS date) BETWEEN '$cal_date' AND '$cal_date1' AND a.memberId=b.member_id AND a.loginMemberId=c.member_id order by a.dateTime DESC");
                while ($valActive = mysqli_fetch_assoc($queryActive)) {
                  ++$count; ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $valActive['user_id']; ?></td>
                    <td><?php echo $valActive['name']; ?></td>
                    <td><span class="badge badge-success"> <?php echo $valActive['Amount']; ?></span></td>
                    <td><i class="fa fa-clock-o"></i>
                      <?php echo date('d-m-Y H:i:s', strtotime($valActive['dateTime'])); ?></td>
                    <td><?php echo $valActive['activerName'] . ' (User ID:' . $valActive['activerId'] . ')'; ?></td>
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
  var d = document.getElementById("member");
  d.className += " active";
  var d = document.getElementById("investmentHistory");
  d.className += " active";
</script>
</body>

</html>
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
                <h4 class="card-title">Level Bonus On Growth</h4>
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
                        <th>Level</th>
                        <th>Income Date</th>
                        <th>Income Amount</th>
                        <th>Child ID</th>
                        <th>Child Name</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                        $query_in = mysqli_query($con, "SELECT member_id from sub_admin_user_details where user_id='$user_id1'");
$val_in = mysqli_fetch_assoc($query_in);
$member_id1 = $val_in[0];

$query = '';
if ($user_id1 != '') {
    $query = $query." AND a.memberId='$member_id1'";
}

$count = 0;
$queryLevel = mysqli_query($con, "SELECT b.name,b.user_id,a.dateTime,a.levelIncome,a.level,c.user_id AS childId,c.name AS childName FROM user_level_income a, sub_admin_user_details b, sub_admin_user_details c WHERE a.memberId=b.member_id AND a.childId=c.member_id AND CAST(a.dateTime AS date) BETWEEN '$cal_date' AND '$cal_date1' ".$query.' order by a.dateTime DESC');
while ($valLevel = mysqli_fetch_assoc($queryLevel)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valLevel['user_id']; ?></td>
                        <td><?php echo $valLevel['name']; ?></td>
                        <td>Level <?php echo $valLevel['level']; ?></td>
                        <td><i class="fa fa-clock-0"></i> <?php echo $valLevel['dateTime']; ?></td>
                        <td> <?php echo $valLevel['levelIncome']; ?></td>
                        <td><?php echo $valLevel['childId']; ?></td>
                        <td><?php echo $valLevel['childName']; ?></td>
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
var d = document.getElementById("levelIncome");
    d.className += " active";
</script>
</body>
</html>
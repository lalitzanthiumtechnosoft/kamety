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
                  <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?php echo $user_id1; ?>" >
                </div>
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
                        <th>Sender Details</th>
                        <th>Receiver Details</th>
                        <th>Transfer Amount</th>
                        <th>Transfer Date</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                      function name($con, $member_id)
                      {
                          $query = "SELECT name from sub_admin_user_details where member_id='$member_id' ";
                          $result = mysqli_query($con, $query);
                          $val1 = mysqli_fetch_array($result);

                          return $val1[0];
                      }
function user_id($con, $member_id)
{
    $query = "SELECT user_id from sub_admin_user_details where member_id='$member_id' ";
    $result = mysqli_query($con, $query);
    $val1 = mysqli_fetch_array($result);

    return $val1[0];
}

$query_in = "SELECT member_id from sub_admin_user_details where user_id='$user_id1'";
$result = mysqli_query($con, $query_in);
$val1 = mysqli_fetch_array($result);
$member_id1 = $val1[0];
$query = '';
if ($cal_date != '') {
    $query = "AND CAST(date_time AS DATE)>='$cal_date'";
}
if ($cal_date1 != '') {
    if ($query == '') {
        $query = $query." AND CAST(date_time AS DATE)<='$cal_date1'";
    } else {
        $query = $query." and CAST(date_time AS DATE)<='$cal_date1'";
    }
}
if ($user_id1 != '') {
    $query = $query." AND sender_member_id='$member_id1'";
}

$count = 0;
$query = 'SELECT * from user_fund_transfer_history where 1=1 '.$query.' order by date_time desc';
$result = mysqli_query($con, $query);
while ($val1 = mysqli_fetch_array($result)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo name($con, $val1['sender_member_id']); ?> ( <?php echo user_id($con, $val1['sender_member_id']); ?> )</td>
                        <td><?php echo name($con, $val1['receiver_member_id']); ?> ( <?php echo user_id($con, $val1['receiver_member_id']); ?> )</td>
                        <td> <?php echo $val1['amount']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo $val1['date_time']; ?></td>
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
var d = document.getElementById("fundTransferHistory");
    d.className += " active";
</script>
</body>
</html>
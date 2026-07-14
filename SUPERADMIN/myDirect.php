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
} else {
    $user_id1 = $_SESSION['admin_user_id'];
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
                <h4 class="card-title">My Direct</h4>
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
                        <th>Phone</th>
                       
                        <th>Joinig Date</th>
                        <th>Active Status</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                    <?php
                      $query = mysqli_query($con, "SELECT member_id FROM sub_admin_user_details where user_id='$user_id1'");
$val1 = mysqli_fetch_array($query);
$member_id = $val1[0];

$count = 0;
$queryDirect = mysqli_query($con, "SELECT * FROM sub_admin_user_details WHERE sponser_id='$member_id' ORDER BY date_time");
while ($valDirect = mysqli_fetch_assoc($queryDirect)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valDirect['user_id']; ?></td>
                        <td><?php echo $valDirect['name']; ?></td>
                        <td><?php echo $valDirect['phone']; ?></td>
                     
                        <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:d', strtotime($valDirect['date_time'])); ?></td>
                        <td><?php if ($valDirect['topup_flag'] == 1) {
                            echo 'Active';
                        } else {
                            echo 'In-Active';
                        }?></td>
                        <td><a href="myDirect?user_id=<?php echo $valDirect['user_id']; ?>"><span class="badge badge-success"><i class="fa fa-users"></i> Team</span></a></td>
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
var d = document.getElementById("Team");
    d.className += " active";
var d = document.getElementById("myDirect");
    d.className += " active";
</script>
</body>
</html>
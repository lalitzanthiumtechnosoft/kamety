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
                <h4 class="card-title">Wallet Outstanding</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>User ID</th>
                        <th>Join Date</th>
                        <th>Wallet</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                        $query = '';
if ($user_id1 != '') {
    $query = $query." and user_id='$user_id1'";
}
$count = 0;
$query = 'SELECT member_id,name,user_id,wallet,date_time from sub_admin_user_details WHERE wallet>0 '.$query.' ORDER BY wallet DESC';
$result = mysqli_query($con, $query);
while ($val1 = mysqli_fetch_array($result)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $val1['name']; ?></td>
                        <td><?php echo $val1['user_id']; ?></td>
                        <td><?php echo $val1['date_time']; ?></td>
                        <td> <?php echo $val1['wallet']; ?></td>
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
var d = document.getElementById("walletOutstanding");
    d.className += " active";
</script>
</body>
</html>
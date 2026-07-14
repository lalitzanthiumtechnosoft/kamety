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
                <h4 class="card-title">Level Team</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>
                        <th>Level Number.</th>          
                        <th>Total Member</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                        $query = "SELECT member_id from sub_admin_user_details where user_id='$user_id1'";
$result = mysqli_query($con, $query);
$val1 = mysqli_fetch_array($result);
$member_id1 = $val1[0];

for ($level = 1; $level <= 20; ++$level) {
    $queryMember = mysqli_query($con, "SELECT COUNT(1) AS totalMember FROM sub_admin_user_child_ids WHERE member_id='$member_id1' AND level='$level'");
    $valMember = mysqli_fetch_array($queryMember);
    ++$count; ?>
                        <tr >
                            <td><?php echo $level; ?></td>
                            <td>Level <?php echo $level; ?></td>
                            <td><i class="fa fa-user"></i> <?php echo isset($valMember[0]) ? $valMember[0] : '0'; ?></td>
                            <td><a href="levelTeamDetails?MemberID=<?php echo $member_id1; ?>&LevelID=<?php echo $level; ?>" class="btn btn-primary">More</a></td>
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
var d = document.getElementById("Team");
    d.className += " active";
var d = document.getElementById("levelTeam");
    d.className += " active";
</script>
</body>
</html>
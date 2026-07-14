<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
               <div class="iq-header-title">
                  <h4 class="card-title">Level <?php echo $_GET['LevelID']; ?> Team Details</h4>
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
                           <th>Email ID</th>
                           <th>Joining Date</th>
                           <th>Package Amount</th>
                           <th>Account Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        function totalPackage($con, $member_id)
                        {
                           $query = "SELECT SUM(Amount) FROM user_invest_history WHERE memberId='$member_id'";
                           $result = mysqli_query($con, $query);
                           $val1 = mysqli_fetch_array($result);
                           if ($val1[0] != '') {
                              return $val1[0];
                           } else {
                              echo '0.00';
                           }
                        }
                        $count = 0;
                        $queryDetails = mysqli_query($con, "SELECT a.member_id,a.child_id,a.date_time,a.topup_status,b.name,b.user_id,b.email_id,b.password FROM sub_admin_user_child_ids a, sub_admin_user_details b WHERE a.level=$_GET[LevelID] AND a.member_id='$_GET[MemberID]' AND a.child_id=b.member_id ORDER BY a.date_time DESC");
                        while ($valDetails = mysqli_fetch_assoc($queryDetails)) {
                           ++$count; ?>
                           <tr>
                              <td><?php echo $count; ?></td>
                              <td><?php echo $valDetails['user_id']; ?></td>
                              <td><?php echo $valDetails['name']; ?></td>
                              <td><?php echo $valDetails['email_id']; ?></td>
                              <td><?php echo $valDetails['date_time']; ?></td>
                              <td> <?php echo totalPackage($con, $valDetails['child_id']); ?></td>
                              <td><b><?php if ($valDetails['topup_status'] == 1) {
                                 echo 'Active Member';
                              } else {
                                 echo 'InActive Member';
                              } ?></b></td>
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
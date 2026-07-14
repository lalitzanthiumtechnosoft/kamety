<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php';

if ($_GET) {
    if ($_GET['user_id']) {
        $memberId = $_GET['user_id'];
    }
}
?>

<div class="container-fluid">
  <div class="row">

    <div class="col-sm-12">
      <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
          <div class="iq-header-title">
            <h4 class="card-title">ReEntry Pool Status Details</h4>
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
                      <th>Entry No.</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  $count = 0;
$queryPool = mysqli_query($con, "SELECT a.entryId,a.reEntryCount,a.poolLevel,a.entryDate,b.user_id,b.name FROM user_pool_entry_details a, sub_admin_user_details b WHERE a.memberId='$memberId' AND a.memberId=b.member_id AND a.poolStatus=0 ORDER BY a.entryDate ASC");
while ($valPool = mysqli_fetch_array($queryPool)) {
    ++$count; ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $valPool['user_id']; ?></td>
                      <td><?php echo $valPool['name']; ?></td>
                      <td>Entry No <?php echo $valPool['reEntryCount']; ?></td>
                      <td><?php echo date('d-m-Y H:i:s', strtotime($valPool['entryDate'])); ?></td>
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
  var d = document.getElementById("reEntryPool");
  d.className += " active";
</script>
</body>

</html>
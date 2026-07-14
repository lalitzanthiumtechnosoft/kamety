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
            <h4 class="card-title">Auto Pool Status</h4>
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
                  <th>Current Pool</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
$queryEntry = mysqli_query($con, 'SELECT a.entryId,a.memberId,a.boardId,a.reEntryCount,a.entryDate,b.user_id,b.name FROM user_board_entry_details a, sub_admin_user_details b WHERE a.memberId=b.member_id AND a.entryId = ( SELECT MAX(entryId) FROM user_board_entry_details WHERE memberId=a.memberId )ORDER BY a.entryDate DESC');
while ($valEntry = mysqli_fetch_assoc($queryEntry)) {
    ++$count; ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $valEntry['user_id']; ?></td>
                    <td><?php echo $valEntry['name']; ?></td>
                    <td>Pool <?php echo $valEntry['boardId']; ?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valEntry['entryDate'])); ?></td>
                    <td><a
                        href="autoPoolEntryStatus?userId=<?php echo $valEntry['memberId']; ?>&entryId=<?php echo $valEntry['entryId']; ?>&boardId=<?php echo $valEntry['boardId']; ?>"
                        class="btn btn-primary btn-sm">More</a></td>
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
  var d = document.getElementById("autoPoolEntry");
  d.className += " active";
</script>
</body>

</html>
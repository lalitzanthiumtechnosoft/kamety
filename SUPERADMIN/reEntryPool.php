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
            <h4 class="card-title">ReEntry Pool Status</h4>
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
                      <th>Re-Entry</th>
                      <th>Date</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  $count = 0;
$queryPool = mysqli_query($con, '
    SELECT 
        b.user_id,
        b.name,a.memberId,
        COUNT(a.entryId) AS totalEntries,
        MIN(a.entryDate) AS firstEntryDate,
        MAX(a.entryDate) AS lastEntryDate
    FROM user_pool_entry_details a
    JOIN sub_admin_user_details b 
        ON a.memberId = b.member_id
    WHERE a.poolStatus = 0
    GROUP BY b.user_id, b.name
    ORDER BY lastEntryDate ASC
');

$count = 0;
while ($valPool = mysqli_fetch_array($queryPool)) {
    ++$count;
    ?>
    <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $valPool['user_id']; ?></td>
        <td><?php echo $valPool['name']; ?></td>
        <td><span class="badge badge-danger"><b>ReEntry# - <?php echo $valPool['totalEntries']; ?></b></span></td>
        <td><?php echo date('d-m-Y H:i:s', strtotime($valPool['lastEntryDate'])); ?></td>
      <td>
        <a href="reEntryDetails?user_id=<?php echo $valPool['memberId']; ?>" 
           class="btn btn-sm btn-primary">
           View Details
        </a>
    </td>
      </tr>
    <?php
} ?>
                  
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
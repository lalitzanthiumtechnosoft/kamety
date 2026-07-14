<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
if ($_GET) {
    if ($_GET['boardId']) {
        $poolId = $_GET['boardId'];
    }
    if ($_GET['userId']) {
        $memberId = $_GET['userId'];
    }
    if ($_GET['entryId']) {
        $parentEntryId = $_GET['entryId'];
    }
}
$queryDeal = mysqli_query($con, "SELECT poolId FROM config_pool_list WHERE poolId='$poolId'");
$valDeal = mysqli_fetch_assoc($queryDeal);
$queryDetail = mysqli_query($con, "SELECT user_id FROM sub_admin_user_details WHERE member_id='$memberId'");
$valDetail = mysqli_fetch_assoc($queryDetail); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
          <div class="iq-header-title">
            <h4 class="card-title"><?php echo $valDetail['user_id']; ?> Team Status</h4>
          </div>
        </div>
        <div class="iq-card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Pool No</th>
                  <th>Pool Income</th>
                  <th>Pool Status</th>
                  <th>Achieved Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Function to display pool status
                function poolStatus($con, $memberId, $poolLevel)
                {
                    $queryCount = mysqli_query($con, "SELECT COUNT(1) FROM user_pool_income1 WHERE memberId='$memberId'  AND poolLevel='$poolLevel'");
                    $valCount = mysqli_fetch_array($queryCount);
                    if ($valCount[0] > 0) {
                        echo "<span class='badge badge-success'>ACHIEVED</span>";
                    } else {
                        echo "<span class='badge badge-warning'>PROCESSING</span>";
                    }
                }

// Function to display achievement date
function achiveDate($con, $memberId, $poolLevel)
{
    $queryDate = mysqli_query($con, "SELECT COUNT(1), dateTime FROM user_pool_income1 WHERE memberId='$memberId'   AND poolLevel='$poolLevel'");
    $valDate = mysqli_fetch_array($queryDate);
    if ($valDate[0] > 0) {
        echo "<i class='fa fa-clock-o'></i> ".date('d-m-Y H:i:s', strtotime($valDate['dateTime']));
    } else {
        echo '';
    }
}

$count = 0;
$poolId = $_GET['boardId'];
$entryId = $_GET['entryId'];
$totalMembers = 0;

$queryPool = mysqli_query($con, 'SELECT * FROM config_pool_income  ORDER BY poolLevel ASC');

while ($valPool = mysqli_fetch_assoc($queryPool)) {
    ++$count;
    $queryFind = mysqli_query($con, "SELECT COUNT(1), entryId, memberId FROM user_board_entry_details WHERE memberId='$memberId' AND boardId='$poolId' AND entryId='$entryId'");
    $valFind = mysqli_fetch_array($queryFind);

    ?>
                  <tr>
                    <?php if ($valFind[0] > 0) { ?>
                      <td><?php echo $count; ?></td>

                      <td>Pool <?php echo $valPool['poolLevel']; ?></td>

                      <td><span class="badge badge-success"><i class="fa fa-usd"></i> <?php echo $valPool['userIncome']; ?></span>
                      </td>
                      <td>
                        <?php poolStatus($con, $memberId, $valPool['poolLevel']); ?>
                      </td>
                      <td>
                        <?php achiveDate($con, $memberId, $valPool['poolLevel']); ?>
                      </td>
                    <?php } ?>
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
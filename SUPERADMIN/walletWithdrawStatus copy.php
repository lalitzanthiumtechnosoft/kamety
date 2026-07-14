<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
$user_id1 = '';
if ($_GET) {
    if ($_GET['user_id']) {
        $user_id1 = $_GET['user_id'];
        $query = "SELECT count(*) from sub_admin_user_details WHERE user_id='$user_id1'";
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
    $withdrawStatus = $_GET['withdrawStatus'];
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
    $withdrawStatus = 0;
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
              <div class="col-2">
                <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?php echo $user_id1; ?>">
              </div>
              <div class="col-2">
                <select class="form-control" name="withdrawStatus">
                  <option value=""> Select One </option>
                  <option value="0" <?php if ($withdrawStatus == 0) {
                      echo 'selected';
                  } ?>> Pending </option>
                  <option value="1" <?php if ($withdrawStatus == 1) {
                      echo 'selected';
                  } ?>> Released </option>
                  <option value="2" <?php if ($withdrawStatus == 2) {
                      echo 'selected';
                  } ?>> Processing </option>
                  <option value="3" <?php if ($withdrawStatus == 3) {
                      echo 'selected';
                  } ?>> Rejected </option>
                </select>
              </div>
              <div class="col-2">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="e.g. From Date" required value="<?php echo $show_date; ?>" readonly>
              </div>
              <div class="col-2">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="e.g. To Date" required value="<?php echo $show_date1; ?>" readonly>
              </div>
              <div class="col-2">
                <input class="btn btn-primary" type="submit" value="Search">
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
            <h4 class="card-title">Wallet Withdraw Status</h4>
          </div>
        </div>
        <div class="iq-card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="font-size: 13px;">

              <thead>
                <tr>
                  <th>#</th>
                  <th>UserId</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <!-- <th>Charge</th>
                  <th>Net Amount</th> -->
                  <th>UPI Address</th>
                  <th>OrderId</th>
                  <th>Withdraw Status</th>
                  <th>Action Date</th>
                  <th>Remark</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $queryIn = mysqli_query($con, "SELECT member_id FROM sub_admin_user_details WHERE user_id='$user_id1'");
$valIn = mysqli_fetch_assoc($queryIn);
$member_id1 = $valIn['member_id'];

$query = '';
if (!empty($user_id1)) {
    $query .= " AND a.member_id='$member_id1'";
}
if (!empty($withdrawStatus)) {
    $query .= " AND a.released='$withdrawStatus'";
}

$count = 0;
$queryWithdraw = mysqli_query(
    $con,
    "SELECT a.*, b.name, b.user_id, u.upiAddress 
   FROM user_wallet_withdrawal_crypto a
   INNER JOIN sub_admin_user_details b ON a.member_id = b.member_id
   LEFT JOIN user_upi_address_details u ON a.upiId = u.payment_id
   WHERE CAST(a.date_time AS date) BETWEEN '$cal_date' AND '$cal_date1' 
   $query 
   ORDER BY a.date_time DESC"
);

while ($valWithdraw = mysqli_fetch_assoc($queryWithdraw)) {
    ++$count;
    ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo htmlspecialchars($valWithdraw['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($valWithdraw['name']); ?></td>
                    <td class="text-left"><?php echo htmlspecialchars($valWithdraw['date_time']); ?></td>
                    <td>$ <?php echo htmlspecialchars($valWithdraw['amount']); ?></td>
                    <!-- <td><?php echo htmlspecialchars($valWithdraw['withdrawCharge']); ?>%</td>
                    <td>$<?php echo htmlspecialchars($valWithdraw['netAmount']); ?></td> -->
                    <td><?php echo htmlspecialchars($valWithdraw['upiAddress'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($valWithdraw['orderid']); ?></td>
                    <td><?php if ($valWithdraw['released'] == 0) {
                        echo "<span class='badge badge-primary'>PENDING</span>";
                    } elseif ($valWithdraw['released'] == 1) {
                        echo "<span class='badge badge-success'>RELEASED</span>";
                    } elseif ($valWithdraw['released'] == 2) {
                        echo "<span class='badge badge-warning'>PROCESSING</span>";
                    } elseif ($valWithdraw['released'] == 3) {
                        echo "<span class='badge badge-danger'>REJECTED</span>";
                    } ?></td>
                    <td><?php echo htmlspecialchars($valWithdraw['payment_date']); ?></td>
                    <td><?php echo htmlspecialchars($valWithdraw['remarks']); ?></td>
                    <td>
                      <?php if ($valWithdraw['released'] == 0 || $valWithdraw['released'] == 2) { ?>
                        <a data-id="<?php echo htmlspecialchars($valWithdraw['id']); ?>" data-toggle="modal" data-target="#cryptoRemark" data-whatever="<?php echo htmlspecialchars($valWithdraw['id']); ?>" href="javascript:void(0)" class="btn btn-primary btn-xs">
                          <?php echo $valWithdraw['released'] == 0 ? 'Add' : 'Edit'; ?>
                        </a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php
}
?>
              </tbody>


            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cryptoRemark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="cryptoRemarkDash">
        <!-- Content goes in here -->
      </div>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>
<script>
  $('#cryptoRemark').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this);
    var id = recipient;
    var userId = '<?php echo $userId; ?>';
    var withdrawStatus = '<?php echo $withdrawStatus; ?>';
    var fromDate = '<?php echo $show_date; ?>';
    var toDate = '<?php echo $show_date1; ?>';
    $.ajax({
      type: "POST",
      url: "ajax_calls/cryptoRemarkAjax",
      data: {
        id: id,
        withdrawStatus: withdrawStatus,
        fromDate: fromDate,
        toDate: toDate,
        userId: userId
      },
      cache: false,
      success: function(data) {
        console.log(data);
        modal.find('.cryptoRemarkDash').html(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  })
  var d = document.getElementById("payout");
  d.className += " active";
  var d = document.getElementById("walletWithdrawStatus");
  d.className += " active";
</script>
</body>

</html>
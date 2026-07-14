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
    if ($_GET['withdrawStatus']) {
        $withdrawStatus = $_GET['withdrawStatus'];
    } elseif ($_GET['withdrawStatus'] == 0) {
        $withdrawStatus = 0;
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
                <input class="form-control" type="text" placeholder="Enter User ID" name="user_id"
                  value="<?php echo $user_id1; ?>">
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
                  <option value="4" <?php if ($withdrawStatus == 4) {
                      echo 'selected';
                  } ?>> Online Release</option>
                </select>
              </div>
              <div class="col-2">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="e.g. From Date"
                  required value="<?php echo $show_date; ?>" readonly>
              </div>
              <div class="col-2">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="e.g. To Date" required
                  value="<?php echo $show_date1; ?>" readonly>
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
            <table id="example" class="example1 table table-striped table-bordered" style="font-size: 13px;">
               <thead>
                    <tr><th><input type="checkbox" id="selectAll"></th>

                      <th>#</th>
                      <th>UserId</th>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Gross Amount</th>
                      <th>Charge</th>
                      <th>Net Amount</th>
                      <th>OrderId</th>
                      <th>Currency</th>
                      <th>Wallet Address</th>
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
$member_id1 = $valIn[0];

$query = '';
if ($user_id1 != '') {
    $query = $query." AND a.member_id='$member_id1'";
}
if ($withdrawStatus != '') {
    $query = $query." AND a.released='$withdrawStatus'";
}
$count = 0;
$queryWithdraw = mysqli_query($con, "SELECT a.*,b.name,b.user_id,c.walletAddress,d.currencyName FROM user_wallet_withdrawal_crypto a, sub_admin_user_details b, user_wallet_address_details c,config_currency_list d WHERE CAST(a.date_time AS date) BETWEEN '$cal_date' AND '$cal_date1' AND a.paymentId=c.payment_id AND c.currency_id=d.currency_id AND a.member_id=b.member_id ".$query.' ORDER BY a.date_time DESC');
while ($valWithdraw = mysqli_fetch_assoc($queryWithdraw)) {
    ++$count; ?>
                    <tr>
                      <td><input type="checkbox" class="selectCheckbox" value="<?php echo $valWithdraw['id']; ?>"></td>


                      <td><?php echo $count; ?></td>
                      <td><?php echo $valWithdraw['user_id']; ?></td>
                      <td><?php echo $valWithdraw['name']; ?></td>
                      <td class="text-left"><?php echo $valWithdraw['date_time']; ?></td>
                      <td><span class="badge badge-success"><i class="fa fa-usd"></i> <?php echo $valWithdraw['amount']; ?></span></td>
                      <td><span class="badge badge-success"><i class="fa fa-usd"></i> <?php echo $valWithdraw['withdrawCharge']; ?></span></td>
                      <td><span class="badge badge-danger"><i class="fa fa-usd"></i> <?php echo $valWithdraw['netAmount']; ?></span></td>
                      <td><?php echo $valWithdraw['orderid']; ?></td>
                      <td><?php echo $valWithdraw['currencyName']; ?></td>
                      <td><?php echo $valWithdraw['walletAddress']; ?></td>
                      <td><?php if ($valWithdraw['released'] == 0) {
                          echo "<span class='badge badge-primary'>PENDING</span>";
                      } elseif ($valWithdraw['released'] == 1) {
                          echo "<span class='badge badge-success'>RELEASED</span>";
                      } elseif ($valWithdraw['released'] == 2) {
                          echo "<span class='badge badge-warning'>PROCESSING</span>";
                      } elseif ($valWithdraw['released'] == 3) {
                          echo "<span class='badge badge-danger'>REJECTED</span>";
                      }?></td>
                      <td><?php echo $valWithdraw['payment_date']; ?></td>  
                      <td><?php echo $valWithdraw['remarks']; ?></td>
                      <td><?php if ($valWithdraw['released'] == 0) { ?><a data-id="<?php echo $valWithdraw['id']; ?>" data-toggle="modal" data-target="#cryptoRemark" data-whatever="<?php echo $valWithdraw['id']; ?>" href="javascript:void(0)" class="btn btn-primary btn-xs"> Add </a><?php } elseif ($valWithdraw['released'] == 2) { ?><a data-id="<?php echo $valWithdraw['id']; ?>" data-toggle="modal" data-target="#cryptoRemark" data-whatever="<?php echo $valWithdraw['id']; ?>" href="javascript:void(0)" class="btn btn-primary btn-xs"> Edit </a><?php } ?></td>
                    </tr>
                  <?php } ?>  
                 </tbody>
            </table>
          </div>
<form action="ajax_calls/selectedAction.php" method="POST" onsubmit="return validateBulkForm();">
  <input type="hidden" name="userId" value="<?php echo $user_id1; ?>">
  <input type="hidden" name="fromDate" value="<?php echo $show_date; ?>">
  <input type="hidden" name="toDate" value="<?php echo $show_date1; ?>">
  <input type="hidden" name="addEditBulkRemark" value="1">

  <div class="row mt-3">
    <div class="col-md-3">
      <select class="form-control" name="withdrawStatus" required>
        <option value="">-- Select Status --</option>
        <option value="0">Pending</option>
        <option value="1">Released</option>
        <option value="2">Processing</option>
        <option value="3">Rejected</option>
        <option value="4">Online Release</option>
      </select>
    </div>
    <div class="col-md-4">
      <input type="text" name="remarks" class="form-control" placeholder="Enter remark for selected" required>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-success">Update Selected</button>
    </div>
  </div>

  <!-- Hidden inputs for selected IDs -->
  <div id="selectedIdsContainer"></div>
</form>


        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cryptoRemark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="false">
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
function validateBulkForm() {
  const selectedCheckboxes = document.querySelectorAll('.selectCheckbox:checked');
  const selectedIdsContainer = document.getElementById('selectedIdsContainer');

  selectedIdsContainer.innerHTML = ""; // clear old inputs

  if (selectedCheckboxes.length === 0) {
    alert("Please select at least one record to update.");
    return false;
  }

  selectedCheckboxes.forEach(cb => {
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'ids[]';
    hiddenInput.value = cb.value;
    selectedIdsContainer.appendChild(hiddenInput);
  });

  return true; // allow form to submit
}
</script>

<script>



document.getElementById("updateSelected").addEventListener("click", function () {
  const selectedCheckboxes = document.querySelectorAll(".selectCheckbox:checked");
  const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.value);
  const newStatus = document.getElementById("bulkStatus").value;
  const newRemark = document.getElementById("bulkRemark").value.trim();
 console.log(newStatus);
  if (selectedIds.length === 0) {
    alert("Please select at least one record.");
    return;
  }
  if (newStatus === "") {
    alert("Please select a status to update.");
    return;
  }

  fetch("ajax_calls/selectedAction.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      ids: selectedIds,
      status: newStatus,
      remark: newRemark
    })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert("Status updated successfully.");
        location.reload();
      } else {
        alert("Update failed. Try again.");
      }
    })
    .catch(err => console.error("Error:", err));
});
</script>
<script>
  $('#cryptoRemark').on('show.bs.modal', function (event) {
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
      success: function (data) {
        console.log(data);
        modal.find('.cryptoRemarkDash').html(data);
      },
      error: function (err) {
        console.log(err);
      }
    });
  })
  var d = document.getElementById("payout");
  d.className += " active";
  var d = document.getElementById("walletWithdrawStatus");
  d.className += " active";
</script>

<!-- // Release Selected -->
<script>
  // "Select All" functionality
  document.getElementById("selectAll").addEventListener("change", function () {
    const checkboxes = document.querySelectorAll(".selectCheckbox");
    checkboxes.forEach(checkbox => {
      checkbox.checked = this.checked; // Set all checkboxes to match "Select All"
    });
  });

  // Update "Select All" checkbox based on individual checkbox state
  document.querySelectorAll(".selectCheckbox").forEach(checkbox => {
    checkbox.addEventListener("change", function () {
      const allCheckboxes = document.querySelectorAll(".selectCheckbox");
      const allChecked = Array.from(allCheckboxes).every(cb => cb.checked);
      document.getElementById("selectAll").checked = allChecked;
    });
  });

  // "Release Selected" functionality
  document.getElementById("releaseSelected").addEventListener("click", function () {
    // Get all selected checkboxes
    const selectedCheckboxes = document.querySelectorAll(".selectCheckbox:checked");
    const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

    if (selectedIds.length > 0) {
      // Send selected IDs to the server via a POST request
      fetch("releaseWithdrawals.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          ids: selectedIds
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert("Selected withdrawals released successfully!");
            location.reload(); // Reload the page to reflect changes
          } else {
            alert("Error releasing withdrawals. Please try again.");
          }
        })
        .catch(error => console.error("Error:", error));
    } else {
      alert("No rows selected.");
    }
  });
</script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
if (isset($_POST['remark']) && $_POST['remark'] != '') {
    date_default_timezone_set('Asia/Kolkata');
    $d = date('Y-m-d');
    $todayD = date('Y-m-d H:i:s');
    $userCount = count($_POST['hid']);
    for ($i = 0; $i < $userCount; ++$i) {
        if ($_POST['status'] == 1) {
            $query = mysqli_query($con, "UPDATE user_wallet_withdrawal set remarks='".$_POST['remark']."', status='".$_POST['status']."',release_date='$todayD' WHERE id='".$_POST['hid'][$i]."'");
        } else {
            $query = mysqli_query($con, "UPDATE user_wallet_withdrawal set remarks='".$_POST['remark']."', status='".$_POST['status']."',release_date='$todayD' WHERE id='".$_POST['hid'][$i]."'");
        }
    }
    if ($query) { ?>
     <script>
     alert("Payment Remark Updated Successfully");
     window.top.location.href='wallet-withdraw-status';

     </script>
     <?php }
    } ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 col-lg-12">
         <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
               <div class="iq-header-title">
                  <h4 class="card-title">Payment Remark</h4>
               </div>
            </div>
            <div class="iq-card-body">
               <form class="text-center" action="walletWithdrawPaymentDetails" method="POST">
                  <fieldset>
                     <div class="form-card text-left">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Payment Remark *</label>
                                <select name="status" required="" class="form-control">
                                  <option value="">-</option>
                                  <option value="1" > Paid </option>
                                  <option value="2" > Un-Paid </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Remarks *</label>
                              <input type="text" name="remark" class="form-control" required >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h5 class="mb-4">User Details</h5>
                        </div>
                      </div>
                      <div class="row">
                        <?php
                        $rowCount = count($_POST['payout_id']);
for ($i = 0; $i < $rowCount; ++$i) {
    $result = mysqli_query($con, "SELECT * FROM user_wallet_withdrawal WHERE id='".$_POST['payout_id'][$i]."'");
    $row[$i] = mysqli_fetch_assoc($result);
    $result_in = mysqli_query($con, "SELECT * FROM sub_admin_user_details WHERE member_id='".$row[$i]['member_id']."'");
    $row_in[$i] = mysqli_fetch_array($result_in);
    ?> 
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">User Id ( Name ) *</label>
                            <input type="hidden" name="hid[]" value="<?php echo $row[$i]['id']; ?>">
                            <p class="form-control"><?php echo $row_in[$i]['user_id']; ?>( <?php echo $row_in[$i]['name']; ?> )</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Amount To Pay *</label>
                            <input type="text" class="form-control" value="<?php echo $row[$i]['netAmount']; ?>" readonly >
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  <hr>
                  <button type="submit" name="add_remark" class="btn btn-success">Submit</button>
                  <a href="wallet-withdraw-status"  class="btn btn-danger">Back</a>
                  </div>
                </fieldset>
              </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include 'include/footer.php'; ?>
<script>
function onlynum(evt){
  evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function onlycharnum(evt){
   evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode >= 48 && charCode <= 57) || (charCode >= 97 && charCode <= 122))  {
        return true;
    }
    return false;
}
function dont(evt){
  return false;
}
var d = document.getElementById("payout");
    d.className += " active";
var d = document.getElementById("wallet-withdraw-status");
    d.className += " active";
</script>
</body>
</html>
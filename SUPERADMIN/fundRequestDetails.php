<!DOCTYPE html>
<html lang="en">
<?php include("login-check.php");?>
<?php include('include/head.php');
      include('include/menu.php'); 
      include('include/header.php'); ?>
<?php 
  $id=$_GET['RqsID'];
  $query="SELECT * from user_fund_request where id='$id'";
  $result=mysqli_query($con,$query);
  $val1=mysqli_fetch_array($result);
  $name=$val1['name'];
  $user_id=$val1['user_id'];
  $date_time=$val1['date_time'];
  $member_id1=$val1['member_id'];
  $requestFund=$val1['requestFund'];
  $paymentDate=$val1['paymentDate'];
  $paymentRemark=$val1['paymentRemark'];
  $transactionImage=$val1['transactionImage'];
  $paymentHash=$val1['paymentHash'];
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 col-lg-12">
         <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
               <div class="iq-header-title">
                  <h4 class="card-title">Fund Request Details</h4>
               </div>
            </div>
            <div class="iq-card-body">
               <form class="text-center" method="POST" action="fundRequestAcceptBack" onsubmit="return confirm('Are you sure?')">
                  <fieldset>
                     <div class="form-card text-left">
                        <div class="row">
                           <div class="col-12">
                              <h3 class="mb-4">Transaction Details</h3>
                           </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Name -:</label>
                              <input type="text" class="form-control" required="" id="name" name="name" placeholder=" Name" readonly value="<?=$name?>" >
                              <input type="hidden" name="member_id" value="<?= $member_id1; ?>">
                              <input type="hidden" name="login_member_id" value="<?= $member_id;?>">
                              <input type="hidden" name="ResID" value="<?=$id?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>User ID -: </label>
                              <input type="text" class="form-control" class="form-control" required="" id="user_id" name="user_id" placeholder=" User ID" readonly value="<?=$user_id?>" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Request Amount -:</label>
                              <input class="form-control" id="requestFund"  value="<?= $requestFund; ?>" name="requestFund" placeholder=" Request Amount" required >
                            </div>
                          </div>
                          <!-- <div class="col-md-6">
                            <div class="form-group">
                              <label>Payment Date -:</label>
                              <input class="form-control" id="paymentDate" value="<?= $paymentDate; ?>" name="paymentDate" placeholder=" Payment Date" readonly >
                            </div>
                          </div> -->
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Transaction No/ UTR No -:</label>
                              <input class="form-control" id="paymentHash" value="<?= $paymentHash; ?>" name="paymentHash" placeholder=" Transaction ID" readonly >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Payment Remark -:</label>
                              <input class="form-control" id="paymentRemark" value="<?= $paymentRemark; ?>" name="paymentRemark" placeholder=" Payment Remark" readonly >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Request Date -:</label>
                              <input class="form-control" id="date_time" value="<?= $date_time; ?>" name="date_time" placeholder=" Request Date" readonly >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Transaction Slip. -:</label>
                              <img src="<?=$transactionImage?>" height="260px" width="360px" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php if($val1['status']==0){ ?>
                      <button type="submit" name="active" class="btn btn-success action-button float-left"  >Transfer Now</button>&nbsp;&nbsp;
                      <a href="fundRequestRejectBack?ResID=<?=$id?>" class="btn btn-danger action-button float-left">Reject Request</a> 
                      <?php } ?>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("transfer");
    d.className += " active";
var d = document.getElementById("fundRequest");
    d.className += " active";
</script>
</body>
</html>
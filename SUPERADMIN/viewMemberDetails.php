<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<div class="container-fluid">
  <div class="row">
<?php
    $user_id1 = $_GET['user_id'];
$query = "SELECT * from sub_admin_user_details where user_id='$user_id1'";
$result = mysqli_query($con, $query);
$val1 = mysqli_fetch_array($result);
$member_id1 = $val1['member_id'];
$name = $val1['name'];
$user_id = $val1['user_id'];
$phone = $val1['phone'];
$date_time = $val1['date_time'];
$email_id = $val1['email_id'];
$sponser_id = $val1['sponser_id'];
$password = $val1['password'];
$trnPassword = $val1['trnPassword'];
$account_name = $val1['acName'];
$ifsc = $val1['ifsc'];
$account_number = $val1['accountNo'];
$branch = $val1['branch'];
$bank = $val1['bank'];

$result = mysqli_query($con, "SELECT * from sub_admin_user_details where member_id='$sponser_id'");
$val = mysqli_fetch_array($result);
$sponser_name = $val['name'];
$sponser_user_id = $val['user_id'];
?>
    <div class="col-sm-12 col-lg-12">
       <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
             <div class="iq-header-title">
                <h4 class="card-title">View Member Details</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                <li class="nav-item">
                   <a class="nav-link active" id="pills-home-tab-fill" data-toggle="pill" href="#profile" role="tab" aria-controls="pills-home" aria-selected="true">Profile</a>
                </li>
                <!--<li class="nav-item">-->
                <!--   <a class="nav-link " id="pills-profile-tab-fill" data-toggle="pill" href="#bank" role="tab" aria-controls="pills-profile" aria-selected="true">Bank Details</a>-->
                <!--</li>-->
                <li class="nav-item">
                   <!--<a class="nav-link " id="pills-upi-tab-fill" data-toggle="pill" href="#upi" role="tab" aria-controls="pills-upi" aria-selected="true">UPI Details</a>-->
                </li>
             </ul>
             <div class="tab-content" id="pills-tabContent-1">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="pills-home-tab-fill">
                  <form class="form-horizontal form-bordered" method="POST" action="personal-details-update">
                    <input type="hidden" name="member_id" value="<?php echo $member_id1; ?>">
                    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" >
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">User ID * :</label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" value="<?php echo $user_id; ?>" placeholder="Enter Name" disabled >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Name * :</label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" required value="<?php echo $name; ?>" name="name" placeholder="Enter Name" >
                      </div>
                    </div>  
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Phone * :</label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" value="<?php echo $phone; ?>" name="phone" readonly placeholder="Enter Phone" onkeypress="return onlynum(event)" maxlength="10" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Email ID :</label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" value="<?php echo $email_id; ?>" name="email_id" placeholder="Enter EmailID" >
                      </div>
                    </div> 
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Sponser Id * :</label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" disabled value="<?php echo $sponser_name; ?> (<?php echo $sponser_user_id; ?>)" placeholder="Enter Sponser Id" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Date of Joining * :</label>
                      <div class="col-md-6 col-sm-6">
                        <input class="form-control" disabled value="<?php echo date('d-m-Y H:i:d', strtotime($date_time)); ?>" name="date_time" >
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Login Password * :</label>
                      <div class="col-md-6 col-sm-6">
                      <input class="form-control" value="<?php echo $password; ?>" name="password" placeholder="Enter Password">
                       </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3" for="fullname1">Transaction Password * :</label>
                      <div class="col-md-6 col-sm-6">
                      <input class="form-control" value="<?php echo $trnPassword; ?>" name="trnPassword" placeholder="Enter Transaction Password">
                       </div>
                    </div>                 
                    <div class="mt-3">
                      <button class="btn btn-success" type="submit">Update</button>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="pills-profile-tab-fill">
                  <form class="form-horizontal form-bordered" method="POST" action="update-bank-details" >
                  <div class="form-group">
                    <input type="hidden" name="member_id" value="<?php echo $member_id1; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <label class="control-label col-md-3 col-sm-3" for="fullname1">Account Holder Name * :</label>
                      <div class="col-md-6 col-sm-6">
                         <input class="form-control" required="" value="<?php echo $account_name; ?>" name="account_name" placeholder="Enter Account Holder Name" required >
                      </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname1">IFSC Code * :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"  required="" value="<?php echo $ifsc; ?>" name="ifsc" placeholder="Enter IFSC Code" required >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname1">Bank Name * :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"  required="" value="<?php echo $bank; ?>" name="bank" placeholder="Enter Bank Name" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname1">Branch * :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" required="" value="<?php echo $branch; ?>" name="branch" placeholder="Enter Branch" required >
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname1">A/C No. * :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" required value="<?php echo $account_number; ?>" placeholder="Enter A/C No." name="account_number" onkeypress="return onlynum(event)" required >
                        </div>
                    </div>
                    <div class="mt-3">
                      <button class="btn btn-success" type="submit">Update</button>
                    </div>
                  </form>
                </div>
                <!--<div class="tab-pane fade" id="upi" role="tabpanel" aria-labelledby="pills-upi-tab-fill">-->
                <!--  <form class="form-horizontal form-bordered" method="POST" action="update-upi-details" >               -->
                <!--    <div class="form-group">-->
                <!--      <input type="hidden" name="member_id" value="<?php echo $member_id1; ?>">-->
                <!--      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">-->
                <!--      <label class="control-label col-md-3 col-sm-3" for="fullname1">UPI Address * :</label>-->
                <!--      <div class="col-md-6 col-sm-6">-->
                <!--            <?php
                          // $queryUpi=mysqli_query($con,"SELECT upiAddress from user_upi_address_details where member_id='$member_id1'");
                          // $valUpi=mysqli_fetch_array($queryUpi);
                          // $upi=$valUpi['upiAddress'];
?>-->
                        <!--<input class="form-control"  value="<?php echo $upi; ?>" name="upi_address" placeholder="Enter UPI Address" onkeypress="return onlynum(event)" required >-->
                <!--      </div>-->
                <!--    </div>-->
                <!--    <div class="mt-3">-->
                <!--      <button class="btn btn-success" type="submit">Update</button>-->
                <!--   </div>-->
                <!--  </form>-->
                <!--</div>-->
             </div>
          </div>
       </div>
    </div>
  </div>
  </div>
<?php include 'include/footer.php'; ?>
<script>
var d = document.getElementById("member");
    d.className += " active";
var d = document.getElementById("viewMember");
    d.className += " active";
</script>
</body>
</html>
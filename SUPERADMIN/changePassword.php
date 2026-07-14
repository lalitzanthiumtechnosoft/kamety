<!DOCTYPE html>
<html lang="en">
<?php include("login-check.php");?>
<?php include('include/head.php');
      include('include/menu.php'); 
      include('include/header.php'); ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-6 col-lg-6">
         <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
               <div class="iq-header-title">
                  <h4 class="card-title">Change Login Password</h4>
               </div>
            </div>
            <div class="iq-card-body">
               <form class="text-center" method="POST" action="changePasswordProcess" onsubmit="return confirm('Are you sure?')">
                  <fieldset>
                     <div class="form-card text-left">
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                <label>Current Password *</label>
                                <input type="password" class="form-control" required name="password" placeholder="*******">
                                <input type="hidden" name="member_id" value="<?=$member_id?>">
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <label>New Password *</label>
                                <input type="password" class="form-control" name="password1" id="loginPassword"  placeholder="*********" required >
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <label>Re-Type New Password *</label>
                                <input type="password" class="form-control" name="password2" placeholder=" *********" required >
                              </div>
                           </div>
                        </div>
                     </div>
                      <button type="submit" name="loginPassword" class="btn btn-primary action-button float-left"  >Change</button>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("changePassword");
    d.className += " active";
</script>
</body>
</html>
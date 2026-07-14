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
                  <h4 class="card-title">Update Business Plan</h4>
               </div>
            </div>
            <div class="iq-card-body">
               <form class="text-center" method="POST" action="pdfUpdateBack" enctype="multipart/form-data" >
                  <fieldset>
                     <div class="form-card text-left">
                        <div class="row">
                           <div class="col-12">
                              <h3 class="mb-4">Business Plan</h3>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                <label>Select PDF *</label>
                                <input type="file" name="pdfPath" class="form-control-file" required accept=".pdf, .PDF" />
                              </div>
                           </div>
                        </div>
                     </div>
                     <button type="submit" name="pdfUpdate" class="btn btn-primary action-button float-left" value="Submit" >Update PDF</button>
                     <button type="button" name="previous" class="btn btn-danger action-button-previous float-left ml-3" value="Reset" onclick="location.reload()">Reset</button>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("setting");
    d.className += " active";
var d = document.getElementById("pdfUpdate");
    d.className += " active";
</script>
</body>
</html>
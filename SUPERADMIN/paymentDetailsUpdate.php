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
                <h4 class="card-title">Payment Details Update</h4>
             </div>
             <a class="btn btn-success" data-id="ThisID" data-toggle="modal" data-target="#addPaymentMode" href="#" style="float:right;" ><i class="fa fa-plus"></i> Add Paymet Mode</a>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>          
                        <th>Mode Name</th>
                        <th>Payment Details</th>
                        <th>QR Code / Bank Image</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                  $count = 0;
$queryMode = mysqli_query($con, 'SELECT * from config_payment_details WHERE status=1 ORDER BY payment_id ASC');
while ($valMode = mysqli_fetch_array($queryMode)) {
    ++$count; ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $valMode['paymentName']; ?></td>
                            <td><?php echo $valMode['paymentAddress']; ?></td>
                            <td><img src="../<?php echo $valMode['paymentImage']; ?>" height="150px" width="150px" ></td>
                            <td><a onclick="deletePaymentDetails(<?php echo $valMode['payment_id']; ?>);" href="javascript:void(0)" class="btn btn-danger btn-xs"> Delete </a></td>        
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
<div class="modal fade" id="addPaymentMode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add Payment Mode </h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="addPaymentModeBack" method="post" enctype="multipart/form-data">
        <div class="modal-body">     
          <div class="form-group">
            <label class="control-label" for="inputSuccess">Mode Name * </label>
            <input class="form-control" required name="paymentName" type="text" placeholder="Mode Name ">
          </div>
          <div class="form-group">
            <label class="control-label" for="inputSuccess">Payment Details *</label>
            <textarea class="form-control" name="paymentAddress" type="text" required  placeholder="Payment Details "></textarea>
          </div>
          <div class="form-group">
            <label class="control-label" for="inputSuccess">QR Code / Bank Image </label>
            <input class="form-control" name="paymentImage" type="file" required accept=".jpg, .JPG, .png, .PNG, .jpeg, .JPEG, .gif, .GIF" >
          </div>        
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="addPaymentMode" value="Add Payment Mode">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>
<script>
function deletePaymentDetails(paymentId){
  if(paymentId!=""){
      if(confirm('Are you sure to Delete this Payment Details?')){
        $.ajax({
          type: "POST",
          url: 'ajax_calls/deletePaymentDetails',
          data: { paymentId:paymentId },
          cache: false,
          success: function(data){
               // alert(data);
             if(data){
              alert('Payment Mode Deleted Successfully');
              location.reload();
             }
          }
      });
    }
  }
}
var d = document.getElementById("setting");
    d.className += " active";
var d = document.getElementById("paymentDetailsUpdate");
    d.className += " active";
</script>
</body>
</html>
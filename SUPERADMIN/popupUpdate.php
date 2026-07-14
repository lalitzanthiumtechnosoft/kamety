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
                <h4 class="card-title">Popup Update</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>                    
                        <th>Dashboard Notice</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                  $queryConfig = mysqli_query($con, 'SELECT * from config_misc_setting');
$valConfig = mysqli_fetch_assoc($queryConfig); ?>
                      <tr>
                        <form action="popupUpdateBack" method="POST" enctype="multipart/form-data" > 
                          <td>1</td>
                          <td><img src="../<?php echo $valConfig['dashboardImage']; ?>" class="img-responsive" height="100px" width="100px"> &nbsp; <input type="file" name="dashboardImage" class="form-control-file" required accept=".jpg, .JPG, .png, .PNG, .jpeg, .JPEG, .gif, .GIF" ></td>  
                          <td class="text-center"><input type="submit" class="btn btn-success" name="imageUpdate" value="Update">
                            <?php if ($valConfig['imageStatus'] == 0) { ?>
                            <a href="javascript:void();" class="btn btn-warning" onclick="updateImageStatus(1)">Show</a>
                            <?php } else { ?>
                              <a href="javascript:void();" class="btn btn-danger" onclick="updateImageStatus(0)">Hide</a>
                            <?php } ?></td>
                        </form>
                      </tr>  
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
function updateImageStatus(imageStatus){
  $.ajax({
      type: "POST",
      url: 'ajax_calls/updateImageStatus',
      data: { imageStatus:imageStatus },
      cache: false,
      success: function(data){
         if(data){
          alert('Updated Successfully');
          location.reload();
         }
      }
  });
}
var d = document.getElementById("setting");
    d.className += " active";
var d = document.getElementById("popupUpdate");
    d.className += " active";
</script>
</body>
</html>
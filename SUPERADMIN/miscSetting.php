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
                <h4 class="card-title">MISC Setting Master</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>
                        <th>Withdraw Charge</th>
                        <th>Min Withdraw</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                  $count = 0;
$queryMisc = mysqli_query($con, 'SELECT id,withdrawCharge,minimumWithdraw FROM config_misc_setting');
while ($valMisc = mysqli_fetch_array($queryMisc)) {
    ++$count; ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $valMisc['withdrawCharge']; ?> <i class="fa fa-percent"></i></td>
                            <td> <?php echo $valMisc['minimumWithdraw']; ?></td>
                            <td><a data-id="<?php echo $valMisc['id']; ?>" data-toggle="modal" data-target="#miscEdit" data-whatever="<?php echo $valMisc['id']; ?>" href="#" data-backdrop="static" data-keyboard="false" class="btn btn-success btn-sm">Edit</a></td>        
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
<!-- Coin Rate Edit Modal -->
<div class="modal fade" id="miscEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="coinDash"></div>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>
<script>
$('#miscEdit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var miscId = recipient;
  // alert("helo");
    $.ajax({
      type: "POST",
      url: 'ajax_calls/miscAjaxFetch',
      data: { miscId : miscId },
      cache: false,
      success: function (data) {
          console.log(data);
          modal.find('.coinDash').html(data);
      },
      error: function(err) {
          console.log(err);
      }
    });  
})
var d = document.getElementById("setting");
    d.className += " active";
var d = document.getElementById("miscSetting");
    d.className += " active";
</script>
</body>
</html>
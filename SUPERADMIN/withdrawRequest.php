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
                <h4 class="card-title">Raised Withdraw Request</h4>
             </div>
          </div>
          <div class="iq-card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="font-size: 13px;">
                 <thead>
                    <tr>
                        <th>#</th> 
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Gross Amount</th>
                        <th>Withdraw Charge</th>
                        <th>Net Amount</th>
                        <th>IFSC</th>
                        <th>AccountNo</th>
                        <th>Bank</th>
                        <th>Branch</th>
                        <th>AccountName</th>
                        <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>
                    <?php
                $count = 0;
$queryRequest = mysqli_query($con, 'SELECT a.*,b.name,b.user_id,b.bank,b.ifsc,b.branch,b.account_name,b.account_number from user_wallet_withdrawal a, sub_admin_user_details b WHERE a.released=0 AND a.member_id=b.member_id ORDER BY a.date_time DESC');
while ($valRequest = mysqli_fetch_array($queryRequest)) {
    ++$count; ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valRequest['user_id']; ?></td>
                        <td><?php echo $valRequest['name']; ?></td>
                        <td class="text-left"><?php echo $valRequest['date_time']; ?></td>
                        <td> <?php echo $valRequest['amount']; ?></td>
                        <td> <?php echo $valRequest['withdrawCharge']; ?></td>
                        <td> <?php echo $valRequest['netAmount']; ?></td>
                        <td><?php echo $valRequest['ifsc']; ?></td>
                        <td><?php echo $valRequest['account_number']; ?></td>
                        <td><?php echo $valRequest['bank']; ?></td>
                        <td><?php echo $valRequest['branch']; ?></td>
                        <td><?php echo $valRequest['account_name']; ?></td>
                        <td><?php if ($valRequest['released'] == 0) { ?>
                          <a href="withdrawRequestAccept?WalletID=<?php echo $valRequest[id]; ?>" class="btn btn-primary btn-xs" onclick="return confirm('Are You Sure to Accept?');"><span>Accept</span></a>&nbsp;<a data-id="<?php echo $valRequest['id']; ?>" data-toggle="modal" data-target="#withdrawRquestCancel" data-whatever="<?php echo $valRequest['id']; ?>" href="#" class="btn btn-danger btn-xs" > Reject </a> <?php } ?>
                        </td>
                    </tr> 
                    <?php } ?>
                 </tbody>
                 </div>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add Withdrawal Payment Remark -->
<div class="modal fade" id="withdrawRquestCancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="cancelDash">
             <!-- Content goes in here -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php include 'include/footer.php'; ?>
<script> 
$('#withdrawRquestCancel').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var id = recipient;
  var actionType = 1;
  $.ajax({
    type: "POST",
    url: "ajax_calls/withdrawRequestCancel",
    data: { id: id, actionType : actionType },
    cache: false,
    success: function (data) {
      console.log(data);
      modal.find('.cancelDash').html(data);
    },
    error: function(err) {
      console.log(err);
    }
  });  
})
var d = document.getElementById("payout");
    d.className += " active";
var d = document.getElementById("withdrawRequest");
    d.className += " active";
</script>
</body>
</html>
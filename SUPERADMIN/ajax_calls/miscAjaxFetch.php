<?php
include '../../conection.php';
$miscId = $_POST['miscId'];
$queryDetails = mysqli_query($con, "SELECT id,withdrawCharge,minimumWithdraw FROM config_misc_setting WHERE id='$miscId'");
$valDetails = mysqli_fetch_array($queryDetails);
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #5d9cec; color: #ffffff;">
        <h4 class="modal-title" id="myModalLabel">MISC Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="removeModal()">x</button>
    </div>                            
    <form method="POST" action="miscSettingProcess">
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Withdraw Charge</label>
                <input type="text" class="form-control" name="withdrawCharge" value="<?php echo $valDetails['withdrawCharge']; ?>" required >
                <input type="hidden" name="miscId" value="<?php echo $miscId; ?>" readonly >
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Min Withdraw</label>
                <input type="text" class="form-control" name="minimumWithdraw" value="<?php echo $valDetails['minimumWithdraw']; ?>" required >
            </div>
       </div>
        <div class="modal-footer" style="background-color: #ff902bb5;">
            <input type="submit" name="miscUpdate" class="btn btn-success" value="Save Change">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeModal()">Close</button>
        </div>
    </form>
</div>

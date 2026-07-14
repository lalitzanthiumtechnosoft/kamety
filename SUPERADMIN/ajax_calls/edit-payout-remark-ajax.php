<?php
include '../../conection.php';
$id = $_POST['id'];

$query = mysqli_query($con, "SELECT member_id,status,remarks,amount FROM user_wallet_withdrawal WHERE id='$id'");
$val1 = mysqli_fetch_assoc($query);
$prv_remarks = $val1['remarks'];

$member_id = $val1['member_id'];
$result = mysqli_query($con, "SELECT name FROM sub_admin_user_details WHERE member_id='$member_id'");
$res = mysqli_fetch_assoc($result);
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$user_id = $_POST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Edit Remark : <?php echo $res['name']; ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>
    <form action="wallet-withdraw-status-back" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Payment Status</label>
                    <select name="status" class="form-control" required="">
                        <option value=""> -Select Paymet Status- </option>
                        <option value="1" <?php if ($val1['status'] == 1) {
                            echo 'selected';
                        } ?> > Released </option>
                        <option value="0" <?php if ($val1['status'] == 0) {
                            echo 'selected';
                        } ?> > Not-Released </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                <input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
                <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Remarks</label>
                    <input class="form-control" required="" type="text" value="<?php echo $val1['remarks']; ?>" name="remarks" >
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="edit_remark" class="btn btn-primary">Change Save</button>
        </div>
    </form>
</div>
</body>
</html>
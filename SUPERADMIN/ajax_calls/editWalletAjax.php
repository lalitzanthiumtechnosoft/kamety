<?php
include '../../conection.php';
$memberId = $_POST['memberId'];
$queryDetails = mysqli_query($con, "SELECT member_id,user_id,name,wallet,roiWallet,fundWallet FROM sub_admin_user_details WHERE member_id='$memberId'");
$valDetails = mysqli_fetch_array($queryDetails);
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
    <div class="modal-header" style="background-color: #5d9cec; color: #ffffff;">
        <h4 class="modal-title">Edit Wallet</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
    </div>
    <form action="editWalletProcess" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" name="memberId" value="<?php echo $valDetails[member_id]; ?>">
            <div class="form-group">
                <label class="control-label" for="inputSuccess">User Id :</label>
                <input type="text" class="form-control" value="<?php echo $valDetails['user_id']; ?>" readonly >
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess"> Name :</label>
                <input type="text" class="form-control" value="<?php echo $valDetails['name']; ?>" readonly >
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess"> Select Wallet :</label>
                <select class="form-control" required name="walletType">
                    <option value=""> Select Wallet </option>
                    <option value="wallet">Withdraw Wallet [ $ <?php echo $valDetails['wallet']; ?> ] </option>
                    <option value="roiWallet">Share Bonus [ $ <?php echo $valDetails['roiWallet']; ?> ] </option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess"> Select Action :</label>
                <select class="form-control" required name="actionType">
                    <option value=""> Select Action </option>
                    <option value="1">Add Wallet</option>
                    <option value="2">Deduct Wallet</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Amount *</label>
                <input type="number" class="form-control" id="actionAmount" name="actionAmount" required >
            </div>
        </div>
        <div class="modal-footer" style="background-color: #ff902bb5;">
            <input type="submit" name="editWallet" class="btn btn-primary" value="Update Now">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
</body>
</html>

<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php

date_default_timezone_set('Asia/Kolkata');
include 'loginCheck.php';
if (isset($_POST['editWallet'])) {
    $member_id = $_POST['memberId'];
    $walletType = $_POST['walletType'];
    $actionType = $_POST['actionType'];
    $actionAmount = $_POST['actionAmount'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    // Update Code Starts//

    if ($actionType == 1) {
        mysqli_query($con, 'UPDATE sub_admin_user_details SET '.$walletType.'='.$walletType."+'$actionAmount' WHERE member_id='$member_id'");
    } else {
        mysqli_query($con, 'UPDATE sub_admin_user_details SET '.$walletType.'='.$walletType."-'$actionAmount' WHERE member_id='$member_id'");
    }
    // Update Code Ends//
    echo "<script>alert('Wallet Adjusted Successfully!!!');window.top.location.href='wallet-outstanding';</script>";
} ?>
<?php include '../close-connection.php'; ?>
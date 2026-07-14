<?php

include '../../conection.php';
$memberId = $_POST['memberId'];
$blockStatus = $_POST['blockStatus'];
date_default_timezone_set('Asia/Kolkata');
$d = date('Y-m-d H:i:s');
$query = mysqli_query($con, "UPDATE sub_admin_user_details SET walletBlock='$blockStatus' WHERE member_id='$memberId'");
if ($query) {
    echo true;
// return true;
} else {
    return false;
}

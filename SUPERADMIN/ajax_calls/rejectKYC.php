<?php

include '../../conection.php';
$memberId = $_POST['memberID'];
date_default_timezone_set('Asia/Kolkata');
$d = date('Y-m-d H:i:s');
$query = mysqli_query($con, "UPDATE sub_admin_user_details SET kycUpdate=0,kycApprovedDate='$d',kycApproved=2 WHERE member_id='$memberId'");
if ($query) {
    echo true;
} else {
    return false;
}

<?php

include '../../conection.php';
$memberId = $_POST['memberID'];
date_default_timezone_set('Asia/Kolkata');
$d = date('Y-m-d H:i:s');
$query = mysqli_query($con, "UPDATE sub_admin_user_details SET kycApproved=1,kycApprovedDate='$d' WHERE member_id='$memberId'");
if ($query) {
    echo true;
// return true;
} else {
    return false;
}

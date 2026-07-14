<?php

include '../../conection.php';
date_default_timezone_set('Asia/Kolkata');
$memberId = $_POST['memberId'];
$query = mysqli_query($con, "UPDATE sub_admin_user_details SET account_status=1 WHERE member_id='$memberId'");
if ($query) {
    echo '1';

    return true;
} else {
    return false;
}

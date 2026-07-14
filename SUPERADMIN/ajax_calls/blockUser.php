<?php

include '../../conection.php';
$memberId = $_POST['memberId'];
date_default_timezone_set('Asia/Kolkata');
$d = date('Y-m-d H:i:s');
$query = mysqli_query($con, "UPDATE sub_admin_user_details SET account_status=0,blockDate='$d' WHERE member_id='$memberId'");

if ($query) {
    echo '1';

    return true;
} else {
    return false;
}

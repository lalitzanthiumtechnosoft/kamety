<?php

include '../../conection.php';
$memberId = $_POST['memberId'];
$blockStatus = $_POST['blockStatus'];
$query = mysqli_query($con, "UPDATE sub_admin_user_details SET account_status='$blockStatus' WHERE member_id='$memberId'");
if ($query) {
    echo true;
// return true;
} else {
    return false;
}

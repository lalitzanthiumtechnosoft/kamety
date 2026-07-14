<?php
error_reporting(0);
error_reporting(E_ALL);
include '../conection.php';
$userId = mysqli_real_escape_string($con, $_SESSION['member_user_id']);
$passKey = mysqli_real_escape_string($con, $_SESSION['member_password']);
$result = mysqli_query($con, "SELECT * FROM sub_admin_user_details WHERE user_id='$userId' AND password='$passKey ' AND user_type=2 AND account_status=1");
$count = mysqli_num_rows($result);
if ($count == 0) { ?>
<script>
window.top.location.href = "LoginAuth";
</script>
<?php
    exit;
} ?>
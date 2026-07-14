<?php

error_reporting(0);
session_start();
$user_id = $_SESSION['admin_user_id'];
$password = $_SESSION['admin_password'];
$newPass = md5($password);
include '../conection.php';

$result = mysqli_query($con, "SELECT * FROM sub_admin_user_details WHERE user_id='$user_id' AND password='$password' AND user_type=1");
$count = mysqli_num_rows($result);
if ($count == 0) { ?>
	<script>
	 	window.top.location.href="index";
	</script>
	<?php
    exit;
}
?>

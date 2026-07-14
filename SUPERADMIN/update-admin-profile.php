<?php

ob_start();

error_reporting(E_ALL ^ E_NOTICE);

include 'login-check.php';
$member_id = $_POST['member_id'];
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email_id = $_POST['email_id'];

$result1 = mysqli_query($con, "UPDATE sub_admin_user_details set name='$name',phone='$phone',email_id='$email_id' where member_id='$member_id'");

if ($result1) { ?>
     <script>
	    alert("Profile Updated Successfully");
    	window.top.location.href='admin-profile';
     </script>
     <?php
} else { ?>
 	<script>
	    alert("Profile Not-Updated...Try Again");
    	window.top.location.href='admin-profile';
     </script>
     <?php
}
?>
<?php include '../close-connection.php'; ?>
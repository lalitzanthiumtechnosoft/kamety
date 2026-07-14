<?php

ob_start();

error_reporting(E_ALL ^ E_NOTICE);

include 'login-check.php';
$member_id = $_POST['member_id'];
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$email_id = $_POST['email_id'];
$password = $_POST['password'];
$trnPassword = $_POST['trnPassword'];

$result1 = mysqli_query($con, "UPDATE sub_admin_user_details SET name='$name',email_id='$email_id',password='$password',trnPassword='$trnPassword' WHERE member_id='$member_id'");
if ($result1) { ?>
    <script>
	    alert("Profile Updated Successfully");
    	window.top.location.href='viewMemberDetails?user_id=<?php echo $user_id; ?>';
    </script>
    <?php
} else { ?>
 	<script>
	    alert("Profile Not-Updated...Try Again");
    	window.top.location.href='viewMemberDetails?user_id=<?php echo $user_id; ?>';
    </script>
    <?php
}
?>
<?php include '../close-connection.php'; ?>
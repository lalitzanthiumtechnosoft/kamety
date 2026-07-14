<?php

ob_start();

error_reporting(E_ALL ^ E_NOTICE);
include 'login-check.php';
require '../PHPMailer/EncrptyModel.php';
if (isset($_POST['loginPassword'])) {
    $member_id = $_POST['member_id'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password2 != $password1) { ?>

		<script>
		alert("New passwords do not match!!!");
		window.top.location.href='changePassword';
		</script>
		<?php
        exit;
    }
    $newCalObj = new passEncrypt();
    $encPass = $newCalObj->twoPassEncrypt($password);
    $result = mysqli_query($con, "SELECT count(*) from sub_admin_user_details where member_id= '$member_id' and password='encPass' AND user_type=1");
    $val = mysqli_fetch_array($result);

    $newCalObj = new passEncrypt();
    $newEncPass = $newCalObj->twoPassEncrypt($password1);
    $result1 = mysqli_query($con, "UPDATE sub_admin_user_details set password='$newEncPass' where member_id='$member_id' AND user_type=1");
    if ($result1) { ?>
	    <script>
	     alert("Login Password Updated Successfully!!!\nNow please login again with new password. ");
	     window.top.location.href='changePassword';
	    </script>
	     <?php
    }
}
if (isset($_POST['trnPassword'])) {
    $member_id = $_POST['member_id'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password2 != $password1) { ?>

		<script>
		alert("New passwords do not match!!!");
		window.top.location.href='changePassword';
		</script>
		<?php
        exit;
    }
    $newCalObj1 = new passEncrypt();
    $encTrnPass = $newCalObj1->twoPassEncrypt($trnPassword);
    $result = mysqli_query($con, "SELECT count(*) from sub_admin_user_details where member_id= '$member_id' and transaction_password='$encTrnPass' AND user_type=1");
    $val = mysqli_fetch_array($result);
    if ($val[0] == 0) {  ?>
		<script>
	     alert("Incorrect Current Transaction Password!!!");
		 window.top.location.href='changePassword';
		</script>
		<?php
        exit;
    }
    $newCalObj1 = new passEncrypt();
    $newencTrnPass = $newCalObj1->twoPassEncrypt($trnPassword1);
    $result1 = mysqli_query($con, "UPDATE sub_admin_user_details set transaction_password='$newencTrnPass' where member_id='$member_id' AND user_type=1");
    if ($result1) { ?>
	    <script>
	     alert("Transaction Password Updated Successfully!!!");
	     window.top.location.href='changePassword';
	    </script>
	     <?php
    }
}
?>
<?php include '../close-connection.php'; ?>
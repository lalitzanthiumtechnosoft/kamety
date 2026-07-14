<?php

ob_start();

error_reporting(E_ALL ^ E_NOTICE);

include 'login-check.php';
$member_id = $_POST['member_id'];
$user_id = $_POST['user_id'];
$acName = $_POST['account_name'];
$ifsc = $_POST['ifsc'];
$bank = $_POST['bank'];
$branch = $_POST['branch'];
$accountNo = $_POST['account_number'];

$result1 = mysqli_query($con, "UPDATE sub_admin_user_details SET acName='$acName',ifsc='$ifsc',bank='$bank',branch='$branch',accountNo='$accountNo' WHERE member_id='$member_id'");
if ($result1) { ?>
    <script>
	    alert("Bank Details Updated Successfully");
    	window.top.location.href='viewMemberDetails?user_id=<?php echo $user_id; ?>';
    </script>
    <?php
} else { ?>
 	<script>
	    alert("Bank Details Not-Updated...Try Again");
    	window.top.location.href='viewMemberDetails?user_id=<?php echo $user_id; ?>';
    </script>
    <?php
}
?>
<?php include '../close-connection.php'; ?>
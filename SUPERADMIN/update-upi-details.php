<?php 

ob_start();

error_reporting(E_ALL ^ E_NOTICE);

include("login-check.php");
$member_id=$_POST['member_id'];
$user_id=$_POST['user_id'];
$upiAddress=$_POST['upi_address'];


$result1=mysqli_query($con,"UPDATE user_upi_address_details SET upiAddress='$upiAddress' WHERE member_id='$member_id'");
if($result1) { ?>
    <script>
	    alert("UPI Address Updated Successfully");
    	window.top.location.href='viewMemberDetails?user_id=<?=$user_id;?>';
    </script>
    <?php
}else{ ?>
 	<script>
	    alert("UPI Address Not-Updated...Try Again");
    	window.top.location.href='viewMemberDetails?user_id=<?=$user_id;?>';
    </script>
    <?php
 } 
?>
<?php include("../close-connection.php"); ?>